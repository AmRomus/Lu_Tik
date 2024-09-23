<?php

namespace App\Livewire\Managment;

use App\Models\BillingAccount;
use Livewire\Component;

class Accounts extends Component
{
    public function render()
    {
        $accounts=BillingAccount::all();
        return view('livewire.managment.accounts',['accounts'=>$accounts]);
    }
}
