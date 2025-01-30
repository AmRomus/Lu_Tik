<div>
    <x-layouts.sidebar activePage="Tarifs" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{$tarif->name}}</h4>
                <nav class="nav">
                    <a href="#" class="btn btn-sm btn-danger tx-bold" wire:click="delete"> {{__('Delete')}}</a>
                  </nav>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" >{{__('Tarif name')}}</span>
                            </div>
                            <input type="text" class="form-control" placeholder="{{__('Tarif name')}}" aria-label="name" name="name" wire:model.defer="name">
                        </div>
                        <div class="input-group mb-3">                           
                              <span class="input-group-text" >{{__('Description')}}</span>                           
                            <textarea type="text" class="form-control" placeholder="{{__('Description')}}" aria-label="description" name="description" wire:model.defer="description">{{$description}} </textarea>
                        </div>
                    </div>
                    <div class="col-8 df-example" data-label="{{__('Services')}}">
                        <div class="col-12  justify-content-end mb-2">
                            @if ($tarif?->InetService)
                            <h6>Internet Service</h6>
                                <div class="row ">
                                    <div class="col-auto table-responsive">
                                        <table class="table table-dashboard">
                                            <thead>
                                                <tr>
                                                   
                                                    <th>{{__('Speed UP')}}</th>
                                                    <th>{{__('Speed DOWN ')}}</th>
                                                    <th>{{__('Burst %')}}</th>
                                                    <th>{{__('Burst Time (s)')}}</th>
                                                    <th>{{__('Price')}}</th>
                                                    <th>{{__('Company')}}</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr align="middle">                                
                                                    <td>{{$tarif?->InetService->speed_up}} {{$tarif?->InetService->speed_up_unit}}bit/s</td>
                                                    <td>{{$tarif?->InetService->speed_down}} {{$tarif?->InetService->speed_down_unit}}bit/s</td>
                                                    <td>{{$tarif?->InetService->burst_percent}}</td>
                                                    <td>{{$tarif?->InetService->burst_time}}</td>
                                                    <td>{{$tarif?->InetService->price}}</td>
                                                    <td>{{$tarif?->InetService->ServiceCompanies?->Name}}</td>
                                                    <td><i class="fa fa-edit" style="cursor: pointer" wire:click.prevent="$dispatchTo('modals.new-inet-services','show_modal',{ tarif: {{$tarif->id}} })"></i></td>
                                                    <td><i class="fa fa-trash tx-danger" style="cursor: pointer" wire:confirm="{{__('Delete service from tarif?')}}" wire:click="del_inet_service({{$tarif?->InetService->id}})"></i></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                            <button class="btn btn-sm btn-primary" wire:click.prevent="$dispatchTo('modals.new-inet-services','show_modal',{ tarif: {{$tarif->id}} })">{{__('New Internet Service')}}</button>    
                            @endif
                            
                        </div>
                        <div class="col-12  justify-content-end mb-2">
                            @if ($tarif?->CatvService)
                            <h6>CATV Service</h6>
                                <div class="row ">
                                    <div class="col-auto table-responsive">
                                        <table class="table table-dashboard">
                                            <thead>
                                                <tr>                                   
                                                    <th>{{__('State')}}</th>
                                                    <th>{{__('Price')}}</th>
                                                    <th>{{__('Company')}}</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr align="middle">                                                                    
                                                    <td>{{__('CATV Enabled')}}</td>
                                                    <td>{{$tarif?->CatvService->price}}</td>
                                                    <td>{{$tarif?->CatvService->ServiceCompanies?->Name}}</td>
                                                    <td><i class="fa fa-edit" style="cursor: pointer" wire:click.prevent="$dispatchTo('modals.new-catv-services','show_modal',{ tarif: {{$tarif->id}} })"></i></td>
                                                    <td><i class="fa fa-trash tx-danger" style="cursor: pointer" wire:confirm="{{__('Delete service from tarif?')}}" wire:click="del_catv_service({{$tarif?->CatvService->id}})"></i></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                            <button class="btn btn-sm btn-primary" wire:click.prevent="$dispatchTo('modals.new-catv-services','show_modal',{ tarif: {{$tarif->id}} })">{{__('New CATV Service')}}</button>    
                            @endif
                            
                        </div>
                        <div class="col-12  justify-content-end">
                            @if ($tarif?->IptvService)
                            <h6>IPTV Service</h6>
                                <div class="row ">
                                    <div class="col-auto table-responsive">
                                        <table class="table table-dashboard">
                                            <thead>
                                                <tr>                                   
                                                    <th>{{__('Play List')}}</th>
                                                    <th>{{__('Price')}}</th>
                                                    <th>{{__('Company')}}</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr align="middle">                                                                    
                                                    <td>{{$tarif?->IptvService?->PlayList?->name}}</td>
                                                    <td>{{$tarif?->IptvService->price}}</td>
                                                    <td>{{$tarif?->IptvService->ServiceCompanies?->Name}}</td>
                                                    <td><i class="fa fa-edit" style="cursor: pointer" wire:click.prevent="$dispatchTo('modals.new-iptv-service','show_modal',{ tarif: {{$tarif->id}} })"></i></td>
                                                    <td><i class="fa fa-trash tx-danger" style="cursor: pointer" wire:confirm="{{__('Delete service from tarif?')}}" wire:click="del_iptv_service({{$tarif?->IptvService->id}})"></i></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                            <button class="btn btn-sm btn-primary" wire:click.prevent="$dispatchTo('modals.new-iptv-service','show_modal',{ tarif: {{$tarif->id}} })">{{__('New IPTV Service')}}</button>    
                            @endif
                            
                        </div>
                        <div class="col-12 mt-2 bd-t ">
                          <strong>  {{__('Total')}} {{__('price')}}: {{$tarif->getAmountProduct()}}</strong>
                        </div>
                    </div>
                </div>
            </div>

        <livewire:modals.new-inet-services ::wire:key="$tarif->id">
        <livewire:modals.new-catv-services ::wire:key="$tarif->id">
        <livewire:modals.new-iptv-service ::wire:key="$tarif->id">
</div>
