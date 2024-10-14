<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \RouterOS\Client;
use \RouterOS\Query;
use Exception;

class Mikrotik extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'hostname',
        'login',
        'password',
        'port',
        'ssl'
    ];
    public function getLinkAttribute() : Client | null
    {
        
        try {
            $client = new Client([
                'host' => $this->hostname,
                'user' => $this->login,
                'pass' => $this->password,
                'port' => $this->port,
            ]);
            return $client;
        } catch (Exception $ignore)
        {
            return null;
        }
    }
    public function getSysInfoAttribute()
    {
       
        $query =(new Query('/system/resource/print'));
        $resp = $this->Link?->qr($query);
        if(is_array($resp))
        {
            return $resp[0];
        }
        return null;       
    }
    public function getRemoteInterfacesAttribute()
    {
        $params_array=$this->Link?->q(new Query(endpoint: '/interface/print'))->read();
        return $params_array;
    }
    public function ControlInterface(){
        return $this->hasMany(ControlInterface::class);
    }
  
    public function findDevice($device)
    {
        $faces= array();
        foreach($this->ControlInterface as $item)
        {           
            $faces[]=array('interface',$item->interface);
        }
        if(count($faces)>1)
        {          
           $params_array=$this->Link?->q('/ip/arp/print',$faces,'|')->r();
        }elseif(count($faces)==1)
        {
            $params_array=$this->Link?->q('/ip/arp/print',$faces)->r();
        }else{
            $params_array=[];
        }
        foreach($params_array as $key=>$val)
        {
            if(!array_key_exists('mac-address',$val)||$val['mac-address']!=$device)
            {
                unset($params_array[$key]);
            }
        }
        
        return $params_array;
    }
    public function getArpListAttribute()
    {
        $faces= array();
        $ret_list=array();
        foreach($this->ControlInterface as $item)
        {           
            $faces[]=array('interface',$item->interface);
        }
        if(count($faces)>1)
        {          
           $params_array=$this->Link?->q('/ip/arp/print',$faces,'|')->readAsIterator();
        }elseif(count($faces)==1)
        {
            $params_array=$this->Link?->q('/ip/arp/print',$faces)->readAsIterator();
        }       
        for ($params_array->rewind(); $params_array->valid(); $params_array->next()) {
            try{
            $item=$params_array->current();      
            $ret_list[]=$item;
            } catch (Exception $ignoire){
                continue;
            }
        }
        return $ret_list;
    }
    public function getAccessListAttribute()    :array
    {
        $ret= $this->Link?->q((new Query('/ip/firewall/address-list/print'))->where('list','inet-access'))->readAsIterator();
        $ret_list=array();
        for ($ret->rewind(); $ret->valid(); $ret->next()) {
            try{
            $item=$ret->current();      
            $ret_list[$item['.id']]=$item['address'];
            } catch (Exception $ignoire){
                continue;
            }
        }
       return $ret_list;
    }
    public function getQueueListAttribute() : array 
    {
        $ret= $this->Link?->q(new Query('/queue/simple/print'))->readAsIterator();
        $ret_list=array();       
        for ($ret->rewind(); $ret->valid(); $ret->next()) {
            try{
                $item=$ret->current();
              $ret_list[$item['.id']]=$item['name'];
            } catch (Exception $ignoire){
                continue;
            }
          }
       return $ret_list;
    }

    public function AddToList($ip){
       $result=$this->Link?->qr((new Query('/ip/firewall/address-list/add'))->equal('list','inet-access')->equal('address',$ip));
       return $result;
    }
    public function DeleteFromList($id)
    {
        $result=$this->Link?->qr((new Query('/ip/firewall/address-list/remove'))->equal('.id',$id));
       return $result;
    }
    public function AddQueue(InetDevices $device)
    {
        $up_speed=$device->BillingAccount->Tarif->InetService->speed_up.$device->BillingAccount->Tarif->InetService->speed_up_unit;
        $down_speed=$device->BillingAccount->Tarif->InetService->speed_down.$device->BillingAccount->Tarif->InetService->speed_down_unit;  
        $ips=implode(',',$device->BillingAccount->InetDevices->pluck('ip')->toArray());
        // dd($ips));     
        $result=$this->Link?->qr((new Query('/queue/simple/add'))->equal('name','q'.$device->BillingAccount->ident)
        ->equal('target',$ips)
        ->equal('max-limit',$up_speed.'/'.$down_speed));
       return $result;
    }
    public function DelQueue(InetDevices $dev){
        $result=$this->Link?->qr((new Query('/queue/simple/remove'))->equal('numbers','q'.$dev->BillingAccount->ident));
        return $result;
    }
    public function findDhcp($device)
    {
        $params_array=$this->Link?->q((new Query(endpoint: '/ip/dhcp-server/lease/print'))->where('mac-address',$device))->read();
        return $params_array;
    }
}
