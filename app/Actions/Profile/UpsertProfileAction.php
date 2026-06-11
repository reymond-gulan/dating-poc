<?php

namespace App\Actions\Profile;

use App\Models\Profile;
use App\Models\User;

class UpsertProfileAction
{
    /**
     * Creates or updates the profile for the given user with the provided data.
     *
     * @param User $user The user whose profile is being created or updated.
     * @param array{age: int, bio: string} $data Validated profile data.
     * @return Profile The created or updated profile instance.
     */
    public function execute(User $user, array $data): Profile
    {
        return $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $data
        );
    }
}
