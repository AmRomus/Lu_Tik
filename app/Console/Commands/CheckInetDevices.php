<?php

namespace App\Console\Commands;

use App\Models\InetDevices;
use App\Models\Mikrotik;
use Illuminate\Console\Command;

class CheckInetDevices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-inet-devices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    
    public function handle()
    {
        $this->info("Begin process");       
       
        $time_start = microtime(true); 
        foreach(Mikrotik::all() as $mk){
           $mk->UpdateInterfaceNames();
            $this->info('Checkin MK :'.$mk->name);
            $this->info('Request mac list');
            $link=$mk->Link;
            if($link===null){
                $this->info('Mikrotik '.$mk->hostname.' unrechable');
                continue;
            }
           
            $macs= $mk->ArpList;
            $access_list = $mk->getAccessList($link);            
            $limit_list = $mk->getQueueList($link);
            foreach($mk->ControlInterface()->with('InetDevices')->get() as $ci){
              
                foreach($ci->InetDevices as $dev){ 
                     $iface_macs=$macs->where("mac-address",$dev->mac)->where('interface','!=',$dev->ControlInterface->interface); 
                     if(count($iface_macs)==0){
                        $iface_macs=$macs->where("mac-address",$dev->mac)->where('address','!=',$dev->ip);
                     }                                          
                    if($dev->ip&&$dev->BillingAccount){
                        $u_access=($dev->BillingAccount->InetAccess>=0)?false:true;
                        $in_list=array_search($dev->ip,$access_list,true); 
                        $in_q=array_search('q'.$dev->BillingAccount->ident,$limit_list,true);
                        $right_place=true;
                        
                        if(count($iface_macs)>0){                          
                            $right_place=false;
                        }
                        if($in_list!==false){                            
                            if(!$u_access||!$right_place){
                                $this->info("Dekativate ".$dev->ip);
                                $mk->DeleteFromList($link,$in_list); 
                                unset($access_list[$in_list]);
                            }else{
                                unset($access_list[$in_list]);
                            }
                        }else {
                            if($u_access&&$right_place){
                                $this->info("Activate ".$dev->ip);
                                $mk->AddToList($dev->ip); 
                               // $mk->AddQueue($dev);
                            }
                        }
                        if($in_q!==false)
                        {                           
                            if(!$u_access||!$right_place){                               
                                $this->info('REM Q:'.$dev->ip);
                                $mk->DelQueue($dev->BillingAccount);
                                unset($limit_list[$in_q]);
                            }
                        }else {
                            var_dump($in_q);
                            if($u_access&&$right_place){
                                $this->info('ADD Q:'.$dev->ip);
                                $mk->AddQueue($dev->BillingAccount);
                            }
                        }
                      
                    }
                }
            }
            foreach($access_list as $key=>$val){
             $mk->DeleteFromList($link,$key);   
            }
           
            // var_dump($access_list);
            // foreach($mk->ControlInterface()->with('InetDevices')->get() as $ci){
            //     $this->info('Checkin iface :'.$ci->interface);
            //     $this->info("Mac count ".count($macs));
            //     foreach($ci->InetDevices as $dev){
            //         $this->info('Process Device with mac: '.$dev->mac);                   
            //         foreach($macs as $key=>$unit){
            //             //check macs 
            //             if(array_search($dev->mac,$unit)){
            //                unset($macs[$key]);
            //             }                                              
            //         }
            //         if($dev->ip&&$dev->BillingAccount?->Tarif?->InetService){
            //             $this->info("IP is: ".$dev->ip);
            //             // var_dump($access_list);
            //             $in_list=array_search($dev->ip,$access_list,true);                      
            //             if($in_list!==false&& $dev->BillingAccount?->InetAccess>=0){
            //                 // del ip from list
            //                 $this->info("Deactivate ".$dev->ip);
            //                 $mk->DeleteFromList($in_list);
            //                                    ;
            //             }
            //             if($in_list===false&&$dev->BillingAccount?->AccountInetService->service_state==1){
            //                 //Add ip ot list
            //                 $this->info("Activate ".$dev->ip);
            //                 $ret=$mk->AddToList($dev->ip);                  
            //                                     ;         
            //             }
            //        }
                    
            //     }
            //     $this->info("Mac count ".count($macs));
            // }
        }
        $this->info("Map in: ".(microtime(true) - $time_start)." seconds");
    }
}
