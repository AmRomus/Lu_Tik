<div @if ($wrong)
    class="tx-danger"
@endif>
    <div class="marker marker-ribbon marker-top-right pos-absolute  r-0 >@if ($online) bg-success tx-white @else bg-danger @endif ">@if ($online)
        {{__('Online')}}
    @else
        {{__('Offline')}}
    @endif</div>    
    <p class="tx-12 mg-b-0"><strong>IP:</strong> {{$dev?->ip}}</p> 
    <p class="tx-12 mg-b-0"><strong>MAC:</strong> {{$dev?->mac}}</p>     
</div>
