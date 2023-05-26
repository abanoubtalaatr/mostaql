<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Pusher\Pusher;

class Chat extends Component
{
    use WithFileUploads;

    public $message;
    public $messages = [];
    public $receiver;
    public $users;
    public $lastMessage = '';
    public $file;

    public function mount()
    {
        $this->receiver = User::find(request()->query('chat'));

        $userId = \auth()->id();
        $this->users = User::joinSub(function ($query) use ($userId) {
            $query->selectRaw('distinct case when sender_id <> ? then sender_id else receiver_id end as user_id', [$userId])
                ->from('chats')
                ->where('sender_id', '=', $userId)
                ->orWhere('receiver_id', '=', $userId);
        }, 'chats', function ($join) {
            $join->on('users.id', '=', 'chats.user_id');
        })->get();


    }

    public function send()
    {
        $this->validate();

        if (isset($this->file)) {
            $this->file = $this->file->storeAs(date('Y/m/d'), Str::random(50) . '.' . $this->file->extension(), 'public');
        }

        if (!$this->receiver) {
            $this->addError('receiver', 'برجاء اختيار عضو لبدء المجادثه.');
            return;
        }
        $message = new \App\Models\Chat();
        $message->sender_id = Auth::id();
        $message->receiver_id = $this->receiver->id;
        $message->message = $this->message;
        $message->file = $this->file;

        $message->save();

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true
            ]
        );

        $data = [
            'message' => $message->load('sender', 'receiver')
        ];


        $pusher->trigger('chat', "message$message->receiver_id", $data);

        $this->message = '';
        $this->file = '';
    }

    public function getListeners()
    {
        return [
            'messageReceived' => 'addMessage'
        ];
    }

    public function addMessage($message)
    {
        $this->messages[] = $message;
    }

    protected function rules()
    {
        return [
            'message' => 'required',
            'file' => 'nullable',
        ];
    }

    public function setReceiver($receiverId)
    {
        $this->receiver = User::find($receiverId);
        $this->removeError();
    }

    public function removeError()
    {
        $this->resetErrorBag('receiver');
    }

    public function render()
    {
        if ($this->receiver) {
            $this->messages = \App\Models\Chat::with(['sender', 'receiver'])
                ->where(function ($query) {
                    $query->where('sender_id', Auth::id())
                        ->where('receiver_id', $this->receiver->id);
                })
                ->orWhere(function ($query) {
                    $query->where('sender_id', $this->receiver->id)
                        ->where('receiver_id', Auth::id());
                })
                ->orderBy('created_at', 'asc')
                ->get()->toArray();


        }

        $messages = $this->messages;
        $users = $this->users;

        return view('livewire.user.chat', compact('messages', 'users'))->layout('layouts.front');
    }
}
