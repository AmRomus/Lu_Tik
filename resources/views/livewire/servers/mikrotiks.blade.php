<div>
    <x-layouts.sidebar activePage="Mikrotiks" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('Mikrotiks')}}</h4>
                <nav class="nav">
                    <a href="#" class="btn btn-sm btn-success tx-bold" wire:click="$dispatchTo('modals.new-mikrotik','show_modal')"> {{__('New Mikrotik')}}</a>
                  </nav>
            </div>
            <div class="content-body">
                <div class="row">
                    @foreach ($mikrotiks as $item)
                    <div class="col-sm-6 col-lg-3 mt-2">
                        <div class="card card-body shadow-none">
                            <div class="marker marker-ribbon marker-top-right pos-absolute t-10 r-0"><a href="{{route('mikrotik.edit',$item->id)}}">{{$item->SysInfo?$item->SysInfo["board-name"]:"Mikrotik"}}</a></div>
                            <h6 class="mg-b-15 mg-t-2 tx-10">{{$item->name}} - {{$item->hostname}}</h6>
                            <p class="mg-b-0">Uptime: <span> {{$item->SysInfo?$item->SysInfo["uptime"]:"OFFLINE"}}</p>
                        </div>
                    </div>     
                    @endforeach
                </div>
            </div>
        </div>
        <livewire:modals.new-mikrotik  @saved="$refresh">
</div>
