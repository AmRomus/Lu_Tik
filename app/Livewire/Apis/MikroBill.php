<?php

namespace App\Livewire\Apis;

use App\Models\MikroBillApi;
use Livewire\Component;

class MikroBill extends Component
{
    public function render()
    {
        return view('livewire.apis.mikro-bill',['mapis'=>MikroBillApi::all()]);
    }
}
