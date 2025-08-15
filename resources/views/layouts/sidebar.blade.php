<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a wire:navigate href="{{route('home')}}" class="brand-link">
      <img src="{{ asset('adminlte3/dist/img/AdminLTELogo.png')}} " alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Pizza</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @can('view dashboard')
          <li class="nav-item">
            <a wire:navigate href="{{ route('dashboard') }}" class="nav-link @yield('menuDashboard')">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          @endcan
                   
          <li class="nav-header">SUPER ADMIN</li>
          @can('view user')
          <li class="nav-item">
            <a wire:navigate href="{{ route('superadmin.user.index') }}" class="nav-link @yield('menuSuperadminUser')">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          @endcan

          @can('view category')
          <li class="nav-item">
            <a wire:navigate href="{{ route('superadmin.category.index') }}" class="nav-link @yield('menuSuperadminCategory')">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Category
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>              
          @endcan

          @can('view product')
          <li class="nav-item">
            <a wire:navigate href="{{ route('superadmin.product.index') }}" class="nav-link @yield('menuSuperadminProduct')">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Product
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          @endcan

          <li class="nav-header">ADMINISTRATION</li>

          @can('view role')
          <li class="nav-item">
            <a wire:navigate href="{{ route('superadmin.role.index') }}" class="nav-link @yield('menuSuperadminRole')">
              <i class="nav-icon fas fa-user-tag"></i>
              <p>
                Roles
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          @endcan

          @can('view permission')
          <li class="nav-item">
            <a wire:navigate href="{{ route('superadmin.permission.index') }}" class="nav-link @yield('menuSuperadminPermission')">
              <i class="nav-icon fas fa-lock"></i>              
              <p>
                Permissions
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          @endcan
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>