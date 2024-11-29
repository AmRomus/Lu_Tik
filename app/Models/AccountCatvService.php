<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Log;
class AccountCatvService extends Model
{
    use HasFactory;
    public function MikroBillApi()
    {
        return $this->belongsTo(MikroBillApi::class);
    }
    public function scopeActive(Builder $query)
    {
        $query->whereNotNull('catv_service_id');
    }
    public function CatvService()
    {
        return $this->belongsTo(CatvService::class);
    }
    public function CatvDevices()
    {
        return $this->hasMany(Onu::class);
    }
    public function getBillingStateAttribute()
    {
        
       
        if($this->mikro_bill_api_id!=null)
        {
           
            if($this->api_check==null)
            {            
                // Апи назначено но не опрошено добавляем 5 минут
                $this->api_check=Carbon::now()->addMinutes(5);
                Log::debug('$this->bill_update (null) :'.$this->id);
                $this->service_state=$this->get_bill_state_from_api();
                $this->save();
                $this->refresh();
                
                return $this->service_state;
            }
	        if($this->service_state>=0){
                $this->api_check=Carbon::now()->addMinutes(-6);
                $this->save();
                $this->refresh();                
            }
              /// Данные устарели
            if(Carbon::parse($this->api_check)->diffInMinutes(Carbon::now(),false)>5)
            {
                Log::debug('$this->bill_update (timeout) :'.$this->id.' INTERVAL '.Carbon::parse($this->api_check)->diffInMinutes(Carbon::now()));
                // Апи назначено Данные устарели
                $this->service_state=$this->get_bill_state_from_api();
                if($this->service_state<0)
                {
                    $next_check=Carbon::now()->addDay();
                    $next_check->hour(9);
                    $next_check->minutes(30);
                    $this->api_check=$next_check;
                    Log::debug('$this->bill_update (timeout) :'.$next_check);
                }else {
            	    $this->api_check=Carbon::now()->addMinutes(5);
		        }
               
                $this->save();
                $this->refresh();                
                return $this->service_state;
            }
          
            return $this->service_state;
        }
        return $this->service_state;
    }
    public function get_bill_state_from_api() : int 
    {
        Log::debug('Bill info for :'.$this->id);
        $JSON=json_decode($this->MikroBillApi->Process('API.Client.'.$this->api_ssid.'.StatusInfo.BlockReason'),true);
        if($JSON!=null&&$JSON['code']==0){ 
            if($JSON['return']!=null) {            
                return $JSON['return'];
            }
            return $this->service_state;
        }
         else 
        {
            return $this->service_state;
        }
    }
}
