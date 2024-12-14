<div>
    <x-layouts.sidebar activePage="workers" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('Workers')}}</h4>
                <nav class="nav">
                    <a href="#" class="btn btn-sm btn-success tx-bold" wire:click="$dispatchTo('modals.new-inet-device','show_modal')"> {{__('New')}}</a>
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
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{($user->ServiceCompany)?$user->ServiceCompany->Name:__('Not set')}}</td>
                                        <td>{{$user->Role}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
