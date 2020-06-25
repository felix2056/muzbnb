<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\Message;

class Conversation extends Model
{
    protected $fillable = ['first_user_id', 'second_user_id'];

    public $appends = ['last_message', 'has_unread'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'first_user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'second_user_id');
    }

    public function hasAccepted()
    {
        foreach ($this->messages as $message) {
            if ($message->seen === 0 && ($message->user_id !== \Auth::user()->id)) return true;
        }
        return false;
    }

    public function getHasUnreadAttribute()
    {
        foreach ($this->messages as $message) {
            if ($message->seen === 0 && ($message->user_id !== \Auth::user()->id)) return $message->count();
        }

        return false;
    }

    public function getLastMessageAttribute()
    {
        return $this->messages()->orderBy('created_at', 'DESC')->take(1)->get();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
