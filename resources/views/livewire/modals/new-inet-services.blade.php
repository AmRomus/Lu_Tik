<div class="modal fade  @if($show) show @endif "  role="dialog" aria-hidden="true">
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
                  <span class="input-group-text" >{{__('Speed UP')}}</span>
                </div>
                <input type="number" class="form-control" placeholder="1" aria-label="speed_up" name="speed_up" wire:model.defer="speed_up" min="0" >
                <select class="form-control" wire:model.live="speed_up_unit">
                  <option value="">Bit/s</option>
                  <option value="K">Kbit/s</option>
                  <option value="M">Mbit/s</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Speed Down')}}</span>
                </div>
                <input type="number" class="form-control" placeholder="1" aria-label="speed_down" name="speed_down" wire:model.defer="speed_down" min="0" >
                <select class="form-control" wire:model.live="speed_down_unit">
                  <option value="">Bit/s</option>
                  <option value="K">Kbit/s</option>
                  <option value="M">Mbit/s</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Price')}}</span>
                </div>
                <input type="number" class="form-control" placeholder="0" aria-label="price" name="price" id="price" wire:model.defer="price" min="0" >
            </div>
          <div class="d-flex justify-content-end mg-t-30 mg-b-0">
            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal" wire:click="show_modal">{{__('Cencel')}}</button>
            <button type="button" class="btn  btn-xs btn-primary mg-l-5" wire:click="save">{{__('Save')}}</button>
          </div>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->