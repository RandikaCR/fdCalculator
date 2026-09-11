<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ url('/admin') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/common/images/logo_admin_mini.png') }}" alt="" height="40">
                    </span>
            <span class="logo-lg">
                        <img src="{{ asset('assets/common/images/logo_admin.png') }}" alt="" height="40">
                    </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ url('/admin') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/common/images/logo_admin_mini.png') }}" alt="" height="40">
                    </span>
            <span class="logo-lg">
                        <img src="{{ asset('assets/common/images/logo_admin.png') }}" alt="" height="40">
                    </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->segment(2) == '') ? 'active' : '' }}" href="{{ url('/admin') }}">
                        <i class="mdi mdi-speedometer"></i> <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>


                <li class="menu-title"><span data-key="t-menu">Clients</span></li>


                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarClients" data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->segment(2) == 'players') ? 'true' : 'false' }}" aria-controls="sidebarClients">
                        <i class="mdi mdi-gift"></i> <span data-key="t-raffles-main">Clients</span>
                    </a>
                    <div class="collapse menu-dropdown {{ (request()->segment(2) == 'clients') ? 'show' : '' }}" id="sidebarClients">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('/admin/clients') }}" class="nav-link {{ (request()->segment(2) == 'clients' && request()->segment(3) == '') ? 'active' : '' }}" data-key="t-players">All Clients</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/clients/create') }}" class="nav-link {{ (request()->segment(2) == 'clients' && request()->segment(3) == 'create') ? 'active' : '' }}" data-key="t-client-add">Add New</a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="menu-title"><span data-key="t-system">Settings</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->segment(2) == 'application-settings') ? 'active' : '' }}" href="{{ url('/admin/application-settings') }}">
                        <i class="mdi mdi-account-details"></i> <span data-key="t-application-settings">Application Settings</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->segment(2) == 'rates') ? 'active' : '' }}" href="{{ url('/admin/rates') }}">
                        <i class="mdi mdi-account-details"></i> <span data-key="t-rates">Rates</span>
                    </a>
                </li>

                @if(isSuperAdmin())
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ (request()->segment(2) == 'users') ? 'active' : '' }}" href="{{ url('/admin/users') }}">
                            <i class="mdi mdi-account-details"></i> <span data-key="t-users">Users</span>
                        </a>
                    </li>
                @endif


            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
