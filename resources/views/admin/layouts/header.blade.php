<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/admin') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>KCB</b>Room</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>KCB</b>Room</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="user user-menu">
                    <a href="#">
                        <span class="hidden-xs"></span>
                    </a>
                </li>
                <li class="user user-menu">
                    <a href="{{ url('/') }}">
                        <span class="hidden-xs">Back to Desktop</span>
                    </a>
                </li>
                <li class="user user-menu">
                    <a href="{{ url('/logout') }}">
                        <span class="hidden-xs">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>