<?php

use Illuminate\Support\Facades\Route;

Route::prefix('forums')->name('forums.')->group(function () {
    Route::resource('category', \Despawn\Http\Controllers\Forums\CateogryController::class)
        ->only(['show']);

    Route::resource('board', \Despawn\Http\Controllers\Forums\BoardController::class)
        ->only(['show']);

    Route::resource('board.thread', \Despawn\Http\Controllers\Forums\ThreadController::class)
        ->only(['show', 'create', 'store', 'update'])
        ->shallow();

    Route::resource('thread.comment', \Despawn\Http\Controllers\Forums\CommentController::class)
        ->only(['store', 'update'])
        ->shallow();
});
