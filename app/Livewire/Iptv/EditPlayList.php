<?php

namespace App\Livewire\Iptv;

use App\Models\iptv_streams_play_list;
use App\Models\IptvStreams;
use App\Models\PlayList;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class EditPlayList extends Component
{
    public $name;
    public $playlist;
    public $channels;
    public $all_channels;
    public $show_channels;
    #[On('hide')]
    public function hide_channels(){
        $this->show_channels=false;
    }
    #[On('show')]
    public function show_channels(){
       $this->show_channels=true;
    }
    #[On('add_channel')]
    public function add_channel($id)
    {
        $piv=iptv_streams_play_list::where('play_list_id',$this->playlist->id)->pluck('order_id')->max()+1;     
        $this->playlist->channels()->attach($id,['order_id'=>$piv]);
        $this->all_channels=IptvStreams::whereNotIn('id',$this->playlist->channels->pluck('id'))->get();
        $this->show_channels=false;
    }
    public function rules()
    {
        return [
            'name' => ['required', Rule::unique('play_lists','name')->ignore($this->playlist->id)],
           
        ];
    }
    public function mount($playlist)
    {
        $this->playlist = PlayList::find($playlist);  
        $this->channels =  $this->playlist->channels;
        $this->name=$this->playlist?->name;
        //dd($this->channels->pluck('id'));
        if($this->playlist->channels->count()>0){
            $this->all_channels=IptvStreams::whereNotIn('id',$this->channels->pluck('id'))->get();
        }else 
        {
            $this->all_channels=IptvStreams::all();
        }
    }
    public function updatedName($value)
    {
        $this->validate();
        $this->playlist->name=$value;
        $this->playlist->save();
    }
    public function updateChannelOrder($new_sort)
    {
        if(is_array($new_sort))
        {         
             foreach($new_sort as $key=>$value)
             {
               
                  $stream_reorder=iptv_streams_play_list::where(function($q)use($value){
                    $q->where('play_list_id',$this->playlist->id);
                    $q->where('id',$value["value"]);
                  })->first();
                  $stream_reorder->order_id=$value["order"];
                  $stream_reorder->save();                    
                            
             }
            $this->channels=$this->playlist->channels;
            
        }
        
    }
    public function remove($id)
    {
       $itm=iptv_streams_play_list::find($id);
       $itm->delete();
       $this->all_channels=IptvStreams::whereNotIn('id',$this->playlist->channels->pluck('id'))->get();
    }
    public function render()
    {
        return view('livewire.iptv.edit-play-list');
    }
}
