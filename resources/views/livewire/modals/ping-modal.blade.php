<div class="modal fade @if($show) show @endif "  role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3">{{__('Ping to ')}}@if ($netdev) {{$netdev->ip}}
                
            @endif</h4>  
            <a href="" class="close pos-absolute t-15 r-15" wire:click.prevent="show_modal" >
                <span aria-hidden="true">&times;</span>
              </a>
        </div>
        <div class="modal-body pd-20 pd-sm-30">
            <div class="row">
                <div class="col-10">
                    <div wire:loading>Processing ...</div>
                    <div wire:loading.remove>
                        @if ($ping_array)
                        <table class="table table-hover">                            
                          @foreach ($ping_array as $item)
                          <tr>
                            <td>@if (array_key_exists("host",$item))
                                {{$item["host"]}} 
                            @endif</td>
                            <td>
                                @if (array_key_exists("status",$item))
                                {{$item["status"]}}
                                @elseif (array_key_exists("time",$item))
                                {{$item["time"]}}
                                @endif
                            </td>
                          </tr>
                          @endforeach  
                        </table>
                        @endif
                    </div>   
                </div>
                <div class="col text-end">
                    <button class="btn btn-sm btn-success" wire:click="ping_dev">Ping</button>
                </div>
            </div>
               
        </div><!-- modal-body -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->    
</div>
