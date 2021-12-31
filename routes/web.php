<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BeaconController;
use App\Http\Controllers\VesselController;
use App\Imports\BeaconImport;
use App\Imports\VesselImport;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

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
    return 5;
    return \Illuminate\Support\Facades\Redirect::route('vessels.index');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('vessels/export', [VesselController::class, 'export'])->name('vessels.export');
Route::get('vessels/import', function () {
    Excel::import(new BeaconImport(), 'data.xls');
    Excel::import(new VesselImport(), 'data.xls');
    return 'Done!';
});

Route::resources([
    'users' => UserController::class,
    'vessels' => VesselController::class,
    'beacons' => BeaconController::class,
    'ports' => \App\Http\Controllers\PortController::class
], ['middleware' => 'auth']);
