        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
              <a href="{{ route('redirects') }}" class="app-brand-link">
                {{-- <span class="app-brand-logo demo">
                  <img src="/assets/icon.png" alt="" width="75px">
                </span> --}}
                <img src="/assets/icon.png" class="demo menu-text" alt="" width="150px">
                {{-- <span class="fs-3 demo menu-text fw-bolder ms-2">{{ config('app.name') }}</span> --}}
              </a>
  
              <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
              </a>
            </div>
  
            <div class="menu-inner-shadow"></div>
  
            <ul class="menu-inner py-1">
              <!-- Dashboard -->
              <li class="menu-item {{ Route::currentRouteName() == 'adminDashboard' ? 'active' : '' }} {{ (Request::segment(1) == 'dashboard') ? 'active' : '' }}">
                <a href="{{ route('redirects') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Dashboard">Dashboard</div>
                </a>
              </li>
              
              @can('isMember')
              <li class="menu-item">
                <a href="/rental" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-car"></i>
                  <div data-i18n="Rental">Rental</div>
                </a>
              </li>
              @endcan
              
              @can('isAdmin')
              <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Admin</span>
              </li>

              <li class="menu-item {{ Route::currentRouteName() == 'AdminTypes' ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-category"></i>
                  <div data-i18n="Manage Type">Manage Type</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="{{ route('AdminTypes') }}" class="menu-link">
                      <div data-i18n="View Types">View Types</div>
                    </a>
                  </li>
                </ul>
              </li>
              
              <li class="menu-item {{ Route::currentRouteName() == 'AdminBrands' ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-git-compare"></i>
                  <div data-i18n="Manage Brand">Manage Brand</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="{{ route('AdminBrands') }}" class="menu-link">
                      <div data-i18n="View Brands">View Brands</div>
                    </a>
                  </li>
                </ul>
              </li>
              
              <li class="menu-item {{ Route::currentRouteName() == 'AdminVehicles' ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-car"></i>
                  <div data-i18n="Manage Vehicle">Manage Vehicle</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="{{ route('AdminVehicles') }}" class="menu-link">
                      <div data-i18n="View Vehicles">View Vehicles</div>
                    </a>
                  </li>
                </ul>
              </li>
              
              <li class="menu-item {{ Route::currentRouteName() == 'transaction' ? 'active' : '' }} {{ request()->segment(2) == 'transaction' ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-wallet"></i>
                  <div data-i18n="Manage Transaction">Manage Transaction</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="{{ route('transaction') }}" class="menu-link">
                      <div data-i18n="View Transactions">View Transactions</div>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="menu-item {{ Route::currentRouteName() == 'rentalAction' ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class='menu-icon tf-icons bx bx-toggle-right'></i>
                  <div data-i18n="Rental Action">Rental Action</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="{{ route('rentalAction') }}" class="menu-link">
                      <div data-i18n="Change Vehicle Status">Change Vehicle Status</div>
                    </a>
                  </li>
                </ul>
              </li>
              @endcan
  
              <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Information</span>
              </li>
              <li class="menu-item {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-cog"></i>
                  <div data-i18n="Account Settings">Account Settings</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="{{ route('profile') }}" class="menu-link">
                      <div data-i18n="Account">Account</div>
                    </a>
                  </li>
                </ul>
              </li>
              
              @can('isMember')
              <!-- Components -->
              <li class="menu-header small text-uppercase"><span class="menu-header-text">Transaction</span></li>
              <!-- Cards -->
              <li class="menu-item {{ Route::currentRouteName() == 'historyMember' ? 'active' : '' }} {{ Route::currentRouteName() == 'historyDetail' ? 'active' : '' }}">
                <a href="{{ route('historyMember') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-collection"></i>
                  <div data-i18n="History">History</div>
                </a>
              </li>
              @endcan
              
              <!-- Misc -->
              <li class="menu-header small text-uppercase"><span class="menu-header-text">Other</span></li>
              <li class="menu-item">
                <a
                  href="/developer"
                  class="menu-link"
                >
                  <i class="menu-icon tf-icons bx bx-support"></i>
                  <div data-i18n="Support">Support</div>
                </a>
              </li>
            </ul>
          </aside>