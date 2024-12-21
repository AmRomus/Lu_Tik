<div class="row">
   @if ($inet)
   <div class="col">       
        <div><i class="fa fa-check"></i>Internet</div>
        <div>{{$inet_owner}}</div>
   </div>
   @endif
   @if ($catv)
   <div class="col ">        
        <div><i class="fa fa-check"></i>CATV</div>
        <div>{{$catv_owner}}</div>
   </div>
   @endif
   @if ($iptv)
   <div class="col">        
        <div><i class="fa fa-check"></i>IPTV</div>
        <div>{{$iptv_owner}}</div>
   </div>
   @endif
</div>
