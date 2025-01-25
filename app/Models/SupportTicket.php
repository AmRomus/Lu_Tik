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
       $q->where('finished','!=',1)->where('processed',0);
    }
    public function scopeRegistred(Builder $q)
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
    public function scopeSupport(Builder $q)
    {
       $q->where('ticket_type',TicketTypes::Support)->whereProcessed(0);
    }
    public function scopeUninstall(Builder $q)
    {
       $q->where('ticket_type',TicketTypes::Uninstall)->whereProcessed(0);
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
    public function SupportType()
    {
        return $this->belongsTo(SupportType::class);
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
    public function getIsTodayAttribute()
    {
        $date = Carbon::parse($this->planed_time);
        return $date->isToday() ? true : false;
    }
    public function getProcessedResultsAttribute()
    {
        return $this->morphMany(AcctionsHistory::class,'acct_object')->where('acction','Ticket Processed')->latest()->first();
    }
    public function getPlanedDayAttribute()
    {
        return Carbon::parse($this->planed_time)->format("d-m-y");
    }
    
    public function getCreatedDayAttribute()
    {
        return Carbon::parse($this->created_at)->format("d-m-y");
    }
    public function getDurationAttribute()
    {
        return Carbon::parse($this->ProcessedResults?->created_at)->diffForHumans($this->created_at);
    }

}
