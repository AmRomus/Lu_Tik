<div class="modal fade @if($show) show bg-black-8 @endif modal-sm"  role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3">{{__('Ticekt users')}}</h4>  
            <a href="" class="close pos-absolute t-15 r-15" wire:click.prevent="hide_modal" >
                <span aria-hidden="true">&times;</span>
              </a>
        </div>
        <div class="modal-body">
            <ul class="list-group list-group-flush tx-13">
               @forelse ($users as $u)
               <li class="list-group-item d-flex pd-sm-x-20">               
                <div class="pd-sm-l-10">
                  <p class="tx-medium mg-b-0">{{$u->name}}</p>
                  <small class="tx-12 tx-color-03 mg-b-0">Mar 21, 2023, 3:30pm</small>
                </div>
                <div class="form-check form-switch mg-l-auto text-end">
                    <input class="form-check-input" type="checkbox" value="{{$u->id}}" wire:model.live="selected_arr"  >                  
                </div>
                
              </li>
               @empty
               <li class="list-group-item d-flex pd-sm-x-20">No Users found</li>
               @endforelse
            </ul>
            
          <div class="d-flex justify-content-end mg-t-30 mg-b-0">
            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal" wire:click="show_modal">{{__('Cencel')}}</button>
            <button type="button" class="btn  btn-xs btn-primary mg-l-5" wire:click="save">{{__('Save')}}</button>
          </div>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->