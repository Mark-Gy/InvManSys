  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"> {{ Auth::user()->name ?? '' }} </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Menus
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href=" {{ route('dashboard') }} " class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                  <i class="fa fa-home nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{ route('users.index') }} " class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                  <i class="fa fa-user nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{ route('categories.index') }} " class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{ route('brands.index') }} " class="nav-link {{ request()->routeIs('brands.*') ? 'active' : '' }}">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Brands</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{ route('sizes.index') }} " class="nav-link {{ request()->routeIs('sizes.*') ? 'active' : '' }}">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Sizes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{ route('products.index') }} " class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{ route('stock') }} " class="nav-link {{ request()->routeIs('stock') ? 'active' : '' }}">
                  <i class="fa fa-cart-plus nav-icon"></i>
                  <p>Stocks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{ route('stockHistory') }} " class="nav-link {{ request()->routeIs('stockHistory') ? 'active' : '' }}">
                  <i class="fa fa-file nav-icon"></i>
                  <p>Stock History</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{ route('returnProduct') }} " class="nav-link {{ request()->routeIs('returnProduct') ? 'active' : '' }}">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Return Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{ route('returnProductHistory') }} " class="nav-link {{ request()->routeIs('returnProductHistory') ? 'active' : '' }}">
                  <i class="fa fa-file nav-icon"></i>
                  <p>Return Product History</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ route('sold') }}" class="nav-link {{ request()->routeIs('sold') ? 'active' : '' }}">
                  <i class="fa fa-file nav-icon"></i>
                  <p>Sold Items</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ route('sold-items.history') }}" class="nav-link {{ request()->routeIs('sold-items.history') ? 'active' : '' }}">
                  <i class="fa fa-file nav-icon"></i>
                  <p>Sold Items History</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <a class="nav-link" href="{{ route('logout') }}"
                          @click.prevent="$root.submit();">
                          <i class="fa fa-sign-out-alt nav-icon"></i> {{ __('Log Out') }}
                </a>
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>