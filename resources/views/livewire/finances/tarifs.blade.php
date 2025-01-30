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
                    <div class="col-12 table-resposncive">
                        <table class="table table-hover table-dashboard bd">
                            <thead class="bg-gray-100">
                                <th>{{__('Name')}}</th>
                                <th>{{__('Services')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Accounts')}}</th>
                                <th>{{__('Description')}}</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($tarif_list as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td><livewire:widgets.active-services :tarif="$item->id"></td>
                                    <td>{{$item->getAmountProduct()}}</td>
                                    <td>{{$item->BillingAccount->count()}}</td>
                                    <td>{{$item->description}}</td>
                                    <td><a href="{{route('finances.edit.tarif',$item->id)}}" class="nav-link">{{__('Edit')}}</a></td>
                                </tr>                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
       
</div>
