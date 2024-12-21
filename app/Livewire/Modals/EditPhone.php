<?php

namespace App\Livewire\Modals;

use App\Models\BillingAccount;
use Livewire\Attributes\On;
use Livewire\Component;

class EditPhone extends Component
{
    public $show;
    public $acc;
    public $phone;
    #[On('show_modal')]
    public function show_modal(BillingAccount $account)
    {       
        
        $this->acc=$account;
        $this->phone=$account?->phone;
        $this->show=!$this->show;
    }
    public function render()
    {
        return view('livewire.modals.edit-phone');
    }
    public function save()
    {
        $this->acc->phone=$this->phone;
        $this->acc->save();
        $this->dispatch('saved');
        $this->show=!$this->show;
    }
    
}
