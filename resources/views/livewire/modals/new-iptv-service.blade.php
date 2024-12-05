<div class="modal fade  @if($show) show @endif "  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3">{{__('Add Iptv Service')}}</h4>  
            <a href="" class="close pos-absolute t-15 r-15" wire:click.prevent="show_modal" >
                <span aria-hidden="true">&times;</span>
              </a>
        </div>
        <div class="modal-body pd-20 pd-sm-30">          
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
     
            <select name="comapny_service" wire:model.live="selected_company" class="form-select">              
              @forelse ($companyes as $item)
                  <option value="{{$item->id}}" @if ($item->id==$selected_company) @selected(true) @endif >{{$item->Name}}</option>
              @empty
                  
              @endforelse
          </select>          
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Iptv STB')}}</span>
                </div>
                <input type="number" class="form-control" placeholder="0" aria-label="iptv_devices" name="iptv_devices" wire:model.defer="iptv_devices" min="0" >
                
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Smart TV')}}</span>
                </div>
                <input type="number" class="form-control" placeholder="0" aria-label="smart_devices" name="smart_devices" wire:model.defer="smart_devices" min="0" >
               
            </div>            
            <div class="input-group mb-3">
                <select name="playlist" wire:model.live="selected_playlist" class="form-select">              
                    @forelse ($playlists as $item)
                        <option value="{{$item->id}}" @if ($item->id==$selected_playlist) @selected(true) @endif >{{$item->name}}</option>
                    @empty
                        
                    @endforelse
                </select>         
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Price')}}</span>
                </div>
                <input type="number" class="form-control" placeholder="0" aria-label="price" name="price" id="price" wire:model.defer="price" min="0" >
            </div>
          <div class="d-flex justify-content-end mg-t-30 mg-b-0">
            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal" wire:click="show_modal">{{__('Cencel')}}</button>
            <button type="button" class="btn  btn-xs btn-primary mg-l-5" wire:click="save">{{__('Save')}}</button>
          </div>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->