<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\PrivateFileController;
use App\Livewire\Apis\MikroBill;
use App\Livewire\Auth\Login;
use App\Livewire\Companies\EditCompany;
use App\Livewire\Companies\EditUser;
use App\Livewire\Companies\ManageCompanies;
use App\Livewire\Companies\ManageUsers;
use App\Livewire\Companies\WorkerAccess;
use App\Livewire\Confs\InetServices;
use App\Livewire\Dashboard;
use App\Livewire\Finances\EditTarif;
use App\Livewire\Finances\Tarifs;
use App\Livewire\Iptv\EditPlayList;
use App\Livewire\Iptv\EditStream;
use App\Livewire\Iptv\ManagePlayLists;
use App\Livewire\Iptv\Streams;
use App\Livewire\Managment\AccountPersonal;
use App\Livewire\Managment\Accounts;
use App\Livewire\Managment\EditAccount;
use App\Livewire\Misc\Addressbook;
use App\Livewire\Network\InetDevices;
use App\Livewire\Pon\OltDetails;
use App\Livewire\Pon\OltList;
use App\Livewire\Servers\EditMikrotik;
use App\Livewire\Servers\Mikrotiks;
use App\Livewire\Support\NeedConfirm;
use App\Livewire\Support\NewsConnection;
use App\Livewire\Support\ReqEdit;
use App\Livewire\Support\ServiceTickets;
use App\Livewire\Support\SupportList;
use App\Livewire\Support\WorkPlan;
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
    Route::get('/olts',OltList::class)->name('olt.list');
    Route::get('/olt/{olt}/edit',OltDetails::class)->name('olt.edit');    
});

#accounts
Route::middleware('auth')->prefix('/accounts')->group(function(){
    Route::get('/list',Accounts::class)->name('accounts.list');
    Route::get('/edit/{billing_account}',EditAccount::class)->name('account.edit');
    Route::get('/personal/{billing_account}',AccountPersonal::class)->name('account.personal');
    Route::get('/personal/pimage/{f_name}',[PrivateFileController::class,'get_passport_image'])->name('get_passport_image');
    Route::get('/personal/files/{f_name}',[PrivateFileController::class,'get_file'])->name('get_file');
});


#misc
Route::middleware('auth')->prefix('/misc')->group(function(){
    Route::get('/addressbook',Addressbook::class)->name('addressbook');
    Route::get('/address/{parent}/childs/{view?}',[AddressController::class,'achilds']);  
});

#finances
Route::middleware('auth')->prefix('/finances')->group(function(){
    Route::get('/tarifs',Tarifs::class)->name('tarifs');
    Route::get('/t/{tarif}/edit',EditTarif::class)->name('finances.edit.tarif');
});



#Network
Route::middleware('auth')->prefix('/network')->group(function(){
    Route::get('/inet_devices',InetDevices::class)->name('inetdevices');
});

#IPTV
Route::middleware('auth')->prefix('/iptv')->group(function(){
    Route::get('/streams',Streams::class)->name('iptv.streams');
    Route::get('/stream/new',EditStream::class)->name('iptv.streams.new');
    Route::get('/stream/{stream_id}/edit',EditStream::class)->name('iptv.streams.edit');
    Route::get('/playlists',ManagePlayLists::class)->name('iptv.playlists');
    Route::get('/playlist/{playlist}/edit',EditPlayList::class)->name('iptv.playlist.edit');
});
Route::get('/logos/{logo?}.png',function($logo){
    return File::get('storage/logos/'.$logo.'.png');
});

#companies
Route::middleware('auth')->prefix('/companies')->group(function(){
    Route::get('/list',ManageCompanies::class)->name('companies.list');
    Route::get('/workers',ManageUsers::class)->name('companies.workers');
    Route::get('/worker/{user}/edit',EditUser::class)->name('company.user.edit');
    Route::get('/company/{company}/edit',EditCompany::class)->name('company.edit');
    Route::get('/positions',WorkerAccess::class)->name('positions');
});

#support
Route::middleware('auth')->prefix('/support')->group(function(){
    Route::get('/new_cons',NewsConnection::class)->name('support.new');
    Route::get('/edit/{tid}',ReqEdit::class)->name('support.ticket.edit');
    Route::get('/unconfirmed',NeedConfirm::class)->name('support.ticket.needconfirm');
    Route::get('/type/{ttype}',ServiceTickets::class)->name('support.tickets.service');
    Route::get('/tasklist',SupportList::class)->name('support.my.tasks');
});
