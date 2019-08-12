<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Conversation;
use App\Message;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(1);
        $user->load('Conversations.Users');

        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($request->conversation_id) == null) {
            $conversation = Conversation::create();

            $conversation->Users()->sync([$request->from_user_id, $request->to_user_id]);

            $conversation->id = $conversation->id;
        }
        else {
            $conversation_id = $request->conversation_id;
        }

        $message = Message::create([
            'conversation_id' => $conversation_id,
            'from_user_id' => $request->from_user_id,
            'message' => $request->message,
            'is_read' => false
        ]);
        
        if(!isset($message->id)) {
            return response()->json([
                'message' => 'Message sending failed.'
            ]);
        }

        return response()->json([
            'message' => 'Message sent.'
        ]); 
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
                        ->whereHas('Users', function($q){
                            $q->where('user_id', 1);
                        })
                        ->get();
        $messages->load('Messages');

        return response()->json($messages);
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
