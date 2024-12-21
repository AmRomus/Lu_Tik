<?php

namespace App\Helpers;

use App\Models\Onu;
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
    public $onu_from_db;
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
        $this->onu_from_db=Onu::where('mac',$this->mac)->first();
       }
       if($onu_place)
       {
        $this->onu_by_place=$this->server->Onu($onu_place);
       }
        ///Проверка соответдтвия порта 
        if($this->mac&&$onu_place&&$this->onu_by_mac)
        {
            //За базу берем данные из пакета
            //Есть мак адрес  в базе и в пакете 
            //запись по адресу не соответствует мак адресу 
            // запись по маку не соответствует адресу 
            // 
            // Если данные адреса ону не соответстует тому что в пакете 
            // узнаем id интерфейса 
            $iface_id=$this->server->OltIfaces()->where('pon_index',$onu_place[1])->first()?->id;
            // сравниваем с данными о ону
            if($this->onu_by_mac->olt_ifaces_id!=$iface_id)
            {
                /// Ону перемщено на другой интерфейс /проверяем не был ли занят адрес 
                if($this->onu_by_place)
                {
                    //запись есть значит эта запись старая и изменится в дальнейшем , во избеание повторений сбрасываем ее адрес.
                    //если старая запись активна , она обновится при следующем запросе
                    $this->onu_by_place->olt_ifaces_id=null;
                    $this->onu_by_place->save();
                }
                $this->onu_by_mac->olt_ifaces_id=$iface_id;
                $this->onu_by_mac->onu_index=".".$onu_place[2];
                $this->onu_by_mac->save();
                $this->onu_by_mac->refresh();

            }


        }
       ///Зарегистрированно ли в системе ?
       if($this->mac&&!$this->onu_by_mac){
          //Запрос мак адреса , но на этой олт он не найден

          //проверяем есть ли такая запись вообще 
          if($this->onu_from_db){
             // Ону было зарегистрированно в системе но на другом устройстве, меняем адрес
             if($onu_place){
                $iface_id=$this->server->OltIfaces()->where('pon_index',$onu_place[1])->first()?->id;
                if($iface_id){
                    $this->onu_from_db->olt_ifaces_id=$iface_id;
                    $this->onu_from_db->onu_index=".".$onu_place[2];
                    $this->onu_from_db->save();
                    $this->onu_from_db->refresh();
                    $this->onu_by_mac=$this->onu_from_db;
                }
             }
          } else {
            //Onu не зарегистрированна , регистрируем
            $iface_id=$this->server->OltIfaces()->where('pon_index',$onu_place[1])->first();
            $onu= new Onu();
            $onu->mac=$this->mac;
            $onu->onu_index=".".$onu_place[2];
            $iface_id->Onu()->save($onu);
            $onu->refresh();
            $this->onu_by_mac=$onu;
          }          
         
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
