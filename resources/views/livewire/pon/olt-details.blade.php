<div>
    <x-layouts.sidebar activePage="Olts" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('OLT')}} - {{$olt->SystemName}} / {{$olt->ip}} /</h4>
                <nav class="nav">
                    <a href="#" class="btn btn-sm btn-success tx-bold" wire:click="get_interfaces"> {{__('Get Interfaces')}}</a>
                  </nav>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-3 table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{__('Interface')}}</th>
                                    <th class="tx-center" >{{__('State')}}</th>
                                </tr>
                            </thead>
                            <tbody class="tx-11">
                                @foreach ($olt->OltIfaces as $item)
                                <tr>
                                    <td>{{$item->iface}}</td>
                                    <td align="center"><span class="d-block wd-10 ht-10 @if ($item->state)
                                        bg-success
                                        @else 
                                        bg-danger
                                    @endif  rounded mg-r-5"></span> </td>
                                </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
