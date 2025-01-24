<div class="col-lg-3 col-md-3 col-sm-3 col-12 ps-1" style="min-width:260px">
    <div class="card card-body" >
        @if ($item->planed_time)                        
        <div class="marker marker-ribbon marker-top-right pos-absolute  r-0 t-2 @if(!$item->expired) bg-warning @else bg-danger @endif tx-white" style="width:200px; cursor: pointer;" >
            <div class="dropdown">
            <a href="#" class="dropdown-toggle nav-link @if(!$item->expired) text-black @else text-white @endif"  id="ticket_button_{{$item->id}}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{$item->planed_time}}
            </a>
            <div class="dropdown-menu" aria-labelledby="ticket_button_{{$item->id}}">                             
                <a href="#" wire:click.prevent="$dispatchTo('modals.change-ticket-descr','show_modal',{tid:{{$item->id}}})" class="dropdown-item tx-10 tx-primary" >{{__('Edit Text')}}</a>
                <a href="#" wire:click.prevent="$dispatchTo('modals.change-ticket-day','show_modal',{tid:{{$item->id}}})" class="dropdown-item tx-10 tx-primary" >{{__('Edit Date')}}</a>
                <a href="#" wire:click.prevent="$dispatchTo('modals.close-ticket','show_modal',{tid:{{$item->id}}})" class="dropdown-item tx-10 tx-success" >{{__('Close')}}</a>
             <a href="#" class="dropdown-item tx-10 tx-danger" wire:confirm="{{__('Are you whant delete  ticket  #'.$item->id.'?')}}" wire:click.prevent="delete_ticket({{$item->id}})">{{__('Delete')}}</a>
            </div>
          </div> 
        </div> 
        @endif  
        @if ($item->SupportType)
        <div class="marker marker-ribbon marker-top-right pos-absolute  r-0 t-30  bg-{{$item->SupportType?->bg_color}} tx-{{$item->SupportType?->tx_color}}" style="width:200px; cursor: pointer;" >
          {{$item->SupportType?->name}}
        </div> 
        @endif
        <div class="mt-5">
           <strong> {{$item->BillingAccount?->address}} </strong>
        </div>                           
        <div class="mt-2 text-end">
          <a href="tel:{{$item->BillingAccount?->phone}}">{{$item->BillingAccount?->phone}}</a>  
        </div>
        <div class="pos-absolute d-flex ">                              
                <div class="pd-sm-l-10">
                    <div class="img-group img-group-sm">
                        @foreach ($item->Users as $user)
                        <img src="/imgs/noavatar.png" style="width: 25px" class="img rounded-circle" alt="{{$user->name}}" data-bs-toggle="tooltip" title="{{$user->name}}" >
                        @endforeach
                    </div>
                </div>
                <div class="mg-l-auto text-end">
                    <a href="#" class="nav-link" wire:click.prevent="$dispatchTo('modals.set-ticket-users','show_modal',{ tik: {{$item->id}} })"><i class="fa fa-plus"></i></a>
                </div>                                  
        </div>
        <div class="mt-2  bd-t">
            {{$item->description}}
        </div>
        <div class="mt-2">
            <li class="list-group-item d-flex pd-sm-x-20">
                <div class="d-flex w-100">
                    <div class="w-50" style="cursor: pointer" wire:click="$dispatchTo('modals.short-history','show_modal',{ obj: '{{class_basename($item)}}',id: {{ $item->id}} })">
                        <i class="fa fa-history"></i>  ({{$item->AcctionsHistory->count()}})
                    </div>
                    <div class="text-end w-50" wire:click="toggle_comments" style="cursor: pointer">
                        <i class="fa fa-comment"></i>  ({{$item->TicketComment->count()}})
                    </div>
                </div>
             </li>
             @if ($allow_comment)
             <li class="list-group-item d-flex pd-sm-x-20">
                <ul>
                @foreach ($comments as $c)
                 <li class="bd-b">
                    {{$c->comment}}
                    <p class="tx-gray-500 tx-9">{{$c->TimeLeft}} <span class="tx-gray-900">&copy; {{$c->User?->name}}</span></p>
                </li>
                @endforeach
               
                <li>
                    <textarea name="comment_text" wire:model.defer="comment_text" cols="30" rows="3" class="form-control"></textarea>
                    <div class="w-100 mt-2 text-end">
                        <button class="btn btn-xs btn-primary" wire:click="add_comment">{{__('Send')}}</button>
                    </div>
                </li> 
                
                </ul>
             </li>
             @endif
        </div>
    </div>
</div>