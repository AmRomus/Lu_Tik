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
        $time_start = microtime(true); 
        foreach(Mikrotik::all() as $mk){
           
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
            
           
           // var_dump($limit_list);
            foreach($mk->ControlInterface()->with('InetDevices')->get() as $ci){
              
                foreach($ci->InetDevices as $dev){ 
                     $iface_macs=$macs->where("mac-address",$dev->mac);
              //dd($iface_macs);
                    if($dev->ip&&$dev->BillingAccount){
                        $u_access=($dev->BillingAccount->InetAccess>=0)?false:true;
                        $in_list=array_search($dev->ip,$access_list,true); 
                        $in_q=array_search('q'.$dev->BillingAccount->ident,$limit_list,true);
                       
                        if($in_list!==false){                            
                            if(!$u_access){
                                $this->info("Dekativate ".$dev->ip);
                                $mk->DeleteFromList($link,$in_list); 
                                unset($access_list[$in_list]);
                            }else{
                                unset($access_list[$in_list]);
                            }
                        }else {
                            if($u_access){
                                $this->info("Activate ".$dev->ip);
                                $mk->AddToList($link,$dev->ip); 
                               // $mk->AddQueue($dev);
                            }
                        }
                        if($in_q!==false)
                        {
                            if(!$u_access){
                                $this->info('REM Q:'.$dev->ip);
                                $mk->DelQueue($link,$dev);
                                unset($limit_list[$in_q]);
                            }
                        }else {
                            var_dump($in_q);
                            if($u_access){
                                $this->info('ADD Q:'.$dev->ip);
                                $mk->AddQueue($link,$dev);
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
