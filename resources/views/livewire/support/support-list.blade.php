<div>
    <x-layouts.sidebar activePage="MyTasks" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('Planed tasks')}}  </h4>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card ht-100p">
                          
                          <ul class="list-group list-group-flush tx-13">
                            @if($for_install->count()>0)
                            <li class="card-header d-flex align-items-center justify-content-between pd-r-12 bg-gray-400">
                                <h6 class="mg-b-0">{{__('New Connections')}}</h6>
                              </li>
                            @endif
                            @foreach ($for_install as $item)
                            <li class="pd-r-60 list-group-item d-flex pd-sm-x-20 ">
                                <div class="marker-icon marker-primary pos-absolute t-0 l-0" style="cursor: pointer" wire:click="$dispatchTo('modals.show-ticket-descr','show_modal',{ tid:{{$item->id}}})">
                                    <i data-feather="link"></i>
                                  </div>                              
                              <div class="pd-l-15 mt-2">
                                <p class="tx-12 tx-color-03 mg-b-0">{{__('Ticket ID#')}}{{$item->id}}</p>                               
                                <strong class="tx-12 tx-color-01 mg-b-0">{{__('Customer ID#')}}{{$item->BillingAccount?->ident}}</strong>                               
                                <p class="tx-medium mg-b-0">{{$item->BillingAccount?->Address}}</p>
                               <div class="row">
                                @if ($item->BillingAccount?->Tarif?->InetService)
                                <div class="col-2">
                                    <i style="width: 15px;height:15px;" data-feather="wifi"></i>
                                </div>
                                @endif
                                @if ($item->BillingAccount?->Tarif?->CatvService||$item->BillingAccount?->Tarif?->IptvService)
                                <div class="col-2">
                                    <i style="width: 15px;height:15px;" data-feather="tv"></i>
                                </div>
                                @endif                                
                                <div class="col-8">
                                    @if ($item->alter_phone)
                                    <a href="tel:{{$item->alter_phone}}"  class="nav-link d-flex"> <i style="width: 15px;height:15px;" data-feather="phone"></i><small> {{$item->alter_phone}}</small></a>
                                    @else
                                    <a href="tel:{{$item->BillingAccount->phone}}" class="nav-link d-flex"><i style="width: 15px;height:15px;" data-feather="phone"></i><small> {{$item->BillingAccount->phone}}</small></a>    
                                    @endif                                   
                                </div>                                
                               </div>
                              </div>
                              <div class="mg-l-auto d-flex align-self-center">
                                
                              </div>
                              <div class="marker marker-ribbon marker-top-right @if($item->IsToday) marker-success  @elseif($item->expired) marker-danger @else marker-primary @endif pos-absolute t-10 r-0">{{$item->IsToday?__('Today'):$item->PlanedDay}}</div>
                            </li>
                            <li class="list-group-item d-flex pd-sm-x-20 ">
                                <div class="d-flex w-50">
                                    <div class="px-2" style="cursor: pointer" wire:click="$dispatchTo('modals.short-history','show_modal',{ obj: '{{class_basename($item)}}',id: {{ $item->id}} })">
                                     <small> <i class="fa fa-history"></i> ({{$item->AcctionsHistory->count()}})</small>  
                                    </div>
                                    <div class="px-2" wire:click="$dispatchTo('modals.show-coments','show_modal',{ tid:{{$item->id}}})" style="cursor: pointer">
                                       <small> <i class="fa fa-comment"></i> ({{$item->TicketComment->count()}})</small>
                                    </div>
                                </div>
                                <div class="w-50 text-end">
                                    <a href="#" wire:click.prevent="close_connection({{$item->id}})" wire:confirm="{{__('Customer connected ?')}}" class="btn btn-xs bg-success nav-link text-white px-2">{{__('Done')}}</a>
                                </div>
                            </li>
                            @endforeach
                            @if($for_support->count()>0)
                            <li class="card-header d-flex align-items-center justify-content-between pd-r-12 bg-gray-400">
                              <h6 class="mg-b-0">{{__('Service Tickets')}}</h6>  
                            </li>
                            @endif
                            @foreach ($for_support as $item)
                            <li class="pd-r-60 list-group-item d-flex pd-sm-x-20 ">
                                <div class="marker-icon marker-danger pos-absolute t-0 l-0" style="cursor: pointer" wire:click="$dispatchTo('modals.show-ticket-descr','show_modal',{ tid:{{$item->id}}})">
                                    <i data-feather="tool"></i>
                                  </div>                              
                              <div class="pd-l-15 mt-2">
                                <p class="tx-12 tx-color-03 mg-b-0">{{__('Ticket ID#')}}{{$item->id}}</p>                               
                                <strong class="tx-12 tx-color-01 mg-b-0">{{__('Customer ID#')}}{{$item->BillingAccount?->ident}}</strong>                               
                                <p class="tx-medium mg-b-0">{{$item->BillingAccount?->Address}}</p>
                               <div class="row">                                                      
                                <div class="col-8">
                                    @if ($item->alter_phone)
                                    <a href="tel:{{$item->alter_phone}}"  class="nav-link d-flex"> <i style="width: 15px;height:15px;" data-feather="phone"></i> <small>{{$item->alter_phone}}</small></a>
                                    @else
                                    <a href="tel:{{$item->BillingAccount->phone}}" class="nav-link d-flex"><i style="width: 15px;height:15px;" data-feather="phone"></i><small> {{$item->BillingAccount->phone}}</small></a>    
                                    @endif                                   
                                </div>          
                                                              
                               </div>
                              </div>
                             
                              <div class="marker marker-ribbon marker-top-right @if($item->IsToday) marker-success  @elseif($item->expired) marker-danger @else marker-primary @endif pos-absolute t-10 r-0">{{$item->IsToday?__('Today'):$item->PlanedDay}}</div>
                            </li>
                            @if ($item->SupportType)
                            <li  class="list-group-item d-flex pd-sm-x-20 bg-{{$item->SupportType?->bg_color}} tx-{{$item->SupportType?->tx_color}}">
                                  {{$item->SupportType?->name}}
                            </li>
                            @endif
                            <li class="list-group-item d-flex pd-sm-x-20 ">
                                <div class="d-flex w-50">
                                    <div class="px-2" style="cursor: pointer" wire:click="$dispatchTo('modals.short-history','show_modal',{ obj: '{{class_basename($item)}}',id: {{ $item->id}} })">
                                     <small> <i class="fa fa-history"></i> ({{$item->AcctionsHistory->count()}})</small>  
                                    </div>
                                    <div class="px-2"  wire:click="$dispatchTo('modals.show-coments','show_modal',{ tid:{{$item->id}}})" style="cursor: pointer">
                                       <small> <i class="fa fa-comment"></i> ({{$item->TicketComment->count()}})</small>
                                    </div>
                                </div>
                                <div class="w-50 text-end">
                                    <a href="#" wire:click.prevent="$dispatchTo('modals.close-ticket','show_modal',{tid:{{$item->id}}})"  class="btn btn-xs bg-success nav-link text-white px-2">{{__('Done')}}</a>
                                </div>
                            </li>
                            @endforeach
                            @if($for_uninstall->count()>0)
                            <li class="card-header d-flex align-items-center justify-content-between pd-r-12 bg-gray-400">
                                <h6 class="mg-b-0">{{__('Uninstalls')}}</h6>
                              </li>
                            @endif
                            @foreach ($for_uninstall as $item)
                            <li class="pd-r-60 list-group-item d-flex pd-sm-x-20 ">
                                <div class="marker-icon marker-dark pos-absolute t-0 l-0" style="cursor: pointer" wire:click="$dispatchTo('modals.show-ticket-descr','show_modal',{ tid:{{$item->id}}})">
                                    <i data-feather="activity"></i>
                                  </div>                              
                              <div class="pd-l-15 mt-2">
                                <p class="tx-12 tx-color-03 mg-b-0">{{__('Ticket ID#')}}{{$item->id}}</p>                               
                                <strong class="tx-12 tx-color-01 mg-b-0">{{__('Customer ID#')}}{{$item->BillingAccount?->ident}}</strong>                               
                                <p class="tx-medium mg-b-0">{{$item->BillingAccount?->Address}}</p>
                               <div class="row">
                                                     
                                <div class="col-8">
                                    @if ($item->alter_phone)
                                    <a href="tel:{{$item->alter_phone}}"  class="nav-link d-flex"> <i style="width: 15px;height:15px;" data-feather="phone"></i> <small>{{$item->alter_phone}}</small></a>
                                    @else
                                    <a href="tel:{{$item->BillingAccount->phone}}" class="nav-link d-flex"><i style="width: 15px;height:15px;" data-feather="phone"></i><small> {{$item->BillingAccount->phone}}</small></a>    
                                    @endif                                   
                                </div>                                
                               </div>
                              </div>
                              <div class="mg-l-auto d-flex align-self-center">
                                
                              </div>
                              <div class="marker marker-ribbon marker-top-right @if($item->IsToday) marker-success  @elseif($item->expired) marker-danger @else marker-primary @endif pos-absolute t-10 r-0">{{$item->IsToday?__('Today'):$item->PlanedDay}}</div>
                            </li>
                            <li class="list-group-item d-flex pd-sm-x-20 ">
                                <div class="d-flex w-50">
                                    <div class="px-2" style="cursor: pointer" wire:click="$dispatchTo('modals.short-history','show_modal',{ obj: '{{class_basename($item)}}',id: {{ $item->id}} })">
                                     <small> <i class="fa fa-history"></i> ({{$item->AcctionsHistory->count()}})</small>  
                                    </div>
                                    <div class="px-2"  wire:click="$dispatchTo('modals.show-coments','show_modal',{ tid:{{$item->id}}})" style="cursor: pointer">
                                       <small> <i class="fa fa-comment"></i> ({{$item->TicketComment->count()}})</small>
                                    </div>
                                </div>
                                <div class="w-50 text-end">
                                    <a href="#" wire:click.prevent="close_connection({{$item->id}})" wire:confirm="{{__('Customer connected ?')}}" class="btn btn-xs bg-success nav-link text-white px-2">{{__('Done')}}</a>
                                </div>
                            </li>
                            @endforeach
                          </ul>
                          
                        </div><!-- card -->
                      </div>
                </div>
            </div>
        </div>
    
        <livewire:modals.short-history> 
        <livewire:modals.show-ticket-descr> 
        <livewire:modals.show-coments> 
        <livewire:modals.close-ticket  @saved="$refresh"> 
       
</div>