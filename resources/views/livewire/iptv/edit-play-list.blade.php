<div>
    <x-layouts.sidebar activePage="iptv_playlists" > </x-layouts.aside>
    <div class="content">
        <div class="content-header">         
            <nav class="nav">             
            </nav>
          </div><!-- content-header -->
        <div class="container-fluid pd-x-0">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                    <div class="col">
                        @error('name')
                        <div> {{$message}} </div>    
                        @enderror                    
                        <input type="text" class="form-control" wire:model.live="name">
                    </div>
                    <div class="col me-auto text-end">
                        Տրամադրվող ալիքները
                    </div>
                </div>
                </div>  
        
                <div class="card-body">  
            <div class="row row-xs">
    <ul class="" wire:sortable="updateChannelOrder"  wire:sortable.options="{ animation: 100 }"> 
               
        @foreach ($playlist->channels as $item)                       
            <li class="border m-1 p-2" style="list-style:none; display:inline-flex;height:70px;width:220px; " wire:sortable.item="{{$item->pivot->id }}" wire:key="task-{{ $item->pivot->order_id }}" > 
                <div class="d-flex justify-content-start">
                    <div class="col-sm">
                        <span class="badge top position-absolute translate-middle rounded-pill bg-danger"> {{$item->pivot->order_id}} </span>
                        <a wire:sortable.handle>
                            <img src="/logos/{!! ($item->tvg_ico)?$item->tvg_ico:'null' !!}.png" alt="" style="width: 50px">                             
                        </a>                           
                    </div>
                    <div class="col-auto ms-2">
                       <div class="row">
                        <b>{{$item->name}}</b> 
                       </div>
                       @if ($item->have_catchup)
                       <div class="row">
                           <b>Catch-Up</b> 
                       </div>
                       @endif
                    </div>
                </div>
                <span class="badge ms-auto text-black" style="cursor: pointer" wire:click="remove({{$item->pivot->id}})" wire:confirm="Հեռացնե՞լ ցանկից"> <i data-feather="trash-2" style="height: 16px"></i> </span>
            </li>
        @endforeach 
        <li class="border m-1 p-2" style="list-style:none; display:inline-flex;width:220px;cursor: pointer;" x-on:click="$dispatch('show')">
            <div class="col-4 me-auto ">
                <img src="/images/add_channel.png" alt="" style="width: 50px">
            </div>
            <div class="col me-auto mb-2">                           
                <div class="row">
                    <b>Ավելացնել</b> 
                </div>
                @if($show_channels)
                <div class="row">
                    <div  class="ms-2 col position-absolute" style="max-height:500px !important;width:300px;overflow-y:scroll;overflow-x:hidden;" x-on:click.away="$dispatch('hide')">
                        <ul  style="list-style:none; ">
                            @foreach ($all_channels as $item)
                            <li class="border m-1 p-2 bg-white d-flex" style="width:250px;cursor: pointer;" x-on:click="$dispatch('add_channel',{id:{{$item->id}}})">
                              
                                <div class="col-4 me-auto ">                                       
                                        <img src="/logos/{!! ($item->tvg_ico)?$item->tvg_ico:'null' !!}.png" alt="" style="width: 50px; height:50px;">                                                                            
                                </div>
                                <div class="col me-auto mb-2">                           
                                    <div class="row">
                                        <b>{{$item->name}}</b> 
                                    </div>
                                @if ($item->have_catchup)
                                <div class="row">
                                    <b>Catch-Up</b> 
                                </div>
                                @endif
                                </div>
                              
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>
            
        </li>
        </ul>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>
