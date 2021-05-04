<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use App\Events\NewMessageConversation;
use App\Events\NewMessageUser;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        //$user->withCount('Conversations.unreadMessages');
        $user->load(['conversations' => function($query) {
            $query->withCount('unreadMessages');
        },
        'conversations.latestMessage',
        'conversations.users' => function($query) {
                    $query->where('user_id', '!=', Auth::id());
        }]);

        return response()->json($user);
    }

    public function countConversationsWithUnreadMessages()
    {
        $conversationsWithUnread = 0;

        $user = User::where('id', Auth::id())
                    ->with(['conversations' => function($query) {
                        $query->withCount('unreadMessages');
                    }])
                    ->first();

        foreach($user->conversations as $conversation) {
            if($conversation->unread_messages_count) {
                $conversationsWithUnread++;
            }
        }

        return response()->json([
            'conversations_with_unread' => $conversationsWithUnread
        ]);
    }

    // public function try()
    // {
    //     $conv = Conversation::where('id',5)
    //                 ->whereHas('Users', function($q) {
    //                     $q->where('user_id', 2);
    //                 })
    //                 ->first()
    //                 ->id;
    //     return response()->json($conv);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!isset($request->conversation_id)) {
            $conversation = Conversation::create();

            // Adds the values within the array to the pivot table (user_conversations)
            $conversation->users()->sync([Auth::id(), $request->to_user_id]);

            $conversation_id = $conversation->id;
        }
        else {
            $conversation_id = $request->conversation_id;
        }

        $message = Message::create([
            'conversation_id'   => $conversation_id,
            'from_user_id'      => Auth::id(),
            'message'           => $request->message,
            'is_read'           => false
        ]);

        $conversation = Conversation::find($conversation_id);
        $conversation->updated_at = Carbon::now();
        $conversation->save();

        if(!isset($message->id)) {
            return response()->json([
                'message' => 'Message sending failed.'
            ]);
        }

        $message = Message::where('id', $message->id)
                    ->with(['user'=> function($query) {
                        $query->select('id', 'firstname', 'lastname', 'profile_picture_url');
                    }])
                    ->first();

        $message->to_user_id = $request->to_user_id;

        broadcast(new NewMessageConversation($message))->toOthers();
        broadcast(new NewMessageUser($message))->toOthers();

        return response()->json($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $messages = Conversation::where('id', $id)
                        ->whereHas('users', function($q){
                            $q->where('user_id', Auth::id());
                        })
                        ->first();
                        
        $messages->load(['messages.user' => function($query) {
            $query->select('id', 'firstname', 'lastname', 'profile_picture_url');
        }]);

        return response()->json($messages);
    }

    public function showConversationWithUser($id) {
        $conversation = Conversation::whereHas('users', function($q) {
                            $q->where('user_id', Auth::id());
                        })->whereHas('users', function($q) use ($id) {
                            $q->where('user_id', $id);
                        })->first();

        return response()->json($conversation);
    }

    public function markMessagesAsRead(Request $request, $id) {
        $messages = Message::where('conversation_id', $id)
                        ->where('from_user_id', $request->from_user_id)
                        ->update(['is_read' => 1]);

        return response()->json([
            'message' => 'Marked messages as read.'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
