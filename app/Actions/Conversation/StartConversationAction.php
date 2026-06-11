<?php

namespace App\Actions\Conversation;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StartConversationAction
{
    /**
     * Finds an existing private conversation between two users or creates a new one.
     *
     * A conversation is considered a match when both participants appear in the
     * conversation_user pivot and no other participants exist in that conversation.
     *
     * @param User $sender The user initiating the conversation.
     * @param User $recipient The user being contacted.
     * @return Conversation The existing or newly created conversation.
     */
    public function execute(User $sender, User $recipient): Conversation
    {
        $existing = Conversation::whereHas('participants', function ($q) use ($sender) {
                $q->where('users.id', $sender->id);
            })->whereHas('participants', function ($q) use ($recipient) {
                $q->where('users.id', $recipient->id);
            })->whereDoesntHave('participants', function ($q) use ($sender, $recipient) {
                $q->whereNotIn('users.id', [$sender->id, $recipient->id]);
            })->first();

        if ($existing) {
            return $existing;
        }

        return DB::transaction(function () use ($sender, $recipient) {
            $conversation = Conversation::create();
            $conversation->participants()->attach([$sender->id, $recipient->id]);

            return $conversation;
        });
    }
}
