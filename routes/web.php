<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['admin'])->group(function(){
    Route::controller(AdminController::class)->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', 'AdminDashboard')->name('admin.dashboard');
            Route::get('/profile', 'AdminProfile')->name('admin.profile');
            Route::post('/profile/store', 'AdminProfileStore')->name('admin.profile.store');
            Route::get('/change/password', 'AdminChangePassword')->name('admin.change.password');
            Route::post('/password/update', 'AdminPasswordUpdate')->name('admin.password.update');
        });
    });
});

Route::controller(AdminController::class)->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/login', 'AdminLogin')->name('admin.login');
        Route::post('/login', 'AdminLoginSubmit')->name('admin.login_submit');
        Route::get('/logout', 'AdminLogout')->name('admin.logout');
        Route::get('/forget-password', 'AdminForgetPassword')->name('admin.forget_password');
        Route::post('/forget-password', 'AdminPasswordSubmit')->name('admin.password_submit');
        Route::get('/reset-password/{token}/{email}', 'AdminResetPassword');
        Route::post('/reset-password-submit', 'AdminResetPasswordSubmit')->name('admin.reset_password_submit');
    });
});

Route::middleware(['client'])->group(function(){
    Route::controller(ClientController::class)->group(function () {
        Route::prefix('client')->group(function () {
            Route::get('/dashboard', 'ClientDashboard')->name('client.dashboard');
            Route::get('/profile', 'ClientProfile')->name('client.profile');
            Route::post('/profile/store', 'ClientProfileStore')->name('client.profile.store');
            Route::get('/change/password', 'ClientChangePassword')->name('client.change.password');
            Route::post('/password/update', 'ClientPasswordUpdate')->name('client.password.update');
        });
    });
});

Route::controller(ClientController::class)->group(function () {
    Route::prefix('client')->group(function () {
        Route::get('/login', 'ClientLogin')->name('client.login');
        Route::post('/login', 'ClientLoginSubmit')->name('client.login.submit');
        Route::get('/logout', 'ClientLogout')->name('client.logout');
        Route::get('/forget-password', 'ClientForgetPassword')->name('client.forget_password');
        Route::post('/forget-password', 'ClientPasswordSubmit')->name('client.password_submit');
        Route::get('/reset-password/{token}/{email}', 'ClientResetPassword');
        Route::post('/reset-password-submit', 'ClientResetPasswordSubmit')->name('client.reset_password_submit');
        Route::get('/register', 'ClientRegister')->name('client.register');
        Route::post('/register', 'ClientRegisterSubmit')->name('client.register.submit');
    });
});


