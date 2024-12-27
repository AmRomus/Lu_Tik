<?php

namespace App\Livewire\Iptv;

use App\Models\PlayList;
use Livewire\Component;

class ManagePlayLists extends Component
{
   
    public function render()
    {
        $playlists=PlayList::all();
        return view('livewire.iptv.manage-play-lists',compact('playlists'));
    }
    public function del(PlayList $pl)
    {
        if($pl->IptvServices->count()==0)
        {
            $pl->delete();
        }
        
    }
}
