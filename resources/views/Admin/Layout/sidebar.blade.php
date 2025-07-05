<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ url('/') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="{{ asset('assets/Logo.png') }}" alt="Logo" width="30" />
      </span>
      <span class="app-brand-text demo menu-text fw-bold ms-2">UangKu</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
    </a>
  </div>
  <div class="menu-divider mt-0"></div>
  <div class="menu-inner-shadow"></div>
  <ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item {{ Request::is('dashboard') ? 'active open' : '' }}">
      <a href="{{ url('dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-smile"></i>
        <div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
      </a>
    </li>
    <!-- Categories -->
    <li class="menu-item {{ Request::is('categories*') ? 'active open' : '' }}">
      <a href="{{ url('categories') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-category"></i>
        <div class="text-truncate" data-i18n="Categories">Categories</div>
      </a>
    </li>
    <!-- Incomes -->
    <li class="menu-item {{ Request::is('incomes*') ? 'active open' : '' }}">
      <a href="{{ url('incomes') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-category"></i>
        <div class="text-truncate" data-i18n="Incomes">Incomes</div>
      </a>
    </li>
    <!-- Expenses -->
    <li class="menu-item {{ Request::is('expenses*') ? 'active open' : '' }}">
      <a href="{{ url('expenses') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-money-withdraw"></i>
        <div class="text-truncate" data-i18n="Expenses">Expenses</div>
      </a>
    </li>
    <!-- Balances -->
    <li class="menu-item {{ Request::is('balances*') ? 'active open' : '' }}">
      <a href="{{ url('balances') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-wallet"></i>
        <div class="text-truncate" data-i18n="Balances">Balances</div>
      </a>
    </li>
    
  </ul>
</aside>