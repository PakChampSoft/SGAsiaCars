<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{ asset('images/assets/toyota-car-logo-6968.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SG Cars</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ auth()->user()->avatar != null ? Storage::url(auth()->user()->avatar) : asset('images/assets/nissan-logo-703.png') }}" class="rounded elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <p>
                    Dashboard
                    </p>
                </a>
            </li>

            {{-- start of admin routes / links --}}
            @role('admin')
            {{-- user management start --}}
            @php
                $routes = ['permissions', 'roles', 'users', 'customers', 'vendors', 'clones'];
            @endphp
            <li class="nav-item {{ in_array(request()->segment(2), $routes) ? 'menu-is-opening menu-open' : '' }}">
                <a href="#" class="nav-link {{ in_array(request()->segment(2), $routes) ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <p>
                    User Management
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('permissions.index') }}" class="nav-link {{ request()->segment(2) == 'permissions' ? 'active' : '' }}">
                        <i class="fas fa-user-tag"></i>
                        <p>Permissions</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}" class="nav-link {{ request()->segment(2) == 'roles' ? 'active' : '' }}">
                        <i class="fas fa-user-tag"></i>
                        <p>Roles</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link {{ request()->segment(2) == 'users' ? 'active' : '' }}">
                        <i class="fas fa-user-tag"></i>
                        <p>Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.customers') }}" class="nav-link {{ request()->segment(2) == 'customers' ? 'active' : '' }}">
                        <i class="fas fa-user-tag"></i>
                        <p>Customers</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.vendors') }}" class="nav-link {{ request()->segment(2) == 'vendors' ? 'active' : '' }}">
                        <i class="fas fa-user-tag"></i>
                        <p>Vendors</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('clones.index') }}" class="nav-link {{ request()->segment(2) == 'clones' ? 'active' : '' }}">
                        <i class="fas fa-clone"></i>
                        <p>Clone Management</p>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- user management end --}}


            {{-- product management start --}}
            @php
                $routes = ['products', 'deals', 'parts', 'metas'];
            @endphp
            <li class="nav-item {{ in_array(request()->segment(2), $routes) ? 'menu-is-opening menu-open' : '' }}">
                <a href="#" class="nav-link {{ in_array(request()->segment(2), $routes) ? 'active' : '' }}">
                <i class="fab fa-product-hunt"></i>
                <p>
                    Product Management
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link {{ request()->segment(2) == 'products' ? 'active' : '' }}">
                        <i class="fab fa-product-hunt"></i>
                        <p>Products</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('metas.index') }}" class="nav-link {{ request()->segment(2) == 'metas' ? 'active' : '' }}">
                        <i class="fab fa-product-hunt"></i>
                        <p>Prodcut Meta</p>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ route('deals.index') }}" class="nav-link {{ request()->segment(2) == 'deals' ? 'active' : '' }}">
                        <i class="fas fa-tags"></i>
                        <p>Deals on Product</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ request()->segment(2) == 'parts' ? 'active' : '' }}">
                        <i class="fas fa-car-battery"></i>
                        <p>Auto Part</p>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- product management end --}}

            {{-- stock location start --}}
            @php
                $routes = ['countries', 'ports'];
            @endphp
            <li class="nav-item {{ in_array(request()->segment(2), $routes) ? 'menu-is-opening menu-open' : '' }}">
                <a href="#" class="nav-link {{ in_array(request()->segment(2), $routes) ? 'active' : '' }}">
                <i class="fas fa-globe"></i>
                <p>
                    Stock Location
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('countries.index') }}" class="nav-link {{ request()->segment(2) == 'countries' ? 'active' : '' }}">
                        <i class="fas fa-globe"></i>
                        <p>Stock Countries</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ports.index') }}" class="nav-link {{ request()->segment(2) == 'ports' ? 'active' : '' }}">
                        <i class="far fa-flag"></i>
                        <p>Stock Ports</p>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- stock location end --}}
            {{-- SEO MANAGMENT --}}
            @php
                $routes = ['seo'];
            @endphp
            <li class="nav-item {{ in_array(request()->segment(2), $routes) ? 'menu-is-opening menu-open' : '' }}">
                <a href="#" class="nav-link {{ in_array(request()->segment(2), $routes) ? 'active' : '' }}">
                <i class="fas fa-search-minus"></i>
                <p>
                    SEO Management
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('seo.index') }}" class="nav-link {{ request()->segment(2) == 'seo' ? 'active' : '' }}">
                        <i class="fas fa-search-minus"></i>
                        <p>SEO Management</p>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- // SEO MANAGEMENT --}}
            {{-- vehicle attribute start --}}
            @php
                $routes = ['companies', 'models', 'types', 'accessories', 'colors', 'currencies'];
            @endphp
            <li class="nav-item {{ in_array(request()->segment(2), $routes) ? 'menu-is-opening menu-open' : '' }}">
                <a href="#" class="nav-link {{ in_array(request()->segment(2), $routes) ? 'active' : '' }}">
                <i class="fas fa-car"></i>
                <p>
                    Vehicle Attributes
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('companies.index') }}" class="nav-link {{ request()->segment(2) == 'companies' ? 'active' : '' }}">
                        <i class="fas fa-car"></i>
                        <p>Vehicle Company</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('models.index') }}" class="nav-link {{ request()->segment(2) == 'models' ? 'active' : '' }}">
                        <i class="fas fa-car"></i>
                        <p>Vehicle Model</p>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ route('types.index') }}" class="nav-link {{ request()->segment(2) == 'types' ? 'active' : '' }}">
                        <i class="fas fa-car"></i>
                        <p>Vehicle Type</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('accessories.index') }}" class="nav-link {{ request()->segment(2) == 'accessories' ? 'active' : '' }}">
                        <i class="fas fa-car"></i>
                        <p>Vehicle Accessories</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('colors.index') }}" class="nav-link {{ request()->segment(2) == 'colors' ? 'active' : '' }}">
                        <i class="fas fa-car"></i>
                        <p>Vehicle Color</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('currencies.index') }}" class="nav-link {{ request()->segment(2) == 'currencies' ? 'active' : '' }}">
                        <i class="fas fa-car"></i>
                        <p>Currency Rate</p>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- vehicle attribute end --}}


            {{-- content management start --}}
            @php
                $routes = ['contents'];
            @endphp
            <li class="nav-item {{ in_array(request()->segment(2), $routes) ? 'menu-is-opening menu-open' : '' }}">
                <a href="#" class="nav-link {{ in_array(request()->segment(2), $routes) ? 'active' : '' }}">
                <i class="fas fa-tasks"></i>
                <p>
                    Content Management
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('contents.index') }}" class="nav-link {{ request()->segment(2) == 'contents' ? 'active' : '' }}">
                        <i class="fas fa-outdent"></i>
                        <p>Utility Contents</p>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- content management end --}}

            {{-- blogs --}}
            <li class="nav-item">
                <a href="{{ route('blogs.index') }}" class="nav-link {{ request()->segment(2) == 'blogs' ? 'active' : '' }}">
                <i class="fas fa-blog"></i>
                <p>
                    Blogs
                </p>
                </a>
            </li>
            {{-- end blogs --}}

            {{-- excel management start --}}
            <li class="nav-item">
                <a href="{{ route('excel.index') }}" class="nav-link {{ request()->segment(2) == 'excel' ? 'active' : '' }}">
                <i class="fas fa-table"></i>
                <p>
                    Excel Management
                </p>
                </a>
            </li>
            {{-- excel management end --}}

            {{-- beforward area start --}}
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="fab fa-btc"></i>
                <p>
                    Beforward
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="fas fa-sync"></i>
                        <p>Sync Products</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="fab fa-product-hunt"></i>
                        <p>Beforward Prodcuts</p>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- beforward area end --}}

            {{-- outsource api start --}}
            @php
                $routes = ['api-clients'];
            @endphp
            <li class="nav-item {{ in_array(request()->segment(2), $routes) ? 'menu-is-opening menu-open' : '' }}">
                <a href="#" class="nav-link {{ in_array(request()->segment(2), $routes) ? 'active' : '' }}">
                <i class="fas fa-share-alt-square"></i>
                <p>
                    Out Source API
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('api-clients.index') }}" class="nav-link {{ request()->segment(2) == 'api-clients' ? 'active' : '' }}">
                        <i class="fas fa-user-secret"></i>
                        <p>Out Source API Clients</p>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- outsource api end --}}

            {{-- shipping schedule start --}}
            <li class="nav-item">
                <a href="{{ route('shippings.index') }}" class="nav-link {{ request()->segment(2) == 'shippings' ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i>
                <p>
                    Shipping Schedule
                </p>
                </a>
            </li>
            {{-- shipping schedule end --}}

            {{-- quote request start --}}
            <li class="nav-item">
                <a href="{{ route('quotes.index') }}" class="nav-link {{ request()->segment(2) == 'quotes' ? 'active' : '' }}">
                <i class="fas fa-quote-right"></i>
                <p>
                    Quote Requests
                </p>
                </a>
            </li>
            {{-- quote request end --}}
            @endrole
            {{-- end of admin routes / links --}}

            {{-- start of customer routes / links --}}
            @role('customer')
            {{-- user quote requests --}}
            <li class="nav-item">
                <a href="{{ route('user.quote.index') }}" class="nav-link {{ request()->segment(2) == 'quotes' ? 'active' : '' }}">
                <i class="fas fa-quote-right"></i>
                <p>
                    My Quotes
                </p>
                </a>
            </li>

            {{-- user notification --}}
            <li class="nav-item">
                <a href="{{ route('user.notification.index') }}" class="nav-link {{ request()->segment(2) == 'notifications' ? 'active' : '' }}">
                <i class="fas fa-bell"></i>
                <p>
                    Notifications
                </p>
                </a>
            </li>
            @endrole
            {{-- end of customer routes / links --}}

            {{-- user profile start --}}
            <li class="nav-item">
                <a href="{{ route('profile.index') }}" class="nav-link {{ request()->segment(1) == 'profile' ? 'active' : '' }}">
                <i class="far fa-user-circle"></i>
                <p>
                    User Profile
                </p>
                </a>
            </li>
            {{-- user profile end --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
