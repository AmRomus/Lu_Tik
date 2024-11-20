<?php

namespace App\Livewire\Modals;

use App\Models\Olt;
use App\Models\OltTemplate;
use Livewire\Attributes\Rule;
use Livewire\Attributes\On;

use Livewire\Component;

class NewOlt extends Component
{
    public $show;
    public $templates;
    public $selected_template;
    #[Rule('integer|gt:0')]
    public $port=161;
    #[Rule('required|ip|unique:olts,ip')]
    public $ip;
    #[Rule('required')]
    public $name;
    #[Rule('required')]
    public $ro_community;
    #[Rule('required')]
    public $rw_community;
    public $valid=false;
    public function mount()
    {
        $this->templates = OltTemplate::all();
    }
    #[On('show_modal')]
    public function show_modal()
    {      
        $this->show=!$this->show;
    }
    public function updated()
    {
        $this->validate();
        $this->valid=true;
    }
    public function render()
    {
        return view('livewire.modals.new-olt');
    }
    public function add_olt()
    {
        $olt = new Olt();
        $olt->name=$this->name;
        $olt->ip=$this->ip;
        $olt->port = $this->port;
        $olt->olt_template_id = $this->selected_template;
        $olt->ro_community = $this->ro_community;
        $olt->rw_community = $this->rw_community;
        $olt->save();
        $this->dispatch('saved');
    }
}
