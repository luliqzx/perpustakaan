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

Route::group(['middleware' => ['web']], function () {
    //
	Route::auth();

Route::get('/', function () {
	return view('welcome');
});

	
	Route::get('/home', 'HomeController@index');

	// Route::group(['prefix'=>'admin', 'middleware'=>['auth']], function () {
		// Route diisi disini...
	Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'role:admin']], function () {
		Route::resource('authors', 'AuthorsController');
		Route::resource('books', 'BooksController');

	});	
});

Route::get('/about', 'HomeController@showAbout');


Route::get('/testmodel', function() {
	$post = new App\Post;
	$post->title = "7 Amalan Pembuka Jodoh";
	$post->content = "shalat malam, sedekah, puasa sunah, silaturahmi, senyum, doa, tobat";
	$post->save();
	return $post;
 // check record baru di database
});

