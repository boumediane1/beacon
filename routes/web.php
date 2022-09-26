<?php

use App\Http\Controllers\ProfileInformationController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BeaconController;
use App\Http\Controllers\VesselController;
use App\Imports\UsersImport;
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

//Route::get('/activities', function () {
//    return \App\Models\Activity::with('unitTypes')->get();
//});

Route::get('/', function () {
    return \Illuminate\Support\Facades\Redirect::route('vessels.index');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('vessels/export', [VesselController::class, 'export'])->name('vessels.export');
Route::post('vessels/import', [VesselController::class, 'import'])->name('vessels.import');

Route::resources([
    'users' => UserController::class,
    'staff' => StaffController::class,
    'vessels' => VesselController::class,
    'beacons' => BeaconController::class,
    'ports' => \App\Http\Controllers\PortController::class
], ['middleware' => 'auth']);

Route::middleware('auth')->group(function () {
    Route::get('user/profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile-information', [ProfileInformationController::class, 'update'])->name('user-profile-information.update');
    Route::put('/password', [PasswordController::class, 'update'])->name('user-password.update');
});

