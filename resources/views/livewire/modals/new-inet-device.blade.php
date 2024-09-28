<div class="modal fade @if($show) show @endif "  role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3">{{__('New device')}}</h4>  
            <a href="" class="close pos-absolute t-15 r-15" wire:click.prevent="show_modal" >
                <span aria-hidden="true">&times;</span>
              </a>
        </div>
        <div class="modal-body pd-5 pd-sm-5">
            <div class="input-group">
                @foreach ($errors->all() as $error)
                <div class="tx-danger tx-bold">{{ $error }}</div>
                @endforeach
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" >{{__('MAC ADDRESS')}}</span>
                <input type="text" class="form-control" id="new_mac" name="mac" wire:model.live="mac">               
            </div>
            

          <div class="d-flex justify-content-end mg-t-30 mg-b-0">
            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal" wire:click="show_modal">{{__('Cencel')}}</button>
            <button type="button" class="btn  btn-xs btn-primary mg-l-5" wire:click="save">{{__('Save')}}</button>
          </div>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->