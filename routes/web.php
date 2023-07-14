<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;


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

Route::get('/home', 'HomeController@index')->name('home'); //メインページ
Route::resource('posts', 'PostController'); //投稿
Route::resource('users', 'UsersController'); //アカウント
Route::resource('comments', 'CommentController'); //コメント
Route::get('/mypage', [DisplayController::class, 'index'])->name('mypage.index');
Route::post('/user_create/{user}', [DisplayController::class, 'iconupdate'])->name('users.iconupdate');
Route::get('/violation_create/{post}', [DisplayController::class, 'createviolation'])->name('violation.create');//違反報告ページへ
Route::post('/show', [DisplayController::class, 'storeviolation'])->name('violation.store');//違反報告して投稿
Route::post('/home', 'PostsController@index')->name('posts.index');
