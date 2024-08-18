<body>
    <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:#f9f9f9">
            <h5 id="application_name">{{ $system->application_name }}</h5>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav" style="margin-left: 80%">
                    <!-- Profile image -->
                    <li class="nav-item" >
                        <img src="#" class="rounded-circle" alt="Image"
                            style="height: 30px; width:30px">
                    </li>
                    <!-- Dropdown menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ get_data('user_name') }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="margin-left:20px !important">
                            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-2">
            <button class="toggle-sidebar-btn" id="toggleSidebar"><i class="fas fa-bars"></i></button>
            <div class="sidebar border-right" style="background-color: #f9f9f9">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center {{ request()->is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center {{ request()->is('groups') ? 'active' : '' }}" href="#fundsCollapse" data-bs-toggle="collapse" aria-expanded="false" aria-controls="fundsCollapse">
                            <i class="fas fa-wallet"></i>
                            Funds
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="fundsCollapse">
                            <a class="nav-link" href="#">Individual</a>
                            <a class="nav-link {{ request()->is('groups') ? 'active' : '' }}" href="{{ route('groups') }}">Group</a>
                        </div>
                    </li>

                    @if( $data->is_admin == 1 )
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center {{ request()->is('settings') ? 'active' : '' }}" href="#">
                                <i class="fas fa-cog"></i>
                                Settings
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

        </div>

        <div class="col-md-10" style="margin-top: 70px !important" id="mainContent">




