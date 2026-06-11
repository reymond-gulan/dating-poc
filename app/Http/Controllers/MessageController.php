<?php

namespace App\Http\Controllers;

use App\Events\UserTyping;
use App\Http\Requests\SendMessageRequest;
use App\Models\Conversation;
use App\Services\MessageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct(
        private readonly MessageService $messageService
    ) {}

    /**
     * Broadcasts a typing indicator to the other participant in the conversation.
     *
     * @param \App\Models\Conversation $conversation
     * @return \Illuminate\Http\JsonResponse
     */
    public function typing(Conversation $conversation): JsonResponse
    {
        abort_unless($conversation->participants->contains(Auth::id()), 403);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        broadcast(new UserTyping($conversation, $user));

        return response()->json(['ok' => true]);
    }

    /**
     * Marks all unread incoming messages in the conversation as read for the authenticated user.
     *
     * @param \App\Models\Conversation $conversation
     * @return \Illuminate\Http\JsonResponse
     */
    public function markRead(Conversation $conversation): JsonResponse
    {
        abort_unless($conversation->participants->contains(Auth::id()), 403);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $this->messageService->markAsRead($conversation, $user);

        return response()->json(['ok' => true]);
    }

    /**
     * Sends a new message in the conversation and broadcasts it to the other participant.
     *
     * @param \App\Http\Requests\SendMessageRequest $request
     * @param \App\Models\Conversation $conversation
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SendMessageRequest $request, Conversation $conversation): JsonResponse
    {
        abort_unless($conversation->participants->contains(Auth::id()), 403);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $message = $this->messageService->send($conversation, $user, $request->validated('body'));

        return response()->json([
            'id'         => $message->id,
            'sender_id'  => $message->sender_id,
            'body'       => $message->body,
            'read_at'    => $message->read_at,
            'created_at' => $message->created_at->toISOString(),
        ]);
    }
}
