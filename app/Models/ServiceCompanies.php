<?php

namespace App\Models;

use App\Observers\ServiceCompaniesObserver;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\HasWallet;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(ServiceCompaniesObserver::class)]
class ServiceCompanies extends Model implements Wallet
{
    use HasWallet;
}
