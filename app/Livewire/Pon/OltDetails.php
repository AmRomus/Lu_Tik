<?php

namespace App\Livewire\Pon;

use App\Models\Olt;
use App\Models\OltIfaces;
use Livewire\Component;
use Illuminate\Support\Str;
class OltDetails extends Component
{
    public $olt;
    public function mount(Olt $olt)
    {
        $this->olt=$olt;
    }
    public function render()
    {
       
        return view('livewire.pon.olt-details');
    }
    public function get_interfaces()
    {
        $oid=$this->olt->OltTemplate?->SnmpOids?->where('cmd','ifname')->first()?->oid;       
        if($oid){           
            $ret = $this->olt->Read()->walk($oid);
            $pon_num=0;
            while (!$ret->isComplete()) {                              
                $r = $ret->next();                
                $face_id=Str::remove($oid,$r->getOid());              
                $face = $this->olt->OltIfaces()->where('if_index',$face_id)->first();
                $pon_index=false;
                if(Str::contains((string)$r->getValue(),$this->olt->OltTemplate->pon_template)){
                    $pon_num++;
                    $pon_index=true;
                }
                if(!$face)
                {
                  
                    $face = new OltIfaces();
                    $face->iface=(string)$r->getValue();
                    $face->if_index=$face_id;
                    if($pon_index) $face->pon_index=$pon_num;
                    $face->state=false;
                    $this->olt->OltIfaces()->save($face);
                }               
            }
        }
        $face=null;
         $oid=$this->olt->OltTemplate?->SnmpOids?->where('cmd','ifstate')->first()?->oid; 
         if($oid){           
             $ret = $this->olt->Read()->walk($oid);        
             while (!$ret->isComplete()) {
                 $r = $ret->next();
                 $face_id=Str::remove($oid,$r->getOid());
                 $face = $this->olt->OltIfaces()->where('if_index',$face_id)->first();
                 if($face){
                    $face->state=((string)$r->getValue()==="1")?true:false;
                    $face->save();
                 }        
             }
         }
    }
    public function select_pon(int $face)
    {       
        $this->dispatch('show_pon',["pon"=>$face])->to(OnuList::class);
    }
}
