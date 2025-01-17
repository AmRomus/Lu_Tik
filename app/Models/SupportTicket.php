<?php

namespace App\Models;

use App\TicketTypes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class SupportTicket extends Model
{
    protected $casts=
    [
        'ticket_type'=>TicketTypes::class,
    ];
    public function scopeActual(Builder $q)
    {
       $q->where('finished','!=',1);
    }
    public function BillingAccount()
    {
        return $this->belongsTo(BillingAccount::class);
    }
    public function scopeConnections(Builder $q)
    {
       $q->where('ticket_type',TicketTypes::Install)->whereProcessed(0);
    }
    public function scopeWaitConfirm(Builder $q)
    {
       $q->where('finished',0)->whereProcessed(1);
    }
    public function Users()
    {
        return $this->belongsToMany(User::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function TicketComment()
    {
        return $this->hasMany(TicketComment::class);
    }

    public function AcctionsHistory()
    {
        return $this->morphMany(AcctionsHistory::class,'acct_object');
    }
    public function getTimeLeftAttribute()
    {
        return Carbon::now()->diff(Carbon::parse($this->created_at))->forHumans(true);
    }
    public function getExpiredAttribute(): bool
    {
        if(Carbon::now()->diffInHours(Carbon::parse($this->planed_time),false)>0)
        {
            return false;
        }else {
            return true;
        }
    }
    public function getProcessedResultsAttribute()
    {
        return $this->morphMany(AcctionsHistory::class,'acct_object')->where('acction','Close ticket')->latest()->first();
    }

}
