<?php

namespace App\Livewire\Modals;

use App\Models\AccountNotes;
use App\Models\BillingAccount;
use Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class NewAccountNote extends Component
{
    public $show;
    #[Rule('required')]
    public $note;

    public $account;
    #[On('show_modal')]
    public function show_modal()
    {
        $this->show=!$this->show;
    }
    public function mount (BillingAccount $account)
    {
        $this->account=$account;
    }
    public function render()
    {
        return view('livewire.modals.new-account-note');
    }
    public function save()
    {
        $this->validate();
        $an= new AccountNotes();
        $an->note=$this->note;
        $an->user_id=Auth::user()->id;       
        $this->account->AccountNotes()->save($an);
        $this->show_modal();
        $this->dispatch('saved');
    }
}
