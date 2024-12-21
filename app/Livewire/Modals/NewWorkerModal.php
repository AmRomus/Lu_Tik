<?php

namespace App\Livewire\Modals;

use App\Models\ServiceCompanies;
use App\Models\User;
use Hash;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class NewWorkerModal extends Component
{
    public $show;
    public $name;
    #[Rule('required|unique:users,email')]
    public $email;
    #[Rule('required')]
    public $password;
    public $service_company_id;
    public $company_list;
    public $roles;
    #[Rule('required')]
    public $role;

    #[On('show_modal')]
    public function show_modal()
    {
        $this->show=!$this->show;
    }
    public function mount()
    {
        $this->company_list=ServiceCompanies::all();
        $this->roles=Role::all();
        $this->role=Role::first()?->name;
    }
    public function render()
    {
        return view('livewire.modals.new-worker-modal');
    }
    public function save()
    {
        $this->validate();
        $user = new User();
        $user->name=$this->name;
        $user->email=$this->email;
        $user->password=Hash::make($this->password);
        $user->service_companies_id=$this->service_company_id?$this->service_company_id:ServiceCompanies::first()?->id;
        $user->save();
        $user->refresh();
        $user->syncRoles($this->role);
        $this->show_modal();
        $this->dispatch('saved');
    }
}
