<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('/adminlte3/dist/img/user2-160x160.jpg') }}"
                    class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header">
                    <img src="{{ asset('/adminlte3/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                    <p>
                        {{ Auth::user()->name }}
                        
                    <div><span class="badge badge-success">{{ Auth::user()->getRoleNames()->implode(', ') }}</span></div>
                    </p>
                </li>
                <!-- Menu Body -->

                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                    {{-- <a href="{{route('logout')}}" class="btn btn-default btn-flat float-right">Sign out</a> --}}
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="btn btn-default btn-flat float-right">
                        Sign out
                    </a>

                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
