<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;


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

// Route::get('/',[DisplayController::class,'main']);

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    
Route::get('/home', 'HomeController@index')->name('home'); 
Route::resource('posts', 'PostController'); 
Route::resource('users', 'UsersController'); 
Route::resource('comments', 'CommentController'); 
Route::get('/mypage', [DisplayController::class, 'index'])->name('mypage.index');
Route::post('/user_create/{user}', [DisplayController::class, 'iconupdate'])->name('users.iconupdate');
Route::get('/violation_create/{post}', [DisplayController::class, 'createviolation'])->name('violation.create');
Route::post('/show', [DisplayController::class, 'storeviolation'])->name('violation.store');
Route::post('/home', 'PostController@index')->name('posts.index');

Route::get('/user_list', [DisplayController::class, 'administrator'])->name('admin.strator');
Route::get('/post_list', [DisplayController::class, 'adminpost'])->name('admin.post');
Route::get('/post_list_delete/{id}', [DisplayController::class, 'logicaldelete'])->name('admin.logicaldelete');
Route::get('/heart_list', [DisplayController::class, 'heartlist'])->name('heart.list');

Route::post('ajaxlike', 'PostController@ajaxlike')->name('posts.ajaxlike');

});