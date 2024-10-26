<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \RouterOS\Client;
use \RouterOS\Query;
use Exception;
use Log;
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
    public function getQtypesAttribute()
    {
        $colection = new Collection();
        $params_array=$this->Link?->q(new Query('/queue/type/print'))->read();
        foreach($params_array as $item)
        {
            $colection->push((object)$item);
        }
        return $colection;
    }
    public function findDevice($device)
    {
       
        $dev=$this->ArpList->where('mac-address',$device);
        return $dev;
    }
    public function getArpListAttribute()
    {
      
        $c=new Collection();
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
    public function AddQueue(BillingAccount $account)
    {
        $link=$this->Link;
        $q=$this->qtype?$this->qtype:'default';
       
        $ips=implode(',',$account->InetDevices->pluck('ip')->toArray()); 
        if(count($account->InetDevices)>0){              
            $ret=$link->qr((new Query('/queue/simple/add'))->equal('name','q'.$account->ident)
            ->equal('target',$ips)
            ->equal('max-limit',$account->InetSpeedLimit)
            ->equal('burst-limit',$account->InetSpeedBurst)
            ->equal('burst-time',$account->InetSpeedBurstTime)
            ->equal('burst-threshold',$account->InetBustThreshold)
            ->equal('total-queue',$q)
            ->equal('queue',$q.'/'.$q)
            );          
        }     
    }
    public function DelQueue(BillingAccount $account){
        $link=$this->Link;
        $lease = $link?->q((new Query('/queue/simple/print'))->where('name','q'.$account->ident))->r();      
        foreach($lease as $item){      
            $delobj=(object)$item;
            $id=".id";
            $link->qr((new Query('/queue/simple/remove'))->equal('.id',$delobj->$id));            
        }
       
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

    public function RemLease(String  $mac_address)
    {       
        $link=$this->Link;
        $lease = $link?->q((new Query('/ip/dhcp-server/lease/print'))->where('mac-address',$mac_address))->r();
      
         foreach($lease as $item){      
             $delobj=(object)$item;
             $id=".id";
             $this->Link?->qr((new Query('/ip/dhcp-server/lease/remove'))->equal('.id',$delobj->$id));
         }
    }
    public function RemFromList(String $ip)
    {
        $link=$this->Link;
        $ret= $link?->q((new Query('/ip/firewall/address-list/print'))->where('list','inet-access')->where('address',$ip))->r();
       
         foreach($ret as $item){
             $delobj=(object)$item;
             $id=".id";
             $link?->qr((new Query('/ip/firewall/address-list/remove'))->equal('.id',$delobj->$id));
         }
    }
    public function AddLease(InetDevices $device)
    {
        $this->Link?->qr((new Query('/ip/dhcp-server/lease/add'))->equal('address',$device->ip)->equal('mac-address',$device->mac)->equal('server',$device->ControlInterface->DhcpName)->equal('comment',$device->BillingAccount->ident));
    }
}
