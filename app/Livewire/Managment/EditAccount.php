<?php

namespace App\Livewire\Managment;

use App\Models\BillingAccount;
use Livewire\Component;

class EditAccount extends Component
{
    public $acc;
    public $account;
    public function mount($billing_account)
    {
        $this->account=BillingAccount::findOrFail($billing_account);
        $this->acc=$this->account?->toArray();
    }
    public function render()
    {
        return view('livewire.managment.edit-account');
    }
}
