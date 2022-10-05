<?php

use Illuminate\Support\Facades\Route;

Route::prefix('forums')->name('forums.')->group(function () {
    Route::get('category/{category}', [\Despawn\Http\Controllers\Forums\CateogryController::class, 'show'])
        ->name('category.show');

    Route::get('board/{board}', [\Despawn\Http\Controllers\Forums\BoardController::class, 'show'])
        ->name('board.show');

    Route::get('thread/{thread}', [\Despawn\Http\Controllers\Forums\ThreadController::class, 'show'])
        ->name('thread.show');
});
