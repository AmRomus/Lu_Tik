<div>
    @if ($pon)
        <div  class="card">
            <div class="card-body">
                <h6 class="h6">{{__('Onus on ')}}{{$pon->iface}}</h6>
                <div class="row" wire:loading>
                    <div class="col-12"><h5 class="h5 tx-mutted">Loading ...</h5></div>
                </div>
                <div class="table-responsive" wire:loading.remove>
                    <table class="table table-dashboard table-hover">
                        <thead>
                        <tr class="table-header">
                            <th>{{__('Mac')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Signal')}}</th>
                            <th>{{__('Account')}}</th>
                        </tr>
                    </thead>
                    <tbody>                       
                        @foreach ($pon->onu as $item)
                            <tr>
                                <td>{{$item->mac}}</td>
                                <td></td>
                                <td>{{$item->signal}}</td>
                                <td>{{$item->BillingAccount?->ident}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif    
</div>
