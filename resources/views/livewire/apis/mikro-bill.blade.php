<div>
    <x-layouts.sidebar activePage="Mikrobill" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('MikroBill')}}</h4>
                <nav class="nav">
                    <a href="#" class="btn btn-sm btn-success tx-bold" wire:click="$dispatchTo('modals.new-mikro-bill','show_modal')"> {{__('New Mikrobill')}}</a>
                  </nav>
            </div>
            <div class="content-body">
                <div class="row">
                    
                        @foreach ($mapis as $item)
                        <div class="col-sm-6 col-lg-3 mt-2">
                            <div class="card card-body shadow-none">
                                <div class="marker marker-ribbon marker-top-right pos-absolute t-10 r-0">{{$item->name}}</div>
                                <p>{{__('Host')}}: {{$item->host}}</p> 
                                
                            </div>
                        </div>     
                        @endforeach
                    
                </div>
            </div>
        </div>

    <livewire:modals.new-mikro-bill @saved="$refresh">
</div>
