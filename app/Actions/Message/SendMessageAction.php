<?php

namespace App\Actions\Message;

use App\Events\MessageSent;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;

class SendMessageAction
{
    /**
     * Stores a new message in the given conversation from the given sender.
     *
     * @param Conversation $conversation The conversation the message belongs to.
     * @param User $sender The user sending the message.
     * @param string $body The message text content.
     * @return Message The newly created message instance.
     */
    public function execute(Conversation $conversation, User $sender, string $body): Message
    {
        $message = $conversation->messages()->create([
            'sender_id' => $sender->id,
            'body'      => $body,
        ]);

        $message->load('sender');
        broadcast(new MessageSent($message));

        return $message;
    }
}
