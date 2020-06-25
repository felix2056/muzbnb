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
use Cmgmyr\Messenger\Models\Participant as MainParticipant;
use Illuminate\Support\Facades\Auth;

class Participant extends MainParticipant
{
    protected $fillable = ['thread_id', 'user_id', 'last_read', 'status', 'unread'];
}