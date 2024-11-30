<?php

namespace App\Helpers;

use App\Models\SnmpOids;

class SnmpReceivedPacket
{
    /**
    * Create a new class instance.
     */
    public function __construct($from,$packet)
    {
        
        $this->server_ip=$from;
        $this->packet=$packet;
        $this->get_vendor($packet->where('oid','1.3.6.1.6.3.1.1.4.1.0')->first());
       
    }
    public $server_ip;
    public $server;
    public $template;
    protected $packet;
    public $mac;
    public $msg;
    public $onu_by_mac;
    public $onu_by_place;
    private function get_vendor($pair){
        
       $item_ident=SnmpOids::where('cmd','ident')->where('oid',$pair->value)->first();
       printf("Pair value %s \n",$pair->value);
       
       if($item_ident){
        $this->template=$item_ident->SnmpTemplate;
        $this->server=$item_ident->SnmpTemplate->Rels->where(function($item){
            return $item->device->ip==$this->server_ip;
        })->first()?->device;
       
        if($this->server)
        {
            switch(class_basename($this->server))
            {
                case "Olt":
                    $this->parse_onu();
                    break;
                case "Mikrotik":
                    printf("Mikrotik Packet from %s \n",$this->server_ip);
                    break;
                default:
                    break;
            }
        }
       }
    }
    private function parse_onu()
    {
        //1.3.6.1.4.1.13464.1.13.10.1.2.5.0
       // $mac=$this->packet->where('onu_mac_ident',)
       $oid=$this->server->OltTemplate?->SnmpOids?->where('cmd','onu_mac_ident')->first();
       $mac=$this->packet->where('oid',$oid->oid)->first()?->value;
       if($mac)
       {
        $this->mac=$this->findMacAddresses($mac);
       }
       $oid=$this->server->OltTemplate?->SnmpOids?->where('cmd','onu_msg_ident')->first();
       $this->msg=$this->packet->where('oid',$oid->oid)->first()?->value;
       $oid=$this->server->OltTemplate?->SnmpOids?->where('cmd','onu_place_ident')->first();
       $place=$this->packet->where('oid',$oid->oid)->first()?->value;
       $onu_place=null;
       if($place)
       {
         $onu_place=$this->getPonId($place);
       }
       if($this->mac){
        $this->onu_by_mac=$this->server->Onu($this->mac);
       }
       if($onu_place)
       {
        $this->onu_by_place=$this->server->Onu($onu_place);
       }
       
    }
    private function getPonId($hex) {
        // Преобразуем шестнадцатеричную строку в двоичную строку длиной 64 бита
        $bin_str = str_pad(base_convert($hex, 16, 2), 64, '0', STR_PAD_LEFT);
        
        // Извлекаем значения для board, pon и unit
        $board = bindec(substr($bin_str, 0, 8));  // Первые 8 бит для board
        $pon = bindec(substr($bin_str, 8, 8));    // Следующие 8 бит для pon
        $unit = bindec(substr($bin_str, 16, 8));  // Следующие 8 бит для unit

        // Возвращаем массив с извлеченными значениями
        return array($board, $pon, $unit);
    }
    function findMacAddresses($text) {
        $patterns = [
            '/(?:mac:)?([a-f0-9]{2}(:[a-f0-9]{2}){5})/i',      // Формат mac:xx:xx:xx:xx:xx:xx
            '/([a-f0-9]{2}([-])[a-f0-9]{2}([-])[a-f0-9]{2}([-])[a-f0-9]{2}([-])[a-f0-9]{2}([-])[a-f0-9]{2})/i', // Формат xx-xx-xx-xx-xx-xx
            '/([a-f0-9]{4}(\.)[a-f0-9]{4}(\.)[a-f0-9]{4})/i'    // Формат xxxx.xxxx.xxxx
        ];
        
        // Перебираем все регулярные выражения
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $text, $matches)) {
                return str_replace(['-', '.'], ':', $matches[1]); // Преобразуем все разделители в двоеточие
            }
        }
        
        return null; // Если MAC-адрес не найден
    }
}
