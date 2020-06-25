<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\Conversation;
use App\User;

class Message extends Model
{
    protected $fillable = ['user_id', 'conversation_id', 'body', 'seen'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}
