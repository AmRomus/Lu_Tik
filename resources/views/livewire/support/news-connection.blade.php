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
                                {{$item->planed_time}}
                                </div> 
                            @endif
                            <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">
                                                        
                            </h6>
                            <ul class="list-group list-group-flush tx-13">
                                <li class="list-group-item d-flex pd-sm-x-20">
                                   <h6> {{$item->BillingAccount->Address}} </h6>
                                </li>
                                <li class="list-group-item d-flex pd-sm-x-20">
                                   <div class="pd-sm-l-10">ID  </div>
                                   <div class="mg-l-auto text-end"><a href="{{route('account.edit',$item->BillingAccount->id)}}">{{$item->BillingAccount->ident}}</a> </div>
                                </li>
                                <li class="list-group-item d-flex pd-sm-x-20">
                                    <div class="pd-sm-l-10">Phone  </div><div class="mg-l-auto text-end"><a href="tel:{{$item->BillingAccount->phone}}">{{$item->BillingAccount->phone}}</a> </div>
                                 </li>
                                 <li class="list-group-item d-flex pd-sm-x-20">
                                    {{$item->description}}
                                 </li>
                                 <li class="list-group-item d-flex pd-sm-x-20">
                                    <div class="pd-sm-l-10">
                                        <div class="img-group img-group-sm mg-b-5">
                                            @foreach ($item->Users as $user)
                                            <img src="/imgs/noavatar.png" style="width: 25px" class="img rounded-circle" alt="{{$user->name}}" data-bs-toggle="tooltip" title="{{$user->name}}" >
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="mg-l-auto text-end">
                                        <a href="#" class="nav-link" wire:click.prevent="$dispatchTo('modals.set-ticket-users','show_modal',{ tik: {{$item->id}} })"><i class="fa fa-plus"></i></a>
                                    </div>
                                 </li>
                                 <li class="list-group-item d-flex pd-sm-x-20">
                                    <div class="d-flex w-100">
                                        <div class="w-50">
                                            <i class="fa fa-history"></i> {{__('History')}} ({{$item->AcctionsHistory->count()}})
                                        </div>
                                        <div class="text-end w-50">
                                            <i class="fa fa-comment"></i> {{__('Comments')}} ({{$item->TicketComment->count()}})
                                        </div>
                                    </div>
                                 </li>
                            </ul>
                            
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <livewire:modals.set-ticket-users @saved="$refresh">
            
</div>
