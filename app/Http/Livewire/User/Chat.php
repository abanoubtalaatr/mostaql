<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Pusher\Pusher;

class Chat extends Component
{

    public $message;
    public $messages = [];
    public $receiver;
    public $users;

    public function mount()
    {

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

        $message = new \App\Models\Chat();
        $message->sender_id = Auth::id();
        $message->receiver_id = $this->receiver->id;
        $message->message = $this->message;

        $message->save();
        $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,
        ]);

        $this->messages[] = $message;
        $this->message = '';
    }

    protected function rules()
    {
        return [
            'message' => 'required',
        ];
    }

    public function setReceiver($receiverId)
    {
        $this->receiver = User::find($receiverId);
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
