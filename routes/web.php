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

Route::get('/team-invite/{user}', 'TeamController@userAccreditationAssign')->name('team-invite');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('agency', 'AgencyController', ['except' => ['show','create']]);
	Route::resource('program', 'ProgramController', ['except' => ['show','create']]);
	Route::resource('user', 'UserController');
	Route::post('userEmailInvitation/{accreditation}', ['as' => 'email.invitation', 'uses' => 'TeamController@userEmailInvitation']);
	Route::resource('scoring', 'ScoringTypeController', ['except' => ['show']]);
	Route::resource('task', 'TaskController', ['except' => ['show']]);
	Route::get('notification', ['as' => 'notification.index', 'uses' => 'NotificationController@index']);
	Route::get('activities', ['as' => 'activities.index', 'uses' => 'HomeController@activities']);
	Route::post('taskInProgress/{task}', ['as' => 'task.in-progress', 'uses' => 'TaskController@taskInProgress']);
	Route::post('taskComplete/{task}', ['as' => 'task.complete', 'uses' => 'TaskController@taskComplete']);
	Route::resource('document', 'DocumentController', ['except' => ['show']]);
	Route::resource('document-outline', 'DocumentOutlineController');
	Route::post('document-outlineUpload/{document_outline}', ['as' => 'outline.upload', 'uses' => 'DocumentOutlineController@outlineUpload']);
	Route::post('document-outlineSelect/{document_outline}', ['as' => 'outline.select', 'uses' => 'DocumentOutlineController@outlineSelect']);
	Route::get('select-evidences', ['as' => 'evidence.show', 'uses' => 'FileRepositoryController@showEvidences']);
	Route::post('select-evidences/{appendix_exhibit}', ['as' => 'evidence.select', 'uses' => 'DocumentOutlineController@selectEvidences']);
	Route::post('evidenceUpload/{appendix_exhibit}', ['as' => 'evidence.upload', 'uses' => 'DocumentOutlineController@evidenceUpload']);
	Route::post('evidence-complete/{appendix_exhibit}', ['as' => 'evidence.complete', 'uses' => 'DocumentOutlineController@evidenceComplete']);
	Route::get('appendices-exhibits', ['as' => 'appendices-exhibits.index', 'uses' => 'FileRepositoryController@appendicesExhibits']);
	Route::get('select-appendices-exhibits/{document_outline}', ['as' => 'appendices-exhibits.select', 'uses' => 'FileRepositoryController@selectAppendicesExhibits']);
	Route::get('show-file-repository', ['as' => 'show.file.repo', 'uses' => 'FileRepositoryController@showFileRepository']);
	Route::post('accreditationRecommendationEvidenceSelect/{accreditation}', ['as' => 'accreditation.recommendation.evidence.select', 'uses' => 'AccreditationController@accreditationRecommendationEvidenceSelect']);
	Route::post('accreditationRecommendationEvidenceUpload/{accreditation}', ['as' => 'accreditation.recommendation.evidence.upload', 'uses' => 'AccreditationController@accreditationRecommendationEvidenceUpload']);
	Route::resource('file-repository', 'FileRepositoryController', ['except' => ['show']]);
	Route::get('file/{file_repository}', ['as' => 'file-repository.download', 'uses' => 'FileRepositoryController@download']);
	Route::post('fileUpload/', ['as' => 'file-repository.upload', 'uses' => 'FileRepositoryController@upload']);
	Route::get('timeline/{accreditation}', ['as' => 'timeline.view', 'uses' => 'TimelineController@show']);
	Route::get('timeline/{timeline}/edit', ['as' => 'timeline.edit', 'uses' => 'TimelineController@edit']);
	Route::post('timeline/{accreditation}', ['as' => 'timeline.store', 'uses' => 'TimelineController@store']);
	Route::put('timeline/{timeline}', ['as' => 'timeline.update', 'uses' => 'TimelineController@update']);
	Route::put('timeline-complete/{timeline}', ['as' => 'timeline.is_complete_update', 'uses' => 'TimelineController@is_complete_update']);
	Route::resource('team', 'TeamController');
	Route::get('createTeam/{accreditation}', ['as' => 'accreditation.team.create', 'uses' => 'TeamController@createTeam']);
	Route::post('assignTeam/{accreditation}', ['as' => 'team.assign', 'uses' => 'TeamController@assignTeam']);
	Route::resource('accreditation', 'AccreditationController');
	Route::post('createSubTeam{accreditation}', ['as' => 'accreditation.team.store', 'uses' => 'AccreditationController@createSubTeam']);
	Route::get('assignTeam/{accreditation}', ['as' => 'accreditation.assignTeam', 'uses' => 'AccreditationController@assign_team']);
	Route::post('generateAppendixExhibitList{accreditation}', ['as' => 'accreditation.appendix.generate', 'uses' => 'AccreditationController@generateAppendixExhibitList']);
	Route::post('generateDocument/{accreditation}', ['as' => 'accreditation.generate', 'uses' => 'AccreditationController@generateDocument']);
	Route::get('accreditationComplete/{timeline}', ['as' => 'accreditation.show.complete', 'uses' => 'AccreditationController@showCompleteAccreditation']);
	Route::post('accreditationComplete/{timeline}', ['as' => 'accreditation.complete', 'uses' => 'AccreditationController@completeAccreditation']);
	Route::get('accreditationRecommendation/{accreditation}', ['as' => 'accreditation.show.recommendation', 'uses' => 'AccreditationController@showAccreditationRecommendation']);
	Route::put('accreditationRecommendation/{accreditation}', ['as' => 'accreditation.recommendation', 'uses' => 'AccreditationController@accreditationRecommendation']);
	Route::get('answerRecommendation/{accreditation}', ['as' => 'answer.show.recommendation', 'uses' => 'AccreditationController@showAnswerRecommendation']);
	Route::put('answerRecommendation/{accreditation}', ['as' => 'answer.recommendation', 'uses' => 'AccreditationController@answerRecommendation']);
	Route::get('evidence_list/{accreditation}', ['as' => 'accreditation.evidence_list.create', 'uses' => 'AccreditationController@showEvidenceList']);
	Route::post('evidenceDownload/{appendix_exhibit}', ['as' => 'evidence.download', 'uses' => 'FileRepositoryController@evidenceDownload']);
	// Route::post('evidence_list/{accreditation}', ['as' => 'accreditation.evidence_list', 'uses' => 'AccreditationController@createEvidenceList']);
	Route::post('evidenceRemove/{appendix_exhibit}/{file_repository}', 'FileRepositoryController@evidenceRemove');
	Route::put('evidence_list/{document_outline}', ['as' => 'accreditation.evidence_list.update', 'uses' => 'DocumentOutlineController@updateEvidenceList']);
	Route::post('teamTask/{accreditation}', ['as' => 'team.task.store', 'uses' => 'AccreditationController@teamTask']);
	Route::post('createTeam/{accreditation}', ['as' => 'team.store.accreditation', 'uses' => 'TeamController@storeAccreditationTeam']);
	Route::resource('curriculum', 'CurriculumController');
	Route::post('getCurriculumCourses', 'CurriculumController@getCurriculumCourses');
	Route::get('curriculum-search', ['as' => 'curriculum.search', 'uses' => 'CurriculumController@curriculumSearch']);
	Route::resource('course', 'CourseController');
	Route::post('courseRemindAll', ['as' => 'course.remindAll', 'uses' => 'CourseController@allCourseRemind']);
	Route::post('courseRemind/{course}', ['as' => 'course.remind', 'uses' => 'CourseController@courseRemind']);
	Route::get('course-search', ['as' => 'course.search', 'uses' => 'CourseController@courseSearch']);
	Route::post('course-search-download', ['as' => 'course.search-download', 'uses' => 'CourseController@courseSearchDownload']);
	Route::post('course-syllabus/{course}', ['as' => 'course.syllabus', 'uses' => 'CourseController@downloadSyllabus']);
	Route::put('courseSyllabus/{course}', ['as' => 'courseSyllabus.update', 'uses' => 'CourseController@updateSyllabus']);
	Route::post('uploadImage', 'DocumentOutlineController@image_upload');
	Route::post('outlineComment/{document_outline}', ['as' => 'outlineComment.store', 'uses' => 'DocumentOutlineController@insert_comment']);
	Route::post('outlineResolve/{outline_comment}', ['as' => 'outlineResolve', 'uses' => 'DocumentOutlineController@resolved_comment']);
	Route::get('getAgencyScoring/{agency}', 'AgencyController@get_agency_scoring');
	Route::get('getAgencyDocument/{agency}', 'AgencyController@get_agency_document');
	Route::post('addRole', ['as' => 'role.store', 'uses' => 'UserController@addRole']);
	Route::get('roles-permission', ['as' => 'roles-permission.index', 'uses' => 'UserController@roles_index']);
	Route::get('roles-permission/{role}/edit', ['as' => 'roles-permission.edit', 'uses' => 'UserController@roles_edit']);
	Route::put('roles-permission/{role}', ['as' => 'roles-permission.update', 'uses' => 'UserController@roles_update']);
	Route::delete('roles-permission/{role}', ['as' => 'roles-permission.destroy', 'uses' => 'UserController@roles_delete']);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::get('faculty', ['as' => 'faculty.index', 'uses' => 'FacultyController@facultyIndex']);
	Route::post('facultyRemindAll', ['as' => 'faculty.remindAll', 'uses' => 'FacultyController@facultyRemindAll']);
	Route::get('faculty-search', ['as' => 'faculty.search', 'uses' => 'FacultyController@facultySearch']);
	Route::post('faculty-search-download', ['as' => 'faculty.search-download', 'uses' => 'FacultyController@facultySearchDownload']);
	Route::get('faculty/{user}', ['as' => 'faculty.show', 'uses' => 'FacultyController@facultyShow']);
	Route::get('faculty-profile', ['as' => 'faculty.profile', 'uses' => 'FacultyController@facultyProfile']);
	Route::post('faculty-profile/{user}', ['as' => 'faculty.store', 'uses' => 'FacultyController@facultyStore']);
	Route::post('exportAllFaculty/', ['as' => 'faculty.exportAllFaculty', 'uses' => 'FacultyController@exportAllFaculty']);
	Route::post('exportFaculty/{user}', ['as' => 'faculty.exportFaculty', 'uses' => 'FacultyController@exportFaculty']);
	Route::post('exportFaculty/', ['as' => 'faculty.download.export', 'uses' => 'FacultyController@downloadExportFaculty']);
	Route::post('facultyRemind/{user}', ['as' => 'faculty.remind', 'uses' => 'FacultyController@facultyRemind']);
	Route::post('exportFacultyAcademicBackground/{user}', ['as' => 'faculty.exportFacultyAcademicBackground', 'uses' => 'FacultyController@exportFacultyAcademicBackground']);
	Route::post('exportFacultyEducationalBackgroundExport/{user}', ['as' => 'faculty.exportFacultyEducationalBackgroundExport', 'uses' => 'FacultyController@exportFacultyEducationalBackgroundExport']);
	Route::post('exportFacultyProfessionalActivitiesExport/{user}', ['as' => 'faculty.exportFacultyProfessionalActivitiesExport', 'uses' => 'FacultyController@exportFacultyProfessionalActivitiesExport']);
	Route::post('exportFacultyCommunityServiceExport/{user}', ['as' => 'faculty.exportFacultyCommunityServiceExport', 'uses' => 'FacultyController@exportFacultyCommunityServiceExport']);
});