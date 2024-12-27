<?php

namespace App\Livewire\Companies;

use App\Models\ServiceCompanies;
use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    public $user;
    public $name;
    public $email;
    public $password;
    public $companies;
    public $selected_companies;
    public function mount(User $user)
    {
        $this->user=$user;
        $this->name=$user->name;
        $this->email=$user->email;
        $this->companies=ServiceCompanies::all();       
        $this->selected_companies=$user->ServiceCompany()->pluck('service_companies.id');
    }
    public function render()
    {
        return view('livewire.companies.edit-user');
    }
    public function updatedSelectedCompanies()
    {
       // dd( $this->selected_companies);
       $this->user->ServiceCompany()->sync($this->selected_companies->toArray());
    }
}
