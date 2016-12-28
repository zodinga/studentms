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
		//Registration
	//disable registration from guest
	/*Route::get('auth/register',['as'=>'register','uses'=> 'Auth\AuthController@getRegister']);
	Route::post('auth/register','Auth\AuthController@postRegister');*/
	//End disable
	//Reroute /auth/register
		//Route::any('/auth/register','PagesController@getIndex');
	//End Reroute

	//GUEST
	//Authenticate
	Route::get('auth/login',['as'=>'login','uses'=>'Auth\AuthController@getLogin']);
	Route::post('auth/login','Auth\AuthController@postLogin');
	Route::get('auth/logout',['as'=>'logout','uses'=> 'Auth\AuthController@getLogout']);
	
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


//AUTHORISED

	Route::get('dashboard', ['uses'=>'PagesController@getDashboard','as'=>'dashboard',
		'middleware'=>'roles',
		'roles'=>['Reception','Admin','Coordinator','Faculty']
		]);

	///////////////Route::get('pages/students/{id}',['as'=>'pages.students','uses'=>'PagesController@getStudents']);

	//STUDENT
	//Route::resource('students','StudentController');
	Route::get('students',['as'=>'students.index','uses'=>'StudentController@index']);
	Route::get('students/create',['as'=>'students.create','uses'=>'StudentController@create','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::post('students/create',['as'=>'students.store','uses'=>'StudentController@store','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::get('students/{id}',['as'=>'students.show','uses'=>'StudentController@show']);
	Route::get('students/{id}/edit',['as'=>'students.edit','uses'=>'StudentController@edit','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::put('students/{id}',['as'=>'students.update','uses'=>'StudentController@update','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::delete('students/{id}',['as'=>'students.destroy','uses'=>'StudentController@destroy','middleware' => 'roles','roles' => ['Admin','Coordinator']]);

	Route::get('students/editSubject/{id}',['as'=>'students.editSubject','uses'=>'StudentController@editSubject','middleware'=>'roles','roles'=> ['Admin','Coordinator','Faculty','Reception']]);
	Route::put('students/updateSubject/{id}',['uses'=>'StudentController@updateSubject', 'as'=>'students.updateSubject','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	//END STUDENT

	//CATEGORIES
	//Route::resource('categories','CategoryController',['except'=>['create']]);
	Route::get('categories',['as'=>'categories.index','uses'=>'CategoryController@index']);
	Route::get('categories/create',['as'=>'categories.create','uses'=>'CategoryController@create','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::post('categories/create',['as'=>'categories.store','uses'=>'CategoryController@store','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::get('categories/{id}',['as'=>'categories.show','uses'=>'CategoryController@show']);
	Route::get('categories/{id}/edit',['as'=>'categories.edit','uses'=>'CategoryController@edit','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::put('categories/{id}',['as'=>'categories.update','uses'=>'CategoryController@update','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::delete('categories/{id}',['as'=>'categories.destroy','uses'=>'CategoryController@destroy','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	//END CATEGORIES

	//COURSES
	//Route::resource('courses','CourseController',['except'=>['create']]);
	Route::get('courses',['as'=>'courses.index','uses'=>'CourseController@index']);
	Route::get('courses/create',['as'=>'courses.create','uses'=>'CourseController@create','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::post('courses/create',['as'=>'courses.store','uses'=>'CourseController@store','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::get('courses/{id}',['as'=>'courses.show','uses'=>'CourseController@show']);
	Route::get('courses/{id}/edit',['as'=>'courses.edit','uses'=>'CourseController@edit','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::put('courses/{id}',['as'=>'courses.update','uses'=>'CourseController@update','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::delete('courses/{id}',['as'=>'courses.destroy','uses'=>'CourseController@destroy','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	//END COURSES


	//COMMUNITIES
	//Route::resource('communities','CommunityController',['except'=>['create']]);
	Route::get('communities',['as'=>'communities.index','uses'=>'CommunityController@index']);
	Route::get('communities/create',['as'=>'communities.create','uses'=>'CommunityController@create','middleware' => 'roles','roles' => ['Admin']]);
	Route::post('communities/create',['as'=>'communities.store','uses'=>'CommunityController@store','middleware' => 'roles','roles' => ['Admin']]);
	Route::get('communities/{id}',['as'=>'communities.show','uses'=>'CommunityController@show']);
	Route::get('communities/{id}/edit',['as'=>'communities.edit','uses'=>'CommunityController@edit','middleware' => 'roles','roles' => ['Admin']]);
	Route::put('communities/{id}',['as'=>'communities.update','uses'=>'CommunityController@update','middleware' => 'roles','roles' => ['Admin']]);
	Route::delete('communities/{id}',['as'=>'communities.destroy','uses'=>'CommunityController@destroy','middleware' => 'roles','roles' => ['Admin']]);
	//END COMMUNITIES

	//STATUSES
	//Route::resource('statuses','StatusController',['except'=>['create']]);
	Route::get('statuses',['as'=>'statuses.index','uses'=>'StatusController@index']);
	Route::get('statuses/create',['as'=>'statuses.create','uses'=>'StatusController@create','middleware' => 'roles','roles' => ['Admin']]);
	Route::post('statuses/create',['as'=>'statuses.store','uses'=>'StatusController@store','middleware' => 'roles','roles' => ['Admin']]);
	Route::get('statuses/{id}',['as'=>'statuses.show','uses'=>'StatusController@show']);
	Route::get('statuses/{id}/edit',['as'=>'statuses.edit','uses'=>'StatusController@edit','middleware' => 'roles','roles' => ['Admin']]);
	Route::put('statuses/{id}',['as'=>'statuses.update','uses'=>'StatusController@update','middleware' => 'roles','roles' => ['Admin']]);
	Route::delete('statuses/{id}',['as'=>'statuses.destroy','uses'=>'StatusController@destroy','middleware' => 'roles','roles' => ['Admin']]);
	//END STATUSES

	//USERS
	//Route::resource('users','UserController',['except'=>['create']]);
	Route::get('users',['as'=>'users.index','uses'=>'UserController@index','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::get('users/create',['as'=>'users.create','uses'=>'UserController@create','middleware' => 'roles','roles' => ['Admin']]);
	Route::post('users/create',['as'=>'users.store','uses'=>'UserController@store','middleware' => 'roles','roles' => ['Admin']]);
	Route::get('users/{id}',['as'=>'users.show','uses'=>'UserController@show','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::get('users/{id}/edit',['as'=>'users.edit','uses'=>'UserController@edit','middleware' => 'roles','roles' => ['Admin']]);
	Route::put('users/{id}',['as'=>'users.update','uses'=>'UserController@update']);
	Route::delete('users/{id}',['as'=>'users.destroy','uses'=>'UserController@destroy','middleware' => 'roles','roles' => ['Admin']]);
	//END USERS
	
	//Subject
	//Route::resource('subjects','SubjectController',['except'=>['create']]);
	Route::get('subjects',['as'=>'subjects.index','uses'=>'SubjectController@index']);
	Route::get('subjects/create',['as'=>'subjects.create','uses'=>'SubjectController@create','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::post('subjects/create',['as'=>'subjects.store','uses'=>'SubjectController@store','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::get('subjects/{id}',['as'=>'subjects.show','uses'=>'SubjectController@show','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::get('subjects/{id}/edit',['as'=>'subjects.edit','uses'=>'SubjectController@edit','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::put('subjects/{id}',['as'=>'subjects.update','uses'=>'SubjectController@update','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::delete('subjects/{id}',['as'=>'subjects.destroy','uses'=>'SubjectController@destroy','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
//End Subject

	//RESULTS
	//Route::resource('results','ResultController');
	Route::get('results',['as'=>'results.index','uses'=>'ResultController@index']);
	Route::get('results/create',['as'=>'results.create','uses'=>'ResultController@create','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::post('results/create',['as'=>'results.store','uses'=>'ResultController@store','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::get('results/{id}',['as'=>'results.show','uses'=>'ResultController@show','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::get('results/{id}/edit',['as'=>'results.edit','uses'=>'ResultController@edit','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::put('results/{id}',['as'=>'results.update','uses'=>'ResultController@update','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::delete('results/{id}',['as'=>'results.destroy','uses'=>'ResultController@destroy','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	//END RESULTS

	//SEARCH
	Route::get('studentsearch', ['uses'=>'StudentController@search','as'=>'students.search',
		'middleware'=>'roles',
		'roles'=>['Reception','Admin','Coordinator','Faculty']
		]);

	Route::get('search', ['uses'=>'ResultController@search','as'=>'results.search']);
	//END SEARCH

	//EXCEL IMPORT AND EXPORT
	Route::get('index','ExcelController@getIndex');
	Route::get('export',['uses'=>'ExcelController@getExport','as'=>'excel.export']);
	Route::post('import',['uses'=>'ExcelController@getImport','as'=>'excel.import','middleware' => 'roles','roles' => ['Admin','Coordinator','Reception']]);
	//END EXCEL IMPORT AND EXPORT

	Route::get('exportSubjects',['uses'=>'ExcelController@getExportSubjects','as'=>'excel.exportSubjects']);
	Route::post('importSubject',['uses'=>'ExcelController@getImportSubject','as'=>'excel.importSubject','middleware' => 'roles','roles' => ['Admin','Coordinator','Reception']]);

	//Admin Route
	Route::post('assign',['uses'=>'AdminController@postAssign', 'as'=>'admin.assign','middleware' => 'roles','roles' => ['Admin']]);

});
