<div>
    <x-layouts.sidebar activePage="Addresses" > </x-layouts.aside>
        <div class="content ht-100v pd-0">
            <div class="content-header">
                <h4>{{__('Addresses')}}</h4>
                <p>{{$selected?->FullAddress}}</p>
                <nav class="nav">
                    <a href="#" class="btn btn-sm btn-success tx-bold" wire:click="$dispatchTo('modals.new-address','show_modal',{ parent:{{$sid?->id}}})"> {{__('New Unit')}}</a>
                   
                    @if ($selected&&count($sid?->children)==0)
                    
                    <a href="#" class="ms-2 btn btn-sm btn-danger tx-bold" wire:confirm="{{__('Are you sure want delete this unit ?')}}" wire:click="delete"> {{__('Delete Unit')}}</a>
                    @endif
                  </nav>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12 table-resposive" wire:ignore>
                        <ul id="tree1" >
                            @forelse($addr as $category)
                            <li class="" id="cat_{{$category->id}}">
                                <a href="#" onClick="unit_click_load({{$category->id}})" > {{ $category->unit }}</a>
                                @if(count($category->children)>0)<i class="fa fa-plus"></i> @else <i class="fa fa-minus"></i> @endif
                             
                            </li>                   
                                @empty
                                <li class="nav-label">
                                    {{__('No address registred')}}
                                 </li>
                            @endforelse
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <livewire:modals.new-address >
        @push('js')
        <script  type="module">
            $.fn.extend({
                treed: function (o) {
                  
                  var openedClass = 'fa-minus';
                  var closedClass = 'fa-plus';
                  
                  if (typeof o != 'undefined'){
                    if (typeof o.openedClass != 'undefined'){
                    openedClass = o.openedClass;
                    }
                    if (typeof o.closedClass != 'undefined'){
                    closedClass = o.closedClass;
                    }
                  };
                  
                    /* initialize each of the top levels */
                    var tree = $(this);
                    tree.addClass("tree");
                    tree.find('li').has("ul").each(function () {
                        var branch = $(this);
                        branch.addClass('branch');
                      
                       if(!branch.data('event-click-assigned')){
                        branch.on('click', function (e) {
                             if (this == e.target) {
                                 console.log(e);
                                 var icon = $(this).children('i:first');
                                 icon.toggleClass(openedClass + " " + closedClass);
                                 $(this).children().children().toggle();
                                
                               
                             }                
                         })
                            branch.data('event-click-assigned', true);
                        }
                    })
        
                     tree.find('.branch>a').each(function () {
                        if(!$(this).data('event-click-assigned')){
                            $(this).on('click', function (e) {
                                 $(this).closest('li').click();
                                                              
                                e.preventDefault();
                             });
                        $(this).data('event-click-assigned', true);
                         }
                     });
     
                }
            });        
        $('#tree1').treed();       
        </script>
        <script>
            Livewire.on('saved', ({ c_id }) => {
             console.log(c_id);
             $.ajax({
                url: "/misc/address/"+c_id+"/childs",
                success: function(data) {
                            $('#cat_'+c_id).html(data); 
                            $('#tree1').treed();
                       },
                error: function( xhr, status, errorThrown ) {
                       alert( "Sorry, there was a problem!" );
                       console.log( "Error: " + errorThrown );
                       console.log( "Status: " + status );
                       console.dir( xhr );
                       },
                   });
               
            })
        function unit_click(c_id)
           {
            Livewire.dispatch('select_address',{id:c_id});
            }
        function unit_click_load(c_id)
            {
            console.log(c_id);
            Livewire.dispatch('select_address',{id:c_id});
            $.ajax({
                url: "/misc/address/"+c_id+"/childs",
                success: function(data) {
                            $('#cat_'+c_id).html(data); 
                            $('#tree1').treed();
                       },
                error: function( xhr, status, errorThrown ) {
                       alert( "Sorry, there was a problem!" );
                       console.log( "Error: " + errorThrown );
                       console.log( "Status: " + status );
                       console.dir( xhr );
                       },
                   })
               }
        </script>
        @endpush
        <style> 
            .tree, .tree ul {
                margin:0;
                padding:0;
                list-style:none
            }
            .tree ul {
                margin-left:1em;
                position:relative
            }
            .tree ul ul {
                margin-left:.5em
            }
            .tree ul:before {
                content:"";
                display:block;
                width:0;
                position:absolute;
                top:0;
                bottom:0;
                left:0;
                border-left:1px solid
            }
            .tree li {
                margin:0;
                padding:0 1em;
                line-height:2em;
                color:#369;
                font-weight:700;
                position:relative
            }
            .tree ul li:before {
                content:"";
                display:block;
                width:10px;
                height:0;
                border-top:1px solid;
                margin-top:-1px;
                position:absolute;
                top:1em;
                left:0
            }
            .tree ul li:last-child:before {
                background:#fff;
                height:auto;
                top:1em;
                bottom:0
            }
            .indicator {
                margin-right:5px;
            }
            .tree li a {
                text-decoration: none;
                color:#369;
            }
            .tree li a.selected {
                text-decoration: none;
                color:rgb(230, 16, 16);
            }
            .tree li button, .tree li button:active, .tree li button:focus {
                text-decoration: none;
                color:#369;
                border:none;
                background:transparent;
                margin:0px 0px 0px 0px;
                padding:0px 0px 0px 0px;
                outline: 0;
            }
            
            </style>
</div>
