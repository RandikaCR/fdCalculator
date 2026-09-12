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
    Route::get('/client/rate/{clientId}', [Frontend::class, 'viewRate'])->name('frontend.viewRate');
    Route::post('/client/rate/get', [Frontend::class, 'getRate'])->name('frontend.getRate');

    Route::post('/app-logout', [Frontend::class, 'appLogout'])->name('frontend.appLogout');

});

//2 - Auth Routes
Route::middleware(['auth', 'verified', 'isActiveUser'])->group(function () {

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
        Route::post('/clients/get-ceiling-rate', [BackendClients::class, 'getCeilingRate'])->name('backend.clients.getCeilingRate');
        Route::post('/clients/status', [BackendClients::class, 'status'])->name('backend.clients.status');

        // R
        Route::get('/rates', [BackendRates::class, 'index'])->name('backend.rates.index');
        Route::get('/rates/import', [BackendRates::class, 'import'])->name('backend.rates.import');
        Route::post('/rates/store', [BackendRates::class, 'store'])->name('backend.rates.store');
        Route::post('/rates/import/store', [BackendRates::class, 'importStore'])->name('backend.rates.importStore');
        Route::post('/rates/import/process', [BackendRates::class, 'importProcess'])->name('backend.rates.importProcess');
        Route::post('/rates/import/clear', [BackendRates::class, 'ClearImportedRates'])->name('backend.rates.ClearImportedRates');

        // U
        // U
        Route::get('/users', [BackendUsers::class, 'index'])->name('backend.users.index');
        Route::post('/users/store', [BackendUsers::class, 'store'])->name('backend.users.store');
        Route::post('/users/get', [BackendUsers::class, 'get'])->name('backend.users.get');
        Route::post('/users/status', [BackendUsers::class, 'status'])->name('backend.users.status');

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
