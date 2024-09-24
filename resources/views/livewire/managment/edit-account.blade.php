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
                                <div class="wd-35 ht-35 bd bd-2 @if($account->status<0) bg-success @else bg-danger  @endif tx-white rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex" >
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
                               
                                  @if($account->status<0)
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
                                <div class="wd-35 ht-35 bd bd-2 bd-primary tx-primary rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex" wire:click="change_tarif">
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
                            <li class="list-item">
                              <div class="media align-items-center">
                                <div class="wd-35 ht-35 bd bd-2 bd-primary tx-primary rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex" wire:click="change_billing">
                                  <i data-feather="link-2" style="cursor: pointer"></i>
                                </div>
                                <div class="media-body mg-sm-l-15">
                                  <p class="tx-medium mg-b-0">{{__('Bill API')}}</p>
                                 
                                </div><!-- media-body -->
                              </div><!-- media -->
                              <div class="text-end tx-rubik">
                                {{$account->api?->name}}
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
                    <div class="col-4">
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
                                          <div class="wd-35 ht-35 bd bd-2 bd-primary tx-primary rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex" wire:click="change_tarif">
                                            <i data-feather="briefcase" style="cursor: pointer"></i>
                                          </div>
                                          <div class="media-body mg-sm-l-15">
                                            <p class="tx-medium mg-b-0">{{__('Control')}}</p>
                                           
                                          </div><!-- media-body -->
                                        </div><!-- media -->
                                        <div class="text-end tx-rubik">
                                          {{$account->Tarif?->name}}
                                        </div>
                                    </li>                            
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>