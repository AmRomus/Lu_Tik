<?php

use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', Dashboard::class)->middleware('auth');

Route::get('/login',Login::class)->name('login');
Route::post('/logout',function(){
    Auth::logout();
     return redirect('/');
})->name('logout');
