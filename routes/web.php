<?php

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

Route::get('/', function () {
    return view('home.index');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/teachers', function () {
        return view('admin.teachers.index');
    });
    Route::get('/students', function () {
        return view('admin.students.index');
    });
    Route::get('/registrants', function () {
        return view('admin.registrants.index');
    });
    Route::get('/schedules', function () {
        return view('admin.schedules.index');
    });
    Route::get('/profile', function () {
        return view('admin.profile.index');
    });
});

require __DIR__ . '/auth.php';
