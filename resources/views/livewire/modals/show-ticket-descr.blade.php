<div class="modal fade @if($show) show bg-black-8 @endif "  role="dialog" aria-hidden="true"   >
    <div class="modal-dialog modal-dialog-centered" role="document" x-on:click.away="$dispatch('hide_modal')">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3">{{__('Ticket #')}}{{$item?->id}}</h4>  
            <a href="" class="close pos-absolute t-15 r-15" wire:click.prevent="hide_modal" >
                <span aria-hidden="true">&times;</span>
              </a>
        </div>
        <div class="modal-body">
           {{$item?->description}}
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->