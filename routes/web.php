<?php

use App\Models\Article;
use App\Articles\SearchRepository;
use App\Articles\ArticlesRepository;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestQueueEmails;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ItemSearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    echo "test here";
    return phpinfo();
});

// test xdeug
Route::get('/test', [HomeController::class, 'index']);
Route::get('/test2', [HomeController::class, 'test2']);

// test queue
Route::get('sending-queue-emails', [TestQueueEmails::class, 'sendTestEmails']);


// algoliasearch
Route::get('items-lists', [ItemSearchController::class, 'index'])->name('items-lists');
Route::post('create-item', [ItemSearchController::class, 'create'])->name('create-item');

// elasticsearch
Route::get('/elasticsearch', function (ArticlesRepository $repository) {
    $articles = $repository->search(request('q'));
    return view('elasticsearch', [
        'articles' => $articles,
    ]);
})->name('elasticsearch');


// testing in laravel
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);


// auth routes

Route::get('/welcome', function () {
    return view('welcome', ['name' => 'hello']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__ . '/auth.php';
