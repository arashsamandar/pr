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

$this->get('/','HomeController@index')->name('home');

$this->get('/home','HomeController@index')->name('home');

Route::get('/upload','UploadController@index')->name('upload');

Route::get('userimage/{id}','ImageController@showimage')->name('userimage');

Route::get('/changepass','UserUpdateController@updatepass')->name('uppass');
Route::post('/changepass','UserUpdateController@changepass')->name('uppass');

$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/update','UserUpdateController@showUpdate')->name('update');
Route::post('/update','UserUpdateController@update');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/crop/{id}','ImageController@showimage');

// Starting Ajax Calls

Route::get('users', 'AjaxController@index')->name('users');

Route::post('users', 'AjaxController@index');

Route::get('contacts','AjaxController@readData'); // put it on top secret

Route::get('/student/read-data','AjaxController@readData'); // put it on top secret

Route::post('/student/store','AjaxController@store');

Route::post('/student/destroy','AjaxController@destroy');

Route::get('/users/edit','AjaxController@edit')->name('edit');

Route::post('/student/update','AjaxController@update');

Route::get('/users/pagination','AjaxController@pagination')->name('userspagination');


Route::get('/student/show/','AjaxController@showName');

Route::post('/student/search','AjaxController@searchNames')->name('searchName');

Route::get('/student/showpassword','AjaxController@showpassword');

Route::post('/student/changepass','AjaxController@changepass');

Route::post('/student/saveimage','AjaxController@saveimage');

Route::get('/student/showaccess','AjaxController@show_access');

Route::post('/student/changaccess','AjaxController@change_access');




// CMS Section

// ___________________________Content Page_______________________________

Route::get('/users/addContent','AjaxContentController@pagination')->name('addcontent'); // shows content page with pagination

Route::post('/users/saveContent','AjaxContentController@saveContent')->name('saveContent'); // shows the modal and saves it

Route::post('/content/destroy','AjaxContentController@DestroyContent')->name('destroycontent'); // destroys the contents with its pictures

Route::get('/content/edit','AjaxContentController@editContent')->name('editContent'); // shows edit modal with its values

Route::post('/content/update','AjaxContentController@UpdateContent')->name('UpdateContent');

Route::get('/content/showcontentimage','AjaxContentController@showContentImages')->name('showcontentimage');

Route::get('/aboutUs',function() {
    return view('MainPages.aboutUs');
})->name('aboutUs');

Route::get('/Services',function (){
   return view('MainPages.ourServices');
})->name('ourServices');

Route::get('/ContactUs',function (){
    return view('MainPages.contactUs');
})->name('contactUs');

//Route::get('/{website}','PageManager@goToAddress')->name('goTo');

Route::get('/{page_address}','PageManager@makePages')->name('page_caller');



//Route::get('/mypage','AjaxContentController@testFunction');  // IMPORTANT :: -> DELETE THIS LINE


//Route::get('/yourcontent',function() {
//   return view('MainPages.newpage');
//})->name('welcome');
//
//Route::post('/submit',function(\Illuminate\Http\Request $request) {
//   $content = $request['content'];
//   return view('MainPages.output',['content' => $content]);
//})->name('submit');

//Route::get( 'sites/{keyword}', function ( $keyword) {
//    fopen( resource_path( 'views/' . $keyword . '.blade.php' ), 'w' );
//    return view(  $keyword   );
//} );




//Route::post('/student/test','AjaxController@getuserimageid')->name('getuserimageid');
//Route::get('/student/pagination','AjaxController@pagination');
//Route::get('/userdata/{filename}','UsersController@getUserImage')->name('account.image');