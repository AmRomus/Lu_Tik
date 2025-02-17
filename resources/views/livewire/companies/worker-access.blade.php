<div>
<x-layouts.sidebar activePage="Positions" > </x-layouts.aside>
    <div class="content ht-100v pd-0">
        <div class="content-header">
            <h4>{{__('Positions')}}</h4>
            <nav class="nav">
                <a href="#" class="btn btn-sm btn-success tx-bold" wire:click="$dispatchTo('modals.new-worker-modal','show_modal')"> {{__('New')}}</a>
            </nav>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-hover table-dashboard">
                        <thead class="bg-gray-100">
                            <th>{{__('Position')}}</th>
                            <th>{{__('Permissions')}}</th>
                            <th style="width: 100px;"></th>
                        </thead>
                        <tbody>
                            @foreach ($all_roles as $item)
                                <tr>
                                    <td>
                                        {{$item->name}}
                                    </td>
                                    <td>
                                        @foreach ($item->permissions as $p)
                                            {{$p->name}},
                                        @endforeach                                        
                                    </td>
                                    <td>
                                        <span style="cursor: pointer" wire:click="$dispatchTo('modals.edit-roles','show_modal',{ role: {{$item->id}} })">
                                            <i data-feather="tool" style="width: 15px;"></i>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <livewire:modals.edit-roles @saved="$refresh" />
</div>   