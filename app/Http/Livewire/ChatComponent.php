<?php

namespace App\Http\Livewire;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Pusher\Pusher;

class ChatComponent extends Component
{

    public $messages = [];
    public $newMessage;
    public $receiver;

    public function mount($receiver)
    {
        $this->receiver = User::find(2);

    }

    public function sendMessage()
    {

    }

    public function render()
    {
        $this->messages = Chat::with(['sender', 'receiver'])
            ->where(function ($query) {
                $query->where('sender_id', Auth::id())
                    ->where('receiver_id', $this->receiver->id);
            })
            ->orWhere(function ($query) {
                $query->where('sender_id', $this->receiver->id)
                    ->where('receiver_id', Auth::id());
            })
            ->latest()
            ->take(50)
            ->get();

        return view('livewire.chat-component', [
            'messages' => $this->messages,
            'receiver' => $this->receiver,
        ]);
    }
}
