<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;


Route::get('/',[FrontController::class,'getHome'])->name('home');
Route::get('/aboutUs',[FrontController::class,'getAboutUs'])->name('aboutus');
Route::get('/contactUs',[FrontController::class,'getContactUs'])->name('contactus');

/**Metodo 'getHome' attivato quando vado sulla rotta specificata */


/**Per la parte di login e registrazione */
Route::get('/user/login',[AuthController::class,'authentication'])->name('user.login');
Route::post('/user/login',[AuthController::class,'login'])->name('user.login');
Route::post('/user/register',[AuthController::class,'registration'])->name('user.register');
Route::get('/user/logout',[AuthController::class,'logout'])->name('user.logout');





//Utente loggato
Route::middleware(['authCustom'])->group(function() {

     // utente visitatore (oltre ai login e register)
Route::get('/dog',[DogController::class,'index'])->name('dog.index');
Route::get('/dog/{id}/info', [DogController::class, 'info'])->name('dog.info');

// rotta per le adozioni
Route::get('/dog/{id}/adoption',[UserController::class,'adoption'])->name('user.adoption');
Route::post('/dog/{id}/adoption',[UserController::class,'addAdoption'])->name('user.adoption');



//rotte per utente admin
Route::middleware(['IsAdmin'])->group(function () {
     Route::resource('dog', DogController::class)->except([
        'index'
    ]);
 
     Route::get('/dog/{id}/destroy', [DogController::class, 'destroy'])->name('dog.destroy');
     Route::get('/dog/{id}/destroy/confirm', [DogController::class, 'confirmDestroy'])->name('dog.destroy.confirm');
 
     // rotte per le vaccinazioni
     Route::get('/dog/{id}/vaccination',[DogController::class,'vaccination'])->name('dog.vaccination');
     Route::post('/dog/{id}/vaccination',[DogController::class,'addVaccination'])->name('dog.vaccination');

});

});




