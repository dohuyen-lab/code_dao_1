<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
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
    return view('manage.calendar.calendar');
});

 //manage
Route::get('/manage/calendar', [ManageController::class, 'getCalendar'])->name('getCalendar');

//student
Route::get('/student/calendar', [StudentController::class, 'getStudentCalendar'])->name('getStudentCalendar');

//teacher
Route::get('/teacher/calendar', [TeacherController::class, 'getTeacherCalendar'])->name('getTeacherCalendar');

