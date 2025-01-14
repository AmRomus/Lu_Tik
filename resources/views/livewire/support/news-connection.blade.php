<div>
    <x-layouts.sidebar activePage="NewCons" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('New Connection tickets')}}</h4>
            </div>
            <div class="content-body">
                <div class="row">
                    @foreach ($tickets as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 m-2 ps-1">
                    <div class="card card-body shadow-dark "> 
                        @if ($item->planed_time)                        
                            <div class="marker marker-ribbon marker-top-right pos-absolute  r-0 t-1 bg-warning tx-white" style="width:200px; cursor: pointer;" >
                                <div class="dropdown">
                                <a href="#" class="dropdown-toggle nav-link text-white"  id="ticket_button_{{$item->id}}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{$item->planed_time}}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="ticket_button_{{$item->id}}">                             
                                    <a href="{{route('support.ticket.edit',$item->id)}}" class="dropdown-item tx-10 tx-primary" >{{__('Edit Text')}}</a>
                                    <a href="{{route('support.ticket.edit',$item->id)}}" class="dropdown-item tx-10 tx-primary" >{{__('Edit Date')}}</a>
                                    <a href="{{route('support.ticket.edit',$item->id)}}" class="dropdown-item tx-10 tx-success" >{{__('Close')}}</a>
                                 <a href="#" class="dropdown-item tx-10 tx-danger" wire:confirm="{{__('Are you whant unlink this device ?')}}" wire:click.prevent="unlik_iptv_dev({{$item->id}})">{{__('Delete')}}</a>
                                </div>
                              </div> 
                            </div> 
                        @endif
                    
                        
                        <livewire:widgets.nc-ticket :tid="$item->id" :key="$item->id">
                    </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <livewire:modals.set-ticket-users @saved="$refresh">
        <livewire:modals.short-history>
</div>
