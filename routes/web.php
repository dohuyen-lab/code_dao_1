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
    return view('login.login');
});

Route::get('/login', 'BaseController@login')->name('login');
Route::post('/login', 'BaseController@postLogin')->name('post.login');
Route::get('/logout', 'BaseController@logout')->name('logout');

Route::get('/signup', function(){
                return view('login.signup');
            })->name('signup');
Route::post('/signup', 'BaseController@signup')->name('signup');

 //manage
Route::group(['prefix'=>'manager', 'middleware'=>'authmdw'], function () { //, 'middleware'=>'auth'
    Route::get('/', [ManageController::class, 'index'])->name('manager.index');
    Route::get('/register', [ManageController::class, 'register'])->name('manager.register');
    Route::post('/register', [ManageController::class, 'postRegister'])->name('manager.post_register');

    //formations -> khoá học.
    Route::resource('formations', 'FormationController')->except([
        'create', 'show', 'edit', 'update'
    ]);
    //cours -> lớp học
    Route::get('cours', [CourController::class, 'getAll'])->name('manager.cours');
    Route::get('/cours/store', [CourController::class, 'getStore'])->name('manager.store.cours');
    Route::get('/cours/edit/{id}', [CourController::class, 'getCourse'])->name('manager.edit.course');
    Route::post('/cours/delete', [CourController::class, 'delete'])->name('manager.delete.course');

    Route::get('/accept', [ManageController::class, 'getRequest'])->name('manager.request');
    Route::post('/accept', [ManageController::class, 'acceptRequest'])->name('manager.request');
    // teacher
    Route::get('/teacher', [ManageController::class, 'getListTeacher'])->name('manager.teacher');
    //student
    Route::get('/student', [ManageController::class, 'getListStudent'])->name('manager.student');
});



//student
Route::group(['prefix'=>'student'], function () { //, 'middleware'=>'auth'
    Route::get('/', [StudentController::class, 'getStudentCalendar'])->name('getStudentCalendar');
    Route::get('/cours', [StudentController::class, 'getListCoursStudent'])->name('getListCoursStudent');
    Route::post('/registercours', [StudentController::class, 'postRegisterCours'])->name('postRegisterCours');
    Route::post('/delete/{id}', [StudentController::class, 'postdeleteCours'])->name('postdeleteCours');

});
//teacher


Route::group(['prefix'=>'teacher', 'middleware'=>'authmdw'], function () { //, 'middleware'=>'auth'
    Route::get('/', [TeacherController::class, 'index'])->name('teacher.index');
    Route::get('/calendar', [TeacherController::class, 'getTeacherCalendar'])->name('getTeacherCalendar');
    Route::get('/cours', [CourController::class, 'getAll'])->name('getListCours');
    Route::get('/cours', [CourController::class, 'getAllWeek'])->name('getListCoursWeek');
    Route::post('/cours/delete', [CourController::class, 'delete'])->name('deleteCours');
    Route::get('/cours/store', [CourController::class, 'getStore'])->name('storeCours');
    Route::post('/cours/store', [CourController::class, 'store'])->name('storeCours');

    Route::get('/cours/edit/{id}', [CourController::class, 'getCourse'])->name('editCours');
    Route::post('/cours/edit', [CourController::class, 'editCours'])->name('updateCours');
});
