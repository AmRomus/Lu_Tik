<div class="modal fade @if($show) show @endif"  role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3">{{__('New Account')}}</h4>  
            <a href="" class="close pos-absolute t-15 r-15" wire:click.prevent="show_modal" >
                <span aria-hidden="true">&times;</span>
              </a>
        </div>
        <div class="modal-body pd-20 pd-sm-30">          
            @foreach ($errors->all() as $error)
                <div class="input-group mb-3 text-danger">{{ $error }}</div>
            @endforeach
     
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('First Name')}}</span>
                </div>
                <input type="text" class="form-control" placeholder="{{__('First Name')}}" aria-label="name" name="name" wire:model.defer="first">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Last Name')}}</span>
                </div>
                <input type="text" class="form-control" placeholder="{{__('Last Name')}}" aria-label="name" name="name" wire:model.defer="last">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Middle Name')}}</span>
                </div>
                <input type="text" class="form-control" placeholder="{{__('Middle Name')}}" aria-label="name" name="name" wire:model.defer="middle">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Ident')}}</span>
                </div>
                <input type="text" class="form-control" placeholder="{{__('Ident')}}" aria-label="name" name="name" wire:model.live="ident">
                <button class="btn btn-sm btn-success" wire:click="mk_ident">{{__('Gen')}}</button>
            </div>
          <div class="d-flex justify-content-end mg-t-30 mg-b-0">
            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal" wire:click="show_modal">{{__('Cencel')}}</button>
            <button type="button" class="btn  btn-xs btn-primary mg-l-5" wire:click="save">{{__('Save')}}</button>
          </div>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->