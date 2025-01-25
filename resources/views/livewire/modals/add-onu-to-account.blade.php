<div class="modal fade @if($show) show bg-black-8 @endif "  role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3">{{__('Add Onu')}}</h4>  
            <a href="" class="close pos-absolute t-15 r-15" wire:click.prevent="show_modal" >
                <span aria-hidden="true">&times;</span>
              </a>
        </div>
        <div class="modal-body pd-5 pd-sm-5 mx-2">
            <div class="input-group">
                @foreach ($errors->all() as $error)
                <div class="tx-danger tx-bold">{{ $error }}</div>
                @endforeach
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" >{{__('MAC ADDRESS')}}</span>
                <input type="text" class="form-control style_mac" id="onu_mac" name="mac" wire:model.live.debounce.1000ms="onu_mac" >               
            </div>
            <div wire:loading> {{__('Searching...')}}</div> 
            @forelse ($free_onus as $key=>$item)
           
           <div class="input-group mb-3 w-auto ">   
            <div class="input-group-text tx-10">         
              <input type="checkbox" class="form-check-input" wire:click="bind({{$key}})" wire:model.live="bind_select">
              <label class="form-check-label ms-2" for="flexCheckDefault">
                {{__('Select')}}
              </label>
            </div>
            <span class="input-group-text tx-10 w-auto">{{__('MAC')}}</span>
            <span class="input-group-text tx-10 w-auto">{{$item}}</span>
           
          </div> 
           @empty
               
           @endforelse
        </div>
      </div>
    </div>
    
</div>

