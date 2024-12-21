<div class="modal fade @if($show) show @endif "  role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">        
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="tx-18 tx-sm-20 mg-b-3">{{__('New Worker')}}</h4>  
            <a href="" class="close pos-absolute t-15 r-15" wire:click.prevent="show_modal" >
                <span aria-hidden="true">&times;</span>
              </a>
        </div>
        <div class="modal-body pd-20 pd-sm-30">          
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('User Name')}}</span>
                </div>
                <input type="text" class="form-control" placeholder="Անուն Ազգանուն՝" aria-label="name" name="name" wire:model.defer="name">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Email')}}</span>
                </div>
                <input type="email" class="form-control" placeholder="Էլ հասցե՝" aria-label="email" name="email" wire:model.live="email">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Password')}}</span>
                </div>
                <input type="password" class="form-control" aria-label="password" name="password" wire:model.defer="password" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Company')}}</span>
                </div>
                <select class="form-control" wire:model.defer="service_company_id">
                    @foreach ($company_list as $item)
                        <option value="{{$item->id}}">{{$item->Name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >{{__('Roles')}}</span>
                </div>
                <select class="form-control" wire:model.defer="role">
                    @foreach ($roles as $item)
                        <option value="{{$item->name}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
          <div class="d-flex justify-content-end mg-t-30 mg-b-0">
            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal" wire:click="show_modal">{{__('Cencel')}}</button>
            <button type="button" class="btn  btn-xs btn-primary mg-l-5" wire:click="save">{{__('Save')}}</button>
          </div>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->