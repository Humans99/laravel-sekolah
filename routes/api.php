<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudentController;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
  Route::post('register-full', [StudentController::class, 'registerFull']);
});

Route::middleware(['auth:sanctum', 'role:admin,teacher'])->group(function () {
  Route::apiResource('students', StudentController::class);
});
