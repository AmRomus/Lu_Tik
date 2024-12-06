<div>   
    <div class="marker marker-ribbon marker-top-right pos-absolute  r-0 >@if ($dev->online) bg-success tx-white @else bg-danger @endif ">@if ($dev->online)
        {{__('Online')}}
    @else
        {{__('Offline')}}
    @endif</div>    
    <p class="tx-12 mg-b-0"><strong>MAC:</strong> {{$dev?->mac}}</p>   
    <p class="tx-12 mg-b-0"><strong>{{__('Signal')}}:</strong> {{$dev->signal}}  </p>     
    @if (!$dev->online)
    <p class="tx-12 mg-b-0"><strong>{{__('Action')}}:</strong> {{$dev->msg}}  </p>     
    @endif
</div>
