<?php

namespace App\Livewire\Companies;

use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class WorkerAccess extends Component
{
    public $show;
    #[On('show_modal')]
    public function show_modal($role=null)
    {}
    public function render()
    {
        $all_roles=Role::all();
        return view('livewire.companies.worker-access',compact('all_roles'));
    }
}
