<div class="modal fade @if($show) show @endif "  role="dialog" aria-hidden="true"   >
    <div class="modal-dialog modal-dialog-centered" role="document" x-on:click.away="$dispatch('hide_history')">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3">{{__('History')}}</h4>  
            <a href="" class="close pos-absolute t-15 r-15" wire:click.prevent="hide_history" >
                <span aria-hidden="true">&times;</span>
              </a>
        </div>
        <div class="modal-body">
            <ul class="list-group list-group-flush tx-13">
               @forelse ($history as $u)
               <li class="list-group-item d-flex pd-sm-x-20">               
                <div class="pd-sm-l-10"> 
                    <div class="d-flex">
                        <div>
                           
                        </div>
                        <div class="px-2 mt-1">
                            <h6> {{$u->acction}}</h6>
                        </div>
                    </div>                  
                  
                  <small class="tx-12 tx-color-03 mg-b-0"> <span class="badge text-bg-secondary">{{$u->created}}</span> {{$u->User?->name}}</small>
                </div>
                <div class="form-check form-switch mg-l-auto text-end">
                    {{$u->meta}}
                </div>
                
              </li>
               @empty
               <li class="list-group-item d-flex pd-sm-x-20">{{__('No acctions found')}}</li>
               @endforelse
            </ul>
            
          
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->