<div class="off-canvas off-canvas-overlay off-canvas-right wd-400 @if($show) show @endif"  style="overflow: scroll!important">
    <ul class="list-unstyled mg-b-0"> 
        <li class="list-label text-black text-bold">{{__('Tarif Filter')}}</li>              
        @forelse ($tarifs as $item)
        <li class="list-item">
          <div class="media align-items-center">
            <div class=" tx-primary align-items-center justify-content-centerd-none d-sm-flex" >
              <div class="form-check form-switch">
                <input class="form-check-input ms-0 me-2" type="checkbox" wire:model.live="selectedt.{{$item->id}}">                           
              </div>
            </div>
            <label class="form-check-label">{{$item['name']}}</label>
          </div>
        </li>
        @empty
        <li class="list-label">{{__('No Tarif found')}}</li>
        @endforelse
    </ul>
    
        <div class="col-12 text-center"><button class="btn btn-success" wire:click="set_filter">{{__('Filter')}}</button></div>
   
</div>
