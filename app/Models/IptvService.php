<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IptvService extends Model
{
    protected $fillable=[
        'tarif_id',        
        'price',
        'play_list_id',
        'iptv_devices',
        'smart_devices',
        'service_companies_id',
    ];
    public function Tarif()
    {
        return $this->belongsTo(Tarif::class);
    }

    public function AccountCatvService()
    {
        return $this->hasMany(AccountCatvService::class);
    }

    public function ServiceCompanies()
    {
        return $this->belongsTo(ServiceCompanies::class);
    }
    public function PlayList()
    {
        return $this->belongsTo(PlayList::class);
    }
}
