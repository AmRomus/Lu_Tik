<div>
    <x-layouts.sidebar activePage="Olts" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('Olts')}}</h4>
                <nav class="nav">
                    <a href="#" class="btn btn-sm btn-success tx-bold" wire:click="$dispatchTo('modals.new-olt','show_modal')"> {{__('New Olt')}}</a>
                  </nav>
            </div>
            <div class="content-body">
                <div class="row">
                    @foreach ($olts as $item)
                    <div class="col-sm-6 col-lg-3 mt-2">
                        <div class="card card-body shadow-none">
                            <div class="marker marker-ribbon marker-top-right pos-absolute t-10 r-0"><a href="{{route('olt.edit',$item->id)}}">{{$item->OltTemplate?$item->OltTemplate->name:__('Unknown')}}</a></div>
                            <h6 class="mg-b-15 mg-t-2 tx-10">{{$item->name}} - {{$item->ip}} - {{$item->SystemName}}</h6>
                            <p class="mg-b-0">Uptime: <span> {{$item->SystemUpTime?$item->SystemUpTime:"OFFLINE"}}</p>
                        </div>
                    </div>     
                    @endforeach
                </div>
            </div>
        </div>
        <livewire:modals.new-olt @saved="$refresh" />
</div>
