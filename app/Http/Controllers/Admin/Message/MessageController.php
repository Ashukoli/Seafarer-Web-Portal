<?php

namespace App\Http\Controllers\Admin\Message;

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
        $user = $request->user();
        $conversations = $this->messageService->getConversations($user);
        return view('admin.messages.index', compact('conversations'));
    }

    // Fetch messages for a conversation (AJAX)
    public function fetch(Request $request)
    {
        $admin = $request->user('admin');
        $withId = $request->input('with_id');
        $withType = $request->input('with_type');
        $messages = $this->messageService->getMessages($admin, $withId, $withType);
        return response()->json(['success' => true, 'messages' => $messages]);
    }

    // Send a message (AJAX)
    public function send(Request $request)
    {
        $admin = $request->user('admin');
        $data = $request->validate([
            'receiver_id' => 'required',
            'receiver_type' => 'required|string',
            'message' => 'required|string|max:1000',
        ]);
        $message = $this->messageService->sendMessage($admin, $data['receiver_id'], $data['receiver_type'], $data['message']);
        return response()->json(['success' => true, 'message' => $message]);
    }
}
