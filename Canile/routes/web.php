<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\DogController;


Route::get('/',[FrontController::class,'getHome'])->name('home');
Route::get('/dog',[DogController::class,'index'])->name('dog.index');

/*
Route::get('/book',[BookController::class,'index'])->name('book.index');
Route::get('/author',[AuthorController::class,'index'])->name('author.index');*/