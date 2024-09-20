<div class="modal fade show "  role="dialog" aria-hidden="true" @if($show)style="display: block"@endif>
    <div class="modal-dialog modal-dialog-centered" role="document">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3">{{__('New Tarif')}}</h4>  
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
                  <span class="input-group-text" >{{__('Tarif Name')}}</span>
                </div>
                <input type="text" class="form-control" placeholder="{{__('Tarif Name')}}" aria-label="name" name="name" wire:model.live="name">
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" >{{__('Description')}}</span>
                  </div>
                  <textarea class="form-control" placeholder="{{__('Description')}}" aria-label="description" name="description" wire:model.defer="description"> </textarea>
            </div>

          <div class="d-flex justify-content-end mg-t-30 mg-b-0">
            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal" wire:click="show_modal">{{__('Cencel')}}</button>
            <button type="button" class="btn  btn-xs btn-primary mg-l-5" wire:click="save">{{__('Save')}}</button>
          </div>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->