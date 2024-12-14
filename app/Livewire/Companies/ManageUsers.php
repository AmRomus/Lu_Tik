<?php

namespace App\Livewire\Companies;

use App\Models\User;
use Livewire\Component;

class ManageUsers extends Component
{
    public function render()
    {
        $users=User::all();
        return view('livewire.companies.manage-users',compact('users'));
    }
}
