<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;

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

Route::get('/dashboard', 'RoleController@redirectToDashboard')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::resource('events', 'EventController');
});

// ユーザー登録後の画面
Route::get('/registration-success', function () {
    return view('auth.register_success');
})->name('register.success');

// イベントカレンダー
Route::get('/calendar', [EventController::class, 'calendar'])->name('events.calendar');

// イベント参加登録とキャンセル
Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register');
Route::post('/events/{event}/cancel', [EventController::class, 'cancel'])->name('events.cancel');

// 参加者リストとCSVエクスポート
Route::get('/events/{event}/participants', [EventController::class, 'participants'])->name('events.participants');
Route::get('/events/{event}/export-csv', [EventController::class, 'exportCsv'])->name('events.exportCsv');
