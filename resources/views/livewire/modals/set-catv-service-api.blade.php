<div class="modal fade @if($show) show @endif "  role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3"> {{__('Add Control')}} </h4>  
            <a href=""  class="close pos-absolute t-15 r-15" wire:click.prevent="show_modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </a>
        </div>
        <div class="modal-body pd-20 pd-sm-30">          
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
     
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" >Billing՝</label>  
                </div>                     
                <select class="form-control" wire:model.live="apis_id">
                  <option value=0>{{__('Internal')}}</option>
                  @foreach ($apis as $item)
                      <option value={{$item->id}}> {{$item->name}}</option>
                  @endforeach
                </select>                
            </div>
          @if($apis_id)
          <div class="input-group mb-3">
            <span class="input-group-text" >ID</span>
            <input type="text" class="form-control" placeholder="####" aria-label="ident" aria-describedby="ident" wire:model.live.debounce.250ms="api_ident">
          </div>
          @endif

          <div class="d-flex justify-content-end mg-t-30 mg-b-0">
            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal" wire:click="show_modal">Cancel</button>
            @if($api_uuid||$apis_id==0)
            <button type="button" class="btn  btn-xs btn-primary mg-l-5" wire:click="save_api">Save Changes</button>
            @endif
          </div>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->