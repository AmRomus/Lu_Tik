<div>   
    <div class="marker marker-ribbon marker-top-right pos-absolute  r-0 >@if ($dev->online) bg-success tx-white @else bg-danger @endif ">@if ($dev->online)
        {{__('Online')}}
    @else
        {{__('Offline')}}
    @endif</div>    
    
    <div class="media align-items-center col-sm">        
        @if ($catv)
        <div class="wd-35 ht-35 bd bd-2 @if (!$active)  tx-danger @else  tx-success @endif  rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex">
            
            <i data-feather="tv"></i>
                                       
          </div>
        @endif
    <div class="media-body mg-sm-l-15" wire:poll.15s>
        <p class="tx-12 mg-b-0"><strong>MAC:</strong> {{$dev?->mac}}</p>   
        <p class="tx-12 mg-b-0"><strong>{{__('Signal')}}:</strong> {{$dev->signal}}  </p>     
        @if (!$dev->online)
        <p class="tx-12 mg-b-0"><strong>{{__('Action')}}:</strong> {{$dev->msg}}  </p>     
        <p class="tx-12 mg-b-0"><strong>{{__('Time')}}:</strong> {{$timediff}}  </p>     
        @endif
    </div>
    </div>
</div>
