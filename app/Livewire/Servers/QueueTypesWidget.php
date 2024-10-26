<?php

namespace App\Livewire\Servers;

use App\Models\Mikrotik;
use Livewire\Component;

class QueueTypesWidget extends Component
{
    public $mk;
    public $qtype;
    public function mount(Mikrotik $mikrotik)
    {
        $this->mk=$mikrotik;
    }
    public function render()
    {
        return view('livewire.servers.queue-types-widget');
    }
    public function save()
    {
        $this->mk->qtype=$this->qtype;
        $this->mk->save();
        $this->dispatch('saved');
    }
}
