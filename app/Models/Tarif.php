<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Customer;
use Bavix\Wallet\Interfaces\ProductLimitedInterface;

class Tarif extends Model implements ProductLimitedInterface
{
    use HasFactory,HasWallet;
    protected $fillable=[
        'name',
        'description'
    ];
    public function getMetaProduct(): ?array
    {
        return [
            'tarif'=>$this->name,
            'description'=>$this->description,
        ];
    }
    public function getAmountProduct(Customer $customer = null): int|string
    {
        $price=0;
        if($this->InetService)
        {
            $price+=$this->InetService->price;
        }
        if($this->CatvService)
        {
            $price+=$this->CatvService->price;
        }
        if($this->IptvService)
        {
            $price+=$this->IptvService->price;
        } 
        return $price;
    }
    public function canBuy(Customer $customer =null, int $quantity = 1, bool $force = false): bool
    {
        /**
         * This is where you implement the constraint logic. 
         * 
         * If the service can be purchased once, then
         *  return !$customer->paid($this);
         */
        //dd($customer->paid($this));
        //return true;
        $ret =true;
        ///CHEK API ACTIVE
        if($this->InetService)
        {
            if($customer->AccountInetService->BillingState<0)
            {
                return false;
            }
        }
        if($this->CatvService)
        {
            if($customer->AccountCatvService->BillingState<0)
            {
               return false;
            }
        }
        ///CHECK SUBSCRIPTION ACTIVE
        if($customer->Tarif){
            if ($customer->Subscription){
                return false;
            }
        }
        
        //CHECK CAN PAY FOR SERVICES
        if($this->InetService)
        {
            $w=$customer->getWallet("wallet_".$this->InetService->ServiceCompanies->id);
            
            if($w){
                if($w->balance<$this->InetService->price)
                {
                    $ret=false;
                }
             }else 
             {
                $ret=false;
             }
        }
        if($this->CatvService)
        {
            $w=null;
            $w=$customer->getWallet("wallet_".$this->CatvService->ServiceCompanies->id);          
            if($w){
                if($w->balance<$this->CatvService->price)
                {
                    $ret=false;
                }
             }else 
             {
                $ret=false;
             }
        }
        if($this->IptvService)
        {
            $w=null;
            $w=$customer->getWallet("wallet_".$this->IptvService->ServiceCompanies->id);          
            if($w){
                if($w->balance<$this->IptvService->price)
                {
                    $ret=false;
                }
             }else 
             {
                $ret=false;
             }
        }                      
        return $ret;
    }
    public function InetService()
    {
        return $this->hasOne(InetService::class);
    }
    public function CatvService()
    {
        return $this->hasOne(CatvService::class);
    }
    public function IptvService()
    {
        return $this->hasOne(IptvService::class);
    }
    public function BillingAccount(){
        return $this->hasMany(BillingAccount::class);
    }
}
