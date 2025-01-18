<div class="modal fade @if($show) show @endif"  role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3">{{__('Solve Date')}}</h4>  
            <a href="" class="close pos-absolute t-15 r-15" wire:click.prevent="hide_modal" >
                <span aria-hidden="true">&times;</span>
              </a>
        </div>
        <div class="modal-body pd-20 pd-sm-30">
            <div class="input-group mb-3">                
                <input 
                wire:model.defer="taskdate"
                type="datetime-local" class="form-control datepicker" placeholder="Due Date" autocomplete="off"
                data-provide="datepicker" data-date-autoclose="true" 
                data-date-today-highlight="true"                        
                
             >
            </div>
            
          <div class="d-flex justify-content-end mg-t-30 mg-b-0">
            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal" wire:click="hide_modal">{{__('Cencel')}}</button>
            <button type="button" class="btn  btn-xs btn-primary mg-l-5" wire:click="save">{{__('Save')}}</button>
          </div>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->
