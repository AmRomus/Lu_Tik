<?php

namespace App\Livewire\Modals;

use App\Models\BillingAccount;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Validation\Rule;
class EditPersonal extends Component
{
    public $show;
   
    public $ident;

    public $first;
    public $last;
    public $middle;
    public $acc;
    #[On('show_modal')]
    public function show_modal(BillingAccount $account)
    {
       
        $this->ident=$account->ident;
        $this->first=$account->first;
        $this->last=$account->last;
        $this->middle=$account->middle;
        $this->acc=$account;
        $this->show=!$this->show;
    }
    public function rules()
    {
        return [
            'ident'=>['required', Rule::unique('billing_accounts')->ignore($this->acc?->id)],
        ];
    }
    public function hide_modal()
    {
        $this->show=!$this->show;
    }
    public function save()
    {
        $this->validate();
        $this->acc->first=$this->first;
        $this->acc->last=$this->last;
        $this->acc->middle=$this->middle;
        $this->acc->ident=$this->ident;
        $this->acc->save();
        $this->dispatch('saved');
        $this->hide_modal();
    }
    public function render()
    {
        return view('livewire.modals.edit-personal');
    }
}
