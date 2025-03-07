<div>
    <x-layouts.sidebar activePage="Accounts" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('Accounts')}}</h4>
                <div class="input-group w-50">                      
                      <input type="text" class="form-control"  wire:model.live="search"> 
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>                              
                </div>
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
                                    <th style="width: 250px">{{__('Full Name')}}</th>                                    
                                    <th style="width: 300px">{{__('Address')}}</th>
                                    <th style="width: 150px;">{{__('Phone')}}</th>
                                    <th><div class="d-flex"><div class="col  @if ($tarif_filtred)
                                        text-bold text-black
                                    @endif">  {{__('Tariff')}} @if ($tarif_filtred) (filtred) <i class="fa fa-trash" style="cursor: pointer" wire:click="reset_tarif_filter"></i> @endif</div><div class="text-end text-black">@if (!$tarif_filtred)
                                        <i class="fa fa-filter" style="cursor: pointer" wire:click="$dispatchTo('modals.set-tarif-filter','show_modal',{filtred:null})"></i>
                                    @endif</div> </div></th>
                                    <th>{{__('State')}}</th>
                                    <th>{{__('Active Until')}}</th>                                    
                                    <th  style="width: 50px;"></th>
                                    <th style="width: 50px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accs as $item)

                                    <tr 
                                    @if($item->trashed())
                                        class="bg-gray-700 tx-white tx-bold"
                                        @endif
                                    @if ($item->WarnInfo)
                                        class="bg-danger"
                                        @elseif (!$item->tarif)
                                        class="bg-gray-300 tx-white tx-bold"
                                        
                                    @endif>
                                        <td >                                          
                                            @if ($item->trashed())
                                                <i class="fa fa-trash"></i>&nbsp;&nbsp;
                                            @endif 
                                            {{$item->ident}}
                                        </td>                                        
                                        <td>
                                            {{$item->FullName}}                                     
                                        </td>
                                        
                                        <td>
                                            {{$item->address}}
                                        </td>
                                        <td>{{$item->phone}}</td>
                                        <td>
                                           
                                            @if ($item->Subscriptions->first()?->tarif?->name)
                                           
                                                {{$item->Subscriptions->first()?->tarif?->name}} 
                                            @else
                                                {{$item->tarif?->name}}                                                
                                            @endif                                            
                                        </td>
                                        <td>
                                            @if ($item->Subscriptions->first())
                                                <span class="badge rounded-pill text-bg-success">{{__('Active')}}</span>
                                            @else
                                            @if ($item->InetAccess<0 || $item->CatvAccess<0)
                                                @if ($item->InetAccess<0)
                                                <span class="badge rounded-pill text-bg-success">{{__('Inet Api Active')}}</span>
                                                @else 
                                                <span class="badge rounded-pill text-bg-danger">{{__('Inet Suspended')}}</span>
                                                @endif
                                                @if ($item->CatvAccess<0)
                                                <span class="badge rounded-pill text-bg-success">{{__('TV Api Active')}}</span>
                                                @else
                                                <span class="badge rounded-pill text-bg-danger">{{__('TV Suspended')}}</span>
                                                @endif
                                            @else
                                            <span class="badge rounded-pill text-bg-danger">{{__('Suspended')}}</span>
                                            @endif
                                            @endif
                                        </td>
                                        <td>{{$item->Subscriptions->first()?->acct_end}}</td>
                                        
                                        <td></td>                                      
                                        <td ><a href="{{route('account.edit',$item->id)}}"><i class="fa fa-arrow-right"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div><div class="col-12"> {{ $accs->links() }}</div>
                </div>
            </div>
        </div>
        <livewire:modals.new-billing-account @saved="$refresh">
        <livewire:modals.set-tarif-filter>
            
</div>
