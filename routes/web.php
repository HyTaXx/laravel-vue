<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\PlaylistController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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



Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',
])->group(function () {
    Route::resource('playlists', PlaylistController::class);
    Route::name('tracks.')->prefix('tracks')->controller(TrackController::class)->middleware([IsAdmin::class])->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{track}', 'show')->name('show');
        Route::get('/{track}/edit', 'edit')->name('edit');
        Route::put('/{track}', 'update')->name('update');
        Route::delete('/{track}', 'destroy')->name('destroy');
    });
});

Route::get('/test',[HomeController::class, 'test'])->name('test');

Route::get('/', [TrackController::class,'index'])->name('tracks.index');





// Route::resource('tracks', TrackController::class)->except(['show']);