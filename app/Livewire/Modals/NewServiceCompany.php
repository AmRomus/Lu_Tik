<?php

namespace App\Livewire\Modals;

use App\Models\ServiceCompanies;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class NewServiceCompany extends Component
{
    public $show;
    #[Rule('required|unique:service_companies,name')]
    public $name;
    #[On('show_modal')]
    public function show_modal()
    {   
        $this->show=!$this->show;
    }
    public function render()
    {
        return view('livewire.modals.new-service-company');
    }
    public function save()
    {
        $this->validate();
        $sc=new ServiceCompanies();
        $sc->name=$this->name;
        $sc->save();
        $this->show=false;
        $this->dispatch('saved');
    }
}
