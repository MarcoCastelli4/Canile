<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MailController;


// utente visitatore
Route::get('/',[FrontController::class,'getHome'])->name('home');
Route::get('/aboutUs',[FrontController::class,'getAboutUs'])->name('aboutus');
Route::get('/contactUs',[FrontController::class,'getContactUs'])->name('contactus');

/**Per la parte di login e registrazione */
Route::get('/user/login',[AuthController::class,'authentication'])->name('user.login');
Route::post('/user/login',[AuthController::class,'login'])->name('user.login');
Route::post('/user/register',[AuthController::class,'registration'])->name('user.register');
Route::get('/user/logout',[AuthController::class,'logout'])->name('user.logout');

Route::get('/dog',[DogController::class,'index'])->name('dog.index');
Route::get('/dog/{id}/info', [DogController::class, 'info'])->name('dog.info');

Route::get('/review', [ReviewController::class,'index'])->name('review.index');

Route::get('/dog/filter', [DogController::class,'dogFilter'])->name('dog.filter');

//rotte per utente admin 
Route::middleware(['authCustom','IsAdmin'])->group(function () {
     Route::resource('dog', DogController::class)->except([
          'index'
      ]);
     Route::get('/dog/{id}/destroy', [DogController::class, 'destroy'])->name('dog.destroy');
     Route::get('/dog/{id}/destroy/confirm', [DogController::class, 'confirmDestroy'])->name('dog.destroy.confirm');
 
     // rotte per le vaccinazioni
     Route::get('/dog/{id}/vaccination',[DogController::class,'vaccination'])->name('dog.vaccination');
     Route::post('/dog/{id}/vaccination',[DogController::class,'addVaccination'])->name('dog.vaccination');

     Route::post('/vaccination',[VaccinationController::class,'store'])->name('vaccination.store');
     Route::get('/vaccination/edit',[VaccinationController::class,'edit'])->name('vaccination.edit');

});

//rotte per utente registrato
Route::middleware(['authCustom','IsUser'])->group(function () {
// rotta per le adozioni
Route::get('/dog/{id}/adoption',[UserController::class,'adoption'])->name('user.adoption');
Route::post('/dog/{id}/adoption',[UserController::class,'addAdoption'])->name('user.adoption');

Route::get('/user/{id}/dogs',[UserController::class,'index'])->name('user.dogs');

Route::get('/mail/{dog_id}/{user_id}',[MailController::class,'sendMail'])->name('mail.confirm');

Route::get('/review/edit',[ReviewController::class,'edit'])->name('review.edit');
Route::post('/review/store', [ReviewController::class,'store'])->name('review.store');

});



