<div>
    <x-layouts.sidebar activePage="inetdevices" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('Network Devices')}}</h4>
                <nav class="nav">
                    <a href="#" class="btn btn-sm btn-success tx-bold" wire:click="$dispatchTo('modals.new-inet-device','show_modal')"> {{__('New')}}</a>
                  </nav>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-hover table-dashboard">
                            <thead>
                                <tr valign="top">
                                    <th >{{__('MAC ADDRESS')}} <input type="text" class="form-control h-8" id="mac_search"></th>
                                    <th>{{__('Account')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($devices as $item)
                                    <tr>
                                        <td>{{$item->mac}}</td>
                                        <td>{{($item->BillingAccount)?$item->BillingAccount->Fullname:__('Stock')}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>{{__('No devices found')}}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <livewire:modals.new-inet-device @saved="$refresh">
            @push('js')
                <script type="module">
                    var cleaveI = new Cleave('#mac_search', {
                                    delimiters: [':', ':', ':',':',':'],
                                        blocks: [2, 2, 2, 2, 2, 2],
                                        uppercase: true
                                    });
                    var cleaveII = new Cleave('#new_mac', {
                                    delimiters: [':', ':', ':',':',':'],
                                        blocks: [2, 2, 2, 2, 2, 2],
                                        uppercase: true
                                    });
                </script>
            @endpush
</div>
