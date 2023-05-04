<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\DogController;


Route::get('/',[FrontController::class,'getHome'])->name('home');

Route::resource('dog', DogController::class);
Route::get('/dog',[DogController::class,'index'])->name('dog.index');
Route::get('/dog/{id}/destroy', [DogController::class, 'destroy'])->name('dog.destroy');
Route::get('/dog/{id}/destroy/confirm', [DogController::class, 'confirmDestroy'])->name('dog.destroy.confirm');

/*
Route::get('/book',[BookController::class,'index'])->name('book.index');
Route::get('/author',[AuthorController::class,'index'])->name('author.index');*/


