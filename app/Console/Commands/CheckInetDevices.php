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
        // foreach(Mikrotik::with('ControlInterface.InetDevices')->get() as $mk)
        // {
        //    $mac_array=$mk->ArpList;
        //    foreach(InetDevices::where('bind',0)->get() as $dindev)
        //    {
           
        //      if(in_array($dindev->mac,array_column($mac_array,'mac-address'),true)){
        //         foreach($mac_array as $key=>$value){
        //             if($value['mac-address']===$dindev->mac){
        //                 var_dump($value);
        //                 if($value['complete']=="true"){                           
        //                     $mk->ControlInterface->where('interface',$value["interface"])->first()->InetDevices()->save($dindev);
        //                     $dindev->ip=$value['address'];
        //                     $dindev->online=1;
        //                 }else {
        //                     $dindev->online=0;
        //                     $dindev->control_interface_id=null;
        //                     $dindev->ip=null;
        //                 }
        //                 $dindev->save();
        //             }
        //         }
        //         $found_key = array_search($dindev->mac, array_column($mac_array,'mac-address'),true);
        //       //  var_dump($mac_array[$found_key]);
        //         $this->info('MAC '.$dindev->mac." IN MK :".$mk->name." Array Key ".$found_key );                
        //      }
        //    }
        // }
      
        // foreach(InetDevices::orderBy('control_interface_id')->get() as $dev){


        // }

        foreach(Mikrotik::all() as $mk){
            $this->info('Checkin MK :'.$mk->name);
            $this->info('Request mac list');
            $macs= $mk->ArpList;
            $access_list = $mk->AccessList;
            foreach($mk->ControlInterface()->with('InetDevices')->get() as $ci){
                foreach($ci->InetDevices as $dev){
                    if($dev->ip&&$dev->BillingAccount){
                        $in_list=array_search($dev->ip,$access_list,true); 
                       
                        if($in_list!==false){
                            var_dump($dev->BillingAccount->InetAccess);
                            if($dev->BillingAccount->InetAccess>=0){
                                $this->info("Dekativate ".$dev->ip);
                                $mk->DeleteFromList($in_list); 
                                unset($access_list[$in_list]);
                            }else{
                                unset($access_list[$in_list]);
                            }
                        }else {
                            if($dev->BillingAccount->InetAccess<0){
                                $this->info("Activate ".$dev->ip);
                                $mk->AddToList($dev->ip); 
                            }
                        }
                      
                    }
                }
            }
            foreach($access_list as $key=>$val){
             $mk->DeleteFromList($key);   
            }
            var_dump($access_list);
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
    }
}
