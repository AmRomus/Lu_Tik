<div>
    <x-layouts.sidebar activePage="{{$tname}}Tickets" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{$tname.__(' tickets')}}  </h4>
            </div>
            <div class="content-body">
                <div class="row">
                    @foreach ($tickets as $item)
                    <livewire:widgets.sp-ticket :tid="$item->id" :key="$item->id">
                    @endforeach                   
                </div>
            </div>
        </div>
    
        <livewire:modals.short-history> 
        <livewire:modals.change-ticket-descr @saved="$refresh">
        <livewire:modals.set-ticket-users @saved="$refresh">  
        <livewire:modals.change-ticket-day  @saved="$refresh">    
        <livewire:modals.close-ticket  @saved="$refresh">      
</div>
