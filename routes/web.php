<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvitationController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/invitation/{slug}', [InvitationController::class, 'show'])->name('invitation.show');
