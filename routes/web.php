<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//FRONTEND CONTROLLERS
use App\Http\Controllers\Frontend\FrontendController AS Frontend;

//BACKEND CONTROLLERS
use App\Http\Controllers\Backend\DashboardController AS BackendDashboard;
use App\Http\Controllers\Backend\ApplicationSettingsController AS BackendApplicationSettings;
use App\Http\Controllers\Backend\ClientsController AS BackendClients;
use App\Http\Controllers\Backend\RatesController AS BackendRates;
use App\Http\Controllers\Backend\UsersController AS BackendUsers;

//1 - Frontend Routes
Route::group([ 'prefix' =>'/'], function () {
    Route::get('/', [Frontend::class, 'index'])->name('frontend.homepage');

    Route::post('/app-logout', [Frontend::class, 'appLogout'])->name('frontend.appLogout');

});

//2 - Auth Routes
Route::middleware(['auth', 'verified'])->group(function () {

    // 2 - Admin Routes
    Route::group([ 'prefix' =>'admin'], function () {

        // D
        Route::get('/', [BackendDashboard::class, 'index'])->name('backend.dashboard');


        // A
        Route::get('/application-settings', [BackendApplicationSettings::class, 'index'])->name('backend.applicationSettings.index');
        Route::post('/application-settings/update/wht-rate', [BackendApplicationSettings::class, 'whtRate'])->name('backend.applicationSettings.whtRate');


        // C
        Route::get('/clients', [BackendClients::class, 'index'])->name('backend.clients.index');
        Route::get('/client/{userId}', [BackendClients::class, 'view'])->name('backend.clients.view');
        Route::get('/clients/create', [BackendClients::class, 'create'])->name('backend.clients.create');
        Route::get('/clients/edit/{clientId}', [BackendClients::class, 'edit'])->name('backend.clients.edit');
        Route::post('/clients/store', [BackendClients::class, 'store'])->name('backend.clients.store');
        Route::post('/clients/rate-calculator', [BackendClients::class, 'rateCalculator'])->name('backend.clients.rateCalculator');

        // R
        Route::get('/rates', [BackendRates::class, 'index'])->name('backend.rates.index');
        Route::post('/rates/store', [BackendRates::class, 'store'])->name('backend.rates.store');

        // U
        Route::get('/my-profile', [BackendUsers::class, 'myProfile'])->name('backend.users.myProfile');
        Route::post('/profile/update-personal-info', [BackendUsers::class, 'saveMyProfilePersonal'])->name('backend.users.saveMyProfilePersonal');

    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
