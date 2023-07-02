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

Route::get('/home', 'HomeController@index')->name('home'); //これがメインページ
Route::resource('Posts', 'PostController'); //投稿
Route::resource('Mypage', 'MypageController'); //マイページ
