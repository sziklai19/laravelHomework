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

//public
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'UserController@index')->name('profile');
Route::get('/kapcsolat', 'HomeController@contact')->name('contact');

//student
Route::get('/student', 'StudentController@index')->name('student');
Route::post('/student/quit/{id}', 'StudentController@quit')->name('quit-subject');
Route::get('/student/apply', 'StudentController@apply')->name('apply-subject');
Route::get('/student/add/{id}', 'StudentController@add')->name('add-subject');

//teacher
Route::get('/teacher', 'TeacherController@index')->name('teacher');
Route::get('/teacher/add-subject', 'TeacherController@addSubject')->name('new-subject');
Route::get('/teacher/modify-subject/{id}', 'TeacherController@modify')->name('modify-subject');

//subject
Route::get('/subject/{id}', 'SubjectController@details')->name('subject-details');
Route::post('/subject/{id}/modify', 'SubjectController@update')->name('update-subject');
Route::post('/subject/{id}/publicate', 'SubjectController@publicate')->name('publicate');
Route::post('/subject/{id}/delete', 'SubjectController@delete')->name('delete-subject');
Route::post('/subject/add', 'SubjectController@store')->name('store-subject');

Auth::routes();
