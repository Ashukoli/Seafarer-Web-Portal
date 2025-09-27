<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Message\MessageService;

class MessageController extends Controller
{
    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    // Show the messaging view
    public function index(Request $request)
    {
        $user = $request->user('company');
        $conversations = $this->messageService->getConversations($user);
        return view('company.messages.index', compact('conversations'));
    }

    // Fetch messages for a conversation (AJAX)
    public function fetch(Request $request)
    {
        $user = $request->user('company');
        $withId = $request->input('with_id');
        $withType = $request->input('with_type');
        $messages = $this->messageService->getMessages($user, $withId, $withType);
        return response()->json($messages);
    }

    // Send a message (AJAX)
    public function send(Request $request)
    {
        $user = $request->user('company');
        $data = $request->validate([
            'receiver_id' => 'required|integer',
            'receiver_type' => 'required|string',
            'message' => 'required|string|max:1000',
        ]);
        $message = $this->messageService->sendMessage($user, $data['receiver_id'], $data['receiver_type'], $data['message']);
        return response()->json($message);
    }
}
