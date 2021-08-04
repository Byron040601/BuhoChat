<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $chatsO = Chat::all();
        $chats = [];

        foreach ($chatsO as $chat){
            if($chat->user_id_1 === auth()->user()->id || $chat->user_id_2 === auth()->user()->id){
                $chats[] = $chat;
            }
        }

        return response()->json($chats, 200);
    }

    public function show(Chat $chat)
    {
        $this->authorize('view', $chat);
        return Chat::find($chat->id);
    }

    public function store(Request $request)
    {
        return Chat::create($request->all());
    }

    public function update(Request $request, Chat $chat)
    {
        $this->authorize('update', $chat);
        $request->validate([
            'lastMessage' => 'required|string',

        ]);
        $chat->update($request->all());
        return $chat;
    }

    public function delete(Request $request, Chat $chat)
    {
        $this->authorize('delete', $chat);
        $chat->delete();
        return 204;
    }

    public function messages(Chat $chat){
        $this->authorize('view', $chat);
        return response()->json($chat->message, 201);
    }
}
