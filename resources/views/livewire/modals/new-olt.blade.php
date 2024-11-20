<div class="modal fade @if($show) show @endif "  role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3">{{__('New Olt')}} </h4>  
            <a href="" class="close pos-absolute t-15 r-15" wire:click.prevent="show_modal" >
                <span aria-hidden="true">&times;</span>
              </a>
        </div>
        <div class="modal-body pd-20 pd-sm-30">          
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
            <select class="form-control mb-3" wire:model.live="selected_template">
                <option value=0>{{__('Olt Template')}}</option>
                @foreach ($templates as $item)
                    <option value={{$item->id}}> {{$item->name}}</option>
                @endforeach
            </select>        
            @if ($selected_template)
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Name')}}</span>
                </div>
                <input type="text" class="form-control" id="name" placeholder="{{__('Name')}}" aria-label="name" name="name" wire:model.defer="name">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Host or IP')}}</span>
                </div>
                <input type="text" class="form-control" id="ip" placeholder="{{__('Host or IP')}}" aria-label="ip" name="ip" wire:model.live="ip">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Port')}}</span>
                </div>
                <input type="text" class="form-control" placeholder="{{__('Port')}}" id="port" aria-label="port" name="port" wire:model.live="port">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Read Community')}}</span>
                </div>
                <input type="text" class="form-control" placeholder="{{__('Read Community')}}" id="ro_community" aria-label="ro_community" name="ro_community" wire:model.live="ro_community">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Write Community')}}</span>
                </div>
                <input type="text" class="form-control" placeholder="{{__('Write Community')}}" aria-label="rw_community" id="rw_community" name="rw_community" wire:model.live="rw_community">
            </div>
            @if ($valid)
                <div class="card-footer text-end">
                    <button class="btn btn-xs btn-success" wire:click="add_olt">{{__('Add')}}</button>
                </div>
            @endif
            @endif
        </div>
      </div>
    </div>
</div>
