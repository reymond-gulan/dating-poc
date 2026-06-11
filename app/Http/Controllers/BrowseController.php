<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use Illuminate\View\View;

class BrowseController extends Controller
{
    public function __construct(
        private readonly ProfileService $profileService
    ) {}

    /**
     * Displays a list of all other users who have completed their dating profile.
     *
     * @return View
     */
    public function index(): View
    {
        $users = $this->profileService->getBrowseList(auth()->user());

        return view('browse.index', compact('users'));
    }
}
