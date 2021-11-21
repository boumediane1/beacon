<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BeaconController;
use App\Http\Controllers\BarqueController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return \Illuminate\Support\Facades\Redirect::route('barques.index');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resources([
    'users' => UserController::class,
    'barques' => BarqueController::class,
    'beacons' => BeaconController::class,
    'ports' => \App\Http\Controllers\PortController::class
], ['middleware' => 'auth', 'except' => 'show']);

Route::get('barques/export', [BarqueController::class, 'export'])->name('barques.export');
