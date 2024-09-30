<div>
    <x-layouts.sidebar activePage="Mikrotiks" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('Edit Mikrotik')." ".$mikrotik->name }}</h4>
            </div>
            <div class="content-body">
                <div class="row">
                   <div class="col-4">
                    <div class="card card-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" >Անվանում</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Անվանում" aria-label="name" name="name" wire:model.defer="name">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" >Հասցե կամ IP</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Հասցե կամ IP" aria-label="host" name="host" wire:model.live="hostname">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" >Մութքանուն</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Մութքանուն" aria-label="login" name="login" wire:model.defer="login">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" >Գաղթնաբառ</span>
                            </div>
                            <input type="password" class="form-control" placeholder="Գաղթնաբառ" aria-label="password" name="password" wire:model.defer="password">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" >Պորտ</span>
                            </div>
                            <input type="text" class="form-control" placeholder="8728" aria-label="port" name="port" wire:model.defer="port" value=8728>
                        </div>                        
                        <div class="form-check form-switch">
                            <input class="form-check-input ms-0 me-2" type="checkbox" wire:model.defer="ssl" @if ($ssl==1) checked @endif>
                            <label class="form-check-label">SSL</label>
                        </div>
                      <div class="d-flex justify-content-end mg-t-30 mg-b-0">
                        <button type="button" class="btn btn-xs btn-white" data-dismiss="modal" wire:click="show_modal">Չեղարկել</button>
                        <button type="button" class="btn  btn-xs btn-primary mg-l-5" wire:click="save">Պահպանել</button>
                      </div>
                    </div>
                   </div>
                   <div class="col-4">
                    <ul class="list-unstyled mg-b-0">
                      <li class="list-label">{{__('Controlled interfaces')}}</li>   
                    @forelse ($mikrotik->ControlInterface as $item)
                    <li class="list-item">
                      <div class="media align-items-center w-100">                        
                        <div class="media-body mg-sm-l-15">
                          <h6>{{$item->interface}}</h6>
                          @forelse ($item->Ip as $ip)
                              <span class="tx-10 tx-bold tx-rubik tx-gray-500">{{$ip['address']}}</span><br>
                          @empty
                          <p>{{__('No Ip address')}}</p>
                          @endforelse  
                            
                        </div>
                        <div class="text-end ">                                            
                          <span wire:click="rem_iface({{$item->id}})"><i data-feather="trash-2"></i></span>
                      </div>                
                      </div>
                    </li>
                    @empty
                    <li class="list-label">{{__('No Interface controlled')}}</li>
                    @endforelse
                    <li class="list-label">{{__('Device Interfaces')}}</li>
                    @forelse ($uncontroled as $key=>$item)
                    <li class="list-item">
                      <div class="media align-items-center">
                        <div class=" tx-primary align-items-center justify-content-centerd-none d-sm-flex" >
                          <div class="form-check form-switch">
                            <input class="form-check-input ms-0 me-2" type="checkbox" wire:click="add_iface({{$key}})">                           
                          </div>

                        </div>
                        <label class="form-check-label">{{$item['name']}}</label>
                      </div>
                    </li>
                    @empty
                    <li class="list-label">{{__('No Interface found')}}</li>
                    @endforelse
                    </ul>
                   </div>
                </div>
            </div>
        </div>
</div>
