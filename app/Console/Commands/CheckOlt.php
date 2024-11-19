<?php

namespace App\Console\Commands;

use App\Models\Olt;
use App\Models\Onu;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
class CheckOlt extends Command
{
    function strToMAC($string){
        $hex = '';
        $j=0;
        for ($i=0; $i<strlen($string); $i++){
            $ord = ord($string[$i]);
            $hexCode = dechex($ord);
            if($j==1){
                $hex.=":";
                $j=0;
            }
            $hex .= substr('0'.$hexCode, -2);
            $j++;
           
        }
        return strToUpper($hex);
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-olt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checkink Olt interfaces and Onu states';

    /**
     * Execute the console command.
     */
    public function handle()
    {        
        foreach(Olt::all() as $olt){
            $oid=$olt->OltTemplate?->SnmpOids?->where('cmd','ifstate')->first()?->oid; 
            if($oid){           
                $ret = $olt->Read()->walk($oid);                      
                while (!$ret->isComplete()) {
                    $r = $ret->next();
                    $face_id=Str::remove($oid,$r->getOid());
                    $face = $olt->OltIfaces()->where('if_index',$face_id)->first();
                    $state=((string)$r->getValue()==="1")?true:false;
                    if($face&&$face->state!=$state){
                       $face->state=$state;
                       $face->save();
                    }        
                }
            }
            $this->info("OLT - ".$olt->ip." ifaces checking complate.");
            foreach($olt->OltIfaces->whereNotNull('pon_index') as $iface)
            {
                $this->info("PON - ".$iface->iface." Get Onus");
                $oid=$olt->OltTemplate?->SnmpOids?->where('cmd','onu_mac')->first()?->oid;
                if($oid)
                {
                     $iface_onus=$iface->Onu->pluck('mac')->toArray();                    
                     $oid=$oid.".".$iface->pon_index;
                     $q = $olt->Read()->walk($oid);
                    while (!$q->isComplete()) {                      
                        $r = $q->next();
                        $onu_mac=$this->strToMAC((string)$r->getValue());
                        $onu_id=Str::remove($oid,$r->getOid());
                        if(!in_array($onu_mac,$iface_onus))
                        {
                            $this->info($onu_mac);
                            $onu = new Onu();
                            $onu->mac=$onu_mac;
                            $onu->onu_index=$onu_id;
                            $iface->Onu()->save($onu);
                        }
                    }
                }
            }
        }
    }
}
