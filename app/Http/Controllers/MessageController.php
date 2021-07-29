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
            'text' => 'nullable|string',
            'chat_id' => 'required',
            'image' => 'nullable|image',
        ]);
        $message = Message::create($validatedData);
        Mail::to($message->user)->send(new NewComment($message));

        if(!is_null($request->image)) {
            $path = $request->image->store('public/messages');
            $message->image = $path;
            $message->save();
        }

        return response()->json($message, 201);
    }

    public function delete(Message $message)
    {
        $message->delete();
        return response()->json(null, 204);
    }
}
