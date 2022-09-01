<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\TeacherController::class, 'index']);

Route::get('/teachers', [App\Http\Controllers\TeacherController::class, 'index']);
Route::get('/teacherform', [App\Http\Controllers\TeacherController::class, 'showTeacherAddForm']);
Route::post('/addteacher', [App\Http\Controllers\TeacherController::class, 'addTeacher']);
Route::get('/get-teachers-name', [App\Http\Controllers\TeacherController::class, 'getTeachers']);
Route::post('/get-teachers-schedule', [App\Http\Controllers\TeacherController::class, 'getTeachersSchedule']);

Route::get('/scheduleform', [App\Http\Controllers\ScheduleController::class, 'showScheduleAddForm']);
Route::post('/addschedule', [App\Http\Controllers\ScheduleController::class, 'addSchedule']);