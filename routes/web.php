<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

// ROTTE GESTITE DALL'ARTICLE CONTROLLER
Route::get('/create/article', [ArticleController::class, 'create'])->name('create.article')->middleware('auth');