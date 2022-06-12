<?php

use Illuminate\Support\Facades\Route;

//Controller Folder Dashboard
use App\Http\Controllers\Dashboard\MemberController;
use App\Http\Controllers\Dashboard\MyOrderController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RequestController;
use App\Http\Controllers\Dashboard\ServiceController;

//Controller Folder Landing
use App\Http\Controllers\Landing\LandingController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::resource('/', LandingController::class);
Route::get('explore', [LandingController::class, 'explore'])->name('explore.landing');
Route::get('detail/{id}', [LandingController::class, 'detail'])->name('detail.landing');
Route::get('boking/{id}', [LandingController::class, 'boking'])->name('boking.landing');
Route::get('detail_boking/{id}', [LandingController::class, 'detail_boking'])->name('detail.boking.landing');

Route::group(['prefix' => 'member', 'as' => 'member.', 'middleware' => ['auth:sanctum', 'verified']],
    function(){
        //Dashboard
        Route::resource('dashboard', MemberController::class);

        //Service
        Route::resource('service', ServiceController::class);

        //Request
        Route::resource('request', RequestController::class);
        Route::get('approve_request/{id}', [RequestController::class, 'approve'])->name('approve.request');

        //My order
        Route::resource('order', MyOrderController::class);
        Route::get('accept/order/{id}', [MyOrderController::class, 'accepted'])->name('accept.order');
        Route::get('reject/order/{id}',[ MyOrderController::class, 'rejected'])->name('reject.order');

        // Profile
        Route::resource('profile', ProfileController::class);
        Route::get('delete_photo', [ProfileController::class, 'delete'])->name('delete.photo.profile');
    }
);
