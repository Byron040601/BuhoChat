<?php

namespace App\Http\Controllers;

use App\Mail\NewComment;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{

    public function index(Message $message)
    {
        $messagesO = Message::all();
        $messages = [];

        foreach ($messagesO as $message){
            if($message->user_id === auth()->user()->id || $message->user_id_2 === auth()->user()->id){
                $messages[] = $message;
            }
        }

        return response()->json($messages, 200);
    }

    public function show(Message $message)
    {
        $this->authorize('view', $message);
        return $message;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'text' => 'nullable|string',
            'chat_id' => 'required|exists:App\Models\Chat,id',
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
        $this->authorize('delete', $message);
        $message->delete();
        return 204;
    }
}
