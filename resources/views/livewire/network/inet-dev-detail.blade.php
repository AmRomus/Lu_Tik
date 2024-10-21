<div>
    <p class="tx-12 mg-b-0"> {{$mac}}</p> 
    @if ($interface)    
     <span>{{($mk->name)?$mk->name:$mk->hostname}}</span> <span class="tx-gray-500">/</span><span>{{$interface}}</span><span class="tx-gray-500">/</span><span class="tx-12 tx-bold">{{$ip}}</span>     
    @else
        <div class="tx-danger tx-bold">
            {{__('Not Registred')}}
        </div>
    @endif
    @forelse ($ret as $item)
   
    @if ($item->complete=="true")
     @if($item->mk->id==$mk->id&&$interface==$item->interface && $ip==$item->address)
     <div class="tx-success">
        @else 
        <div class="tx-danger tx-bold">
        @endif
        @else 
        <div class="tx-gray-400">
    @endif
    
    <span>{{($item->mk->name)?$item->mk->name:$item->mk->hostname}}</span> <span class="tx-gray-500">/</span><span>{{$item->interface}}</span><span class="tx-gray-500">/</span><span class="tx-12 tx-bold">{{$item->address}}</span>
    </div>
    
    @empty
    
   
    @endforelse
   
</div>
