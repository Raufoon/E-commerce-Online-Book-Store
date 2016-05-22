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
Route::post('/books', 'mycontrollers\BooksPageController@process_filter');


/*
default page is set as 'about' page
*/
Route::get('/profile', ['middleware' => 'auth', function()
{
    return view('myviews/profile/profilepage_about');
}]);



/*
goes to edit profile page
*/
Route::get('/profile/about/edit', ['middleware' => 'auth', function()
{
    return view('myviews/profile/profilepage_edit');
}]);



/*
form submitted here after editing profile
*/
Route::post('/profile/save_edit', ['before' => 'csrf', 'uses' => 'mycontrollers\ProfilePageController@updateDatabase'] );


/*
addition of new book by manager
*/
Route::post('/profile/office/inventory/book_add','mycontrollers\ManagerFunctionController@addBookToDatabase');

/*
advertisement of book by user
*/
Route::post('/advertise_book','mycontrollers\UserAdController@addAd');

/*
when user deletes an advertisement
*/
Route::post('/remove_ad','mycontrollers\UserAdController@removeAd');

/*
if logged in user chooses to view someones profile
*/
Route::get('/profile/view/{profile_id}','mycontrollers\ProfileViewController@index');
/*
goes to a section of profile page named by $page 
*/
Route::get('/profile/{page}/{section}', 'mycontrollers\ProfilePageController@open_office_page');

Route::get('/profile/{page}', 'mycontrollers\ProfilePageController@index');


/*
if logged in user chooses to view someones profile and a particular section of that profile
*/
Route::get('/profile/view/{profile_id}/{page}','mycontrollers\ProfileViewController@loadSection');

/*
when profile picture needs to be uploaded
*/
Route::post('/profile/propic/save', 'mycontrollers\ProfilePageController@savePropic');

/*
routes to search page
*/
Route::get('/search','mycontrollers\SearchResultController@search');
?>