<?php

namespace App\Livewire\Modals;

use App\Models\BillingAccount;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class NewBillingAccount extends Component
{
    public $show;
    #[Rule('unique:billing_accounts,ident')]
    public $ident;

    public $first;
    public $last;
    public $middle;

    #[On('show_modal')]
    public function show_modal()
    {      
      $this->show=!$this->show;      
      
    }
    public function updatedIdent()
    {
        $this->validate();
    }
    public function render()
    {
        return view('livewire.modals.new-billing-account');
    }
    public function save()
    {
        $this->validate();
        BillingAccount::create([
            'first'=>$this->first,
            'last'=>$this->last,
            'middle'=>$this->middle,
            'ident'=>$this->ident,
        ]);
        $this->dispatch('saved');
        $this->show_modal();
    }
}
