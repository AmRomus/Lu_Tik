<?php

namespace App\Observers;

use App\Models\Mikrotik;

class MikrotikObserver
{
    public function updated(Mikrotik $mk)
    {
        if($mk->wasChanged('qtype'))
        {
            foreach($mk->ControlInterface as $iface)
            {
                foreach($iface->InetDevices as $dev)
                {
                    $acc=$dev->BillingAccount;
                    if($acc){
                        $mk->DelQueue($acc);
                        $mk->AddQueue($acc);
                    }
                }
            }
        }
    }
}
