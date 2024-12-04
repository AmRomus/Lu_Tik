<?php

namespace App\Livewire\Iptv;

use App\Models\IptvStreams;
use Livewire\Component;
use Livewire\WithPagination;

class Streams extends Component
{
    use WithPagination;
    public $search;

    protected $paginationTheme = 'bootstrap';
    public function mount(){
       
    }
    public function render()
    {
        $pchannels=IptvStreams::where(function($q){
            $q->where('name','LIKE','%'.$this->search.'%');
            $q->orWhere('stream_url','like','%'.$this->search.'%');            
        })
      //->with('epg')
        ->paginate(10);
        return view('livewire.iptv.streams',compact('pchannels'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
    // public function render()
    // {
    //     return view('livewire.iptv.streams');
    // }
}
