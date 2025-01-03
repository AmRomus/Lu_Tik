<div>
@if ($cur_tarif)    

<div class="card card-body">
    @foreach ($errors->all() as $error)
    <div>{{ $error }}</div>
@endforeach
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" >{{__('Tarif name')}}</span>
        </div>
        <input type="text" class="form-control" placeholder="{{__('Tarif name')}}" aria-label="name" name="name" wire:model.defer="name">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" >{{__('Description')}}</span>
        </div>
        <textarea type="text" class="form-control" placeholder="{{__('Description')}}" aria-label="description" name="description" wire:model.defer="description">{{$description}} </textarea>
    </div>
    
    <div class="row">
        <div class="col-12  justify-content-end mb-2">
            @if ($cur_tarif?->InetService)
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
                                    <td>{{$cur_tarif?->InetService->speed_up}} {{$cur_tarif?->InetService->speed_up_unit}}bit/s</td>
                                    <td>{{$cur_tarif?->InetService->speed_down}} {{$cur_tarif?->InetService->speed_down_unit}}bit/s</td>
                                    <td>{{$cur_tarif?->InetService->burst_percent}}</td>
                                    <td>{{$cur_tarif?->InetService->burst_time}}</td>
                                    <td>{{$cur_tarif?->InetService->price}}</td>
                                    <td>{{$cur_tarif?->InetService->ServiceCompanies?->Name}}</td>
                                    <td><i class="fa fa-edit" style="cursor: pointer" wire:click.prevent="$dispatchTo('modals.new-inet-services','show_modal',{ tarif: {{$cur_tarif->id}} })"></i></td>
                                    <td><i class="fa fa-trash tx-danger" style="cursor: pointer" wire:confirm="{{__('Delete service from tarif?')}}" wire:click="del_inet_service({{$cur_tarif?->InetService->id}})"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
            <button class="btn btn-sm btn-primary" wire:click.prevent="$dispatchTo('modals.new-inet-services','show_modal',{ tarif: {{$cur_tarif->id}} })">{{__('New Internet Service')}}</button>    
            @endif
            
        </div>
        <div class="col-12  justify-content-end mb-2">
            @if ($cur_tarif?->CatvService)
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
                                    <td>{{$cur_tarif?->CatvService->price}}</td>
                                    <td>{{$cur_tarif?->CatvService->ServiceCompanies?->Name}}</td>
                                    <td><i class="fa fa-edit" style="cursor: pointer" wire:click.prevent="$dispatchTo('modals.new-catv-services','show_modal',{ tarif: {{$cur_tarif->id}} })"></i></td>
                                    <td><i class="fa fa-trash tx-danger" style="cursor: pointer" wire:confirm="{{__('Delete service from tarif?')}}" wire:click="del_catv_service({{$cur_tarif?->CatvService->id}})"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
            <button class="btn btn-sm btn-primary" wire:click.prevent="$dispatchTo('modals.new-catv-services','show_modal',{ tarif: {{$cur_tarif->id}} })">{{__('New CATV Service')}}</button>    
            @endif
            
        </div>
        <div class="col-12  justify-content-end">
            @if ($cur_tarif?->IptvService)
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
                                    <td>{{$cur_tarif?->IptvService?->PlayList?->name}}</td>
                                    <td>{{$cur_tarif?->IptvService->price}}</td>
                                    <td>{{$cur_tarif?->IptvService->ServiceCompanies?->Name}}</td>
                                    <td><i class="fa fa-edit" style="cursor: pointer" wire:click.prevent="$dispatchTo('modals.new-iptv-service','show_modal',{ tarif: {{$cur_tarif->id}} })"></i></td>
                                    <td><i class="fa fa-trash tx-danger" style="cursor: pointer" wire:confirm="{{__('Delete service from tarif?')}}" wire:click="del_iptv_service({{$cur_tarif?->IptvService->id}})"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
            <button class="btn btn-sm btn-primary" wire:click.prevent="$dispatchTo('modals.new-iptv-service','show_modal',{ tarif: {{$cur_tarif->id}} })">{{__('New IPTV Service')}}</button>    
            @endif
            
        </div>
    </div>

    <div class="card-footer text-end mt-3">
        <button class="btn btn-sm btn-success" wire:click="save">{{__('Save')}}</button>
    </div>
</div>
@endif
<livewire:modals.new-inet-services ::wire:key="$cur_tarif->id">
<livewire:modals.new-catv-services ::wire:key="$cur_tarif->id">
<livewire:modals.new-iptv-service ::wire:key="$cur_tarif->id">
</div>