<?php

namespace App\Livewire\Modals;

use App\Models\AcctionsHistory;
use Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EditRoles extends Component
{
    public $show;
    public $selected_arr=[];
    public $role;
    #[On('show_modal')]
    public function show_modal($role)
    {
        $this->role=Role::find($role);
        $this->show=true;
        $this->selected_arr=$this->role->permissions->pluck('id')->toArray();
    }
    public function hide_modal()
    {
        $this->show=false;
    }
    public $permissions;
    public function mount()
    {
        $this->permissions = Permission::all();
    }
    public function render()
    {
        return view('livewire.modals.edit-roles');
    }
    public function save()
    {
        $this->role->Permissions()->sync($this->selected_arr);  
        $acct= new AcctionsHistory();
        $acct->user_id=Auth::user()->id;
        $acct->acction="Edit Role";
        $acct->meta="Set petmissions:";
        foreach($this->role->permissions->pluck('name')->toArray() as $val){
            $acct->meta.=$val.",";
        }
        Auth::user()->AcctionsHistory()->save($acct);     
       // $acct->save();
        $this->hide_modal();
        $this->dispatch('saved');
    }
}
