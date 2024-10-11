<div>
@if ($cur_tarif)    

<div class="card card-body">
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
        <div class="col-12  justify-content-end">
            @if ($cur_tarif?->InetService)
            <h6>Internet Service</h6>
                <div class="row ">
                    <div class="col-auto table-responsive">
                        <table class="table table-dashboard">
                            <thead>
                                <tr>
                                   
                                    <th>{{__('Speed UP (Mbit/s)')}}</th>
                                    <th>{{__('Speed DOWN (Mbit/s)')}}</th>
                                    <th>{{__('Price')}}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="middle">                                
                                    <td>{{$cur_tarif?->InetService->speed_up}}</td>
                                    <td>{{$cur_tarif?->InetService->speed_down}}</td>
                                    <td>{{$cur_tarif?->InetService->price}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
            <button class="btn btn-sm btn-primary" wire:click.prevent="$dispatchTo('modals.new-inet-services','show_modal',{ tarif: {{$cur_tarif->id}} })">{{__('New Internet Service')}}</button>    
            @endif
            
        </div>
    </div>

    <livewire:modals.new-inet-services>
</div>
@endif
</div>