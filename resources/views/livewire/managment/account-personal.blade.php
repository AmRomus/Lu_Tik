<div>
    <x-layouts.sidebar activePage="Accounts" > </x-layouts.aside>
        <div class="content ht-100v pd-0">           
            <div class="content-body">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="df-example py-3" data-label="{{__('Full Name')}}">
                            @foreach ($errors->all() as $error)
                            <div class="input-group mb-3 text-danger">{{ $error }}</div>
                            @endforeach     
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" >{{__('First Name')}}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{__('First Name')}}" aria-label="name" name="name" wire:model.defer="first">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" >{{__('Last Name')}}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{__('Last Name')}}" aria-label="name" name="name" wire:model.defer="last">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" >{{__('Middle Name')}}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{__('Middle Name')}}" aria-label="name" name="name" wire:model.defer="middle">
                            </div>
                            
                        </div>
                        <div class="df-example py-3 mt-2" data-label="{{__('Pasport Information')}}">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" >{{__('Code')}}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{__('Code')}}" aria-label="name" name="name" wire:model.defer="passport">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" >{{__('Region')}}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{__('Region')}}" aria-label="name" name="name" wire:model.defer="passport_region">
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="flex flex-wrap -mx-2">
                                        @foreach($account->files->where('file_path','p_files') as $passport_file)
                                            <div class="w-1/2 p-2  ">
                                                <div class="w-full h-full border">
                                                    <div class="text-end mx-3" ><i class="fa fa-close" style="cursor: pointer" wire:confirm="{{__('Delete pasport image?')}}" wire:click="delete_pimage({{$passport_file->id}})"></i></div>   
                                                    <img width="200px" src="{{ route('get_passport_image',$passport_file->id) }}">                                                                                                  
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <form wire:submit.prevent="save_passport">
                                    <div class="input-group mb-3 ">
                                        <input type="file" wire:model="p_file" class="form-control"  accept="image/*">
                                        <div>
                                            @error('p_file') <span class="text-sm text-red-500 italic">{{ $message }}</span>@enderror
                                        </div>
                                        <div wire:loading wire:target="p_file" class="text-sm text-gray-500 italic">Uploading...</div>
                                        <button type="submit" class="font-bold py-2 px-4 rounded border">Save Photo</button>
                                    </div>
                    
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="df-example py-3" data-label="{{__('Contact information')}}">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" >{{__('Ident')}}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{__('Ident')}}" aria-label="name" name="name" wire:model.live="ident">
                                <button class="btn btn-sm btn-success" wire:click="mk_ident">{{__('Gen')}}</button>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" >{{__('Phone')}}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{__('Phone')}}" aria-label="name" name="name" wire:model.defer="phone">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" >{{__('Email')}}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{__('Email')}}" aria-label="name" name="name" wire:model.defer="email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="df-example" data-label="{{__('Customer files')}}">
                            <form wire:submit.prevent="save_u_file">
                                <div class="input-group mb-3 ">
                                    <input type="file" wire:model="u_file" class="form-control" >
                                    <div>
                                        @error('u_file') <span class="text-sm text-red-500 italic">{{ $message }}</span>@enderror
                                    </div>
                                    <div wire:loading wire:target="u_file" class="text-sm text-gray-500 italic">Uploading...</div>
                                    <button type="submit" class="font-bold py-2 px-4 rounded border">Upload</button>
                                </div>
                            </form>
                            <table class="table table-hover">
                                @foreach($account->files->where('file_path','user_files') as $user_file)
                                <tr>
                                    <td>{{$user_file->file_name}}</td>
                                    <td class="text-danger text-center" wire:click="delete_file({{$user_file->id}})" wire:confirm="{{__('Delete file')}}" style="cursor: pointer"> {{__('Delete')}}</td>
                                    <td class="text-end"><a href="{{route('get_file',$user_file->id)}}" class="nav-link">{{__('Download')}}</a></td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
