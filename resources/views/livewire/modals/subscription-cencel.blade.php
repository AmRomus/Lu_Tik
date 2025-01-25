<div class="modal fade @if($show) show bg-black-8 @endif "  role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3">{{__('Remove subsciption')}}</h4>  
            <a href="" class="close pos-absolute t-15 r-15" wire:click.prevent="show_modal" >
                <span aria-hidden="true">&times;</span>
              </a>
        </div>
        <div class="modal-body pd-5 pd-sm-5">            
            <div class="row">
                <div class="col mg-5 w-100">
                    <h5 class="tx-danger">{{__('Are you whant cencel subsctiption ?')}}</h5>
                </div>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input ms-0 me-2" type="checkbox" wire:model.live="do_refund">
                <label class="form-check-label">{{__('Refund summ ')}} {{$refund_summ}}</label>
            </div>
            
          <div class="d-flex justify-content-end mg-t-30 mg-b-0">
            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal" wire:click="show_modal">{{__('Cencel')}}</button>
            <button type="button" class="btn  btn-xs btn-danger mg-l-5" wire:click="cencel_subscription">{{__('Remove')}}</button>
          </div>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->