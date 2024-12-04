<?php

namespace App\Livewire\Iptv;

use App\Models\IptvStreams;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditStream extends Component
{
    use WithFileUploads;
    public $curr_stream;
    #[Rule('image|mimes:png|max:1024')] // 1MB Max
    public $logo;
    public $name;
    public $tvg_id;
    public $stream_url;
    public $have_catchup=false;
    public $is_ott=false;
    public $show_start="00:00";
    public $show_stop="00:00";
    public $catchup_server;
    public function mount($stream_id=null)
    {
        if($stream_id)
        {
            $this->curr_stream=IptvStreams::find($stream_id);
            $this->name=$this->curr_stream->name;
            $this->tvg_id = $this->curr_stream->tvg_id;
            $this->stream_url = $this->curr_stream->stream_url;
            $this->have_catchup = $this->curr_stream->have_catchup;
            $this->is_ott = $this->curr_stream->is_ott;
            $this->show_start = $this->curr_stream->show_start;
            $this->show_stop = $this->curr_stream->show_stop;
            $this->catchup_server = $this->curr_stream->catchup_server;
        }else 
        {
            $this->curr_stream= new IptvStreams();
        }

    }
    public function render()
    {
        return view('livewire.iptv.edit-stream');
    }
    public function updatedName()
    {
        $this->validate(
            ['name'=>'unique:iptv_streams,name,'.$this->curr_stream->id]
        );
    }
    public function save(){
        $this->validate(
            ['name'=>'unique:iptv_streams,name,'.$this->curr_stream->id]
        );
        $this->curr_stream->name=$this->name;
        $this->curr_stream->tvg_id=$this->tvg_id ;
        $this->curr_stream->stream_url=$this->stream_url;
        $this->curr_stream->have_catchup = $this->have_catchup;
        $this->curr_stream->is_ott=$this->is_ott;
        $this->curr_stream->show_start=$this->show_start;
        $this->curr_stream->show_stop=$this->show_stop;
        $this->curr_stream->catchup_server=$this->catchup_server;
        $this->curr_stream->save();
        $this->curr_stream->refresh();
        if($this->logo)
        {
            $path = $this->logo->storePubliclyAs('logos',$this->logo->getClientOriginalName(),'public');
            $path=explode('/',$path);
            if(count($path)> 1){
                $file_name=explode('.',$path[1]);
                if(count($file_name)> 1){
                    $this->curr_stream->tvg_ico=$file_name[0];
                    $this->curr_stream->save();
                }

            }
        }
        return redirect()->route('iptv.streams');
    }
    public function delete_logo()
    {
        if($this->logo)
        {
            $this->logo=null;
        }
        if($this->curr_stream->tvg_ico)
        {
            $this->curr_stream->tvg_ico=null;
        }
        $this->curr_stream->save();
        $this->curr_stream->refresh();
    }
}
