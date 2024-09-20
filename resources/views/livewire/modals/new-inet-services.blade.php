<div class="modal fade show "  role="dialog" aria-hidden="true" @if($show)style="display: block"@endif>
    <div class="modal-dialog modal-dialog-centered" role="document">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3">{{__('Add Internet Service')}}</h4>  
            <a href="" class="close pos-absolute t-15 r-15" wire:click.prevent="show_modal" >
                <span aria-hidden="true">&times;</span>
              </a>
        </div>
        <div class="modal-body pd-20 pd-sm-30">          
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
     
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Divecs')}}</span>
                </div>
                <input type="number" class="form-control" placeholder="1" aria-label="devices_count" name="devices_count" wire:model.live="devices_count" min="1" max="20">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Speed UP (Mbit/s)')}}</span>
                </div>
                <input type="number" class="form-control" placeholder="1" aria-label="speed_up" name="speed_up" wire:model.live="speed_up" min="0" >
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Speed Down (Mbit/s)')}}</span>
                </div>
                <input type="number" class="form-control" placeholder="1" aria-label="speed_up" name="speed_up" wire:model.live="speed_down" min="0" >
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Price')}}</span>
                </div>
                <input type="number" class="form-control" placeholder="0" aria-label="price" name="price" wire:model.live="price" min="0" >
            </div>
          <div class="d-flex justify-content-end mg-t-30 mg-b-0">
            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal" wire:click="show_modal">{{__('Cencel')}}</button>
            <button type="button" class="btn  btn-xs btn-primary mg-l-5" wire:click="save">{{__('Save')}}</button>
          </div>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->