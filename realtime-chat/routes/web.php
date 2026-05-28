<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect('/chat');
})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {

    Route::get('/chat', [ChatController::class, 'index'])->name('chat');

    Route::get('/chat/user/{id}', [ChatController::class, 'showUser'])->name('chat.user');

    Route::get('/chat/group/{id}', [ChatController::class, 'showGroup'])->name('chat.group');

    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';