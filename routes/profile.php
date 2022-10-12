<?php

use Despawn\Http\Controllers\Profile\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth:sanctum'])->group(function() {
    Route::get('/profile', [UserProfileController::class, 'show'])
        ->name('profile.show');

    Route::put('/profile', [UserProfileController::class, 'update'])
        ->name('profile.update-profile-information');

    Route::put('/profile/avatar', [\Despawn\Http\Controllers\Profile\UserAvatarController::class, 'store'])
    ->name('profile.update-media');
    Route::delete('/profile/avatar', [\Despawn\Http\Controllers\Profile\UserAvatarController::class, 'destroy'])
        ->name('profile.avatar.destroy');
});