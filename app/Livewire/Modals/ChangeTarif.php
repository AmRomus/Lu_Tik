<?php

namespace App\Livewire\Modals;

use App\Models\BillingAccount;
use App\Models\Tarif;
use Livewire\Attributes\On;
use Livewire\Component;
use Auth;
class ChangeTarif extends Component
{
    public $selected_tarif;
    public $show;    
    #[On('show_modal')]
    public function show_modal()
    {      
        $this->show=!$this->show;
    }
    public $account;
    public function mount($account_id)
    {
        if(Auth::user()->hasAnyPermission(['Delete accounts','Superadmin'])){
        $this->account=BillingAccount::withTrashed()->find($account_id)->load('Tarif');    
        }  else {
            $this->account=BillingAccount::findOrFail($account_id)->load('Tarif');    
        }
        $this->selected_tarif=$this->account->tarif_id;
    }
    public function render()
    {
        return view('livewire.modals.change-tarif',['tarifs'=>Tarif::all()]);
    }
    public function save()
    {
        if(intval($this->selected_tarif)>0){
            $this->account->tarif_id=$this->selected_tarif;       
           
        }else 
        {
           // dd($this->account->load('Tarif'));
            $this->account->tarif_id=null;

        }
        $this->account->save();
        $this->dispatch('saved');
        $this->show_modal();
    }
}
