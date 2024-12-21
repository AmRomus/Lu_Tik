<div class="modal fade @if($show) show @endif"  role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document" wire:click.outside="hide_modal">
      <div class="modal-content"> 
        <div class="modal-body">
            <div class="row d-flex mb-3">
                <div class="media align-items-center">
                    <div class="wd-35 ht-35 bd bd-2 bd-success tx-success rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex">
                      <i data-feather="home" style="cursor: pointer"></i>
                    </div>
                    <div class="media-body mg-sm-l-15">
                      <p class="tx-medium mg-b-0">{{$selected_address}}</p>
                      <p class="tx-14 tx-bold mg-b-0 tx-color-00"></p>
                    </div><!-- media-body -->
                  
                  <div class="text-end tx-rubik">                   
                    <div class="wd-35 ht-35 bd bd-2 bd-success tx-success rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex" wire:click.prevent="set_address">
                        <i  style="cursor: pointer">OK</i>
                      </div>                  
                  </div> 
                </div><!-- media -->
            </div>
          <div class="bd" wire:ignore>
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
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
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

    function unit_click(c_id)
       {
        Livewire.dispatchTo('modals.edit-contacts','select_address',{id:c_id});
        console.log(c_id);
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
  </div><!-- modal -->