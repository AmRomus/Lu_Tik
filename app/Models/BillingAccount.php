<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Bavix\Wallet\Traits\CanPay;
use Bavix\Wallet\Interfaces\Customer;

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
}
