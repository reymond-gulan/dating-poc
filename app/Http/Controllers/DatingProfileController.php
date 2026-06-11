<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertProfileRequest;
use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DatingProfileController extends Controller
{
    public function __construct(
        private readonly ProfileService $profileService
    ) {}

    /**
     * Displays the dating profile edit form for the authenticated user.
     *
     * @return View
     */
    public function edit(): View
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $user->load('profile');

        return view('dating-profile.edit', compact('user'));
    }

    /**
     * Validates and saves the authenticated user's dating profile, then redirects back.
     *
     * @param UpsertProfileRequest $request
     * @return RedirectResponse
     */
    public function update(UpsertProfileRequest $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $this->profileService->save($user, $request->validated());

        return redirect()->route('dating-profile.edit')->with('status', 'Profile saved.');
    }
}
