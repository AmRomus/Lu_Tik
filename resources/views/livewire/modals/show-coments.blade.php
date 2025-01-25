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
                <ul>
                @foreach ($comments as $c)
                 <li class="bd-b">
                    {{$c->comment}}
                    <p class="tx-gray-500 tx-9">{{$c->TimeLeft}} <span class="tx-gray-900">&copy; {{$c->User?->name}}</span></p>
                </li>
                @endforeach
               
                <li>
                    <textarea name="comment_text" wire:model.defer="comment_text" cols="30" rows="3" class="form-control"></textarea>
                    <div class="w-100 mt-2 text-end">
                        <button class="btn btn-xs btn-primary" wire:click="add_comment">{{__('Send')}}</button>
                    </div>
                </li> 
                
                </ul>
             
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->