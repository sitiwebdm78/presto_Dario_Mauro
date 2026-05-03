<?php

use App\Http\Controllers\RevisorController;
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

//ROTTE GESTITE DAL REVISOR CONTROLLER
Route::get('/revisor/index', [RevisorController::class, 'index' ])->middleware('isRevisor')->name('revisor.index');
Route::patch('/accept/{article}', [RevisorController::class, 'accept'])->name('accept');
Route::patch('/reject/{article}', [RevisorController::class, 'reject'])->name('reject');
Route::get('/revisor/request', [RevisorController::class, 'becomeRevisor'])->middleware('auth')->name('become.revisor');
Route::get('make/revisor/{user}', [RevisorController::class, 'makeRevisor'])->name('make.revisor');
