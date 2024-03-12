<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::post("upload", [UploadController::class, 'store'])->name('upload');
Route::post("upload-temp", [UploadController::class, 'tempUpload'])->name('upload_temp');
Route::get("download/{image}", [UploadController::class, 'download'])->name('download');
