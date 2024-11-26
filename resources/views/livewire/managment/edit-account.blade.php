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
                  <div class="col-12">
                    <ul class="nav nav-line" id="myTab5" role="tablist">
                      <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab5" data-bs-toggle="tab" href="#home5" role="tab" aria-controls="home" area-selected="true" >{{__('Technical information')}}</a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab5" data-bs-toggle="tab" href="#profile5" role="tab" aria-controls="profile" >{{__('Billing and Services')}}</a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link " id="contact-tab5" data-bs-toggle="tab" href="#contact5" role="tab" aria-controls="contact" >{{__('Profile')}}</a>
                      </li>
                    </ul>
                    <div class="tab-content mg-t-20" id="myTabContent5">
                      <div class="tab-pane fade active show" id="home5" role="tabpanel" aria-labelledby="home-tab5">
                        <div class="row">
                          <div class="col-4">
                            <div class="card ">                              
                              <div class="card-body"> 
                                <div class="d-flex w-100">
                                  <h6>{{__('Routers')}}</h6>  
                                  <div class="w-100 text-end">
                                    <span style="cursor: pointer"  wire:click="$dispatchTo('modals.add-inet-device-to-account','show_modal')">
                                      <i class="fa fa-plus"></i>{{__('Add')}}
                                    </span>
                                  </div>
                                </div>
                                <div class="row">
                                @foreach ($account->InetDevices as $dev) 
                                <div class="d-flex mb-3 bd bd-2 bd-primary px-3 col">
                                  <div class="media align-items-center">
                                    <div class=" bd bd-2 bd-primary tx-primary  align-items-center justify-content-center op-6 d-none d-sm-flex"
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
                                </div>
                              @endforeach 
                                </div>                     
                              </div>
                            </div>
                          </div>                        
                          <div class="col-4">
                            <div class="card ">                              
                              <div class="card-body"> 
                                <div class="d-flex w-100">
                                <h6>{{__('Onus')}}</h6>  
                                  <div class="w-100 text-end">
                                    <span style="cursor: pointer"  wire:click="$dispatchTo('modals.add-onu-to-account','show_modal')">
                                      <i class="fa fa-plus"></i>{{__('Add')}}
                                    </span>
                                  </div>
                                </div>
                                <div class="row">
                                @foreach ($account->onu as $dev) 
                                <div class="d-flex mb-3 bd bd-2 bd-primary px-3 col">
                                  <div class="media align-items-center">
                                    <div class=" bd bd-2 bd-primary tx-primary  align-items-center justify-content-center op-6 d-none d-sm-flex">
                                      <i data-feather="hard-drive" style="cursor: pointer"></i>
                                    </div>
                                    <div class="media-body mg-sm-l-15">
                                      <p class="tx-12 mg-b-0"><strong>MAC:</strong> {{$dev->mac}}</p> 
                                     
                                      <p class="tx-12 mg-b-0"><strong>{{__('Access Server')}}:</strong> {{$dev->OltIfaces?->olt?->name}} </p>
                                      <p class="tx-12 mg-b-0"><strong>{{__('Interface')}}:</strong> {{$dev->OltIfaces?->iface}}  </p>
                                      <p class="tx-12 mg-b-0"><strong>{{__('Signal')}}:</strong> {{$dev->signal}}  </p>     
                                     @if (!$dev->online)
                                     <p class="tx-12 mg-b-0"><strong>{{__('Action')}}:</strong> {{$dev->msg}}  </p>     
                                     @endif
                                    </div><!-- media-body -->                                         
                                  </div><!-- media -->
                                  <div class="text-end tx-rubik">                                            
                                      <span style="cursor: pointer" wire:confirm="{{__('Are you whant unlink this device ?')}}" wire:click="unlik_catv_dev({{$dev->id}})"><i data-feather="trash" style="height: 16px; color:red"></i></span>
                                  </div>
                                </div>
                              @endforeach 
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="profile5" role="tabpanel" aria-labelledby="profile-tab5">
                        <livewire:widgets.billing-and-services :account_id="$account->id" />
                      </div>
                      <div class="tab-pane fade " id="contact5" role="tabpanel" aria-labelledby="contact-tab5">
                       <div class="row">
                        <div class="col-6">
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
                          </ul>
                        </div>
                        <div class="col-6">
                          <ul class="list-unstyled mg-b-0" >
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

                            <li class="list-label">{{__('Advanced')}}</li>
                            <li class="list-item">
                              <textarea class="form-control" name="coment" rows="2" wire:model.live.debounce.2s="acc.coment">{{$account->coment}}</textarea>
                            </li>
                          </ul>
                        </div>
                       </div>




                      </div>
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
