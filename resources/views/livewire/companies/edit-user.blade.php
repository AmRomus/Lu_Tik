<div>
    <x-layouts.sidebar activePage="workers" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('Worker') }} {{$user->name}}</h4>
                <nav class="nav">
                    <a href="#" class="btn btn-sm btn-danger tx-bold" wire:click="delete"> {{__('Delete')}}</a>
                </nav>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-6 ">
                       <div class="card">
                        <div class="card-body">
                            <div class="input-group">
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
                            </div>
                        </div>
                       </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body">
                                <h6>{{__('Company')}}</h6>
                                <ul class="list-unstyled mg-b-0">
                                @foreach ($companies as $item)
                                    <li class="list-item">
                                        <input  type="checkbox" class="custom-control-input" wire:model.live="selected_companies" value="{{$item->id}}"  @if($selected_companies->contains($item->id)) checked @endif>
                                        {{$item->Name}}
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
</div>
