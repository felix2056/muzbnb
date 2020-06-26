<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Events\NewMessage;
use Redis;
use App\User;
use Carbon\Carbon;
// use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use App\Model\Thread;
use App\Model\Notification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Model\Conversation;
use App\Model\Message;

use App\Notifications\YouHaveNewMessage;

class MessagesController extends Controller
{
    private function getHash($id = null)
    {
        if (!$id) {
            $id = Auth::user()->id;
        }
        return 'usth' . md5('muz' . $id);
    }
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        $hash = $this->getHash();
        $username = Auth::user()->first_name;

        return view('chat', compact('threads', 'hash', 'username'));
    }

    /**
     * provides message sections data
     *  
     * @return mixed
     */
    public function data(Request $request)
    {
        if ($this->getHash() !== $request->get('h')) {
            return;
        }
        $t = $request->get('t');
        if ($t) {
            $start = $request->get('s');
            $thread = Thread::with('recipient.user')->latest('updated_at')->offset($start)->limit(20)->findOrFail($t);
            $data['messages'] = [];
            $data['threadId'] = $t;
            if (count($thread->messages())) {
                foreach ($thread->messages as $m) {
                    $data['messages'][] = [
                        'user' => $m->user->first_name,
                        'user_img' => $m->user->photo('a'),
                        'user_id' => $m->user->id,
                        'body' => $m->body,
                        'time' => strtotime($m->updated_at)
                    ];
                }
            }
        } else {
            // All threads, ignore deleted/archived participants
            $archiveId = (int) $request->archiveId;
            $trashId = (int) $request->trashId;
            $restoreId = (int) $request->restoreId;
            if ($archiveId) {
                $t = Thread::findOrFail($archiveId);
                $participent = $t->getParticipantFromUser(auth()->id());
                $participent->status = 3;
                $participent->save();
            }
            if ($trashId) {
                $t = Thread::findOrFail($trashId);
                $participent = $t->getParticipantFromUser(auth()->id());
                $participent->status = 2;
                $participent->save();
            }
            if ($restoreId) {
                $t = Thread::findOrFail($restoreId);
                $participent = $t->getParticipantFromUser(auth()->id());
                $participent->status = 1;
                $participent->save();
            }
            $type = (int) $request->type;
            if ($type == 4) {
                $allThread = Thread::forUser(Auth::user()->id)->with('recipient.user')->where('participants.unread', true)->latest('updated_at')->get();
            } elseif ($type > 1 && $type < 4) {
                $allThread = Thread::forUser(Auth::user()->id)->with('recipient.user')->where('participants.status', $type)->latest('updated_at')->get();
            } else {
                $allThread = Thread::forUser(Auth::user()->id)->with('recipient.user')->where('participants.status', 1)->latest('updated_at')->get();
            }
            $data['threads'] = [];
            $data['threadId'] = 0;
            $data['messages'] = [];
            //        messages = [];
            if (isset($allThread[0])) {
                $data['threadId'] = $allThread[0]->id;
                foreach ($allThread as $t) {
                    if ($t->messages->first()) {
                        $message = $t->messages[0]->body;
                    } else {
                        $message = '';
                    }
                    $data['threads'][] = [
                        'id' => $t->id,
                        'name' => $t->recipient->user->first_name,
                        'user_img' => $t->recipient->user->photo('a'),
                        'lastMessage' => $message,
                        'time' => strtotime($t->updated_at)
                    ];
                }
                if ($allThread[0]->messages->first()) {
                    foreach ($allThread[0]->messages as $m) {
                        $data['messages'][] = [
                            'user' => $m->user->first_name,
                            'user_img' => $m->user->photo('a'),
                            'user_id' => $m->user->id,
                            'body' => $m->body,
                            'time' => strtotime($m->created_at)
                        ];
                    }
                }
            }
        }
        return $data;
    }

    /**
     * Stores a new message.
     *
     * @return mixed
     */
    public function newMessage()
    {
        $input = Input::all();
        $threadId = (int) $input['t'];
        try {
            $thread = Thread::with('recipient.user')->findOrFail($threadId);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $threadId . ' was not found.');

            echo 'Not Found!';
            exit;
        }

        $thread->updated_at = new Carbon;
        $thread->save();
        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => (string) $input['m'],
            ]
        );
        Notification::addNew($thread->recipient->user_id, 'You have COUNT new message', '/dashboard/messages?t=' . $thread->id, 'NewMessage', 1, true);
        $thread->recipient->unread = true;
        $thread->recipient->save();
        /* Publishes a redis event  */
        Redis::publish('chat', json_encode([
            'hash' => $this->getHash($thread->recipient->user_id),
            'data' => [
                'message' => [
                    'body' => (string) $input['m'],
                    'user' => Auth::user()->first_name,
                    'user_img' => Auth::user()->photo('a'),
                    'user_id' => Auth::user()->id,
                    'time' => time()
                ],
                'thread' => [
                    'id' => $thread->id,
                    'name' => $thread->recipient->user->first_name,
                    'lastMessage' => (string) $input['m'],
                    'time' => time()
                ]
            ],
        ]));
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function newThread($id, Request $request)
    {
        User::findOrFail($id);

        if ($id == auth()->user()->id) {
            return redirect('dashboard/messages');
        }
        foreach (auth()->user()->threads as $thread) {
            if ($thread->recipient->user->id == $id) {
                $thread->updated_at = new Carbon;
                $thread->save();
                return redirect('dashboard/messages');
            }
        }
        $thread = Thread::create(
            [
                'subject' => 'User To User',
            ]
        );

        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'last_read' => new Carbon,
            ]
        );

        // Recipients
        //        if (Input::has('recipient')) {
        //            $thread->addParticipant($input['recipient']);
        //        }
        $thread->addParticipant($id);

        return redirect('dashboard/messages');
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect('messages');
        }

        $thread->activateAllParticipants();

        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::id(),
                'body'      => Input::get('message'),
            ]
        );

        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
            ]
        );
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant(Input::get('recipients'));
        }

        return redirect('messages/' . $id);
    }

    public function getConversations()
    {
        $user = User::find(Auth::user()->id);

        $conversations = [];

        $receiver_conversations = Conversation::where('second_user_id', $user->id)
            ->latest()
            ->get();

        if (count($receiver_conversations)) {
            foreach ($receiver_conversations as $convo) {
                $convo['person'] = User::find($convo->first_user_id);
                $convo['person']['avatar'] = $convo['person']->photo();
            }
        }

        $sender_conversations = Conversation::where('first_user_id', $user->id)
            ->latest()
            ->get();

        if (count($sender_conversations)) {
            foreach ($sender_conversations as $convo) {
                $convo['person'] = User::find($convo->second_user_id);
                $convo['person']['avatar'] = $convo['person']->photo();
            }
        }

        $conversations = array_merge($receiver_conversations->toArray(), $sender_conversations->toArray());

        return response()->json(['conversations' => $conversations]);
    }

    public function fetchConvoMessages($conversation_id)
    {
        $conversation = Conversation::find($conversation_id);
        $messages = $conversation->messages;

        foreach ($messages as $message) {
            if ($message->seen === 0 && ($message->user_id !== \Auth::user()->id)) {
                $message->seen = 1;
                $message->save();
            }

            $message['user'] = User::find($message->user_id);
        }

        return response()->json(['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = User::find(Auth::user()->id);
        $otherUser = User::find($request->user_id);

        $body = $request->message;

        $conversation = Conversation::where(function ($query) use ($user, $otherUser) {
            $query->where('first_user_id', $user->id)->where('second_user_id', $otherUser->id);
        })->orWhere(function ($query) use ($user, $otherUser) {
            $query->where('first_user_id', $otherUser->id)->where('second_user_id', $user->id);
        })->first();


        if (!$conversation) {
            $conversation = new Conversation;

            $conversation->first_user_id = $user->id;
            $conversation->second_user_id = $otherUser->id;
            $conversation->save();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imagename = time() . '_' . $user->id . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('/chat_images/', $imagename);

            if ($path) {
                $body = $body . "\r\n" . "<br><img src='/chat_images/$imagename' style='width: 100%;' />";
            }
        }


        // $message = $conversation->messages()->create([
        //     'user_id' => $user->id,
        //     'body' => $body
        // ]);

        $message = new Message();
        $message->user_id = $user->id;
        $message->conversation_id = $conversation->id;
        $message->body = $body;
        $message->save();

        // $data = [];
        // $data['user'] = $user;
        // $data['message'] = Message::find($message->id);
        // $otherUser->notify(new YouHaveNewMessage($data));

        broadcast(new NewMessage($message->with('user')->find($message->id)))->toOthers();

        return response()->json([
            'message' => $message->with('user')->find($message->id)
        ], 200);
    }
}
