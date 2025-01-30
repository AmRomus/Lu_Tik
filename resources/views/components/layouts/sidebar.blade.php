@props(['activePage'])
<aside class="aside aside-fixed" > 
    <div class="aside-header">
        <a href="/" class="aside-logo"><img src="/imgs/logo.png" width="180" alt=""></a>       
        <a href="" class="aside-menu-link">
          <i data-feather="menu"></i>
          <i data-feather="x"></i>
        </a>       
    </div>
    <div class="aside-body" >
        <div class="aside-loggedin">
            <div class="d-flex align-items-center justify-content-start">
                <a href="" class="avatar"><img src="https://placehold.co/387" class="rounded-circle" alt=""></a>
                <div class="aside-alert-link dropdown dropdown-message">
                  <a href="#" ><i data-feather="message-square"></i></a>
                  <a href="{{route('support.my.tasks')}}" class="dropdown-link @if(auth()->user()->MyTicketsCount>0) new-indicator @endif" ><i data-feather="bell"></i>@if(auth()->user()->MyTicketsCount>0) <span>{{auth()->user()->MyTicketsCount}}</span> @endif</a>
                  <a href="#" data-bs-toggle="tooltip" title="Sign out"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-out"></i></a>
                </div>
            </div>
              <form method="POST" id="logout-form" action="{{ route('logout') }}">
               @csrf
              </form>
            <div class="aside-loggedin-user">
                <a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2" data-bs-toggle="collapse">
                  <h6 class="tx-semibold mg-b-0">{{auth()->user()->name}}</h6>
                  <i data-feather="chevron-down"></i>
                </a>
                <p class="tx-color-03 tx-12 mg-b-0">{{auth()->user()->roles?->first()?->name}} | {{__('Balance')}}:{{auth()->user()->balance}}</p>
                
            </div>
            <div class="collapse" id="loggedinMenu">
                <ul class="nav nav-aside mg-b-0">             
                  <li class="nav-item"><a href="" class="nav-link"><i data-feather="log-out"></i> <span>Sign Out</span></a></li>
                </ul>
            </div>
        </div><!-- aside-loggedin -->
        <ul class="nav nav-aside">
          <li class="nav-label">{{__('Managment')}}</li>
          <li class="nav-item {{ ($activePage === 'Accounts') ? 'active' : '' }} ">
            <a href="{{route('accounts.list')}}" class="nav-link" wire:navigate> 
              <i data-feather="users"></i> <span>{{__('Accounts')}}</span>
            </a>
           </li>
           <li class="nav-item {{($activePage === 'Addresses')? 'active':''}}">
            <a href="{{route('addressbook')}}" class="nav-link">
              <i data-feather="navigation"></i> <span>{{__('Addresses')}}</span>
            </a>
          </li>
           <li class="nav-label">{{__('Support')}}</li>
           <li class="nav-item  {{ ($activePage === 'NewCons') ? 'active' : '' }} ">
            <a href="{{route('support.new')}}" class="nav-link">
              <i data-feather="user-check"></i> <span>{{__('New Connections')}} ({{App\Models\SupportTicket::Connections()->count()}})</span>
            </a>
           </li>
           <li class="nav-item {{ ($activePage === 'ServiceTickets') ? 'active' : '' }}">
            <a href="{{route('support.tickets.service',1)}}" class="nav-link">
              <i data-feather="frown"></i> <span>{{__('Need support')}} ({{App\Models\SupportTicket::support()->count()}})</span>
            </a>
           </li>
           <li class="nav-item {{ ($activePage === 'UninstallTickets') ? 'active' : '' }}">
            <a href="{{route('support.tickets.service',2)}}" class="nav-link">
              <i data-feather="user-x"></i> <span>{{__('Uninstall')}} ({{App\Models\SupportTicket::uninstall()->count()}})</span>
            </a>
           </li>
           <li class="nav-item {{ ($activePage === 'WaitConfirm') ? 'active' : '' }}">
            <a href="{{route('support.ticket.needconfirm')}}" class="nav-link">
              <i data-feather="user-x"></i> <span>{{__('Unconfirmed')}} ({{App\Models\SupportTicket::waitConfirm()->count()}})</span>
            </a>
           </li>
           
           <li class="nav-label">{{__('Finances')}}</li>
          <li class="nav-item {{ ($activePage === 'Tarifs') ? 'active' : '' }} ">
            <a href="{{route('tarifs')}}" class="nav-link"> 
              <i data-feather="dollar-sign"></i> <span>{{__('Tarifs')}}</span>
            </a>
           </li>
          <li class="nav-label">{{__('Configurations')}}</li>
          <li class="nav-item {{($activePage ==='Mikrotiks')? 'active':'' }}" >
            <a href="{{route('mikrotik.list')}}" class="nav-link"> 
              <i data-feather="server"></i> <span>{{__('Mikrotiks')}}</span>
            </a>
          </li>
          <li class="nav-item {{($activePage ==='Olts')? 'active':'' }}" >
            <a href="{{route('olt.list')}}" class="nav-link"> 
              <i data-feather="server"></i> <span>{{__('Olts')}}</span>
            </a>
          </li>          
          <li class="nav-item {{($activePage ==='inetdevices')? 'active':'' }}" >
            <a href="{{route('inetdevices')}}" class="nav-link" wire:navigate> 
              <i data-feather="hard-drive"></i> <span>{{__('Routers')}}</span>
            </a>
          </li>
          <li class="nav-label">{{__('IPTV')}}</li>
          <li class="nav-item {{($activePage ==='iptv_streams')? 'active':'' }}" >
            <a href="{{route('iptv.streams')}}" class="nav-link"> 
              <i data-feather="airplay"></i> <span>{{__('Streams')}}</span>
            </a>
          </li>
          <li class="nav-item {{($activePage ==='iptv_playlists')? 'active':'' }}" >
            <a href="{{route('iptv.playlists')}}" class="nav-link"> 
              <i data-feather="list"></i> <span>{{__('Play Lists')}}</span>
            </a>
          </li>
          <li class="nav-label">{{__('Company managment')}}</li>
          <li class="nav-item {{($activePage ==='companies')? 'active':'' }}" >
            <a href="{{route('companies.list')}}" class="nav-link"> 
              <i data-feather="slack"></i> <span>{{__('Companies')}}</span>
            </a>
          </li>
          <li class="nav-item {{($activePage ==='workers')? 'active':'' }}" >
            <a href="{{route('companies.workers')}}" class="nav-link"> 
              <i data-feather="user"></i> <span>{{__('Workers')}}</span>
            </a>
          </li>
        </ul>
    </div>
</aside>