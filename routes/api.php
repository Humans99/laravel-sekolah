<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudentController;
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
  Route::post('student-register', [StudentController::class, 'registerFull']);
  Route::delete('/students/nis/{nis}', [StudentController::class, 'destroyByNis']);
});

Route::middleware(['auth:sanctum', 'role:admin,teacher'])->group(function () {
  // Teacher (INDEX, SHOW, UPDATE)
  Route::get('/teachers', [TeacherController::class, 'index']);
  Route::get('/teachers/code/{code}', [TeacherController::class, 'showByCode'])->where('code', '[A-Z]{3}');
  // Re-Check Update
  Route::put('/teachers/code/{code}', [TeacherController::class, 'updateByCode'])->where('code', '[A-Z]{3}');
});

Route::middleware(['auth:sanctum', 'role:admin, student'])->group(function () {
  // Student (INDEX, SHOW, UPDATE)
  Route::get('/students', [StudentController::class, 'index']);
  Route::get('/students/nis/{nis}', [StudentController::class, 'show']);
  Route::put('/students/nis/{nis}', [StudentController::class, 'updateByNis']);
});
