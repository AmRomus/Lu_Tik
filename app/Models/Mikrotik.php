<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
       
        $dev=$this->ArpList->where('mac-address',$device);
        return $dev;
    }
    public function getArpListAttribute()
    {
      
        $c=new Collection();
        // foreach($this->ControlInterface as $item)
        // {           
        //     $faces[]=array('interface',$item->interface);
        // }
       
        $params_array=$this->Link->q('/ip/arp/print')->readAsIterator();
        for ($params_array->rewind(); $params_array->valid(); $params_array->next()) {
            try{
            $item=$params_array->current();   
            if($item['complete']==="true"){     
            $item['mk']=$this;           
            $c->push( (object)$item);
            }
            } catch (Exception $ignoire){
                continue;
            }
        }
      
        return $c; 
    }
    public function getAccessList(Client $link) :array
    {
        $ret= $link->q((new Query('/ip/firewall/address-list/print'))->where('list','inet-access'))->readAsIterator();
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
    public function getQueueList(Client $link) : array 
    {
        $ret= $link->q(new Query('/queue/simple/print'))->readAsIterator();
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

    public function AddToList(Client $link,$ip){
       $result=$link->qr((new Query('/ip/firewall/address-list/add'))->equal('list','inet-access')->equal('address',$ip));
       return $result;
    }
    public function DeleteFromList(Client $link,$id)
    {
        $result=$link?->qr((new Query('/ip/firewall/address-list/remove'))->equal('.id',$id));
       return $result;
    }
    public function AddQueue(Client $link,InetDevices $device)
    {
        $ips=implode(',',$device->BillingAccount->InetDevices->pluck('ip')->toArray());      
        $result=$link->qr((new Query('/queue/simple/add'))->equal('name','q'.$device->BillingAccount->ident)
        ->equal('target',$ips)
        ->equal('max-limit',$device->InetSpeedLimit));
       return $result;
    }
    public function DelQueue(Client $link,InetDevices $dev){
        $result=$link->qr((new Query('/queue/simple/remove'))->equal('numbers','q'.$dev->BillingAccount->ident));
        return $result;
    }
    public function findDhcp($device)
    {
        $params_array=$this->Link?->q((new Query(endpoint: '/ip/dhcp-server/lease/print'))->where('mac-address',$device))->read();
        return $params_array;
    }
 
    public function UpdateInterfaceNames()
    {
        foreach($this->RemoteInterfaces as $face)
        {
           $this->ControlInterface->where('ident',$face['.id'])->first()?->update(['interface'=>$face["name"]]);
        }
    }
}
