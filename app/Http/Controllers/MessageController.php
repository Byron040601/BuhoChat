<?php

namespace App\Http\Controllers;

use App\Mail\NewComment;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{

    public function index(Message $message)
    {
        return Message::all();
    }

    public function show(Message $message)
    {
        return $message;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'text' => 'required|string',
            'chat_id' => 'required'
        ]);
        $message = Message::create($validatedData);
        Mail::to($message->user)->send(new NewComment($message));
        return response()->json($message, 201);
    }

    public function delete(Message $message)
    {
        $message->delete();
        return response()->json(null, 204);
    }
}
