<div>
    <x-layouts.sidebar activePage="companies" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('Company') }} {{$company->name}}</h4>
                <nav class="nav">
                    <a href="#" class="btn btn-sm btn-danger tx-bold" wire:click="delete"> {{__('Delete')}}</a>
                </nav>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-xs-12 col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">Logo</div>
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" >{{__('Company Name')}}</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="{{__('Company Name')}}" aria-label="name" name="name" wire:model.defer="name">
                                        </div>
                                        <ul class="list-unstyled mg-b-0">
                                            <li class="list-label"> Inet Services</li>
                                            @forelse ($company->InetServices as $item)
                                            <li class="list-item"><span>{{$item->Tarif?->name}}</span> {{$item->price}}</li>
                                            @empty
                                              <li class="list-item"> {{__('No Internet services')}}</li> 
                                            @endforelse                                        
                                            <li class="list-label"> CaTV Services</li>
                                            @forelse ($company->CatvServices as $item)
                                            <li class="list-item"><span>{{$item->Tarif?->name}}</span> {{$item->price}}</li>
                                            @empty
                                            <li class="list-item">  {{__('No CATV services')}} </li>
                                            @endforelse
                                            <li class="list-label"> IpTV Services</li>
                                            @forelse ($company->IptvServices as $item)
                                            <li class="list-item"><span>{{$item->Tarif?->name}}</span> {{$item->price}}</li>
                                            @empty
                                            <li class="list-item">   {{__('No Iptv services')}} </li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-4">
                        <div class="card">
                            <div class="card-body">
                                <h6>{{__('MikroBill Api')}}</h6>
                                @if ($api)
                                @foreach ($errors->all() as $error)
                                  <div class="input-group mb-3 text-danger">{{ $error }}</div>
                                @endforeach
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" >{{__('Api Host')}}</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="{{__('Api Host')}}" aria-label="api_host" name="api_host" id="api_host" wire:model.live="api_host">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" >{{__('Login')}}</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="{{__('Login')}}" aria-label="api_login" name="api_login" id="api_login" wire:model.defer="api_login">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" >{{__('Passowrd')}}</span>
                                    </div>
                                    <input type="password" class="form-control"  aria-label="api_pass" name="api_pass"  id="api_pass" wire:model.defer="api_pass">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" >{{__('Key')}} 1</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="{{__('Key')}} 1" aria-label="api_key1" name="api_key1" id="api_key1" wire:model.defer="api_key1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" >{{__('Key')}} 2</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="{{__('Key')}} 2" aria-label="api_key2" name="api_key2" id="api_key2" wire:model.defer="api_key2">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" >{{__('Api port')}}</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="{{__('Api port')}}" aria-label="api_port" name="api_port" id="api_port" wire:model.defer="api_port">
                                </div>
                                <div class="row ">
                                    <button class="btn btn-sm btn-success w-50" wire:click="save_api">{{__('Save')}}</button>
                                    @if ($api_del)
                                    <button class="btn btn-sm btn-danger w-50" wire:click="del_api">{{__('Delete')}}</button>    
                                    @endif                                    
                                </div>
                                @else
                                <button class="btn btn-sm btn-success" wire:click="new_api">{{__('New')}}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
