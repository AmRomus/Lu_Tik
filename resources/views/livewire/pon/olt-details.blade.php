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
                                    <th class="tx-center">{{__('Onus')}}</th>
                                </tr>
                            </thead>
                            <tbody class="tx-11">
                                @foreach ($olt->OltIfaces as $item)
                                <tr @if ($item->pon_index)
                                    wire:click="select_pon({{$item->id}})"
                                @endif >
                                    <td>{{$item->iface}}</td>
                                    <td align="center"><span class="d-block wd-10 ht-10 @if ($item->is_up)
                                        bg-success
                                        @else 
                                        bg-danger
                                    @endif  rounded mg-r-5"></span> </td>
                                    <td align="center">{{($item->onu->count()==0)?"--":$item->onu->count()}}</td>
                                </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-4 table-resposive">
                        <livewire:pon.onu-list  :olt_id="$olt->id"/>
                    </div>
                </div>
            </div>
        </div>
</div>
