<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Services\ConversationService;
use App\Services\MessageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ConversationController extends Controller
{
    public function __construct(
        private readonly ConversationService $conversationService,
        private readonly MessageService $messageService
    ) {}

    /**
     * Displays a list of all conversations for the authenticated user.
     * Returns JSON with conversation IDs when the request expects JSON
     * (used by the nav badge to subscribe to Pusher channels).
     *
     * @param \Illuminate\Http\Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        $conversations = $this->conversationService->getForUser(Auth::user());

        if ($request->wantsJson()) {
            return response()->json([
                'conversationIds' => $conversations->pluck('id'),
            ]);
        }

        return view('conversations.index', compact('conversations'));
    }

    /**
     * Finds or creates a private conversation between the authenticated user
     * and the given recipient, then redirects to the conversation.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'recipient_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $recipient = User::findOrFail($request->input('recipient_id'));
        $conversation = $this->conversationService->findOrCreate(Auth::user(), $recipient);

        return redirect()->route('conversations.show', $conversation);
    }

    /**
     * Returns the total count of unread messages across all of the
     * authenticated user's conversations.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function unreadCount(): JsonResponse
    {
        $userId = Auth::id();

        $count = Message::whereHas('conversation.participants', fn ($q) => $q->where('users.id', $userId))
            ->where('sender_id', '!=', $userId)
            ->whereNull('read_at')
            ->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Displays the message thread for a conversation the authenticated user
     * belongs to, and marks all incoming messages as read on open.
     *
     * @param int $conversation
     * @return \Illuminate\View\View
     */
    public function show(int $conversation): View
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $conversation = $user->conversations()
            ->with(['participants.profile', 'messages.sender'])
            ->findOrFail($conversation);

        $this->messageService->markAsRead($conversation, $user);

        return view('conversations.show', compact('conversation', 'user'));
    }
}
