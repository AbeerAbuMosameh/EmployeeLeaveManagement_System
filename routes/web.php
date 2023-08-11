<?php

use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Employee\EmployeesLeaveRequestsController;
use App\Http\Controllers\EmployeesRequestsController;
use App\Http\Controllers\ProfileController;
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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('/superAdmin')->group(function () {
        Route::resource('employees', EmployeeController::class);
        Route::resource('leaves_type', LeaveTypeController::class);
        Route::resource('employee_requests', EmployeesRequestsController::class);
    });
    Route::prefix('/employee')->group(function () {
        Route::resource('leaves_request', EmployeesLeaveRequestsController::class);
    });
});


