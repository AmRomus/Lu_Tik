<div>
    <x-layouts.sidebar activePage="companies" > </x-layouts.aside>
    <div class="content ht-100v pd-0">
        <div class="content-header">
            <h4>{{__('Companies')}}</h4>
            <nav class="nav">
                <a href="#" class="btn btn-sm btn-success tx-bold" wire:click="$dispatchTo('modals.new-inet-device','show_modal')"> {{__('New')}}</a>
            </nav>
        </div>
        <div class="content-body">
            <div class="row">
                @foreach ($companyes as $item)
                    <div class="col-12 col-sm-4 col-lg-2">
                        <div class="df-example p-1" data-label="{{$item->Name}}">
                            <div>
                                {{_('Balance')}}:{{$item->balance}}
                            </div>
                            <div>{{_('Inet Services')}}:{{$item->InetServices->count()}}</div>
                            <div>{{_('CATV Services')}}:{{$item->CatvServices->count()}}</div>
                            <div>{{_('IPTV Services')}}:{{$item->IptvServices->count()}}</div>
                            <div>{{_('Workers')}}:{{$item->Users->count()}}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
