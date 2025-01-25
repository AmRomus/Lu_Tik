<div class="modal fade @if($show) show bg-black-8 @endif"  role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3">{{__('New call')}}</h4>  
            <a href="" class="close pos-absolute t-15 r-15" wire:click.prevent="show_modal" >
                <span aria-hidden="true">&times;</span>
              </a>
        </div>
        <div class="modal-body pd-20 pd-sm-30">
            <div class="row">
                <div class="col-4">

                </div>
                <div class="col-8">
                    <div class="input-group">
                        <select name="call_type" class="form-control mb-2" wire:model.defer="cal">
                            @foreach ($call_types as $key=>$val)
                                <option value="{{$key}}">{{$val}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">                
                <textarea  class="form-control" aria-label="note" name="note"  wire:model.defer="theme"></textarea>
            </div>
            <div class="input-group mb-3 text-end">
                <input type="checkbox" wire:model.defer="solved">&nbsp; {{__('Solved')}}
            </div>
          <div class="d-flex justify-content-end mg-t-30 mg-b-0">
            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal" wire:click="show_modal">{{__('Cencel')}}</button>
            <button type="button" class="btn  btn-xs btn-primary mg-l-5" wire:click="save">{{__('Save')}}</button>
          </div>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->