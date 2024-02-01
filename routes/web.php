<?php

use App\Livewire\Dashboard\Alertas;
use App\Livewire\Dashboard\Home;
use App\Livewire\User\Create;
use App\Livewire\User\Edit;
use App\Livewire\User\Index;
use App\Livewire\User\LoginForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function(){
    Route::get('/login', LoginForm::class)->name('login');
});

Route::middleware('auth')->group(function(){

    Route::get('/logout', function(){
        Auth::logout();
        session()->regenerate();
        return redirect('login');
    })->name('logout');

    Route::get('/', Home::class)->name('home');
    Route::get('/alertas', Alertas::class)->name('alertas');

    Route::prefix('users')->group(function(){
        Route::get('', Index::class)->name('users.index')->can('users-manager');
        Route::get('/create', Create::class)->name('users.create')->can('users-manager');
        Route::get('/{user}/edit', Edit::class)->name('users.edit')->can('users-manager');
    });
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(env('APP_URL').'/livewire/livewire.js', $handle);
});
