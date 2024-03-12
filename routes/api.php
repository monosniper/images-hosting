<?php

use App\Http\Controllers\Api\V1\ImageController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
   Route::resource('images', ImageController::class)->only(['index', 'show']);
});
