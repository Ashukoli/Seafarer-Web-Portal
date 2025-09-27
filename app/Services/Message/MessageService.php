<?php

namespace App\Services\Message;

use App\Models\Message;

class MessageService
{
    // Get all conversations for the user (grouped by receiver)
    public function getConversations($user)
    {
        return Message::where(function($q) use ($user) {
                $q->where('sender_id', $user->id)
                  ->where('sender_type', $user->getTable());
            })
            ->orWhere(function($q) use ($user) {
                $q->where('receiver_id', $user->id)
                  ->where('receiver_type', $user->getTable());
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function($msg) use ($user) {
                // Group by the other party
                if ($msg->sender_id == $user->id && $msg->sender_type == $user->getTable()) {
                    return $msg->receiver_type . ':' . $msg->receiver_id;
                }
                return $msg->sender_type . ':' . $msg->sender_id;
            });
    }

    // Get messages between user and another party
    public function getMessages($user, $withId, $withType)
    {
        return Message::where(function($q) use ($user, $withId, $withType) {
                $q->where('sender_id', $user->id)
                  ->where('sender_type', $user->getTable())
                  ->where('receiver_id', $withId)
                  ->where('receiver_type', $withType);
            })
            ->orWhere(function($q) use ($user, $withId, $withType) {
                $q->where('sender_id', $withId)
                  ->where('sender_type', $withType)
                  ->where('receiver_id', $user->id)
                  ->where('receiver_type', $user->getTable());
            })
            ->orderBy('created_at', 'asc')
            ->get();
    }

    // Send a message
    public function sendMessage($user, $receiverId, $receiverType, $messageText)
    {
        return Message::create([
            'sender_id' => $user->id,
            'sender_type' => $user->getTable(),
            'receiver_id' => $receiverId,
            'receiver_type' => $receiverType,
            'message' => $messageText,
            'is_read' => false,
        ]);
    }
}
