<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\HasWallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements Wallet
{
    use HasFactory, Notifiable, HasRoles,HasWallet;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function ServiceCompany()
    {
        return $this->belongsToMany(ServiceCompanies::class,'users_service_companies','service_companies_id','users_id');
    }
    public function SupportTicket()
    {
        return $this->belongsToMany(SupportTicket::class);
    }
    public function getMyTicketsCountAttribute()
    {
       return $this->SupportTicket()->Actual()?->count();
    }
    public function AcctionsHistory()
    {
        return $this->morphMany(AcctionsHistory::class,'acct_object');
    }
}
