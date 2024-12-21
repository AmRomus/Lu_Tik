<?php

namespace App\Livewire\Companies;

use App\Models\User;
use Livewire\Component;

class ManageUsers extends Component
{
    public function render()
    {
        $users=User::with('ServiceCompany')->with('roles')->get();
        return view('livewire.companies.manage-users',compact('users'));
    }
    public function delete(User $u)
    {
        if($u)
        {
            $u->delete();
        }
    }
}
