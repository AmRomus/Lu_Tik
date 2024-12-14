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
                    <div class="df-example p-1" data-label="{{__('Account information')}}">
                      <ul class="list-unstyled mg-b-0">
                        <li class="list-label">{{__('Personal Infromation')}}</li>
                        <li class="list-item">
                          <div class="avatar"><span class="avatar-initial rounded-circle bg-gray-600">{{$account->Initials}}</span></div>
                          <div class="media-body mg-sm-l-15">
                            <p class="tx-medium mg-b-0">{{__('Full Name')}}</p>                                 
                          </div><!-- media-body -->
                          <div class="pd-l-10">
                            <p class="tx-medium mg-b-0">{{$account->FullName}}</p>
                            <small class="tx-12 tx-color-03 mg-b-0">Customer ID#{{$account->ident}}</small>
                          </div>
                        </li>
                        <li class="list-item">
                          <div class="avatar"><span class="avatar-initial rounded-circle bg-gray-600"><i class="fa fa-home"></i></span></div>
                          <div class="media-body mg-sm-l-15">
                            <p class="tx-medium mg-b-0">{{__('Address')}}</p>                                 
                          </div><!-- media-body -->
                          <div class="pd-l-10 text-end">
                            <p class="tx-medium mg-b-0">{{$account->Address}}</p>
                            <small class="tx-12 tx-color-03 mg-b-0">{{$account->phone}}</small>
                          </div>
                        </li>
                        <li class="list-item">
                          <div class="avatar"><span class="avatar-initial rounded-circle bg-gray-600"><i class="fa fa-money"></i></span></div>
                          <div class="media-body mg-sm-l-15">
                            <p class="tx-medium mg-b-0">{{__('Balances')}}</p>                                 
                          </div><!-- media-body -->
                          <div class="pd-l-10 text-end">
                          @foreach ($account->wallets as $item)
                            <p class="my-0"><small class="tx-12 tx-color-03 mg-b-0">{{$item->name}}:&nbsp;<strong class="text-black">{{$item->balance}}</strong><a href="#" wire:click.prevent="$dispatchTo('modals.cash-pay','show_modal',{ wallet_name:'{{$item->slug}}'})"><i class="fa fa-plus"></i></a></small></p>
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
                          Mikro-Bill({{$account->AccountInetService?->MikroBillApi?->name}}) Login: {{$account->AccountInetService?->api_ident}}
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
                <div class="avatar"><span class="avatar-initial rounded-circle bg-success"><i class="fa fa-paperclip"></i></span></div>
                <div class="pd-l-10 text-end">
                  <p class="tx-medium mg-b-0">{{$account->Subscription->Tarif?->name}}</p>
                  <small class="tx-12 tx-color-03 mg-b-0">{{__('End date:')}} {{$account->Subscription->acct_end}}</small>
                </div>
              </li>
              @endif
                      </ul>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-lg-4">
                    <div class="df-example mb-3" data-label="Active Services">
                        <livewire:widgets.active-services :$account />
                    </div>
                    <div class="df-example p-1" data-label="Account Devices">
                      <div class="row d-flex">
                        <div class="col-12 text-end my-2">
                          <button class="btn btn-xs btn-success" wire:click="$dispatchTo('modals.add-inet-device-to-account','show_modal')">{{__('Add Router')}}</button>
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
                               <a href="#" class="dropdown-item tx-10">{{__('Ping')}}</a>
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
                      <li class="list-label">{{__('Iptv Device')}}</li>
                      <li class="list-item">
                        <livewire:widgets.iptv-dev :dev='$dev->id' :key="$loop->index">
                      </li>                      
                      @endforeach 
                    </ul>
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
          <livewire:modals.ping-modal>
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
