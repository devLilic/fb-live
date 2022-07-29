<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FbController;
use App\Http\Controllers\FbUserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserSettingController;
use App\Http\Livewire\Dashboard;
use App\Services\FbApi;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AuthenticatedSessionController::class, 'create'])->middleware('guest');

Route::group(['prefix' => '/', 'middleware'=>'auth'], function(){
//    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('schedule', ScheduleController::class);

    Route::resource('rooms', RoomController::class);

    Route::get('settings', [UserSettingController::class, 'index'])->name('settings.index');

    Route::get('fbtest', [FbController::class, 'index'])->name('fb-index');
    Route::get('fbtest/logout', [FbController::class, 'logout'])->name('fb-logout');

    Route::get('auth/facebook/callback', [FbController::class, 'callback'])->name('callback');
});

Route::group(['prefix' => 'auth/facebook', 'middleware' => 'auth'], function () {
    Route::get('/', function (){
        return redirect((new FbApi())->redirectTo());
    })->name('fb.auth');

//    Route::get('/callback', [FbUserController::class, 'index'])->name('fb.callback');
});



Route::get('/policy', function () {
    return view('pages.policy');
})->name('policy');

require __DIR__.'/auth.php';
