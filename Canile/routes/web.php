<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\UserController;



Route::get('/',[FrontController::class,'getHome'])->name('home');

Route::resource('dog', DogController::class);
Route::get('/dog',[DogController::class,'index'])->name('dog.index');
Route::get('/dog/{id}/destroy', [DogController::class, 'destroy'])->name('dog.destroy');
Route::get('/dog/{id}/destroy/confirm', [DogController::class, 'confirmDestroy'])->name('dog.destroy.confirm');
Route::get('/dog/{id}/info', [DogController::class, 'info'])->name('dog.info');

// rotte per le vaccinazioni
Route::get('/dog/{id}/vaccination',[DogController::class,'insertVaccination'])->name('dog.vaccination');
Route::post('/dog/{id}/vaccination',[DogController::class,'addVaccination'])->name('dog.vaccination');


// rotta per le adozioni
Route::get('/dog/{id}/adoption',[UserController::class,'adoption'])->name('user.adoption');
Route::post('/dog/{id}/adoption',[UserController::class,'addAdoption'])->name('user.adoption');


// sismtemare rotta insetimento adozione