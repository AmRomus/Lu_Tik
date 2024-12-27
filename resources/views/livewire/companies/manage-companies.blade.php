<div>
    <x-layouts.sidebar activePage="companies" > </x-layouts.aside>
    <div class="content ht-100v pd-0">
        <div class="content-header">
            <h4>{{__('Companies')}}</h4>
            <nav class="nav">
                <a href="#" class="btn btn-sm btn-success tx-bold" wire:click="$dispatchTo('modals.new-service-company','show_modal')"> {{__('New')}}</a>
            </nav>
        </div>
        <div class="content-body">
            <div class="row">
                @foreach ($companyes as $item)
                    <div class="col-12 col-sm-4 col-lg-3">
                        <div class="df-example " data-label="{{$item->Name}}">
                            <div class="row">
                                <div class="col-4">
                                    Logo
                                </div>
                                <div class="col-8">
                                    <ul class="list-unstyled mg-b-0">
                                        <li class="list-item">
                                            <span>{{_('Inet Services')}}</span>
                                            {{$item->InetServices->count()}}
                                        </li>
                                        <li class="list-item">
                                            <span>{{_('CATV Services')}}</span>{{$item->CatvServices->count()}}
                                        </li>
                                        <li class="list-item">
                                            <span>{{_('IPTV Services')}}</span>{{$item->IptvServices->count()}}
                                        </li>
                                        <li class="list-item">
                                            <span>{{_('Workers')}}</span>{{$item->Users->count()}}
                                        </li>
                                        <li class="list-item d-flex">
                                            <button class="btn btn-xs btn-success w-50" wire:click="edit({{$item->id}})">{{__('Edit')}}</button>
                                            <button class="btn btn-xs btn-danger w-50" wire:click="del({{$item->id}})" wire:confirm="{{__('Remove company ?')}}">{{__('Delete')}}</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <livewire:modals.new-service-company @saved="$refresh" />
</div>
