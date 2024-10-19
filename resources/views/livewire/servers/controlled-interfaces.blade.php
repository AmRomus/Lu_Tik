<div>
    <ul class="list-unstyled mg-b-0">
        <li class="list-label">{{__('Controlled interfaces')}}</li> 
    @forelse ($ControlInterface as $item)
    <li class="list-item">
      <div class="media align-items-center w-100">                        
        <div class="media-body mg-sm-l-15">
          <h6>{{$item->interface}}</h6>
          @forelse ($item->Ip as $ip)
              <span class="tx-10 tx-bold tx-rubik tx-gray-500">{{$ip['address']}}</span><br>
          @empty
          <p>{{__('No Ip address')}}</p>
          @endforelse  
            
        </div>
        <div class="text-end ">                                            
          <span wire:click="rem_iface({{$item->id}})"><i data-feather="trash-2"></i></span>
      </div>                
      </div>
    </li>
    @empty
    <li class="list-label">{{__('No Interface controlled')}}</li>
    @endforelse
    </ul>
</div>
