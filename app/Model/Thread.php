<?php
/**
 * Created by PhpStorm.
 * User: Awsaf
 * Date: 3/18/2017
 * Time: 7:55 PM
 */

namespace App\Model;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Models;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread as MainThread;
use Illuminate\Support\Facades\Auth;

class Thread extends MainThread
{
    public function recipient()
    {
        return $this->hasOne(Models::classname(Participant::class), 'thread_id', 'id')->where('user_id', '!=', Auth::user()->id);
    }
}