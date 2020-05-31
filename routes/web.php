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
Route::get('/kapcsolat', 'HomeController@contact')->name('contact');

//user
Route::get('/profile', 'UserController@index')->name('profile');

//student
Route::get('/student', 'StudentController@index')->name('student');
Route::get('/student/assignments', 'StudentController@assignments')->name('student-assignments');
Route::get('/student/apply', 'StudentController@apply')->name('apply-subject');
Route::post('/student/quit/{id}', 'StudentController@quit')->name('quit-subject');
Route::get('/student/add/{id}', 'StudentController@add')->name('add-subject');

//teacher
Route::get('/teacher', 'TeacherController@index')->name('teacher');
Route::get('/teacher/add-subject', 'TeacherController@addSubject')->name('new-subject');
Route::get('/teacher/modify-subject/{id}', 'TeacherController@modify')->name('modify-subject');

//subject
Route::post('/subject/add', 'SubjectController@store')->name('store-subject');
Route::post('/subject/{id}/modify', 'SubjectController@update')->name('update-subject');
Route::post('/subject/{id}/publicate', 'SubjectController@publicate')->name('publicate');
Route::post('/subject/{id}/delete', 'SubjectController@delete')->name('delete-subject');
Route::get('/subject/{id}', 'SubjectController@details')->name('subject-details');

//assignment
Route::get('/subject/{subject}/assignment/add', 'AssignmentController@add')->name('add-assignment');
Route::post('/subject/{subject}/assignment/store', 'AssignmentController@store')->name('store-assignment');
Route::get('/subject/{subject}/assignment/{id}', 'AssignmentController@index')->name('assignment');
Route::get('/subject/{subject}/assignment/{id}/modify', 'AssignmentController@modify')->name('modify-assignment');
Route::post('/subject/{subject}/assignment/{id}/update', 'AssignmentController@update')->name('update-assignment');

//solution
Route::get('/assignment/{assignment}/solution/add', 'SolutionController@add')->name('add-solution');
Route::post('/solution/store', 'SolutionController@store')->name('store-solution');
Route::get('/solution/{id}', 'SolutionController@index')->name('solution');
Route::post('/solution/rate', 'SolutionController@rate')->name('rate-solution');
Route::get('/solution/{id}/download', 'SolutionController@download')->name('download-solution');

Auth::routes();
