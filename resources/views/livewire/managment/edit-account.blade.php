<div>
    <x-layouts.sidebar activePage="Accounts" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('Account')}} {{$account->FullName}}</h4>
                <nav class="nav">
                    <a href="#" class="btn btn-sm btn-danger tx-bold" > {{__('Delete')}}</a>
                  </nav>
            </div>
            <div class="content-body">
                <div class="row">
                  <div class="col-12 col-sm-6 col-lg-4">
                    <div class="df-example py-3 px-0" data-label="{{__('Account information')}}">
                      <div class="marker marker-ribbon marker-top-right pos-absolute  r-0  bg-success tx-white" style="width:100px; cursor: pointer;" wire:click="$dispatchTo('modals.new-account-call','show_modal')">
                        <i class="fa fa-phone" ></i> {{__('New Call')}}
                      </div>   
                      <div class="marker marker-ribbon marker-top-right pos-absolute  r-0 t-45 bg-warning tx-white" 
                      style="width:100px; cursor: pointer;" wire:click="$dispatchTo('modals.new-account-note','show_modal')">
                        <i class="fa fa-bolt" ></i> New Note
                      </div>
                      <div class="marker marker-ribbon marker-top-right pos-absolute  r-0 t-75 bg-danger tx-white" style="width:100px; cursor: pointer;"
                      wire:click="$dispatchTo('modals.new-ticket','show_modal')" >
                        <i class="fa fa-bookmark" ></i> New Ticket
                      </div>      
                      <ul class="list-unstyled mg-b-0">
                        <li class="list-label d-flex w-100" >                         
                          {{__('Personal Infromation')}}
                        </li>
                        <li class="list-item">                                                 
                          <div class="pd-l-10">
                            <p class="tx-medium mg-b-0">{{$account->FullName}}</p>
                            <small class="tx-12 tx-color-03 mg-b-0">Customer ID#{{$account->ident}}</small>
                          </div>
                        </li>
                        <li class="list-item">
                          <div class="avatar"   style="cursor: pointer" wire:click="$dispatchTo('modals.edit-contacts','show_modal',{ account:{{$account->id}}})"><span class="avatar-initial rounded-circle bg-gray-600"><i class="fa fa-home"></i></span></div>
                          
                          <div class="pd-l-10 text-end">
                            <p class="tx-medium mg-b-0">{{$account->Address}}</p>
                            
                          </div>
                        </li>
                        <li class="list-item">
                          <div class="avatar"  style="cursor: pointer" wire:click="$dispatchTo('modals.edit-phone','show_modal',{ account:{{$account->id}}})"><span class="avatar-initial rounded-circle bg-gray-600"><i class="fa fa-phone"></i></span></div>
                          
                          <div class="pd-l-10 text-end">
                            <p class="tx-medium mg-b-0">{{$account->phone}}</p>                           
                          </div>
                        </li>
                        <li class="list-item">
                          <div class="avatar"><span class="avatar-initial rounded-circle bg-gray-600"><i class="fa fa-money"></i></span></div>
                         
                          <div class="pd-l-10 text-end">
                          @foreach ($account->wallets as $item)
                            @if (in_array($item->slug,$alowed_wallets))
                            <p class="my-0"><small class="tx-12 tx-color-03 mg-b-0">{{$item->name}}:&nbsp;<strong class="text-black">{{$item->balance}}</strong><a href="#" wire:click.prevent="$dispatchTo('modals.cash-pay','show_modal',{ wallet_name:'{{$item->slug}}'})"><i class="fa fa-plus"></i></a></small></p>
                            @endif                            
                          @endforeach
                          </div>
                        </li>
                        <li class="list-label">{{__('Billing Infromation')}}</li>
                        <li class="list-item">
                          <div class="media align-items-center">
                            <div class="avatar"><span class="avatar-initial rounded-circle bg-gray-600" wire:click="$dispatchTo('modals.change-tarif','show_modal')">
                              <i class="fa fa-briefcase" style="cursor: pointer"></i> </span>
                            </div>
                            <div class="media-body mg-sm-l-15">
                              <p class="tx-medium mg-b-0">{{__('Tarif')}}</p>                                 
                            </div><!-- media-body -->
                          </div><!-- media -->
                          <div class="text-end tx-rubik">
                            {{$account->Tarif?->name}}
                          </div>
                        </li>
                        @if (!$account->subscription)
                        @if ($account->Tarif?->InetService)
                        <li class="list-item">
                          <div class="media align-items-center">
                            <div class="avatar"><span class="avatar-initial rounded-circle @if ($account->AccountInetService->BillingState<0)
                              bg-success
                            @else
                              bg-danger
                            @endif " 
                    wire:click="$dispatchTo('modals.set-service-api','show_modal',{ service_id:{{$account->AccountInetService?->id}}})">
                      <i data-feather="briefcase" style="cursor: pointer"></i> </span>
                    </div>
                    <div class="media-body mg-sm-l-15">
                      <p class="tx-medium mg-b-0">{{__('Internet Service Api')}}</p>                                           
                    </div><!-- media-body -->
                  </div><!-- media -->
                  <div class="text-end tx-rubik">                                            
                      @if ($account->AccountInetService?->MikroBillApi)                                          
                          Mikro-Bill({{$account->AccountInetService?->MikroBillApi?->ServiceCompanies?->Name}}) Login: {{$account->AccountInetService?->api_ident}}
                      @else
                          {{__('Internal')}}
                      @endif                                         
                  </div>
              </li>
              @else 
              <li class="list-item">
                <div class="media align-items-center">
                  <div class="wd-35 ht-35 bd bd-2 bg-danger tx-white rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex" >
                      <i data-feather="alert-circle" ></i>                                            
                  </div>
                  <div class="media-body mg-sm-l-15">
                    <p class="tx-medium mg-b-0">{{__('Internet Service Api')}}</p>                                           
                  </div><!-- media-body -->
                  <!-- media-body -->
                </div><!-- media -->
                <div class="text-end tx-rubik">
                  <p class="tx-medium mg-b-0">{{__('Disabled in this tarif')}}</p>                                           
                </div>                                        
              </li>
              @endif
              @if ($account->Tarif?->CatvService)
              <li class="list-item">
                  <div class="media align-items-center">
                    <div class="avatar"><span class="avatar-initial rounded-circle @if ($account->AccountCatvService->BillingState<0)
                      bg-success
                    @else
                      bg-danger
                    @endif "  
                    wire:click="$dispatchTo('modals.set-catv-service-api','show_modal',{ service_id:{{$account->AccountCatvService?->id}}})">
                      <i data-feather="briefcase" style="cursor: pointer"></i>
                    </div>
                    <div class="media-body mg-sm-l-15">
                      <p class="tx-medium mg-b-0">{{__('TV Service Api')}}</p>                                           
                    </div><!-- media-body -->
                  </div><!-- media -->
                  <div class="text-end tx-rubik">                                            
                      @if ($account->AccountCatvService?->MikroBillApi)                                          
                          Mikro-Bill({{$account->AccountCatvService?->MikroBillApi?->name}})  Login {{$account->AccountCatvService?->api_ident}}
                      @else
                          {{__('Internal')}}
                      @endif                                         
                  </div>
              </li>
              @else
                <li class="list-item">
                  <div class="media align-items-center">
                    <div class="wd-35 ht-35 bd bd-2 bg-danger tx-white rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex" >
                        <i data-feather="alert-circle" ></i>                                            
                    </div>
                    <div class="media-body mg-sm-l-15">
                      <p class="tx-medium mg-b-0">{{__('TV Service Api')}}</p>                                           
                    </div><!-- media-body -->
                    
                  </div><!-- media -->   
                  <div class="text-end tx-rubik">
                    <p class="tx-medium mg-b-0">{{__('Disabled in this tarif')}}</p>                                           
                  </div><!-- media-body -->                                     
                </li>
              @endif
              @else
              <li class="list-item">
                <div class="avatar" style="cursor: pointer" wire:click="$dispatchTo('modals.subscription-cencel','stop_subscription')"><span class="avatar-initial rounded-circle bg-success"><i class="fa fa-paperclip" style="cursor: pointer"></i></span></div>
                <div class="pd-l-10 text-end">
                  <p class="tx-medium mg-b-0">{{$account->Subscriptions()->first()->Tarif?->name}}</p>
                  <small class="tx-12 tx-color-03 mg-b-0">{{__('End date:')}} {{$account->Subscription->acct_end}}</small>
                </div>
              </li>
              @endif
                      </ul>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-lg-4">
                    <div class="df-example mb-3" data-label="Active Services">
                      @if ($subscr)
                      <livewire:widgets.active-services :tarif="$subscr->tarif->id" />
                        @elseif($account->Tarif)
                        <livewire:widgets.active-services :tarif="$account->Tarif->id" />
                      @endif
                        
                    </div>
                    <div class="df-example p-1" data-label="Account Devices">
                      <div class="row d-flex">
                        <div class="col-12 text-end my-2">
                          @if ($subscr?->Tarif?->InetService||$account->Tarif?->InetService)
                            <button class="btn btn-xs btn-success" wire:click="$dispatchTo('modals.add-inet-device-to-account','show_modal')">{{__('Add Router')}}</button>  
                          @endif
                          <button class="btn btn-xs btn-success" wire:click="$dispatchTo('modals.add-onu-to-account','show_modal')">{{__('Add ONU')}}</button>
                        </div>                        
                      </div>
                    <ul class="list-unstyled mg-b-0">
                      @foreach ($account->InetDevices as $dev)
                      <li class="list-label" >
                        <div class="d-flex">
                          <div class="col">
                            @php $mk=$dev->ControlInterface?->Mikrotik; @endphp
                            {{__('Network Device')}} @if($mk)  on {{($mk->name)?$mk->name:$mk->ip}} @endif
                          </div>
                          <div class="col text-end">
                            <div class="dropdown dropend">
                              <a href=# class="dropdown-toggle tx-14"  id="ipdev_button_{{$dev->id}}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <i class="fa fa-gear "></i>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="ipdev_button_{{$dev->id}}">
                               <a href="#" class="dropdown-item tx-10" wire:click.prevent="$dispatchTo('modals.ping-modal','show_modal',{device_id:{{$dev->id}}})">{{__('Ping')}}</a>
                               <a href="#" class="dropdown-item tx-10 disabled">{{__('----')}}</a>
                               <a href="#" class="dropdown-item tx-10"  wire:click.prevent="$dispatchTo('modals.add-inet-device-to-account','show_modal',{device_id:{{$dev->id}}})">{{__('Edit')}}</a>
                               <a href="#" class="dropdown-item tx-10 tx-danger" wire:confirm="{{__('Are you whant unlink this device ?')}}" wire:click.prevent="unlik_dev({{$dev->id}})">{{__('Delete')}}</a>
                              </div>
                            </div>  
                          </div>
                        </div>
                      </li>
                      <li class="list-item">
                        <livewire:widgets.net-dev :dev="$dev->id" :key="$dev->mac" >                         
                      </li>
                      @endforeach
                      @foreach ($account->onu as $dev) 
                      <li class="list-label" wire:key={{$loop->index}}>
                        <div class="d-flex">
                          <div class="col">
                            {{__('Optical Device')}} on {{$dev->OltIfaces?->olt?->name}} 
                          </div>
                          <div class="col text-end">
                            <div class="dropdown dropend">
                              <a href=# class="dropdown-toggle tx-14"  id="onu_button_{{$dev->id}}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <i class="fa fa-gear "></i>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="onu_button_{{$dev->id}}">
                               <a href="#" class="dropdown-item tx-10" wire:click="reboot_onu({{$dev->id}})">{{__('reboot')}}</a>
                               <a href="#" class="dropdown-item tx-10 disabled">{{__('----')}}</a>
                               <a href="#" class="dropdown-item tx-10"  wire:click.prevent="$dispatchTo('modals.add-onu-to-account','show_modal')">{{__('Edit')}}</a>
                               <a href="#" class="dropdown-item tx-10 tx-danger" wire:confirm="{{__('Are you whant unlink this device ?')}}" wire:click="unlik_catv_dev({{$dev->id}})">{{__('Delete')}}</a>
                              </div>
                            </div> 
                          </div>
                        </div>                        
                      </li>
                      <li class="list-item">
                        <livewire:widgets.opt-dev :dev='$dev->id' :key="$dev->mac">
                      </li>                      
                      @endforeach 
                      @foreach ($account->IptvDevice as $dev) 
                      <li class="list-label">
                        <div class="d-flex">
                          <div class="col">
                            {{__('Iptv Device')}}
                          </div>
                        <div class="col text-end">
                          <div class="dropdown dropend">
                            <a href=# class="dropdown-toggle tx-14"  id="iptvdev_button_{{$dev->id}}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="fa fa-gear "></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="iptcdev_button_{{$dev->id}}">                             
                             <a href="#" class="dropdown-item tx-10 tx-danger" wire:confirm="{{__('Are you whant unlink this device ?')}}" wire:click.prevent="unlik_iptv_dev({{$dev->id}})">{{__('Delete')}}</a>
                            </div>
                          </div>  
                        </div>
                        </div>
                      </li>                      
                      <li class="list-item">
                        <livewire:widgets.iptv-dev :dev='$dev->id' :key="$loop->index">
                      </li>                      
                      @endforeach 
                    </ul>
                    </div>
                   
                  </div>
                  <div class="col-12 col-sm-6 col-lg-4 mt-2">
                    <div class="card card-body shadow-none bd-warning overflow-hidden py-3">
                      <div class="marker-icon marker-warning pos-absolute t-0 l-0">
                       <i data-feather="zap"></i> 
                      </div>
                      <h6 class="mg-b-15 mg-l-15">{{__('Account Notes')}}</h6>
                      @forelse ($account->AccountNotes as $item)
                      <div class="row border-top">
                        <div class="col-12">
                          <div class="pos-absolute r-0 bg-danger text-white px-1 rounded">
                            <i class="fa fa-close" style="cursor: pointer" wire:click="del_note({{$item->id}})" wire:confirm="{{__('Are you whant delete note ?')}}"></i>
                          </div>                       
                        </div>   
                        
                        <p class="mg-b-0 pt-1">{{$item->note}}</p>
                       
                      </div> 
                        <small class="text-end tx-color-03 mg-b-0 ">&copy; {{$item->User?->name}}</small>   
                        <small class="text-end tx-color-03 mg-b-0 "> {{$item->created_at}}</small>   
                    
                      @empty
                      <p class="mg-b-0">{{__('Notes is empty.')}}</p>
                      @endforelse                  
                    </div>
                    <div class="card card-body shadow-none bd-warning overflow-hidden py-3 mt-2">
                     

                      <div class="marker-icon marker-success pos-absolute t-0 l-0">
                       <i data-feather="phone"></i> 
                      </div>
                      <h6 class="mg-b-15 mg-l-15">{{__('Account Calls')}}</h6>
                      @forelse ($account->AccountCalls()->actual()->get() as $item)
                      @if ($item->call_type->value!=0)
                      <div class="media align-items-center border-top py-2">
                        <div class="wd-40 ht-40 bd bd-2 {{$item->solved?'bg-success':'bg-danger'}} tx-white rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex" >
                            <i data-feather="phone" ></i>                                            
                        </div>
                        <div class="media-body mg-sm-l-15">
                          <p class="tx-medium mg-b-0"><span class="badge text-bg-primary mx-2">{{$item->call_type->name}}</span> {{$item->theme}}</p>  
                          <small class="text-end tx-color-03 mg-b-0 ">&copy; {{$item->User?->name}}</small>   
                          <small class="text-end tx-color-03 mg-b-0 "> {{$item->created_at}}</small>                                         
                        </div><!-- media-body -->
                        
                      </div><!-- media --> 
                      @else
                      <div class="media align-items-center border-top py-2">
                        <div class="wd-40 ht-40 bd bd-2 bg-info tx-white rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex" >
                            <i data-feather="info" ></i>                                            
                        </div>
                        <div class="media-body mg-sm-l-15">
                          <p class="tx-medium mg-b-0"> {{$item->theme}}</p>  
                          <small class="text-end tx-color-03 mg-b-0 ">&copy; {{$item->User?->name}}</small>   
                          <small class="text-end tx-color-03 mg-b-0 "> {{$item->created_at}}</small>                                         
                        </div><!-- media-body -->
                        
                      </div><!-- media --> 
                      @endif
                      @empty
                      <p class="mg-b-0">{{__('No calls registred.')}}</p>
                      @endforelse                  
                    </div>
                    <!-- Tickets -->
                    <div class="card card-body shadow-none bd-warning overflow-hidden py-3 mt-2">
                      <div class="marker-icon marker-danger pos-absolute t-0 l-0">
                       <i data-feather="alert-triangle"></i> 
                      </div>
                      <h6 class="mg-b-15 mg-l-15">{{__('Account Tickets')}}</h6>
                      @forelse ($account->SupportTicket()->actual()->get() as $item)                      
                      <div class="media align-items-center border-top py-2">
                        <div class="wd-40 ht-40 bd bd-2 {{$item->processed?'bg-success':'bg-danger'}} tx-white rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex" >
                            <i data-feather="alert-triangle" ></i>                                            
                        </div>
                        <div class="media-body mg-sm-l-15">
                          <p class="tx-medium mg-b-0"><span class="badge text-bg-primary mx-2">{{$item->ticket_type->name}}</span> {{$item->description}}</p>  
                          <small class="text-end tx-color-03 mg-b-0 ">&copy; {{$item->User?->name}}</small>   
                          <small class="text-end tx-color-03 mg-b-0 "> {{$item->created_at}}</small>
                           @if ($item->processed)
                           
                             <p class="tx-medium mg-b-0"> {{$item->ProcessedResults->meta}} </p>
                        
                           @endif                                         
                        </div><!-- media-body -->
                        
                      </div><!-- media --> 
                     
                      @empty
                      <p class="mg-b-0">{{__('No Ticket registred.')}}</p>
                      @endforelse                  
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <livewire:modals.change-tarif @saved="$refresh" :account_id="$account->id" >
        <livewire:modals.set-service-api @saved="$refresh" >
        <livewire:modals.set-catv-service-api @saved="$refresh" >
        <livewire:modals.add-inet-device-to-account @saved="$refresh" :account_id="$account->id">
        <livewire:modals.add-onu-to-account @saved="$refresh" :account_id="$account->id">
        <livewire:modals.subscription-cencel @saved="$refresh" :account_id="$account->id">
        <livewire:modals.cash-pay @saved="$refresh" :account_id="$account->id">
        <livewire:modals.ping-modal />
        <livewire:modals.edit-personal @saved="$refresh"> 
        <livewire:modals.edit-contacts @saved="$refresh"> 
        <livewire:modals.edit-phone @saved="$refresh"> 
        <livewire:modals.new-account-note :account="$account->id" @saved="$refresh">   
        <livewire:modals.new-account-call :account="$account->id" @saved="$refresh">   
        <livewire:modals.new-ticket :account="$account->id" @saved="$refresh">   
          @push('js')
              <script type="module">
                var cleaveII = new Cleave('#new_mac', {
                                    delimiters: [':', ':', ':',':',':'],
                                        blocks: [2, 2, 2, 2, 2, 2],
                                        uppercase: true
                                    });
                var cleaveclasss = new Cleave('.style_mac', {
                                    delimiters: [':', ':', ':',':',':'],
                                        blocks: [2, 2, 2, 2, 2, 2],
                                        uppercase: true
                                    });
              
              </script>
          @endpush
</div>
