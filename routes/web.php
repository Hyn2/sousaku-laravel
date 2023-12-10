<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\EmbedLinkController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\EmbedLink;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $posts = Post::latest()->limit(6)->get();
    $embedLink = EmbedLink::first();
    return view('welcome', ['posts' => $posts, 'embedLink' => $embedLink]);
});

Route::middleware('auth')->group(function () {
    Route::get('/user/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('post', PostController::class)->except('index', 'show');
    Route::post('/post/{post}/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/post/{post}/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
    Route::patch('/embedlink', [EmbedLinkController::class, 'update'])->name('embedlink.update');
});

Route::resource('post', PostController::class)->only('index', 'show');


require __DIR__.'/auth.php';
