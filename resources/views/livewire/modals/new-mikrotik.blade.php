<div class="modal fade @if($show) show @endif "  role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3">Նոր Mikrotik </h4>  
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
                  <span class="input-group-text" >Անվանում</span>
                </div>
                <input type="text" class="form-control" placeholder="Անվանում" aria-label="name" name="name" wire:model.defer="name">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >Հասցե կամ IP</span>
                </div>
                <input type="text" class="form-control" placeholder="Հասցե կամ IP" aria-label="host" name="host" wire:model.live="hostname">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >Մութքանուն</span>
                </div>
                <input type="text" class="form-control" placeholder="Մութքանուն" aria-label="login" name="login" wire:model.defer="login">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >Գաղթնաբառ</span>
                </div>
                <input type="password" class="form-control" placeholder="Գաղթնաբառ" aria-label="password" name="password" wire:model.defer="password">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >Պորտ</span>
                </div>
                <input type="text" class="form-control" placeholder="8728" aria-label="port" name="port" wire:model.defer="port" value=8728>
            </div>
            <div class="custom-control custom-switch text-end">
                <input type="checkbox" class="custom-control-input" id="customSwitch1" wire:model.defer="ssl" >
                <label class="custom-control-label" for="customSwitch1">SSL </label>
              </div>
          <div class="d-flex justify-content-end mg-t-30 mg-b-0">
            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal" wire:click="show_modal">Չեղարկել</button>
            <button type="button" class="btn  btn-xs btn-primary mg-l-5" wire:click="save">Պահպանել</button>
          </div>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->