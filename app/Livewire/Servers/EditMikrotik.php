<?php

namespace App\Livewire\Servers;

use App\Models\ControlInterface;
use App\Models\Mikrotik;

use App\Models\SnmpTemplate;
use App\Models\SnmpTemplateRel;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditMikrotik extends Component
{
    public $mikrotik;
    public $name;
    #[Rule('required')]
    public $ip;
    #[Rule('required')]
    public $login;
    public $password;
    public $port;
    public $ssl;
    public $uncontroled;
    public $tmpl;
    public $tmpls;
    public function mount(Mikrotik $mikrotik)
    {
        $this->mikrotik=$mikrotik;
        $this->name=$mikrotik->name;
        $this->ip=$mikrotik->ip;
        $this->login = $mikrotik->login;
        $this->password = $mikrotik->password;
        $this->port = $mikrotik->port;
        $this->ssl=$mikrotik->ssl;
        $controled_ids=$mikrotik->ControlInterface->pluck('ident')->toArray();
        $uncontroled=$this->mikrotik->RemoteInterfaces;
        foreach($uncontroled as $key=>$item){          
            if(in_array($item['.id'],$controled_ids,true)){
                unset($uncontroled[$key]);
            }
        }
        $this->uncontroled=$uncontroled;
        $this->tmpls=SnmpTemplate::all();
        $this->tmpl=$mikrotik->SnmpTemplateRel?->SnmpTemplate?->id;
    }
    public function render()
    {        
        return view('livewire.servers.edit-mikrotik');
    }
    public function save()
    {
        $this->validate();
        $mk=[
            'name'=>$this->name,
            'ip'=>$this->ip,
            'login'=>$this->login,
            'password'=>$this->password,
            'port'=>$this->port,
            'ssl'=>$this->ssl
        ];
        $this->mikrotik->update($mk);
        if(!$this->mikrotik->SnmpTemplateRel)
        {
            $snmptmpl= new SnmpTemplateRel();
            $snmptmpl->snmp_template_id=$this->tmpl;
            $this->mikrotik->SnmpTemplateRel()->save($snmptmpl);
        }else 
        {
            if($this->tmpl!=$this->mikrotik->SnmpTemplateRel->snmp_template_id)
            {
                $this->mikrotik->SnmpTemplateRel->snmp_template_id=$this->tmpl;
                $this->mikrotik->SnmpTemplateRel->save();
            }
        }
        
    }
    // #[On('changed')]
    // public function refresh(){}
    public function add_iface($key)
    {        
        $new_control = new ControlInterface(["ident"=>$this->uncontroled[$key]['.id'],'interface'=>$this->uncontroled[$key]['name']]);
        $this->mikrotik->ControlInterface()->save($new_control);
        return redirect(request()->header('Referer'));
    }
    public function rem_iface($id){
        ControlInterface::find($id)->delete();
        return redirect(request()->header('Referer'));
    }
}
