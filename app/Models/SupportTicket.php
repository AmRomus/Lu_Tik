<?php

namespace App\Models;

use App\TicketTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class SupportTicket extends Model
{
    protected $casts=
    [
        'ticket_type'=>TicketTypes::class,
    ];

    public function BillingAccount()
    {
        return $this->belongsTo(BillingAccount::class);
    }
    public function scopeConnections(Builder $q)
    {
       $q->where('ticket_type',TicketTypes::Install);
    }
    public function Users()
    {
        return $this->belongsToMany(User::class);
    }
    public function TicketComment()
    {
        return $this->hasMany(TicketComment::class);
    }

    public function AcctionsHistory()
    {
        return $this->morphMany(AcctionsHistory::class,'acct_object');
    }
}
