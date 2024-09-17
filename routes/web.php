<?php

use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use App\Livewire\Servers\EditMikrotik;
use App\Livewire\Servers\Mikrotiks;
use Illuminate\Support\Facades\Route;

Route::get('/', Dashboard::class)->middleware('auth');

Route::get('/login',Login::class)->name('login');
Route::post('/logout',function(){
    Auth::logout();
     return redirect('/');
})->name('logout');

#servers
Route::middleware('auth')->prefix('/servers')->group(function(){
    Route::get('/mikrotik',Mikrotiks::class)->name('mikrotik.list');
    Route::get('/mikrotik/{mikrotik}/edit',EditMikrotik::class)->name('mikrotik.edit');
});