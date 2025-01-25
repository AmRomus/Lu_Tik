<div>
    <x-layouts.sidebar activePage="WaitConfirm" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('Tickets confirmation')}}  </h4>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12 table-reponsive">
                        <table class="table table-hover table-dashboard">
                            <tbody>
                                <thead>
                                    <tr>
                                        <th>{{__('Ticket')}} ID</th>
                                        <th>{{__('Address')}}</th>
                                        <th>{{__('Phone')}}</th>
                                        <th>{{__('Finish date')}}</th>
                                        <th>{{__('Coment')}}</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                @foreach ($tickets as $item)
                                <tr >                                    
                                    <td style="cursor: pointer" wire:click="$dispatchTo('modals.short-history','show_modal',{ obj: '{{class_basename($item)}}',id: {{ $item->id}} })">#{{$item->id}}</td>
                                    <td style="cursor: pointer" wire:click="$dispatchTo('modals.short-history','show_modal',{ obj: '{{class_basename($item)}}',id: {{ $item->id}} })">
                                        <strong> {{__('Customer ID')}}: {{$item->BillingAccount?->ident}}</strong>
                                        <h6>{{$item->BillingAccount?->Address}}</h6>
                                        <p>{{$item->BillingAccount?->FullName}}</p>                                        
                                    </td>
                                    <td>{{$item->alter_phone?$item->alter_phone:$item->BillingAccount?->phone}}</td>
                                    <td>{{$item->ProcessedResults?->created_at}}</td>
                                    <td>{{$item->ProcessedResults?->meta}}</td>
                                    <td>{{$item->ProcessedResults?->User?->name}}</td>
                                    <td><button class="btn btn-xs btn-success" wire:confirm="{{__('Ticket solved ?')}}" wire:click="close({{$item->id}})">{{__('Confirm')}}</button><button class="btn btn-xs btn-danger" wire:click.prevent="$dispatchTo('modals.return-ticket','show_modal',{tid:{{$item->id}}})">{{__('Return')}}</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                   
                </div>
            </div>
        </div>
    
        <livewire:modals.short-history>
        <livewire:modals.return-ticket  @saved="$refresh">  

</div>
