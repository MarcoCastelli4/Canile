<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\VaccinationController;


Route::get('/',[FrontController::class,'getHome'])->name('home');

Route::resource('dog', DogController::class);
Route::get('/dog',[DogController::class,'index'])->name('dog.index');
Route::get('/dog/{id}/destroy', [DogController::class, 'destroy'])->name('dog.destroy');
Route::get('/dog/{id}/destroy/confirm', [DogController::class, 'confirmDestroy'])->name('dog.destroy.confirm');

// rotte per le vaccinazioni
Route::get('/vaccination',[VaccinationController::class,'index'])->name('vaccination.index');


