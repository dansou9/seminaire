<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\EnseignantController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    //Route about information
    Route::get('/information', [InformationController::class, 'index'])
        ->name('information.page');

    Route::post('/information', [InformationController::class, 'store'])
        ->name('information.store');

    //Route about users
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');



    //Route about presentation
    Route::get('/soumission', [PresentationController::class, 'showSoumissionPage'])
        ->name('presentation.soumission');


    Route::get('/presentation', [PresentationController::class, 'index'])
        ->name('presentation.page');

    Route::get('/presentation-view', [PresentationController::class, 'create'])
        ->name('presentation.create');

    Route::post('/presentation-store', [PresentationController::class, 'store'])
        ->name('presentation.store');

    Route::get('/presentation/{id}', [PresentationController::class, 'edit'])
        ->name('presentation.edit');

    // Suppression du paramètre etat (nouveau)
    Route::put('/presentation/{id}', [PresentationController::class, 'update'])
        ->name('presentation.update');

    //Ajout de la nouvelle route
    Route::put('/presentation-refused/{id}', [PresentationController::class, 'updateToRefused'])
        ->name('presentation.refused');

    Route::get('/presentation/passed', [PresentationController::class, 'index_passed'])
        ->name('presentation.index_all_passed');

    Route::get('/presentation/not-passed', [PresentationController::class, 'index_not_passed'])
        ->name('presentation.index_all_not_passed');

    // Voir pour valider
    Route::get('/presentation/show/{id}', [PresentationController::class, 'showValidation'])
        ->name('presentation.showValidation');

    // Programmer / Modifier date
    Route::get('/presentation/programmer/{id}', [PresentationController::class, 'showProgram'])
        ->name('presentation.programmer');

    Route::post('/presentation/programmer/{id}', [PresentationController::class, 'storeProgram'])
        ->name('presentation.programmer.store');

    // Afficher le formulaire pour programmer ou modifier la date
    Route::get('/presentation/programmer/{id}/edit', [PresentationController::class, 'editProgram'])
        ->name('presentation.programmer.edit');

    // Mettre à jour la date (PUT)
    Route::put('/presentation/programmer/{id}', [PresentationController::class, 'updateProgram'])
        ->name('presentation.programmer.update');



    //Route about seminaire
    Route::get('/seminaire/{id}', [PresentationController::class, 'create_seminaire'])
        ->name('presentation.create_seminaire');

    Route::get('/seminaires', [PresentationController::class, 'seminaires'])->name('seminaires.index');


    //Route about register enseignant
    Route::post('/register-enseignant', [EnseignantController::class, 'store'])
        ->name('register-enseignant.store');

    Route::get('/enseignants-store', [EnseignantController::class, 'create'])
        ->name('enseignants.create');

    Route::get('/enseignants', [EnseignantController::class, 'index'])
        ->name('enseignants.index');

    //Other
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
