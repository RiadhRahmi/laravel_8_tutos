<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/blogs/{id}', [BlogController::class, 'index']);
Route::get('/blogs/update/{id}', [BlogController::class, 'update']);
Route::get('/blogs/delete/{id}', [BlogController::class, 'delete']);


Route::get('/cache-data', function () {
    $post = Cache::remember('post', 60, function () {
        return \App\Models\Blog::find(3);
    });
});
