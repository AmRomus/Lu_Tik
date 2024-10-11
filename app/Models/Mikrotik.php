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
            if(!array_key_exists('mac-address',$val))
            {
                unset($params_array[$key]);
            }
        }
        
        return $params_array;
    }
    public function getAccessListAttribute()    :array
    {
        $ret= $this->Link?->qr((new Query('/ip/firewall/address-list/print'))->where('list','inet-access'));
        $ret_list=array();
        foreach($ret as $item){
            $ret_list[$item['.id']]=$item['address'];
            
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
    public function findDhcp($device)
    {
        $params_array=$this->Link?->q((new Query(endpoint: '/ip/dhcp-server/lease/print'))->where('mac-address',$device))->read();
        return $params_array;
    }
}
