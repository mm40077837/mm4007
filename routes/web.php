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

Route::get('/home', 'HomeController@index')->name('home'); //メインページ
Route::resource('posts', 'PostController'); //投稿
Route::resource('users', 'UsersController'); //アカウント
Route::resource('comments', 'CommentController'); //コメント
Route::get('/mypage', [DisplayController::class, 'index'])->name('mypage.index');
Route::post('/user_create/{user}', [DisplayController::class, 'iconupdate'])->name('users.iconupdate');
Route::get('/violation_create/{post}', [DisplayController::class, 'createviolation'])->name('violation.create');//違反報告ページへ
Route::post('/show', [DisplayController::class, 'storeviolation'])->name('violation.store');//違反報告して投稿
Route::post('/home', 'PostController@index')->name('posts.index');

Route::get('/user_list', [DisplayController::class, 'administrator'])->name('admin.strator');//管理者画面（ユーザーの一覧））
Route::get('/post_list', [DisplayController::class, 'adminpost'])->name('admin.post');//管理者画面（投稿の一覧）
Route::get('/post_list_delete/{id}', [DisplayController::class, 'logicaldelete'])->name('admin.logicaldelete');//表示停止（論理削除）


//ログイン中のユーザーのみアクセス可能

    //「ajaxlike.jsファイルのurl:'ルーティング'」に書くものと合わせる。
Route::post('ajaxlike', 'PostController@ajaxlike')->name('posts.ajaxlike');

