<?php

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

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('agency', 'AgencyController', ['except' => ['show','create']]);
	Route::resource('program', 'ProgramController', ['except' => ['show','create']]);
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::resource('scoring', 'ScoringTypeController', ['except' => ['show']]);
	Route::resource('document', 'DocumentController', ['except' => ['show']]);
	Route::resource('document-outline', 'DocumentOutlineController');
	Route::get('timeline/{accreditation}', ['as' => 'timeline.view', 'uses' => 'TimelineController@show']);
	Route::post('timeline/{accreditation}', ['as' => 'timeline.store', 'uses' => 'TimelineController@store']);
	Route::put('timeline/{timeline}', ['as' => 'timeline.is_complete_update', 'uses' => 'TimelineController@is_complete_update']);
	Route::resource('team', 'TeamController');
	Route::post('assignTeam/{accreditation}', ['as' => 'team.assign', 'uses' => 'TeamController@assignTeam']);
	Route::resource('accreditation', 'AccreditationController');
	Route::get('assignTeam/{accreditation}', ['as' => 'accreditation.assignTeam', 'uses' => 'AccreditationController@assign_team']);
	Route::post('generateDocument/{accreditation}', ['as' => 'accreditation.generate', 'uses' => 'AccreditationController@generateDocument']);
	Route::resource('curriculum', 'CurriculumController');
	Route::get('getCurriculumCourses/{count}', 'CurriculumController@getCurriculumCourses');
	Route::resource('course', 'CourseController');
	Route::put('courseSyllabus/{course}', ['as' => 'courseSyllabus.update', 'uses' => 'CourseController@updateSyllabus']);
	Route::post('uploadImage', 'DocumentOutlineController@image_upload');
	Route::post('outlineComment/{document_outline}', ['as' => 'outlineComment.store', 'uses' => 'DocumentOutlineController@insert_comment']);
	Route::post('outlineResolve/{outline_comment}', ['as' => 'outlineResolve', 'uses' => 'DocumentOutlineController@resolved_comment']);
	Route::get('getAgencyScoring/{agency}', 'AgencyController@get_agency_scoring');
	Route::get('getAgencyDocument/{agency}', 'AgencyController@get_agency_document');
	Route::get('roles-permission', ['as' => 'roles-permission.index', 'uses' => 'UserController@roles_index']);
	Route::get('roles-permission/{role}/edit', ['as' => 'roles-permission.edit', 'uses' => 'UserController@roles_edit']);
	Route::put('roles-permission/{role}', ['as' => 'roles-permission.update', 'uses' => 'UserController@roles_update']);
	Route::delete('roles-permission/{role}', ['as' => 'roles-permission.destroy', 'uses' => 'UserController@roles_delete']);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});