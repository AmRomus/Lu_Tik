<div>   
    <p class="tx-12 mg-b-0"><strong>MAC:</strong> {{$dev?->mac}}</p>   
    <p class="tx-12 mg-b-0"><strong>{{__('Signal')}}:</strong> {{$dev->signal}}  </p>     
    @if (!$dev->online)
    <p class="tx-12 mg-b-0"><strong>{{__('Action')}}:</strong> {{$dev->msg}}  </p>     
    @endif
</div>
