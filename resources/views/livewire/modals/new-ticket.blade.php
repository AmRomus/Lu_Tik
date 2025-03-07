<div class="modal fade @if($show) show bg-black-8 @endif"  role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3">{{__('New Ticket')}}</h4>  
            <a href="" class="close pos-absolute t-15 r-15" wire:click.prevent="hide_modal" >
                <span aria-hidden="true">&times;</span>
              </a>
        </div>
        <div class="modal-body pd-20 pd-sm-30">
            <div class="input-group mb-3">
                <select name="call_type" class="form-control mb-2" wire:model.live="ticket_type">
                    @foreach ($ttypes as $key=>$val)
                        <option value="{{$key}}">{{$val}}</option>
                    @endforeach
                </select>
            </div>
            @if ($ticket_type==1)
            <div class="input-group mb-3">
                <select name="call_type" class="form-control mb-2" wire:model.live="support_type">
                    @foreach ($support_types as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Alt. Phone')}}</span>
                </div>
                <input type="text" class="form-control" placeholder="{{__('+XXXXXXXXXXX')}}" aria-label="alter_phone" name="phone" wire:model.defer="alter_phone">
            </div>
            <div class="input-group mb-3">                
                <input 
                wire:model.defer="taskdate"
                type="datetime-local" class="form-control datepicker" placeholder="Due Date" autocomplete="off"
                data-provide="datepicker" data-date-autoclose="true" 
                data-date-today-highlight="true"                        
                
             >
            </div>
            <div class="input-group mb-3">                
                <textarea  class="form-control" aria-label="description" name="description"  wire:model.defer="description">{{$description}}</textarea>
            </div>
            
          <div class="d-flex justify-content-end mg-t-30 mg-b-0">
            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal" wire:click="hide_modal">{{__('Cencel')}}</button>
            <button type="button" class="btn  btn-xs btn-primary mg-l-5" wire:click="save">{{__('Save')}}</button>
          </div>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->