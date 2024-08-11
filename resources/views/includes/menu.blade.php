<body>
    <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:#f9f9f9">
            <h5 id="application_name">CollectiveSaver</h5>
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
                            {{ get_data('user_name'); }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="margin-left:20px !important">
                            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-2">
            <button class="toggle-sidebar-btn" id="toggleSidebar"><i class="fas fa-bars"></i></button>
            <div class="sidebar border-right" style="background-color: #f9f9f9">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Users</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="settingsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Settings
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                            <li><a class="dropdown-item" href="#">General</a></li>
                            <li><a class="dropdown-item" href="#">Security</a></li>
                            <li><a class="dropdown-item" href="#">Notifications</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-10" style="margin-top: 70px !important" id="mainContent">




