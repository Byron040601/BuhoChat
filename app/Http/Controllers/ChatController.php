<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index($id)
    {

        return Chat::all()->where('user_id_1','=',$id);
    }

    public function show($id)
    {
        return Chat::find($id);
    }
    public function store(Request $request)
    {

        return Chat::create($request->all());
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'lastMessage' => 'required|string',

        ]);
        $chat = Chat::findOrFail($id);
        $chat->update($request->all());
        return $chat;
    }
    public function delete(Request $request, $id)
    {
        $chat = Chat::findOrFail($id);
        $chat->delete();
        return 204;
    }

    public function messages(Chat $chat){

        return response()->json($chat->message, 201);
    }
}
