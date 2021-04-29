<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourController;
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


    // return view('manage.course.course');
    return view('teacher.cours.listcours');

});

Route::get('/login', 'BaseController@login')->name('login');
Route::post('/login', 'BaseController@postLogin')->name('post.login');
Route::get('/logout', 'BaseController@logout')->name('logout');
 //manage
Route::group(['prefix'=>'manager', 'middleware'=>'authmdw'], function () { //, 'middleware'=>'auth'
    Route::get('/', [ManageController::class, 'index'])->name('manager.index');
    Route::get('/register', [ManageController::class, 'register'])->name('manager.register');
    Route::post('/register', [ManageController::class, 'postRegister'])->name('manager.post_register');

    //formations
    Route::resource('formations', 'FormationController');
    // teacher

    //student
});
Route::get('/manager/calendar', [ManageController::class, 'getCalendar'])->name('getCalendar');

//student
Route::get('/student/calendar', [StudentController::class, 'getStudentCalendar'])->name('getStudentCalendar');
Route::get('/student/cours', [StudentController::class, 'getListCours'])->name('getListCours');

//teacher

// Route::get('/teacher/calendar', [TeacherController::class, 'getTeacherCalendar'])->name('getTeacherCalendar');


Route::group(['prefix'=>'teacher'], function () { //, 'middleware'=>'auth'
    Route::get('/', [TeacherController::class, 'index'])->name('teacher.index');
    Route::get('/calendar', [TeacherController::class, 'getTeacherCalendar'])->name('getTeacherCalendar');
    Route::get('/cours', [CourController::class, 'getAll'])->name('getListCours');
    Route::post('/cours/delete', [CourController::class, 'delete'])->name('deleteCours');

});
