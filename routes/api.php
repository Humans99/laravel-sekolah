<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TeacherController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
  // Teacher
  Route::post('/teachers', [TeacherController::class, 'store']);
  Route::delete('/teachers/code/{code}', [TeacherController::class, 'destroyByCode'])->where('code', '[A-Z]{3}');

  // Student
  // Route::post('student-register', [StudentController::class, 'registerFull']);
  // Route::apiResource('students', StudentController::class);
});

Route::middleware(['auth:sanctum', 'role:admin,teacher'])->group(function () {
  // Teacher (INDEX, SHOW, UPDATE)
  Route::get('/teachers', [TeacherController::class, 'index']);
  Route::get('/teachers/code/{code}', [TeacherController::class, 'showByCode'])->where('code', '[A-Z]{3}');
  Route::put('/teachers/code/{code}', [TeacherController::class, 'updateByCode'])->where('code', '[A-Z]{3}');
});
