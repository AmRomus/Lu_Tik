<div class="card card-body mt-3">
    <h6 class="card-title">{{__('Queue Type')}}</h6>
    <select class="form-control" wire:model.live="qtype">       
        @foreach ($mk->Qtypes as $item)
            <option value={{$item->name}}> {{$item->name}}</option>
        @endforeach
    </select>       
    <div class="row">
        <div class="col-12 d-flex justify-content-end mt-2">
            <button class="btn btn-xs btn-success text-end" wire:click="save">{{__('Apply')}}</button>
        </div>
    </div>
</div>
