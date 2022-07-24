<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LeaveController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//   return $request->user();
// });

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [LoginController::class, 'register'])->name('register');

Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::apiResource('employees', 'App\Http\Controllers\Api\EmployeeController');
  Route::apiResource('departments', 'App\Http\Controllers\Api\DepartmentController');
  Route::apiResource('leavetypes', 'App\Http\Controllers\Api\LeavetypeController');
  
  Route::apiResource('leaves', 'App\Http\Controllers\Api\LeaveController');
  Route::put('/leaves/approveLeave/{id}', [LeaveController::class, 'approveLeave'])->name('leave.approveLeave');
  Route::get('/leaves/myLeaves/{e_id}', [LeaveController::class, 'myLeaves'])->name('leave.myLeaves');

  Route::apiResource('admins', 'App\Http\Controllers\Api\AdminController');

  Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

