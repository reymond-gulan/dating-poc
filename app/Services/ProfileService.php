<?php

namespace App\Services;

use App\Actions\Profile\UpsertProfileAction;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ProfileService
{
    public function __construct(
        private readonly UpsertProfileAction $upsertProfile
    ) {}

    /**
     * Creates or updates the profile for the given user.
     *
     * @param User $user The user whose profile is being saved.
     * @param array{age: int, bio: string} $data Validated profile data.
     * @return Profile The saved profile instance.
     */
    public function save(User $user, array $data): Profile
    {
        return $this->upsertProfile->execute($user, $data);
    }

    /**
     * Returns all users except the given user, with their profiles eager-loaded.
     * Users who have not completed a profile are excluded.
     *
     * @param User $user The currently authenticated user to exclude.
     * @return Collection<int, User>
     */
    public function getBrowseList(User $user): Collection
    {
        return User::with('profile')
            ->whereHas('profile')
            ->where('id', '!=', $user->id)
            ->get();
    }
}
