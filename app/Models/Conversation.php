<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    /**
     * Returns all users who are participants in this conversation.
     *
     * @return BelongsToMany<User, $this>
     */
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Returns all messages in this conversation, ordered oldest first.
     *
     * @return HasMany<Message, $this>
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class)->oldest();
    }

    /**
     * Returns the most recent message in this conversation.
     *
     * @return HasMany<Message, $this>
     */
    public function latestMessage(): HasMany
    {
        return $this->hasMany(Message::class)->latest();
    }
}
