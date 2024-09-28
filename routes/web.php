<?php

use App\Http\Controllers\AddressController;
use App\Livewire\Apis\MikroBill;
use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use App\Livewire\Finances\Tarifs;
use App\Livewire\Managment\Accounts;
use App\Livewire\Managment\EditAccount;
use App\Livewire\Misc\Addressbook;
use App\Livewire\Network\InetDevices;
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

#accounts
Route::middleware('auth')->prefix('/accounts')->group(function(){
    Route::get('/list',Accounts::class)->name('accounts.list');
    Route::get('/edit/{billing_account}',EditAccount::class)->name('account.edit');
});


#misc
Route::middleware('auth')->prefix('/misc')->group(function(){
    Route::get('/addressbook',Addressbook::class)->name('addressbook');
    Route::get('/address/{parent}/childs/{view?}',[AddressController::class,'achilds']);  
});

#finances
Route::middleware('auth')->prefix('/finances')->group(function(){
    Route::get('/tarifs',Tarifs::class)->name('tarifs');
});

#FROM API
Route::middleware('auth')->prefix('/apis')->group(function(){
    Route::get('/mikrobill',MikroBill::class)->name('mikrobill');
});

#Network
Route::middleware('auth')->prefix('/network')->group(function(){
    Route::get('/inet_devices',InetDevices::class)->name('inetdevices');
});