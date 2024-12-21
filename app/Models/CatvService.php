<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CatvService extends Model
{
    use HasFactory;
    protected $fillable=[
        'tarif_id',        
        'price',
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
}
