<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use FreeDSx\Snmp\SnmpClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Olt extends Model
{
    use HasFactory;
    public function getOltTemplateAttribute(){
       // return $this->belongsTo(OltTemplate::class);
       return $this->morphOne(SnmpTemplateRel::class,'device')->first()->SnmpTemplate;
    }

    public function Read()
    {        
        $snmp = new SnmpClient([
            'host' => $this->ip,
            'port'=> $this->port,
            'version' => 2,
            'community' => $this->ro_community,
        ]);
        return $snmp;
    }
    public function Write() 
    {
        $snmp = new SnmpClient([
            'host' => $this->ip,
            'version' => 2,
            'community' => $this->rw_community,
        ]);
        return $snmp;
    } 
    public function getSystemNameAttribute()
    {
       // dd();
        //.1.3.6.1.2.1.1.5.0
        $oid=$this->OltTemplate?->SnmpOids?->where('cmd','system_name')->first()?->oid;
        if($oid){
            $ret = $this->Read()->get($oid);
            return $ret->first()?->getValue();
        }
    }
    public function getSystemUptimeAttribute()
    {
        //1.3.6.1.2.1.1.3.0
        $oid=$this->OltTemplate?->SnmpOids?->where('cmd','uptime')->first()?->oid;
        if($oid){
            $ret = $this->Read()->get($oid);
            $rticks=(string)$ret->first()?->getValue();
            
            if($rticks){
                $s=Carbon::now()->addSeconds(((intval($rticks)/100)*-1));
                return  $s->diff(Carbon::now())->forHumans();
            }
          
        }
    }
    public function getIfacesAttribute(){
        $if_array=array();
        $if_pair = array();
        $oid=$this->OltTemplate?->SnmpOids?->where('cmd','ifname')->first()?->oid;       
        if($oid){           
            $ret = $this->Read()->walk($oid);
            while (!$ret->isComplete()) {
                $r = $ret->next();
                array_push($if_array,(string)$r->getValue());               
            }
        }
        $oid=$this->OltTemplate?->SnmpOids?->where('cmd','ifstate')->first()?->oid; 
        if($oid){           
            $ret = $this->Read()->walk($oid);
            $ind=0;
            while (!$ret->isComplete()) {
                $r = $ret->next();
                if((string)$r->getValue()==="1") $ifstate=true; else $ifstate=false;
                $iface =(object)array();
                $iface->iface=$if_array[$ind];
                $iface->state= $ifstate;
                array_push($if_pair,$iface);
                $ind++;
                          
            }
        }
        
       return $if_pair;
    }

    /* RELATIONS */
    public function OltIfaces()
    {
        return $this->hasMany(OltIfaces::class);
    }

    public function getOnusAttribute()
    {
        return Onu::whereIn('olt_interface_id',$this->OltIfaces->pluck('id'));
    }

    public function Onu($mac)
    {
        if(!is_array($mac)){
            return Onu::where(function ($q)use($mac){
                $q->whereIn('olt_ifaces_id',$this->OltIfaces->pluck('id'));
                $q->where('mac',$mac);
            })->first();
        }else 
        {
            $iface_id=$this->OltIfaces()->where('pon_index',$mac[1])->first()?->id;
            if($iface_id){
            return Onu::where(function($q)use($mac,$iface_id){
                $q->where('olt_ifaces_id',$iface_id);
                $q->where('onu_index','.'.$mac[2]);
            })->first();
            } else 
            {
                return null;
            }

        }
    }
    
}
