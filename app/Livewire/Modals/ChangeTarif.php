<?php

namespace App\Livewire\Modals;

use App\Models\BillingAccount;
use App\Models\Tarif;
use Livewire\Attributes\On;
use Livewire\Component;

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
      
        $this->account=BillingAccount::find($account_id)->load('Tarif');      
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
