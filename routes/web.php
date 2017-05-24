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
#TEST CASE
Route::get('testmail', function(){dd(Config::get('mail'));});
Route::get('testpass', function(){dd( Hash::make('hemal123'));});

Route::get('readme', function() {
	return view('readme.index');
})->name('readme');

Route::get('event', function() {
	return view('event.index');
})->name('event');

Route::get('careet-test', function() {
	return view('career.index');
})->name('careerTest');

// Company profile
Route::get('company/{alias}', 'Employer\ProfileController@index')->where('alias', '[0-9a-zA-Z]+');

# MAIN JOBSEEKER ROUTS
Route::get('/', function () { return view('main/home'); })->name('home');
Route::post('/jobseeker/sign-up/check/email', 'Jobseeker\RegisterController@checkEmail')->name('jobseeker.check.email');
Route::post('/jobseeker/sign-up/store', 'Jobseeker\RegisterController@store')->name('jobseeker.store.signup');
Route::get('/jobseeker/sign-up/verify/email/{token}', 'Jobseeker\RegisterController@verifyEmail')->name('jobseeker.verify.email');
Route::post('/jobseeker/login', 'Jobseeker\RegisterController@login')->name('jobseeker.login');

#SOCIAL LOGIN
Route::post('/jobseeker/sign-up/social/store', 'Jobseeker\SocialController@storeSocial')->name('jobseeker.store.social');



Route::post('/jobseeker/forgotpassword', 'Jobseeker\RegisterController@forgotpassword')->name('jobseeker.forgotpassword');
Route::get('/', 'Jobseeker\RegisterController@dashboard')->name('jobsekker.dashboard');

//JobSearch
Route::get('/jobsekker/job/search', 'Jobseeker\ProfileController@jobSearch')->name('jobsekker.job.search');
Route::post('/job/apply', 'Jobseeker\ProfileController@applyJob');
Route::post('jobseeker/post/bookmark', 'Jobseeker\ProfileController@bookmark');
// Route::post('/jobsekker/job/search', ['as' => 'job_search', 'uses' =>'Jobseeker\ProfileController@jobSearching']);

// JobDetail
Route::get('/job/detail/{id}', 'Jobseeker\ProfileController@jobDetail')->where('id', '[0-9]+');

Route::group(['middleware' => 'is-jobsekker'], function () {
	Route::get('/jobseeker/logout', 'Jobseeker\RegisterController@logout')->name('jobseeker.logout');
	
	#My account page
	Route::get('/jobsekker/myaccount', 'Jobseeker\AccountController@index')->name('jobsekker.myaccount');
	Route::post('/jobsekker/profilepic/update', 'Jobseeker\AccountController@updateProfilePic')->name('jobsekker.update.profilepic');
	Route::post('/jobseeker/cancel/application', 'Jobseeker\AccountController@cancelApplication');
	
	#Profile section
	Route::get('/jobsekker/profile', 'Jobseeker\ProfileController@index')->name('jobsekker.profile');
	Route::post('/jobsekker/profile', 'Jobseeker\ProfileController@updateProfileDetails')->name('jobsekker.profile.update');
	
	Route::post('/jobseeker/change-password', 'Jobseeker\ProfileController@updatePassword');
	Route::post('/jobseeker/upload/file', 'Jobseeker\ProfileController@uploadResume');
	
	#Other information
	Route::get('/jobsekker/other-info', 'Jobseeker\ProfileController@otherInfo')->name('jobsekker.otherinfo');
	Route::post('/jobsekker/other-info', 'Jobseeker\ProfileController@updateOtherInfo')->name('jobsekker.otherinfo.update');
	
	#Settings
	Route::get('/jobsekker/settings', 'Jobseeker\ProfileController@settings')->name('jobsekker.settings');
	Route::post('/jobsekker/settings', 'Jobseeker\ProfileController@updateSettings')->name('jobsekker.settings.update');
	Route::post('/jobsekker/check/profilecode', 'Jobseeker\ProfileController@checkProfileCode')->name('jobsekker.settings.profilecode');
	
	
	#Preferences
	Route::get('/jobsekker/preferences', 'Jobseeker\ProfileController@preferences')->name('jobsekker.preferences');
	Route::post('/jobsekker/preferences', 'Jobseeker\ProfileController@updatePreferences')->name('jobsekker.preferences.update');
	
	
	Route::get('/jobsekker/employment/list', 'Jobseeker\ProfileController@listEmployment')->name('jobsekker.employment');
	Route::post('/jobsekker/employment/add', ['as' => 'employmentadd', 'uses' => 'Jobseeker\ProfileController@storeEmployment']);
	Route::get('/jobsekker/employment/edit/{id}', ['as' => 'employment_edit', 'uses' => 'Jobseeker\ProfileController@editEmployment']);
	Route::post("/jobsekker/employment/update", ['as' => 'employment_update', 'uses' => 'Jobseeker\ProfileController@updateEmployment']);
	Route::get('/jobsekker/employment/delete/{id}', ['as' => 'employment_delete', 'uses' => 'Jobseeker\ProfileController@deleteEmployment']);
	
	//reference
	Route::get('/jobsekker/reference/list', 'Jobseeker\ProfileController@listReference')->name('jobsekker.reference');
	Route::post('/jobsekker/reference/add', ['as' => 'referenceadd', 'uses' => 'Jobseeker\ProfileController@storeReference']);
	Route::get('/jobsekker/reference/edit/{id}', ['as' => 'reference_edit', 'uses' => 'Jobseeker\ProfileController@editReference']);
	Route::post("/jobsekker/reference/update", ['as' => 'reference_update', 'uses' => 'Jobseeker\ProfileController@updateReference']);
	Route::get('/jobsekker/reference/delete/{id}', ['as' => 'reference_delete', 'uses' => 'Jobseeker\ProfileController@deleteReference']);
	
	//Education
	Route::get('/jobsekker/education/list', 'Jobseeker\ProfileController@listEducation')->name('jobsekker.education');
	Route::post('/jobsekker/education/add', ['as' => 'educationadd', 'uses' => 'Jobseeker\ProfileController@storeEducation']);
	Route::get('/jobsekker/education/edit/{id}', ['as' => 'education_edit', 'uses' => 'Jobseeker\ProfileController@editEducation']);
	Route::post("/jobsekker/education/update", ['as' => 'education_update', 'uses' => 'Jobseeker\ProfileController@updateEducation']);
	Route::get('/jobsekker/education/delete/{id}', ['as' => 'education_delete', 'uses' => 'Jobseeker\ProfileController@deleteEducation']);
	
	//Skill
	Route::get('/jobsekker/skill/list', 'Jobseeker\ProfileController@listSkill')->name('jobsekker.skill');
	Route::post('/jobsekker/skill/add', ['as' => 'skilladd', 'uses' => 'Jobseeker\ProfileController@storeSkill']);
	Route::get('/jobsekker/skill/delete/{id}', ['as' => 'skill_delete', 'uses' => 'Jobseeker\ProfileController@deleteSkill']);
	
	// Resumes.
	Route::get('/jobseeker/resumes', 'Jobseeker\ProfileController@resumes');
	Route::post('/jobseeker/resume/delete', 'Jobseeker\ProfileController@deleteResume');
	
	// Languages
	Route::get('/jobsekker/language/list', 'Jobseeker\ProfileController@listLanguage')->name('jobsekker.language');
	Route::post('/jobsekker/language/add', ['as' => 'languageadd', 'uses' => 'Jobseeker\ProfileController@storeLanguage']);
	Route::get('/jobsekker/language/delete/{id}', ['as' => 'language_delete', 'uses' => 'Jobseeker\ProfileController@deleteLanguage']);

});//END JOB SEKKER SESSION

######################################## EMPLOYER ##############################################

Route::get('/employer', function () { return view('main/employer/home'); })->name('employer.home');

#Register Pages
Route::post('/employer/sign-up/check/email', 'Employer\RegisterController@checkEmail')->name('employer.check.email');
Route::get('/employer/register', 'Employer\RegisterController@index')->name('employer.register');
Route::post('/employer/register', 'Employer\RegisterController@store')->name('employer.store.signup');
Route::get('/employer/sign-up/verify/email/{token}', 'Employer\RegisterController@verifyEmail')->name('employer.verify.email');
Route::post('/employer/login', 'Employer\RegisterController@login')->name('employer.login');

Route::post('/employer/forgotpassword', 'Employer\RegisterController@forgotpassword')->name('employer.forgotpassword');
Route::post('/employer/check/checkcompanyalias', 'Employer\RegisterController@checkCompanyalias')->name('employer.register.companyalias');
Route::group(['middleware' => 'is-employer'], function () {
	Route::get('/employer/logout', 'Employer\RegisterController@logout')->name('employer.logout');
	Route::get('/employer/dashboard', 'Employer\RegisterController@dashboard')->name('employer.dashboard');
	Route::get('/employer/post/list', 'Employer\PostController@index')->name('employer.post.list');
	Route::get('/employer/post/add', 'Employer\PostController@postAdd')->name('employer.post.add');
	Route::get('/employer/post/{id}', 'Employer\PostController@postEdit')->where('id', '[0-9]+');
	Route::post('/employer/post/{id}', 'Employer\PostController@postUpdate')->where('id', '[0-9]+');
	Route::post('/employer/post/store', 'Employer\PostController@postStore')->name('employer.post.store');
	Route::post('/employer/picture/upload', 'Employer\RegisterController@UploadPicture')->name('employer.update.profilepic');
	Route::get('/employer/profile', 'Employer\RegisterController@profile');
	Route::post('/employer/profile', 'Employer\RegisterController@updateProfile');
	Route::get('/employer/post/status/{id}', ['as' => 'update_status', 'uses' => 'Employer\PostController@postStatus']);

});//END EMPLOYER SESSION
