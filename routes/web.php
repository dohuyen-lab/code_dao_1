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

    return view('manage.register.register');

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
    Route::get('/listStudent', [ManageController::class, 'getListStudent'])->name('getListStudent');
    Route::get('/listTeacher', [ManageController::class, 'getListTeacher'])->name('getListTeacher');
    Route::post('/delete/{id}', [ManageController::class, 'postdeleteAccount'])->name('postdeleteAccount');

    //student
});


//student
Route::group(['prefix'=>'student'], function () { //, 'middleware'=>'auth'
    Route::get('/', [StudentController::class, 'getStudentCalendar'])->name('getStudentCalendar');
    Route::get('/cours', [StudentController::class, 'getListCoursStudent'])->name('getListCoursStudent');
    Route::post('/delete/{id}', [StudentController::class, 'postdeleteCours'])->name('postdeleteCours');

});
//teacher

// Route::get('/teacher/calendar', [TeacherController::class, 'getTeacherCalendar'])->name('getTeacherCalendar');


Route::group(['prefix'=>'teacher'], function () { //, 'middleware'=>'auth'
    Route::get('/', [TeacherController::class, 'index'])->name('teacher.index');
    Route::get('/calendar', [TeacherController::class, 'getTeacherCalendar'])->name('getTeacherCalendar');
    Route::get('/cours', [CourController::class, 'getAll'])->name('getListCours');
    Route::post('/cours/delete', [CourController::class, 'delete'])->name('deleteCours');
    Route::post('/cours/store', [CourController::class, 'store'])->name('storeCours');

});
