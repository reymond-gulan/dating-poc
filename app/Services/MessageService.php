<?php

namespace App\Services;

use App\Actions\Message\SendMessageAction;
use App\Events\MessagesRead;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;

class MessageService
{
    public function __construct(
        private readonly SendMessageAction $sendMessage
    ) {}

    /**
     * Sends a message from the given user in the given conversation.
     *
     * @param Conversation $conversation The conversation to post the message in.
     * @param User $sender The user sending the message.
     * @param string $body The message text content.
     * @return Message The stored message instance.
     */
    public function send(Conversation $conversation, User $sender, string $body): Message
    {
        return $this->sendMessage->execute($conversation, $sender, $body);
    }

    /**
     * Marks all unread messages in a conversation as read for the given user.
     * Only messages sent by other participants are marked.
     *
     * @param Conversation $conversation The conversation containing the messages.
     * @param User $reader The user reading the conversation.
     * @return void
     */
    public function markAsRead(Conversation $conversation, User $reader): void
    {
        $updated = $conversation->messages()
            ->where('sender_id', '!=', $reader->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        if ($updated > 0) {
            broadcast(new MessagesRead($conversation, $reader));
        }
    }
}
