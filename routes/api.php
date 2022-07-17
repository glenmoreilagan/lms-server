<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//   return $request->user();
// });


header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header("Access-Control-Max-Age", "3600");
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header("Access-Control-Allow-Credentials", "true");

Route::apiResource('employees', 'App\Http\Controllers\EmployeeController');
Route::apiResource('departments', 'App\Http\Controllers\DepartmentController');
Route::apiResource('leavetypes', 'App\Http\Controllers\LeavetypeController');
Route::apiResource('leaves', 'App\Http\Controllers\LeaveController');
