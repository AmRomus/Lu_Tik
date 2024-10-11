<div>
    <x-layouts.sidebar activePage="Accounts" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('Accounts')}}</h4>
                <nav class="nav">
                    <a href="#" class="btn btn-sm btn-success tx-bold" wire:click="$dispatchTo('modals.new-billing-account','show_modal')"> {{__('New Account')}}</a>
                  </nav>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12 table-resposive">
                        <table class="table table-hover table-dashboard">
                            <thead>
                                <tr>
                                    <th style="width:100px;"></th>
                                    <th style="width:50px;"></th>
                                    <th style="width: 250px">{{__('Full Name')}}</th>
                                    <th style="width: 300px">{{__('Address')}}</th>
                                    <th style="width: 150px;">{{__('Phone')}}</th>
                                    <th>{{__('Tarif')}}</th>
                                    <th>{{__('Active Until')}}</th>
                                    <th>{{__('Comment')}}</th>
                                    
                                    <th style="width: 50px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $item)
                                    <tr>
                                        <td valign="middle"><strong>{{$item->ident}}</strong></td>
                                        <td valign="middle">
                                            <div class="d-flex justify-content-center @if ($item->status>=0) bg-danger @else bg-success @endif rounded-1 text-white font-bold align-items-center me-3" style="height: 30px;width:30px;">
                                                <strong>{{$item->initials}}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">{{$item->FullName}}</h6>
                                            <small class="mt-0">{{__('Balance')}}:{{$item->balance}}</small>
                                        </td>
                                        <td>
                                            {{$item->address}}
                                        </td>
                                        <td>{{$item->phone}}</td>
                                        <td>
                                            <div class="media">
                                                {{__('Current')}}: {{$item->Subscription?->tarif?->name}}
                                            </div>
                                            <div class="media">
                                                {{__('Next Tarif')}}: {{$item->tarif?->name}}
                                            </div>
                                        </td>
                                        <td>{{$item->Subscription?->acct_end}}</td>
                                        <td>{{$item->coment}}</td>                                       
                                        <td valign="middle"><a href="{{route('account.edit',$item->id)}}"><i data-feather="arrow-right"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <livewire:modals.new-billing-account @saved="$refresh">
</div>
