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
                    <div class="col-4">
                    <div class="card ht-md-100p">
                        <div class="card-header d-flex justify-content-between">
                          <h6 class="lh-5 mg-b-0 tx-bold">{{__('Personal information')}}</h6>  
                        </div><!-- card-header -->
                        <div class="card-body pd-0 tx-13">
                          <ul class="list-unstyled mg-b-0">
                            <li class="list-label">{{__('Name')}}</li>
                            <li class="list-item">
                              <div class="media  w-100">
                                <input type="text" class="form-control" placeholder="Անուն" aria-label="first_name" name="first" wire:model.live.debounce.2s="acc.first">
                              </div><!-- media -->
                            </li>
                            <li class="list-item">
                              <div class="media w-100">                                
                                <input type="text" class="form-control" placeholder="Ազգանուն" aria-label="last_name" name="last" wire:model.live.debounce.2s="acc.last">                              
                              </div>
                            </li>
                            <li class="list-item">
                              <div class="media w-100">                               
                                <input type="text" class="form-control" placeholder="Հայրանուն" aria-label="middle_name" name="middle" wire:model.live.debounce.2s="acc.middle">                            
                              </div><!-- media-body -->
                            </li>
                            <li class="list-label">{{__('Passport')}}</li>
                            <li class="list-item">
                              <div class="media w-100">
                                <input type="text" class="form-control" placeholder="Աննագիր՝ XXNNNNNN տրված NN" aria-label="passport" name="passport" wire:model.live.debounce.2s="acc.passport">
                              </div><!-- media-body -->
                            </li>
                            <li class="list-label">{{__('Contacts')}}</li>
                            <li class="list-item">
                              <div class="media align-items-center">
                                <div class="wd-35 ht-35 bd bd-2 bd-success tx-success rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex" wire:click="change_address">
                                  <i data-feather="home" style="cursor: pointer"></i>
                                </div>
                                <div class="media-body mg-sm-l-15">
                                  <p class="tx-medium mg-b-0">{{__('Address')}}</p>
                                  <p class="tx-14 tx-bold mg-b-0 tx-color-00">{{$account->Address}}</p>
                                </div><!-- media-body -->
                              </div><!-- media -->
                             
                            </li>
                            <li class="list-item">
                              <div class="media align-items-center">
                                <div class="wd-35 ht-35 bd bd-2 bd-success tx-primary rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex">
                                  <i data-feather="phone"></i>
                                </div>
                                <div class="media-body mg-sm-l-15">                              
                                  <input type="text" class="form-control" placeholder="{{__('Phone')}}" aria-label="phone" name="phone" wire:model.live.debounce.2s="acc.phone">
                                
                                </div><!-- media-body -->
                              </div><!-- media -->
                             
                            </li>
                            <li class="list-label">{{__('Billing')}}</li>
                            <li class="list-item">
                              <div class="media align-items-center">
                                <div class="wd-35 ht-35 bd bd-2 {{($account->subscription)?'bg-success':'bg-danger'}} tx-white rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex" >
                                  @if($account->status<0)
                                    <i data-feather="check" ></i>
                                    @else
                                    <i data-feather="alert-circle" ></i>
                                  @endif
                                </div>
                                <div class="media-body mg-sm-l-15">
                                  <p class="tx-medium mg-b-0">{{__('Status')}}</p>
                                 
                                </div><!-- media-body -->
                              </div><!-- media -->
                              <div class="text-end tx-rubik">
                               
                                  @if($account->subscription)
                                  <p class="mg-b-0 tx-success"> {{__('Active')}} </p>   
                                  @else
                                  <p class="mg-b-0 tx-danger tx-bold"> {{__('Blocked')}} </p>   
                                @endif
                                                           
                              </div>
                            </li>
                            <li class="list-item">
                              <div class="media align-items-center">
                                <div class="wd-35 ht-35 bd bd-2 bd-primary tx-primary rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex" wire:click="change_ident">
                                 <i data-feather="shield" style="cursor: pointer"></i>
                                </div>
                                <div class="media-body mg-sm-l-15">
                                  <p class="tx-medium mg-b-0">ID`</p>
                                 
                                </div><!-- media-body -->
                              </div><!-- media -->
                              <div class="text-end tx-rubik">
                                <p class="mg-b-0">{{$account->ident}} </p>
                                
                              </div>
                            </li>
                            <li class="list-item">
                              <div class="media align-items-center">
                                <div class="wd-35 ht-35 bd bd-2 bd-primary tx-primary rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex">
                                 <i data-feather="dollar-sign"></i>
                                </div>
                                <div class="media-body mg-sm-l-15">
                                  <p class="tx-medium mg-b-0">{{__('Balance')}}</p>
                                 
                                </div><!-- media-body -->
                              </div><!-- media -->
                              <div class="text-end tx-rubik">
                                <p class="mg-b-0">{{$account->balance}} AMD</p>
                                
                              </div>
                            </li>
                            <li class="list-item">
                              <div class="media align-items-center">
                                <div class="wd-35 ht-35 bd bd-2 bd-primary tx-primary rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex" wire:click="$dispatchTo('modals.change-tarif','show_modal')">
                                  <i data-feather="briefcase" style="cursor: pointer"></i>
                                </div>
                                <div class="media-body mg-sm-l-15">
                                  <p class="tx-medium mg-b-0">{{__('Tarif')}}</p>                                 
                                </div><!-- media-body -->
                              </div><!-- media -->
                              <div class="text-end tx-rubik">
                                {{$account->Tarif?->name}}
                              </div>
                            </li>
                            <li class="list-label">{{__('Advanced')}}</li>
                            <li class="list-item">
                              <textarea class="form-control" name="coment" rows="2" wire:model.live.debounce.2s="acc.coment">{{$account->coment}}</textarea>
                            </li>
                          </ul>
                        </div><!-- card-body -->
                      </div><!-- card -->
                    </div>

                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="lh-5 mg-b-0 tx-bold">{{__('Services')}}</h6>
                            </div>
                            <div class="card-body pd-0">
                                <ul class="list-unstyled mg-b-0">
                                    @if ($account->Tarif?->InetService)
                                    <li class="list-label">{{__('Internet')}}</li>
                                    <li class="list-item">

                                        <div class="media align-items-center">
                                          <div class="wd-35 ht-35 bd bd-2 bd-primary tx-primary rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex" 
                                          wire:click="$dispatchTo('modals.set-service-api','show_modal',{ service_id:{{$account->AccountInetService?->id}}})">
                                            <i data-feather="briefcase" style="cursor: pointer"></i>
                                          </div>
                                          <div class="media-body mg-sm-l-15">
                                            <p class="tx-medium mg-b-0">{{__('Control')}}</p>                                           
                                          </div><!-- media-body -->
                                        </div><!-- media -->
                                        <div class="text-end tx-rubik">                                            
                                            @if ($account->AccountInetService?->MikroBillApi)                                          
                                                Mikro-Bill({{$account->AccountInetService?->MikroBillApi?->name}})
                                            @else
                                                {{__('Internal')}}
                                            @endif                                         
                                        </div>
                                    </li>
                                    @endif
                                   
                                    <li class="list-label">{{__('Tv Service')}}</li>
                                    @if ($account->Tarif?->TvService)
                                    <li class="list-item">
                                        <div class="media align-items-center">
                                          <div class="wd-35 ht-35 bd bd-2 bd-primary tx-primary rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex" 
                                          wire:click="$dispatchTo('modals.set-service-api','show_modal',{ service_id:{{$account->AccountInetService?->id}}})">
                                            <i data-feather="briefcase" style="cursor: pointer"></i>
                                          </div>
                                          <div class="media-body mg-sm-l-15">
                                            <p class="tx-medium mg-b-0">{{__('Control')}}</p>                                           
                                          </div><!-- media-body -->
                                        </div><!-- media -->
                                        <div class="text-end tx-rubik">                                            
                                            @if ($account->AccountTvService?->MikroBillApi)                                          
                                                Mikro-Bill({{$account->AccountInetService?->MikroBillApi?->name}})
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
                                            <p class="tx-medium mg-b-0">{{__('Disabled in this tarif')}}</p>                                           
                                          </div><!-- media-body -->
                                        </div><!-- media -->                                        
                                      </li>
                                    @endif
                                    <li class="list-label">
                                      <div class="d-flex w-100">
                                        <div class="w-100">{{__('Internet Devices')}}</div>
                                        <div class="w-100 text-end">
                                          <span style="cursor: pointer"  wire:click="$dispatchTo('modals.add-inet-device-to-account','show_modal')">
                                            <i class="fa fa-plus"></i>{{__('Add')}}
                                          </span>
                                        </div>
                                      </div>
                                    </li>
                                    @foreach ($account->InetDevices as $dev)
                                   
                                      <li class="list-item">
                                        <div class="media align-items-center">
                                          <div class="wd-35 ht-35 bd bd-2 bd-primary tx-primary rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex"
                                          wire:click="$dispatchTo('modals.add-inet-device-to-account','show_modal',{device_id:{{$dev->id}}})"
                                          >
                                            <i data-feather="hard-drive" style="cursor: pointer"></i>
                                          </div>
                                          <div class="media-body mg-sm-l-15">
                                                 <livewire:network.inet-dev-detail :dev='$dev->id' :wire:key="$loop->index">
                                          </div><!-- media-body -->                                         
                                        </div><!-- media -->
                                        <div class="text-end tx-rubik">                                            
                                            <span style="cursor: pointer" wire:confirm="{{__('Are you whant unlink this device ?')}}" wire:click="unlik_dev({{$dev->id}})"><i data-feather="trash" style="height: 16px; color:red"></i></span>
                                        </div>
                                      </li>
                                    @endforeach                            
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <livewire:modals.change-tarif @saved="$refresh" :account_id="$account->id" >
        <livewire:modals.set-service-api @saved="$refresh" >
        <livewire:modals.add-inet-device-to-account @saved="$refresh" :account_id="$account->id">
          @push('js')
              <script type="module">
                var cleaveII = new Cleave('#new_mac', {
                                    delimiters: [':', ':', ':',':',':'],
                                        blocks: [2, 2, 2, 2, 2, 2],
                                        uppercase: true
                                    });
              </script>
          @endpush
</div>
