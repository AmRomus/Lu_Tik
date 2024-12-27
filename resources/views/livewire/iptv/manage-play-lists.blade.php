<div>
    <x-layouts.sidebar activePage="iptv_playlists" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('Iptv Play Lists')}}</h4>
                <nav class="nav">
                    <a href="#" class="btn btn-sm btn-success tx-bold" wire:click.prevent="$dispatchTo('modals.new-play-list','show_modal')" > {{__('New')}}</a>
                  </nav>
            </div>
            <div class="content-body">
                <div class="row">                  
                    <div class="col-12 table-responsive">
                        <table class="table table-hover table-dashboard">
                            <thead>
                                <tr valign="top">                                   
                                    <th >{{__('Name')}} </th>                                  
                                    <th class="px-4 py-1 border-b-2 border-red-500">{{__('Channels Count')}}</th>
                                    <th class="px-4 py-1 text-center border-b-2 border-yellow-500 sm:text-right">{{__('Acctions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($playlists as $item)
                                <tr class="align-middle">
                                <td>{{$item->name}}</td>
                                <td>{{$item->channels->count()}}</td>   
                                <td class="d-flex">
                                    <a href="{{route('iptv.playlist.edit',$item->id)}}" class="nav-link"><i class="fa fa-edit" style="cursor: pointer"></i></a>
                                    <a href="#" class="nav-link mx-2" wire:click.prevent="del({{$item->id}})" wire:confirm="{{__('Are you whant delete the playlist ?')}}"><i class="fa fa-trash" style="cursor: pointer"></i></a>
                                </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" align="center">{{__('No Play lists found')}}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <livewire:modals.new-play-list @saved="$refresh"/>
</div>
