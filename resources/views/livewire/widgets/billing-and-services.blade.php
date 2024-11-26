<div class="row">
    <div class="col-4">
        <ul class="list-unstyled mg-b-0">
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
        </ul>
    </div>
    <div class="col">
        <ul class="list-unstyled mg-b-0">
            @if ($account->Subscription)
              <li class="list-label">{{__('Subscription')}}</li>
              <li class="list-item">
                <div class="media align-items-center">
                  <div class="wd-35 ht-35 bd bd-2 bd-primary tx-primary rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex" >
                    <i data-feather="briefcase" style="cursor: pointer"></i>
                  </div>
                  <div class="media-body mg-sm-l-15">
                    <p class="tx-medium mg-b-0">{{$account->Subscription->Tarif?->name}}</p> 
                    <p class="tx-small tx-mutted mg-b-0">{{__('End date:')}} {{$account->Subscription->acct_end}}</p>                                
                  </div><!-- media-body -->
                </div><!-- media -->
                <div class="text-end tx-rubik">
                  <i class="fa fa-trash tx-24" wire:click="$dispatchTo('modals.subscription-cencel','stop_subscription')" ></i>
                </div>
              </li>
            @endif                                   
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
             
              <li class="list-label">{{__('Tv Service')}}</li>
              @if ($account->Tarif?->CatvService)
              <li class="list-item">
                  <div class="media align-items-center">
                    <div class="wd-35 ht-35 bd bd-2 bd-primary tx-primary rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex" 
                    wire:click="$dispatchTo('modals.set-catv-service-api','show_modal',{ service_id:{{$account->AccountCatvService?->id}}})">
                      <i data-feather="briefcase" style="cursor: pointer"></i>
                    </div>
                    <div class="media-body mg-sm-l-15">
                      <p class="tx-medium mg-b-0">{{__('Control')}}</p>                                           
                    </div><!-- media-body -->
                  </div><!-- media -->
                  <div class="text-end tx-rubik">                                            
                      @if ($account->AccountCatvService?->MikroBillApi)                                          
                          Mikro-Bill({{$account->AccountCatvService?->MikroBillApi?->name}}) - login {{$account->AccountCatvService?->MikroBillApi?->ident}}
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
             
              
          </ul>
    </div>
</div>
