<?php

namespace App\Models;

use App\Observers\BillingAccountObserver;
use Bavix\Wallet\External\Dto\Extra;
use Bavix\Wallet\External\Dto\Option;
use Bavix\Wallet\Traits\HasWallets;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Bavix\Wallet\Traits\CanPay;
use Bavix\Wallet\Interfaces\Customer;

#[ObservedBy([BillingAccountObserver::class])]
class BillingAccount extends Model implements Customer
{
    use HasFactory,CanPay,HasWallets;
    protected $fillable=[
        'first',
        'last',
        'middle',
        'ident',
    ];
    public function getFullnameAttribute()
    {
        return $this->first.' '.$this->last.' '.$this->middle;
    }
    public function getInitialsAttribute()
    {  
        $initials="";
        if($this->first)             
            $initials=$initials.mb_substr($this->first,0,1,"utf-8");
        if($this->last)
            $initials=$initials.mb_substr($this->last,0,1,"utf-8");
       return $initials;
    }
    public function getAddressAttribute()
    {
       $addr=Address::find($this->address_id)?->rootAncestororSelf()->first();
        return $addr?->FullAddress;
    }
    public function Tarif()
    {
        return $this->belongsTo(Tarif::class);
    }
    /* SERVISES */
    public function AccountInetService()
    {
        return $this->hasOne(AccountInetService::class);
    }
    public function AccountCatvService()
    {
        return $this->hasOne(AccountCatvService::class);
    }
    public function InetDevices(){
        return $this->hasMany(InetDevices::class);
    }
    public function Onu()
    {
        return $this->hasMany(Onu::class);
    }
    public function Subscriptions(){
        return $this->hasMany(AccountSubscription::class);
    }
    public function getSubscriptionAttribute(){
        return $this->Subscriptions()->whereDate('acct_end','>',Carbon::now())->latest()->first();
    }
    public function getApiAccessAttribute():int
    {
        $state=0;
        if($this->AccountInetService?->MikroBillApi&&$this->tarif?->InetService){
            // esli est' privyazka k API
           if($this->AccountInetService->BillingState<0)
           {
                $state=$this->AccountInetService->BillingState;
           }           
        }
        if($this->AccountCatvService?->MikroBillApi&&$this->tarif?->CatvService){
            // esli est' privyazka k API
           if($this->AccountCatvService->BillingState<0){
                $state=$this->AccountCatvService->BillingState;
           }           
        }

        return $state;
    }
    public function make_subscription()
    {
       
            if($this->Tarif?->canBuy($this)){
                // PAY FOR INET
                if($this->Tarif->InetService){
                    $w=$this->getWallet("wallet_".$this->Tarif->InetService->ServiceCompanies->id);
                    $s=$this->Tarif->InetService->ServiceCompanies;
                    $w->transfer($s,$this->Tarif->InetService->price,new Extra(
                        deposit: [
                            'type' => 'extra-deposit',
                        ],                        
                        withdraw: new Option(
                            [
                                'type' => 'extra-withdraw',
                            ],
                            true // confirmed
                        ),
                        extra: [
                            'msg' => 'Pay for tarif '.$this->Tarif->name." -> Inet Service",
                        ],
                    ));
                }
                $catv=$this->Tarif->CatvService;
                if($catv){
                    $w=$this->getWallet("wallet_".$catv->ServiceCompanies->id);
                    $w->transfer($catv->ServiceCompanies,$catv->price,new Extra(
                        deposit: [
                            'type' => 'extra-deposit',
                        ],                        
                        withdraw: new Option(
                            [
                                'type' => 'extra-withdraw',
                            ],
                            true // confirmed
                        ),
                        extra: [
                            'msg' => 'Pay for tarif '.$this->Tarif->name." -> CATV Service",
                        ],
                    ));
                }
                $subscr= new AccountSubscription();
                $subscr->tarif_id=$this->tarif_id;
                $subscr->acct_end=Carbon::now()->addMonth();
                // if($this->safePay($this->Tarif)){
                $this->Subscriptions()->save($subscr);
                // }
                
            }
        
    }
    public function getInetAccessAttribute(): int
    {
        $this->make_subscription();
        $state=0;       
        if($this->AccountInetService?->MikroBillApi&&$this->tarif?->InetService){
            // esli est' privyazka k API
           $state=$this->AccountInetService->BillingState;           
        }
        if($state>=0&&$this->Subscription?->tarif?->InetService){
            $state=-1;
        }        
        return $state;
    }
    public function getCatvAccessAttribute(): int
    {
        $this->make_subscription();
        $state=0;       
        if($this->AccountCatvService?->MikroBillApi&&$this->tarif?->CatvService){
            // esli est' privyazka k API
           $state=$this->AccountCatvService->BillingState;
           
        }
        if($state>=0&&$this->Subscription?->tarif?->CatvService){
            $state=-1;
        }       
        return $state;
    }
    
    public function getInetSpeedLimitAttribute()
    {
        $inet_service=$this->Subscription?->tarif?->InetService;
        if ($inet_service){
            $up_speed= $inet_service->speed_up.$inet_service->speed_up_unit;
            $down_speed= $inet_service->speed_down.$inet_service->speed_down_unit; 
           
        }else {
            $inet_service=$this->Tarif->InetService;
            $up_speed= $inet_service->speed_up.$inet_service->speed_up_unit;
            $down_speed= $inet_service->speed_down.$inet_service->speed_down_unit; 
        }
        $speeds=$up_speed.'/'.$down_speed;
        return $speeds;
    }
    public function getInetSpeedBurstAttribute()
    {
        $inet_service=$this->Subscription?->tarif?->InetService;
        if ($inet_service){
            $up_speed=round($inet_service->speed_up+($inet_service->speed_up/100)*$inet_service->burst_percent).$inet_service->speed_up_unit;
            $down_speed= round($inet_service->speed_down+($inet_service->speed_down/100)*$inet_service->burst_percent).$inet_service->speed_down_unit; 
           
        }else {
            $inet_service=$this->Tarif->InetService;
            $up_speed=round($inet_service->speed_up+($inet_service->speed_up/100)*$inet_service->burst_percent).$inet_service->speed_up_unit;
            $down_speed= round($inet_service->speed_down+($inet_service->speed_down/100)*$inet_service->burst_percent).$inet_service->speed_down_unit; 
        }
        $speeds=$up_speed.'/'.$down_speed;
        return $speeds;
    }
    public function getInetSpeedBurstTimeAttribute()
    {
        $inet_service=$this->Subscription?->tarif?->InetService;
        if ($inet_service){
            $time=$inet_service->burst_time.'s';
        }else {
            $inet_service=$this->Tarif->InetService;
            $time=$inet_service->burst_time.'s';
        }
        $times=$time.'/'.$time;
        return $times;    
    }
    public function getInetBustThresholdAttribute()
    {
        $upk=1;
        $downk=1;
        $inet_service=$this->Subscription?->tarif?->InetService;
        if (!$inet_service){
            $inet_service=$this->Tarif->InetService;
        }
        switch($inet_service->speed_up_unit)
        {
            case "M":
                $upk=1024*1024;
                break;
            case "K":
                $upk=1024;
                break;
            default:
                $upk=1;
        }
        switch($inet_service->speed_down_unit)
        {
            case "M":
                $downk=1024*1024;
                break;
            case "K":
                $downk=1024;
                break;
            default:
                $downk=1;
        }
        $up_speed= ($inet_service->speed_up*$upk*3)/4;
        $down_speed= ($inet_service->speed_down*$downk*3)/4; 
        $speeds=$up_speed.'/'.$down_speed;
        return $speeds;
    }
}
