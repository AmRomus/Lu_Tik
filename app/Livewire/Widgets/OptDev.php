<?php

namespace App\Livewire\Widgets;

use App\Models\Onu;
use Livewire\Component;

class OptDev extends Component
{
    public $dev;    
    public function mount( $dev){
        $this->dev = Onu::find($dev);           
    }
    public function render()
    {
        return view('livewire.widgets.opt-dev');
    }
}
