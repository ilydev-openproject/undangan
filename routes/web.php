<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvitationController;

// Route untuk domain utama (tanpa subdomain)
Route::domain('undangan.test')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

// Route untuk subdomain
Route::get('/{slug}', [InvitationController::class, 'show'])
    ->name('invitation.show');

Route::get('/{slug}/kepada/{guest}', [InvitationController::class, 'showWithGuest'])
    ->name('invitation.show.withGuest');


