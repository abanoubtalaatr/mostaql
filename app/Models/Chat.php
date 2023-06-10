<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function scopeUnreadForUser($query, User $user)
    {
        return $query->where(function ($query) use ($user) {
            $query->where('receiver_id', $user->id)
                ->whereNull('receiver_read_at');
        })->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->whereNull('sender_read_at');
        });
    }

    public static function unRead($sender_id, $receiver_id)
    {
        return Chat::where('sender_id', $sender_id)
            ->where('receiver_id', $receiver_id)
            ->whereNull('receiver_read_at')
            ->count();
    }

    public static function unReadByConversation()
    {
        return Chat::where('receiver_id', auth()->id())
            ->whereNull('receiver_read_at')
            ->groupBy('sender_id', 'receiver_id')
            ->selectRaw('count(*) as un_read_count')
            ->get()
            ->count();
    }
}
