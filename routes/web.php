<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

//ROTTE GESTITE DAL PUBLIC CONTROLLER
Route::get('/', [PublicController::class, 'homepage'])->name('homepage');



// ROTTE GESTITE DALL'ARTICLE CONTROLLER
Route::get('/create/article', [ArticleController::class, 'create'])->name('create.article')->middleware('auth');
Route::get('/index/article', [ArticleController::class, 'index'])->name('index.article');
Route::get('/show/article/{article}', [ArticleController::class, 'show'])->name('show.article');
Route::get('/category/{category}', [ArticleController::class, 'byCategory'])->name('bycategory');
