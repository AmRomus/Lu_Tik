<div>
    <x-layouts.sidebar activePage="Mikrobill" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('MikroBill')}}</h4>
                <nav class="nav">
                    <a href="#" class="btn btn-sm btn-success tx-bold" wire:click="$dispatchTo('modals.new-mikro-bill','show_modal')"> {{__('New Mikrobill')}}</a>
                  </nav>
            </div>
            <div class="content-body">
            </div>
        </div>

    <livewire:modals.new-mikro-bill @saved="$refresh">
</div>
