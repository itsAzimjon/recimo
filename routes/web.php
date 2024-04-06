<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportExportController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => 'auth'], function () {
	
	Route::get('/statistic/{id}', [DashboardController::class, 'index'])->name('dashboard')->middleware('can:only-auth,id');
	Route::get('/export/{id}', [ ImportExportController::class, 'export'])->name('export')->middleware('can:only-auth,id');
	Route::get('/import/{id}', [ImportExportController::class, 'import'])->name('import')->middleware('can:only-auth,id');
	Route::get('/base/{id}', [BaseController::class, 'index'])->name('base.index')->middleware('can:only-auth,id');
	Route::get('/confirmation/{id}', [BaseController::class, 'confirmation'])->name('confirmation')->middleware('can:only-auth,id');
	Route::put('/on-confirm', [BaseController::class, 'onConfirm'])->name('onConfirm');
	Route::get('/agent-management', [UserController::class, 'agent'])->name('agent.management');
	Route::get('/order', [OrderController::class, 'index'])->name('order');
	Route::post('/order/store', [OrderController::class, 'store'])->name('order-store');
	Route::put('/order/attach/{id}', [OrderController::class, 'order_attach'])->name('order.attach');
	Route::get('/user-profile/{id}/edit', [InfoUserController::class, 'edit'])->name('user-profile.edit')->middleware('can:only-auth,id');
	Route::get('/users/search', [UserController::class, 'search'])->name('search.results');

	Route::get('/wallet/{user}', [WalletController::class, 'show'])->name('wallet.show');
    
	Route::resources([
		'user-profile' => InfoUserController::class,
		'region' => RegionController::class,
		'area' => AreaController::class,
		'sale' => ImportExportController::class,
	]);

	Route::group(['middleware' => 'checkUserRole:1'], function () {
		Route::get('/user-management', [UserController::class, 'index'])->name('user.management');
		Route::get('/company-management', [UserController::class, 'company'])->name('company.management');		
		Route::post('/order/{order}/accept', [OrderController::class, 'accept'])->name('order.accept');
		Route::post('/order/{order}/reject', [OrderController::class, 'reject'])->name('order.reject');
		Route::get('/users', [UserController::class, 'index'])->name('user.index');

		Route::resources([
			'user' => UserController::class,
		]);
	});
	
	Route::group(['middleware' => 'checkUserRole:3'], function () {
		Route::post('/createNewProduct', [ImportExportController::class, 'createNewProduct'])->name('createNewProduct');
		Route::post('/importFromClient', [ImportExportController::class, 'importFromClient'])->name('importFromClient');
	});
});

Route::get('/logout', [SessionsController::class, 'destroy']);
Route::get('/', [HomeController::class, 'home']);

Route::get('message', function () {
	return view('message');
})->name('message');

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

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/send/otp', [SessionsController::class, 'send_otp'])->name('send.otp');
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
