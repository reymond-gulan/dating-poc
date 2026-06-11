<?php

namespace App\Services;

use App\Actions\Conversation\StartConversationAction;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ConversationService
{
    public function __construct(
        private readonly StartConversationAction $startConversation
    ) {}

    /**
     * Finds or creates a private conversation between two users.
     *
     * @param User $sender The user initiating the conversation.
     * @param User $recipient The user being contacted.
     * @return Conversation The existing or newly created conversation.
     */
    public function findOrCreate(User $sender, User $recipient): Conversation
    {
        return $this->startConversation->execute($sender, $recipient);
    }

    /**
     * Returns all conversations for the given user, with participants and
     * the latest message eager-loaded, sorted by most recently updated.
     *
     * @param User $user The authenticated user whose conversations are fetched.
     * @return Collection<int, Conversation>
     */
    public function getForUser(User $user): Collection
    {
        return $user->conversations()
            ->with(['participants', 'latestMessage'])
            ->withCount(['messages as unread_count' => fn($q) => $q->where('sender_id', '!=', $user->id)
            ->whereNull('read_at')])
            ->latest()
            ->get();
    }
}
