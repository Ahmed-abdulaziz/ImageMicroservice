<?php
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::post('/images/upload', [ImageController::class, 'upload']);
Route::get('/images/{user_id}', [ImageController::class, 'getByUserId']);
Route::delete('/images/{user_id}', [ImageController::class, 'deleteByUserId']);
?>