<div>
    <x-layouts.sidebar activePage="iptv_streams" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('Iptv Streams')}}</h4>
                <nav class="nav">
                    <a href="{{route('iptv.streams.new')}}" class="btn btn-sm btn-success tx-bold" > {{__('New')}}</a>
                  </nav>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12 text-end">
                        <input type="text" class="form-control h-8" wire:model.live="search">
                    </div>
                    <div class="col-12 table-responsive">
                        <table class="table table-hover table-dashboard">
                            <thead>
                                <tr valign="top">
                                    <th class="px-4 py-1 border-b-2 border-blue-500 " style="width:40px"></th>
                                    <th >{{__('Name')}} </th>
                                    <th class="px-4 py-1 border-b-2 border-green-500">{{__('URL')}}</th>
                                    <th class="px-4 py-1 border-b-2 border-red-500">{{__('EPG')}}</th>
                                    <th class="px-4 py-1 border-b-2 border-red-500">-</th>
                                    <th class="px-4 py-1 border-b-2 border-red-500">{{__('Now')}}</th>
                                    <th class="px-4 py-1 text-center border-b-2 border-yellow-500 sm:text-left"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pchannels as $item)
                                <tr class="align-middle">
                                    <td class="px-2" >
                                        <a href="{{route('iptv.streams.edit',$item->id)}}" >
                                        <div class="d-flex justify-content-center  rounded-1 text-white font-bold align-items-center me-3" style="height: 50px;width:50px;">
                                            <img src="/logos/{{$item->tvg_ico}}.png" style="height: 30px"/>
                                        </div>
                                      </a>
                                    </td>
                                    <td>
                                     {{$item->name}}
                                    </td>
                                    <td class="text_blur">
                                      {{$item->stream_url}}
                                    </td>
                                    <td >
                                     {{$item->tvg_id}} 
                                    </td>
                                    <td>
                                        <div>@if($item->have_catchup) <i class="fa fa-check"></i> Catch-Up @endif</div>
                                        <div>@if($item->is_ott) <i class="fa fa-check"></i> OTT @endif</div>
                                    </td>
                                    <td >
                                       {{$item->epg?->first()?->title}}
                                    </td>                            
                                    <td >                                
                                        <i class="fa fa-trash" style="cursor: pointer" wire:click="remove_stream({{$item->id}})" wire:confirm="Are you sure you want to delete this stream?"></i>                                
                                    </td>
                                  </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" align="center">{{__('No streams found')}}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

</div>
