<div>
    <x-layouts.sidebar activePage="workers" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('Workers')}}</h4>
                <nav class="nav">
                    <a href="#" class="btn btn-sm btn-success tx-bold" wire:click="$dispatchTo('modals.new-worker-modal','show_modal')"> {{__('New')}}</a>
                </nav>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-hover table-dashboard">
                            <thead>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Company')}}</th>
                                <th>{{__('Role')}}</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{($user->ServiceCompany->count()>0)?$user->ServiceCompany->pluck('Name'):__('Not set')}}</td>
                                        <td>{{$user->roles?->pluck('name')}}</td>
                                        <td class="d-flex">                                            
                                            <i class="fa fa-trash" style="cursor: pointer" wire:confirm="{{__('Delete user ?')}}" wire:click="delete({{$user->id}})"></i>
                                            <a href="{{route('company.user.edit',$user->id)}}" class="nav-link"><i class="fa fa-edit mx-3"  style="cursor: pointer"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <livewire:modals.new-worker-modal @saved="$refresh" />
</div>
