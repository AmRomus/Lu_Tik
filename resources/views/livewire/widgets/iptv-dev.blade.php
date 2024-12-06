<div class="d-flex w-100">
    <div class="marker marker-ribbon marker-top-right pos-absolute  r-0 >@if($item->OnlineStatus!=0) bg-success tx-white @else bg-danger @endif ">@if ($item->OnlineStatus!=0)
        {{__('Online')}}
    @else
        {{__('Offline')}}
    @endif</div>    
<div class="media align-items-center col-sm">
    <div class="wd-35 ht-35 bd bd-2 @if ($item->OnlineStatus==0)  tx-danger @else  tx-success @endif  rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex">
      @if ($item->dev_type==='STB')
      <i data-feather="hard-drive"></i>
      @else
      <i data-feather="tv"></i>
      @endif                               
    </div>
    <div class="media-body mg-sm-l-15">
      <p class="tx-medium mg-b-0">{{$item->mac}}</p>
      <p class="tx-12 tx-bold mg-b-0 tx-color-03">{{$item->ip}}</p>
    </div><!-- media-body -->
  </div><!-- media -->
  <div class="media align-items-center col-sm">
    <div class="form-check form-switch">
      <input class="form-check-input ms-0 me-2" type="checkbox"  @if ($item->catch_up) @checked(true) @endif wire:click="toggle_catchup({{$item->id}})" >
      <label class="form-check-label" >Catch-Up</label>
  </div>
  </div>
  <div class="media align-items-center col-sm">
    <div class="wd-35 ht-35 bd bd-2 @if ($item->OnlineStatus==0)  tx-danger @else  tx-success @endif  rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex">
      <img src="/logos/{{$item->IptvStreamStat->whereNull('show_stop')?->first()?->IptvStream->tvg_ico}}.png" style="height: 30px"/>                                           
    </div>
  <div class="ms-3">
     {{$item->IptvStreamStat->whereNull('show_stop')?->first()?->IptvStream->name}}
  </div>
  </div>
 
</div>