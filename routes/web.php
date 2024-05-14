<?php

use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// Student
Route::group(['middleware' => ['auth', 'student']],
    function () {
        Route::get('/dashboard', 'TourController@dashboard')->name('dashboard');
        Route::post('/check-pass', 'TourController@checkPass')->name('check.pass');
        Route::post('/submit-answers', 'TourController@submitAnswers')->name('submit.answers');
    }
);

// Admin
Route::group(['middleware' => ['auth', 'admin']],
    function () {
        // Route::get('/rekap', 'TourController@rekap')->name('rekap');
        Route::get('/rekap', 'TourController@rekap2')->name('rekap2');
        Route::post('/change-group', 'TourController@changeGroup')->name('change.group');
        Route::post('/change-student', 'TourController@changeStudent')->name('change.student');
    }
);
