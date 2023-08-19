<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('dashboard/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Website Name</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dashboard/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
            </ul>
          </li>
          @canany(['Read-Admins','Create-Admins','Read-Users','Create-Users'])
          <li class="nav-header">Human Resources</li>
          @canany(['Read-Admins','Create-Admins'])
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-user"></i>
              <p>
                Admins
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                @can('Create-Admins')
                    <li class="nav-item">
                        <a href="{{route('admins.create')}}" class="nav-link">
                        <i class="far fa-plus-square"></i>
                        <p>Create</p>
                        </a>
                    </li>
                @endcan
                @can('Read-Admins')
                    <li class="nav-item">
                        <a href="{{route('admins.index')}}" class="nav-link">
                        <i class="fas fa-list-ul"></i>
                        <p>Index</p>
                        </a>
                    </li>
                @endcan
            </ul>
          </li>
          @endcanany
          @canany(['Read-Users','Create-Users'])
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-user"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                @can('Create-Users')
                    <li class="nav-item">
                        <a href="{{route('users.create')}}" class="nav-link">
                        <i class="far fa-plus-square"></i>
                        <p>Create</p>
                        </a>
                    </li>
                @endcan
                @can('Read-Users')
                    <li class="nav-item">
                        <a href="{{route('users.index')}}" class="nav-link">
                        <i class="fas fa-list-ul"></i>
                        <p>Index</p>
                        </a>
                    </li>
                @endcan
            </ul>
          </li>
          @endcanany
          @endcanany
          @canany(['Read-Roles','Create-Roles','Read-Permissions','Create-Permissions'])
          <li class="nav-header">Roles & Permissions</li>
          @canany(['Read-Roles','Create-Roles'])
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-user-tag"></i>
              <p>
                Roles
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                @can('Create-Roles')
                    <li class="nav-item">
                        <a href="{{route('roles.create')}}" class="nav-link">
                        <i class="far fa-plus-square"></i>
                        <p>Create</p>
                        </a>
                    </li>
                @endcan
                @can('Read-Roles')
                    <li class="nav-item">
                        <a href="{{route('roles.index')}}" class="nav-link">
                        <i class="fas fa-list-ul"></i>
                        <p>Index</p>
                        </a>
                    </li>
                @endcan
            </ul>
          </li>
          @endcanany
          @canany(['Read-Permissions','Create-Permissions'])
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-key"></i>
              <p>
                Permissions
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                @can('Create-Permissions')
                    <li class="nav-item">
                        <a href="{{route('premissions.create')}}" class="nav-link">
                        <i class="far fa-plus-square"></i>
                        <p>Create</p>
                        </a>
                    </li>
                @endcan
                @can('Read-Permissions')
                    <li class="nav-item">
                        <a href="{{route('premissions.index')}}" class="nav-link">
                        <i class="fas fa-list-ul"></i>
                        <p>Index</p>
                        </a>
                    </li>
                @endcan
            </ul>
          </li>
          @endcanany
          @endcanany
          @canany(['Read-Category','Create-Category','Read-City','Create-City'])
          <li class="nav-header">Content Management</li>
          @canany(['Read-City','Create-City'])
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-map-marker-alt"></i>
              <p>
                Cities
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                @can('Create-City')
                    <li class="nav-item">
                        <a href="{{route('cities.create')}}" class="nav-link">
                        <i class="far fa-plus-square"></i>
                        <p>Create</p>
                        </a>
                    </li>
                @endcan
                @can('Read-City')
                    <li class="nav-item">
                        <a href="{{route('cities.index')}}" class="nav-link">
                        <i class="fas fa-list-ul"></i>
                        <p>Index</p>
                        </a>
                    </li>
                @endcan
            </ul>
          </li>
          @endcanany
          @canany(['Read-Category','Create-Category'])
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-map-marker-alt"></i>
              <p>
                Categories
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                @can('Create-Category')
                    <li class="nav-item">
                        <a href="{{route('categories.create')}}" class="nav-link">
                        <i class="far fa-plus-square"></i>
                        <p>Create</p>
                        </a>
                    </li>
                @endcan
                @can('Read-Category')
                    <li class="nav-item">
                        <a href="{{route('categories.index')}}" class="nav-link">
                        <i class="fas fa-list-ul"></i>
                        <p>Index</p>
                        </a>
                    </li>
                @endcan
            </ul>
          </li>
          @endcanany
          @endcanany
          <li class="nav-header">Setting</li>
          <li class="nav-item">
            <a href="{{route('edit-profile')}}" class="nav-link active">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Edit Profile
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('edit-password')}}" class="nav-link active">
              <i class="nav-icon fas fa-lock"></i>
              <p>
                Change Password
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('logout')}}" class="nav-link active">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>