<?php

namespace App\Livewire\Modals;

use App\Models\Address;
use App\Models\BillingAccount;
use Livewire\Attributes\On;
use Livewire\Component;

class EditContacts extends Component
{
    public $selected_address;
    public $ret_id;
    public $addr;
    public $show;
    public $account;
    public $phone;

    #[On('show_modal')]
    public function show_modal(BillingAccount $account)
    {
        $this->account=$account;      
        $this->show=!$this->show;
    }
    public function  mount()
    {
        $this->addr=Address::isRoot()->get();
    }
    public function render()
    {
        return view('livewire.modals.edit-contacts');
    }
    public function hide_modal()
    {
        $this->show=false;
       
    }
    #[On('select_address')]
    public function select_address($id)
    {
       $this->selected_address=Address::find($id)?->rootAncestororSelf()->first()->FullAddress;
       $this->ret_id=$id;
    }
    public function set_address()
    {
        $this->account->address_id=$this->ret_id;
        $this->account->save();
        $this->dispatch('saved');
        $this->hide_modal();
    }
}
