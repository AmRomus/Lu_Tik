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
        return 100;
    }
    public function canBuy(Customer $customer =null, int $quantity = 1, bool $force = false): bool
    {
        /**
         * This is where you implement the constraint logic. 
         * 
         * If the service can be purchased once, then
         *  return !$customer->paid($this);
         */
        return true; 
    }
    public function InetService()
    {
        return $this->hasOne(InetService::class);
    }
}
