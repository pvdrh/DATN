<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerSchedulesController;
use App\Http\Controllers\CustomerServicesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'home']);
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::get('billing', function () {
        return view('billing');
    })->name('billing');

    Route::get('profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('rtl', function () {
        return view('rtl');
    })->name('rtl');

    Route::get('user-management', function () {
        return view('laravel-examples/user-management');
    })->name('user-management');

    Route::get('tables', function () {
        return view('tables');
    })->name('tables');

    Route::get('virtual-reality', function () {
        return view('virtual-reality');
    })->name('virtual-reality');

    Route::get('static-sign-in', function () {
        return view('static-sign-in');
    })->name('sign-in');

    Route::get('static-sign-up', function () {
        return view('static-sign-up');
    })->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/user-profile', [InfoUserController::class, 'create']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
        return view('dashboard');
    })->name('sign-up');

    Route::prefix('users')->middleware('checkManager')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::put('/{user_id}', [UserController::class, 'update'])->name('users.update');
        Route::get('/{user_id}', [UserController::class, 'edit'])->name('users.edit');
        Route::delete('/{user_id}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    Route::prefix('agencies')->middleware('checkManager')->group(function () {
        Route::get('/', [AgencyController::class, 'index'])->name('agencies.index');
        Route::get('/create', [AgencyController::class, 'create'])->name('agencies.create');
        Route::post('/store', [AgencyController::class, 'store'])->name('agencies.store');
        Route::get('/{agency_id}', [AgencyController::class, 'edit'])->name('agencies.edit');
        Route::put('/{agency_id}', [AgencyController::class, 'update'])->name('agencies.update');
        Route::delete('/{agency_id}', [AgencyController::class, 'destroy'])->name('agencies.destroy');
    });

    Route::prefix('services')->middleware('checkManager')->group(function () {
        Route::get('/', [ServicesController::class, 'index'])->name('services.index');
        Route::get('/create', [ServicesController::class, 'create'])->name('services.create');
        Route::post('/store', [ServicesController::class, 'store'])->name('services.store');
        Route::get('/{service_id}', [ServicesController::class, 'edit'])->name('services.edit');
        Route::put('/{service_id}', [ServicesController::class, 'update'])->name('services.update');
        Route::delete('/{service_id}', [ServicesController::class, 'destroy'])->name('services.destroy');
    });

    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/create', [CustomerController::class, 'create'])->name('customers.create');
        Route::post('/store', [CustomerController::class, 'store'])->name('customers.store');
        Route::get('/{customer_id}', [CustomerController::class, 'edit'])->name('customers.edit');
        Route::put('/{customer_id}', [CustomerController::class, 'update'])->name('customers.update');
        Route::delete('/{customer_id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    });

    Route::prefix('customer-services')->middleware('checkManager')->group(function () {
        Route::get('/', [CustomerServicesController::class, 'index'])->name('customer_services.index');
        Route::get('/create', [CustomerServicesController::class, 'create'])->name('customer_services.create');
        Route::post('/store', [CustomerServicesController::class, 'store'])->name('customer_services.store');
        Route::get('/{customer_id}', [CustomerServicesController::class, 'edit'])->name('customer_services.edit');
        Route::put('/{customer_id}', [CustomerServicesController::class, 'update'])->name('customer_services.update');
        Route::delete('/{customer_id}', [CustomerServicesController::class, 'destroy'])->name(
            'customer_services.destroy'
        );
    });

    Route::prefix('customer-schedules')->group(function () {
        Route::get('/', [CustomerSchedulesController::class, 'index'])->name('customer_schedules.index');
        Route::get('/create', [CustomerSchedulesController::class, 'create'])->name('customer_schedules.create');
        Route::post('/store', [CustomerSchedulesController::class, 'store'])->name('customer_schedules.store');
        Route::get('/{customer_id}', [CustomerSchedulesController::class, 'edit'])->name('customer_schedules.edit');
        Route::put('/{customer_id}', [CustomerSchedulesController::class, 'update'])->name('customer_schedules.update');
    });

    Route::prefix('pages')->middleware('admin')->group(function () {
        Route::get('/', [PageController::class, 'index'])->name('pages.index');
        Route::get('/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('/store', [PageController::class, 'store'])->name('pages.store');
        Route::get('/{page_id}', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('/{page_id}', [PageController::class, 'update'])->name('pages.update');
        Route::delete('/{page_id}', [PageController::class, 'destroy'])->name(
            'pages.destroy'
        );
    });

    Route::get('/profile', [SessionsController::class, 'profile'])->name('profile');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');

Route::get('/{slug}', [HomeController::class, 'getPageBySlug']);