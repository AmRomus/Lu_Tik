<div class="modal fade @if($show) show bg-black-8 @endif "  role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3">{{__('New Mikro-Bill')}}</h4>  
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
                  <span class="input-group-text" >{{__('Name')}}</span>
                </div>
                <input type="text" class="form-control" placeholder="{{__('Name')}}" aria-label="name" name="name" wire:model.defer="name">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Host')}}</span>
                </div>
                <input type="text" class="form-control" placeholder="{{__('Host')}}" aria-label="host" name="host" wire:model.live="host">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Login')}}</span>
                </div>
                <input type="text" class="form-control" placeholder="{{__('Login')}}" aria-label="login" name="login" wire:model.defer="login">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Password')}}</span>
                </div>
                <input type="password" class="form-control" placeholder="{{__('Password')}}" aria-label="password" name="password" wire:model.defer="password">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('KEY 1')}}</span>
                </div>
                <input type="text" class="form-control" placeholder="{{__('KEY 1')}}" aria-label="key1" name="key1" wire:model.defer="key1">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('KEY 2')}}</span>
                </div>
                <input type="text" class="form-control" placeholder="{{__('KEY 2')}}" aria-label="key2" name="key2" wire:model.defer="key2">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Port')}}</span>
                </div>
                <input type="number" class="form-control" placeholder="{{__('Port')}}" aria-label="port" name="port" wire:model.defer="port" min=0>
            </div>
          <div class="d-flex justify-content-end mg-t-30 mg-b-0">
            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal" wire:click="show_modal">Չեղարկել</button>
            <button type="button" class="btn  btn-xs btn-primary mg-l-5" wire:click="save">Պահպանել</button>
          </div>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->