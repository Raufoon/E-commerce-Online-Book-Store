<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/books', 'mycontrollers\BooksPageController@index');

Route::get('/profile/styles/profile_page.css',function()
{
    return view('styles/profilepage.css');
});

Route::get('/profile', ['middleware' => 'auth', function()
{
    return view('myviews/profile/profilepage_about');
}]);

Route::get('/profile/about/edit', ['middleware' => 'auth', function()
{
    return view('myviews/profile/profilepage_edit');
}]);

Route::post('/profile/save_edit', ['before' => 'csrf', 'uses' => 'mycontrollers\ProfilePageController@updateDatabase'] );


Route::get('/profile/{page}', 'mycontrollers\ProfilePageController@index');

Route::get('/profile/view/{profile_id}','mycontrollers\ProfileViewController@index');

Route::get('/profile/view/{profile_id}/{page}','mycontrollers\ProfileViewController@loadSection');

?>