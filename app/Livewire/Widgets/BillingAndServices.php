<?php

namespace App\Livewire\Widgets;

use App\Models\BillingAccount;
use Livewire\Component;

class BillingAndServices extends Component
{
    public $account;
    public function mount(BillingAccount $account_id)
    {
        $this->account=$account_id;
    }
    public function render()
    {
        return view('livewire.widgets.billing-and-services');
    }
}
