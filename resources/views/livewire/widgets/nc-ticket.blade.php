<div>
    <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">
                                
    </h6>
    <ul class="list-group list-group-flush tx-13">
        <li class="list-group-item d-flex pd-sm-x-20">
           <h6> {{$item->BillingAccount->Address}} </h6>
        </li>
        <li class="list-group-item d-flex pd-sm-x-20">
           <div class="pd-sm-l-10">ID  </div>
           <div class="mg-l-auto text-end"><a href="{{route('account.edit',$item->BillingAccount->id)}}">{{$item->BillingAccount->ident}}</a> </div>
        </li>
        <li class="list-group-item d-flex pd-sm-x-20">
            <div class="pd-sm-l-10">{{__('Name')}}</div>
            <div class="mg-l-auto text-end">{{$item->BillingAccount->FullName}}</div>
         </li>
        <li class="list-group-item d-flex pd-sm-x-20">
            <div class="pd-sm-l-10">Phone </div><div class="mg-l-auto text-end">
                @if ($item->alter_phone)
                <a href="tel:{{$item->alter_phone}}">{{$item->alter_phone}}</a>
                @else
                <a href="tel:{{$item->BillingAccount->phone}}">{{$item->BillingAccount->phone}}</a>    
                @endif
                
             </div>
         </li>
         <li class="list-group-item d-flex pd-sm-x-20">
            <div class="pd-sm-l-10">Active  </div><div class="mg-l-auto text-end">{{$item->TimeLeft}}</div>
         </li>
         <li class="list-group-item d-flex pd-sm-x-20">
            <div class="pd-sm-l-10 tx-bold">{{__('Comment')}}</div><div class="mg-l-auto text-end">
            {{$item->description}}
         </li>
         <li class="list-group-item d-flex pd-sm-x-20">
            <div class="pd-sm-l-10">
                <div class="img-group img-group-sm mg-b-5">
                    @foreach ($item->Users as $user)
                    <img src="/imgs/noavatar.png" style="width: 25px" class="img rounded-circle" alt="{{$user->name}}" data-bs-toggle="tooltip" title="{{$user->name}}" >
                    @endforeach
                </div>
            </div>
            <div class="mg-l-auto text-end">
                <a href="#" class="nav-link" wire:click.prevent="$dispatchTo('modals.set-ticket-users','show_modal',{ tik: {{$item->id}} })"><i class="fa fa-plus"></i></a>
            </div>
         </li>
         <li class="list-group-item d-flex pd-sm-x-20">
            <div class="d-flex w-100">
                <div class="w-50" style="cursor: pointer" wire:click="$dispatchTo('modals.short-history','show_modal',{ obj: '{{class_basename($item)}}',id: {{ $item->id}} })">
                    <i class="fa fa-history"></i> {{__('History')}} ({{$item->AcctionsHistory->count()}})
                </div>
                <div class="text-end w-50" wire:click="toggle_comments" style="cursor: pointer">
                    <i class="fa fa-comment"></i> {{__('Comments')}} ({{$item->TicketComment->count()}})
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
    </ul>
    
</div>
