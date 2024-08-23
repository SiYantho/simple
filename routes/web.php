<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KerusakanController;
use App\Http\Controllers\User1Controller;
use App\Http\Controllers\User2Controller;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.home');
    Route::resource('vehicles', VehicleController::class);
});

Route::middleware(['auth', 'role:user1'])->prefix('user1')->group(function () {
    Route::get('/', [User1Controller::class, 'index'])->name('user1.home');
    Route::get('/vehicle', [VehicleController::class, 'index'])->name('user1.vehicle');
    Route::get('/kerusakan', [KerusakanController::class, 'index'])->name('kerusakan.index');
    Route::get('/kerusakan/create', [KerusakanController::class, 'create'])->name('kerusakan.create');
    Route::post('/kerusakan', [KerusakanController::class, 'store'])->name('kerusakan.store');
    Route::get('/kerusakan/{id}/edit', [KerusakanController::class, 'edit'])->name('kerusakan.edit');
    Route::put('/kerusakan/{id}', [KerusakanController::class, 'update'])->name('kerusakan.update');
    Route::delete('/kerusakan/{id}', [KerusakanController::class, 'destroy'])->name('kerusakan.destroy');
    Route::get('/service-reports', 'ServiceReportController@index')->name('service-reports.index');
Route::get('/service-reports/create', 'ServiceReportController@create')->name('service-reports.create');
Route::post('/service-reports', 'ServiceReportController@store')->name('service-reports.store');
Route::get('/service-reports/{id}/edit', 'ServiceReportController@edit')->name('service-reports.edit');
Route::put('/service-reports/{id}', 'ServiceReportController@update')->name('service-reports.update');
Route::delete('/service-reports/{id}', 'ServiceReportController@destroy')->name('service-reports.destroy');
});

Route::middleware(['auth', 'role:user2'])->group(function () {
    Route::get('/user2', [User2Controller::class, 'index'])->name('user2.home');
});

// PRNYA
// DI DASHBOARD ITU MENDETAIL rusaknya apa aja selain ganti oli
// TAMBAHIN NOPOL DI PILIH MOBIL
// TERUS PILIH MOBIL DI DASHBOAR NAMBAHIN NOPOL
// https://www.arducoding.com/2020/07/simple-iot-web-application-dashboard.html contoh
