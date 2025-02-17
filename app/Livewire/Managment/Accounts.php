<?php

namespace App\Livewire\Managment;

use App\Models\Address;
use App\Models\BillingAccount;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Auth;
class Accounts extends Component
{
    use WithPagination;
    public $accounts;
    public $search;
    public $tarif_filtred=false;
    public $farray=array();
    public $adress_ids=array();
    public function mount()
    {
        
    }
    public function render()
    {
       
        //$accounts=BillingAccount::all();
        $accs_res=BillingAccount::where(function($q){
            foreach($this->farray as $key=>$val)
            {
                if($val){
                   $q->orWhere('tarif_id',$key);
                }
            }
            if($this->search && $this->search!=''){
            foreach(explode(' ',$this->search) as $search_str)
                {
 
                     $q->where(function($s)use($search_str){
                         $s->where('ident','like','%'.$search_str.'%');
                         $s->orwhere('first','like','%'.$search_str.'%');
                         $s->orwhere('last','like','%'.$search_str.'%');
                         $s->orwhere('middle','like','%'.$search_str.'%');
                         $s->orwhere('phone','like','%'.$search_str.'%');
                       //  $s->orwhere('address','like','%'.$search_str.'%');
                     });
                     if(count($this->adress_ids))
                     {
                         $q->orwhereIn('address_id',$this->adress_ids);
                     }
                    
              }                
            }
        })
        ->with('Subscriptions')
        ->with('Tarif')
        ->with('AccountInetService')
        ->with('AccountCatvService')
        ->with('Address');
        if(Auth::user()->hasAnyPermission(['Delete accounts','Superadmin'])){
            $accs_res->withTrashed();
        }
        $accs=$accs_res->paginate(20);
        return view('livewire.managment.accounts',compact('accs'));
    }
    #[On('set_tarif_filter')]
    public function set_tfilter($farray)
    {
       $this->farray=$farray;
       $this->tarif_filtred=true;
    }
    public function reset_tarif_filter()
    {
        $this->set_tfilter([]);
        $this->tarif_filtred=false;
    }
    public function updatedSearch()
    {
        $this->tarif_filtred=false;
        $this->adress_ids=$this->FindChildIds($this->search);
        $this->resetPage();
        // $this->accounts=BillingAccount::where(function($q) use($adress_ids){
            
        // })->with('Tarif')
        // ->with('AccountInetService')
        // ->with('AccountCatvService')
        // ->with('Address')->get();
    }
    public static function FindChildIds($search) : array
    {        
        $adress_ids = Address::whereHas('ancestorsAndSelf',function ($query) use ($search) {
            foreach(explode(',',$search) as $search_str){
                $query->whereHas('ancestorsAndSelf',function ($q)use($search_str){
                    $q->where('unit','like',$search_str.'%');
                });
            }
        })->get()->pluck('id')->toArray();
        return $adress_ids;
    }
}
