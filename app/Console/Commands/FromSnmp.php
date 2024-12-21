<?php

namespace App\Console\Commands;

use App\Helpers\SnmpReceivedPacket;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Log;
class FromSnmp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:from-snmp {data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Snmp Packet parser';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data=$this->argument('data');
        $packet=explode('||',$data);
        if(count($packet)==2)
        {
            //NORMAL PACKET
            $server_ip=$packet[0];
            $server_packet=$packet[1];
          //  $p=(object)array();
            foreach(explode("|",$server_packet) as $item)
            {
                $pair=explode("=",$item);
                if(count($pair)==2){
                    $g=(object)array();
                    $g->oid=$pair[0];
                    $g->value=$pair[1];
                }
                $p[]=$g;
            }
            $packet=collect($p);
            $p=new SnmpReceivedPacket($server_ip,$packet);
            if($p->server&&class_basename($p->server)==="Olt")
            {
                
                 switch ($p->server->OltTemplate->SnmpSignals->where('signal',$p->msg)->first()?->action)
                 {
                     case "Online":
                       
                        if($p->onu_by_mac)
                        {
                            Log::debug("Onu ".$p->onu_by_mac->mac." comes to online");
                            printf("Onu %s Online \n",$p->onu_by_mac?->mac);
                            $p->onu_by_mac->online=1;
                            $p->onu_by_mac->last_state=Carbon::now();
                            $p->onu_by_mac->msg=null;
                            $p->onu_by_mac->save();                          
                            if($p->onu_by_mac->CatvAccess<0)
                            {
                                $p->onu_by_mac->CatvOn();
                                print("CATV_ON!\n");
                            }
                            Log::debug("Onu ".$p->onu_by_mac->mac." processed");
                        }
                         break;
                      case "PowerOff":
                        if($p->onu_by_mac)
                        {
                            printf("Onu %s Power Off \n",$p->onu_by_mac?->mac);
                            $p->onu_by_mac->online=0;
                            $p->onu_by_mac->last_state=Carbon::now();
                            $p->onu_by_mac->msg="Power Off";
                            $p->onu_by_mac->save();
                        }
                         break;
                         case "SignalLoss":
                            if($p->onu_by_mac)
                            {   
                                printf("Onu %s Signal lost \n",$p->onu_by_mac?->mac);                            
                                if( $p->onu_by_mac->online>0) {
                                    $p->onu_by_mac->Online=0;
                                    $p->onu_by_mac->last_state=Carbon::now();
                                    $p->onu_by_mac->msg="Loss Signal";
                                    $p->onu_by_mac->save();
                                }
                            }
                             break;
                       default:
                       break;  
                 }
            }
        }
        
    }
}
