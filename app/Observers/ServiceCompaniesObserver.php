<?php

namespace App\Observers;

use App\Models\BillingAccount;
use App\Models\ServiceCompanies;

class ServiceCompaniesObserver
{
    public function created(ServiceCompanies $company): void
    {
        foreach(BillingAccount::all() as $account)
        {
            if(!$account->hasWallet("wallet_".$company->id))
            {
                $account->createWallet([
                    'name' => $company->name,
                    'slug' => "wallet_".$company->id,
                ]);
            }
        }
    }
}
