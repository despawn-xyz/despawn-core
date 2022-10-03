<?php

use Illuminate\Support\Facades\Route;

Route::prefix('forums')->name('forums.')->group(function () {
    Route::get('{category}', [\Despawn\Http\Controllers\Forums\CateogryController::class, 'show'])->name('category.show');
});
