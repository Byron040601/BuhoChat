<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return Chat::all();
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
}
