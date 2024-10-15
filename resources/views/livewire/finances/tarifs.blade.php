<div>
    <x-layouts.sidebar activePage="Tarifs" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('Tarifs')}}</h4>
                <nav class="nav">
                    <a href="#" class="btn btn-sm btn-success tx-bold" wire:click="$dispatchTo('modals.new-tarif','show_modal')"> {{__('New Tarif')}}</a>
                  </nav>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-4 table-resposive">
                        <ul class="list-unstyled mg-b-0">
                            <li class="list-label">{{__('List')}}</li>
                            @forelse ($tarif_list as $item)                            
                            <li class="list-item bd">
                                <div class="media align-items-center w-100">
                                    <div class="wd-35 ht-35 bd bd-2 bd-success tx-primary rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex">
                                      <i data-feather="dollar-sign"></i>
                                    </div>
                                    <div class="media-body mg-sm-l-15">
                                      <p class="tx-medium mg-b-0">{{$item->name}}{{$item->$service}}</p>
                                      <span class="mg-b-5">{{__('Amount')}}:{{$item->getAmountProduct()}}</span><br/>
                                      <span class="tx-12 tx-color-03 mg-b-0">{{__('Description')}}:{{$item->description}}</span>
                                    </div><!-- media-body -->
                                    <div class="justify-content-end">
                                       <a href="#" class="nav-link" wire:click.prevent="$dispatchTo('finances.tarif-services','show_tarif',{tarif:{{$item->id}}})"> edit</a>
                                    </div>
                                </div><!-- media -->                            
                            </li> 
                            @empty
                            <li class="list-item">{{__('No Tarif registred')}} 
                            @endforelse
                        </ul>
                    </div>
                    <div class="col-8">
                        <livewire:finances.tarif-services>
                    </div>
                </div>
            </div>
        </div>
        <livewire:modals.new-tarif @saved="$refresh">
</div>
