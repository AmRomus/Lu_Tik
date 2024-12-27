<?php

namespace App\Livewire\Companies;

use App\Models\MikroBillApi;
use App\Models\ServiceCompanies;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditCompany extends Component
{
    public $company;
    public $name;
    public $api;
    #[Rule('required')]
    public $api_host;
    #[Rule('required')]
    public $api_login;
    public $api_pass;
    public $api_key1;    
    public $api_key2;
    public $api_port=7403;
    public $api_del=true;
    protected $rules = [
        'api_key1' => [
            'required',
            'regex:/^.{16}$|^.{24}$|^.{32}$/',  // Correct regex with proper delimiters
        ],
        'api_key2' => [
            'required',
            'regex:/^.{16}$|^.{24}$|^.{32}$/',  // Correct regex with proper delimiters
        ],
    ];
    public function mount($company)
    {
        $this->company=ServiceCompanies::with(['InetServices','CatvServices','IptvServices','MikroBillApi'])->find($company);
        //$this->company=$company;
        $this->name=$this->company?->Name;
        $this->api=$this->company?->MikroBillApi;
       if($this->api)
       {
         $this->api_host=$this->api->host;
         $this->api_login=$this->api->login;
         $this->api_pass=$this->api->password;
         $this->api_key1=$this->api->key1;
         $this->api_key2=$this->api->key2;
         $this->api_port=$this->api->port;
         if($this->api->AccountInetService->count()>0||$this->api->AccountCatvService->count()>0)
         {
            $this->api_del=false;
         }else 
         {
            $this->api_del=true;
         }
       }
    }
    public function render()
    {
        return view('livewire.companies.edit-company');
    }
    public function new_api()
    {
        $this->api=new MikroBillApi();
    }
    public function save_api()
    {
        $this->validate();
        $this->api->host=$this->api_host;
        $this->api->login=$this->api_login;
        $this->api->password=$this->api_pass;
        $this->api->key1=$this->api_key1;
        $this->api->key2=$this->api_key2;
        $this->api->port=$this->api_port;
        $this->api->service_companies_id=$this->company->id;
        $this->api->save();
    }
    public function del_api()
    {
        $this->api->delete();
        $this->api=null;
        $this->company->refresh();
    }
}
