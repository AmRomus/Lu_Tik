<div class="modal fade @if($show) show bg-black-8 @endif "  role="dialog" aria-hidden="true"   >
    <div class="modal-dialog modal-dialog-centered" role="document" x-on:click.away="$dispatch('hide_modal')">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3">{{__('Tickets History')}}</h4>  
            <a href="" class="close pos-absolute t-15 r-15" wire:click.prevent="hide_modal" >
                <span aria-hidden="true">&times;</span>
              </a>
        </div>
        <div class="modal-body">            
            @if ($ticket_list)
            <div class="table table-responsive">
            <table class="table table-hover table-dashboard ">
                <thead>
                    <tr>
                        <th>{{__('Date')}}</th>
                        <th>{{__('Type')}}</th>
                        <th>{{__('Description')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($history as $u)
                    <tr>
                        <td>{{$u->created_day}}</td>
                        <td>{{$u->ticket_type->name}}</td>
                        <td class="text-wrap">
                            <div>
                            <strong> {{__('Ticket ')}}#{{$u->id}} </strong> - {{$u->description}}
                            </div>
                            <div class="row  bd-2 bd-r-0 bd-l-0 bd-b-0 ">
                                <div class="col">
                                   <strong> &copy;{{$u->User?->name}} </strong>
                                </div>
                                <div class="col text-end">
                                    <span class="tx-primary" style="cursor: pointer" wire:click="show_ticket({{$u->id}})">>>></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" align="middle">{{__('No acctions found')}}</td>
                    </tr>                    
                    @endforelse
                </tbody>
            </table>
            </div>
            @else
            <div class="df-example" data-label="{{__('Ticket')}} #{{$ticket?->id}}">
                <div class=" marker marker-ribbon marker-top-right pos-absolute r-0 t-0 bg-danger text-white px-1 rounded">
                    {{$ticket?->duration}}
                  </div> 
                  <div class="mt-3 bd-b">
                    {{$ticket?->description}}
                  </div>
                  <div class="tx-bold">
                    {{__('Solved by')}}: @foreach ($ticket?->users as $item)
                        {{$item?->name}},
                    @endforeach
                  </div>
                  <div class="w-100 text-end">
                    <button class="btn btn-xs btn-success" wire:click="to_list">{{__('OK')}}</button>
                  </div>  
            </div>
            @endif
          
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->