@props(['activePage'])
<aside class="aside aside-fixed"> 
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
                <div class="aside-alert-link">
                  <a href="#" ><i data-feather="message-square"></i></a>
                  <a href="#" ><i data-feather="bell"></i></a>
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
                <p class="tx-color-03 tx-12 mg-b-0">{{auth()->user()->roles?->first()?->name}}</p>
            </div>
            <div class="collapse" id="loggedinMenu">
                <ul class="nav nav-aside mg-b-0">             
                  <li class="nav-item"><a href="" class="nav-link"><i data-feather="log-out"></i> <span>Sign Out</span></a></li>
                </ul>
            </div>
        </div><!-- aside-loggedin -->
        <ul class="nav nav-aside">
            <li class="nav-label">Բաժանորդներ</li>
            <li class="nav-item {{ ($activePage === 'Accounts') ? 'active' : '' }} ">
             <a href="#" class="nav-link"> 
               <i data-feather="users"></i> <span>Ցանկ</span>
             </a>
            </li>
        </ul>
    </div>
</aside>