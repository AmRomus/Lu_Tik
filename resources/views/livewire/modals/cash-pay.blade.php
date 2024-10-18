<div class="modal fade @if($show) show @endif "  role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-top" role="document">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-16 tx-sm-16 mg-b-3">{{__('Cash Paymant for ')}} {{$account?->FullName}}</h4>  
            <a href="" class="close pos-absolute t-15 r-15" wire:click.prevent="show_modal" >
                <span aria-hidden="true">&times;</span>
              </a>
        </div>
        <div class="modal-body pd-20 pd-sm-30">
            @foreach ($errors->all() as $error)
            <div class="tx-danger">{{ $error }}</div>
            @endforeach
                <div class="input-group w-100">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >{{__('Amount')}}</span>
                    </div>
                      <input type="text" class="form-control" placeholder="0"  wire:model.defer="summ"> 
                </div>
          <div class="d-flex justify-content-end mg-t-30 mg-b-0">
            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal" wire:click="show_modal">{{__('Cencel')}}</button>
            <button type="button" class="btn  btn-xs btn-primary mg-l-5" wire:click="make_paymant">{{__('Pay')}}</button>
          </div>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->