<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

// ロールに基づくルート
Route::middleware(['auth'])->group(function () {
    // 管理者専用ページ
    Route::get('/admin', function () {
        if (Auth::user()->role === 'admin') {
            return view('admin.dashboard'); // 管理者用のビューを表示
        }
        abort(403, 'Unauthorized action.');
    });

    // イベント主催者専用ページ
    Route::get('/organizer', function () {
        if (Auth::user()->role === 'organizer') {
            return view('organizer.dashboard'); // イベント主催者用のビューを表示
        }
        abort(403, 'Unauthorized action.');
    });

    // 一般ユーザー専用ページ
    Route::get('/user', function () {
        if (Auth::user()->role === 'user') {
            return view('user.dashboard'); // 一般ユーザー用のビューを表示
        }
        abort(403, 'Unauthorized action.');
    });
});

