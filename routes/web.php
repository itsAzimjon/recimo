<?php

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportExportController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => 'auth'], function () {

	Route::get('/user-management', [UserController::class, 'index'])->name('user.management');
	Route::get('/agent-management', [UserController::class, 'agent'])->name('agent.management');
	Route::get('/company-management', [UserController::class, 'company'])->name('company.management');
	// Route::get('/users/agent', [UserController::class, 'agent'])->name('user.agent');

	Route::get('/users/search', [UserController::class, 'search'])->name('search.results');
	Route::get('/base/{id}', [BaseController::class, 'index'])->name('base.index');

	Route::get('/import/{id}', [ImportExportController::class, 'import'])->name('import');
	Route::get('/export/{id}', [ImportExportController::class, 'export'])->name('export');
	
	Route::get('/dashboard/{id}', [DashboardController::class, 'index'])->name('dashboard');
	
	Route::resources([
		'user-profile' => InfoUserController::class,
		'user' => UserController::class,
		'sale' => ImportExportController::class,
	]);

	
	
	Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/', [HomeController::class, 'home']);

	
	Route::get('billing', function () {
		return view('billing');
	})->name('billing');


	Route::get('massage', function () {
		return view('massage');
	})->name('massage');


	Route::get('edit', function () {
		return view('users/edit');
	})->name('edit');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');