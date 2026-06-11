<?php

use App\Http\Controllers\BrowseController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\DatingProfileController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dating-profile', [DatingProfileController::class, 'edit'])->name('dating-profile.edit');
    Route::put('/dating-profile', [DatingProfileController::class, 'update'])->name('dating-profile.update');

    Route::get('/browse', [BrowseController::class, 'index'])->name('browse.index');

    Route::get('/conversations', [ConversationController::class, 'index'])->name('conversations.index');
    Route::get('/conversations/unread-count', [ConversationController::class, 'unreadCount'])->name('conversations.unread-count');
    Route::post('/conversations', [ConversationController::class, 'store'])->name('conversations.store');
    Route::get('/conversations/{conversation}', [ConversationController::class, 'show'])->name('conversations.show');
    Route::post('/conversations/{conversation}/messages', [MessageController::class, 'store'])->name('conversations.messages.store');
    Route::post('/conversations/{conversation}/messages/read', [MessageController::class, 'markRead'])->name('conversations.messages.read');
    Route::post('/conversations/{conversation}/typing', [MessageController::class, 'typing'])->name('conversations.typing');
});

require __DIR__.'/auth.php';
