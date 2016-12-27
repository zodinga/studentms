<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middlewareGroups' => ['web']], function () {
	//Authenticate
	Route::get('auth/login',['as'=>'login','uses'=>'Auth\AuthController@getLogin']);
	Route::post('auth/login','Auth\AuthController@postLogin');
	Route::get('auth/logout',['as'=>'logout','uses'=> 'Auth\AuthController@getLogout']);
	
	//Registration
	//disable registration from guest
	/*Route::get('auth/register',['as'=>'register','uses'=> 'Auth\AuthController@getRegister']);
	Route::post('auth/register','Auth\AuthController@postRegister');*/
	//End disable
	//Reroute /auth/register
	Route::any('/auth/register','PagesController@getIndex');
	//End Reroute
	
	//Password Reset Routes
	Route::get('password/reset/{token?}','Auth\PasswordController@showResetForm');
	Route::post('password/email','Auth\PasswordController@sendResetLinkEmail');
	Route::post('password/reset','Auth\PasswordController@reset');
	
	Route::get('public/student/{id}',['as'=>'public.single','uses'=>'PublicController@getSingle']);
	Route::get('public',['uses'=>'PublicController@getIndex','as'=>'public.index']);
	Route::get('public/{id}',['uses'=>'PublicController@getIndex','as'=>'public.index']);

	Route::get('public.search', ['uses'=>'PublicController@getSearch','as'=>'public.search']);
//PAGES/////////////////////
    Route::get('/', 'PagesController@getIndex');
	Route::get('contact', 'PagesController@getContact');
	Route::post('contact', 'PagesController@postContact');

	Route::get('about', 'PagesController@getAbout');

	Route::get('dashboard', 'PagesController@getDashboard');

	Route::get('pages/students/{id}',['as'=>'pages.students','uses'=>'PagesController@getStudents']);
/////////////////////////
	Route::resource('students','StudentController');

	Route::get('studentsearch', ['uses'=>'StudentController@search','as'=>'students.search']);

	Route::resource('categories','CategoryController',['except'=>['create']]);
	Route::resource('courses','CourseController',['except'=>['create']]);
	Route::resource('communities','CommunityController',['except'=>['create']]);
	Route::resource('statuses','StatusController',['except'=>['create']]);
	Route::resource('subjects','SubjectController',['except'=>['create']]);
	Route::resource('users','UserController',['except'=>['create']]);

	Route::resource('results','ResultController');
	Route::get('search', ['uses'=>'ResultController@search','as'=>'results.search']);

	Route::get('index','ExcelController@getIndex');
	Route::get('export',['uses'=>'ExcelController@getExport','as'=>'excel.export']);
	Route::post('import',['uses'=>'ExcelController@getImport','as'=>'excel.import']);

	Route::get('exportSubjects',['uses'=>'ExcelController@getExportSubjects','as'=>'excel.exportSubjects']);
	Route::post('importSubject',['uses'=>'ExcelController@getImportSubject','as'=>'excel.importSubject']);

});
