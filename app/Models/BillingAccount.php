<?php

namespace App\Models;

use App\Observers\BillingAccountObserver;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Bavix\Wallet\Traits\CanPay;
use Bavix\Wallet\Interfaces\Customer;

#[ObservedBy([BillingAccountObserver::class])]
class BillingAccount extends Model implements Customer
{
    use HasFactory,CanPay;
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
    public function AccountInetService()
    {
        return $this->hasOne(AccountInetService::class);
    }

    public function InetDevices(){
        return $this->hasMany(InetDevices::class);
    }

    public function Subscriptions(){
        return $this->hasMany(AccountSubscription::class);
    }
    public function getSubscriptionAttribute(){
        return $this->Subscriptions()->whereDate('acct_end','>',Carbon::now())->latest()->first();
    }
    public function getInetAccessAttribute(): int
    {
        $state=0;       
        if($this->AccountInetService?->MikroBillApi){
            // esli est' privyazka k API
           $state=$this->AccountInetService->BillingState;
           
        }
        if($state>=0&&$this->Subscription?->tarif?->InetService){
            $state=-1;
        }else if($state>=0&&!$this->Subscription){
            //Try to by tarif subscription
            if($this->Tarif->canBuy($this)){
                $subscr= new AccountSubscription();
                $subscr->tarif_id=$this->tarif_id;
                $subscr->acct_end=Carbon::now()->addMonth();
                if($this->safePay($this->Tarif)){
                    $this->Subscriptions()->save($subscr);
                }
            }
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
}
