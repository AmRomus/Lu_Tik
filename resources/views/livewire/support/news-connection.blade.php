<div>
    <x-layouts.sidebar activePage="NewCons" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('New Connection tickets')}}  </h4>
            </div>
            <div class="content-body">
                <div class="row">
                    @foreach ($tickets as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 m-2 ps-1">
                    <div class="card card-body shadow-dark "> 
                        <h6>#{{$item->id}}</h6>
                        @if ($item->planed_time)                        
                            <div class="marker marker-ribbon marker-top-right pos-absolute  r-0 t-1 @if(!$item->expired) bg-warning @else bg-danger @endif tx-white" style="width:200px; cursor: pointer;" >
                                <div class="dropdown">
                                <a href="#" class="dropdown-toggle nav-link text-white"  id="ticket_button_{{$item->id}}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{$item->planed_time}}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="ticket_button_{{$item->id}}">                             
                                    <a href="#" wire:click.prevent="$dispatchTo('modals.change-ticket-descr','show_modal',{tid:{{$item->id}}})" class="dropdown-item tx-10 tx-primary" >{{__('Edit Text')}}</a>
                                    <a href="#" wire:click.prevent="$dispatchTo('modals.change-ticket-day','show_modal',{tid:{{$item->id}}})" class="dropdown-item tx-10 tx-primary" >{{__('Edit Date')}}</a>
                                    <a href="#" wire:click.prevent="$dispatchTo('modals.close-ticket','show_modal',{tid:{{$item->id}}})" class="dropdown-item tx-10 tx-success" >{{__('Close')}}</a>
                                    <a href="#" class="dropdown-item tx-10 tx-danger" wire:confirm="{{__('Are you whant delete  ticket  #'.$item->id.'?')}}" wire:click.prevent="delete_ticket({{$item->id}})">{{__('Delete')}}</a>
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
        <livewire:modals.change-ticket-descr>
        <livewire:modals.change-ticket-day  @saved="$refresh">    
        <livewire:modals.close-ticket  @saved="$refresh">  
</div>
