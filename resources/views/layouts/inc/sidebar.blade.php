@php
    $role = session('selected_role');
@endphp

<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">

    {{-- Tampil untuk semua --}}
    <li class="nav-item">
      <a class="nav-link {{ Request::is('dashboard') ? '' : 'collapsed' }}" href="/dashboard">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    {{-- Hanya untuk admin dan pimpinan --}}
    @if (in_array($role, ['Administrator']))
    <li class="nav-item">
      <a class="nav-link {{ Request::is('category*', 'user*', 'product') ? '' : 'collapsed' }}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse {{ Request::is('category*', 'user*', 'product') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('categories.index') }}" class="nav-link {{ Request::is('category*') ? '' : 'collapsed' }}">
            <i class="bi bi-circle"></i><span>Category</span>
          </a>
        </li>
        <li>
          <a href="/users" class="nav-link {{ Request::is('user') ? '' : 'collapsed' }}">
            <i class="bi bi-circle"></i><span>User</span>
          </a>
        </li>
        <li>
          <a href="/roles" class="nav-link {{ Request::is('role') ? '' : 'collapsed' }}">
            <i class="bi bi-circle"></i><span>Role</span>
          </a>
        </li>
        <li>
          <a href="/products" class="nav-link {{ Request::is('product') ? '' : 'collapsed' }}">
            <i class="bi bi-circle"></i><span>Produk</span>
          </a>
        </li>
      </ul>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link {{ Request::is('pos', 'kasir') ? '' : 'collapsed' }}" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Report Manage</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse {{ Request::is('pos', 'kasir') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        <li>
          <a href="/pos" class="nav-link {{ Request::is('pos') ? '' : 'collapsed' }}">
            <i class="bi bi-circle"></i><span>Report</span>
          </a>
        </li> -->
        <!-- <li>
          <a href="/stock" class="nav-link {{ Request::is('stock') ? '' : 'collapsed' }}">
            <i class="bi bi-circle"></i><span>Stock</span>
          </a>
        </li> -->
      <!-- </ul>
    </li> -->
    @endif
@if (in_array($role, ['Kasir', 'Administrator']))
<li>
          <a href="/stock" class="nav-link {{ Request::is('stock') ? '' : 'collapsed' }}">
            <i class="bi bi-circle"></i><span>Stock</span>
          </a>
        </li>
@endif
    {{-- Hanya untuk kasir dan admin --}}
    @if (in_array($role, ['Kasir']))
    <li class="nav-item">
      <a class="nav-link {{ Request::is('pos', 'kasir') ? '' : 'collapsed' }}" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>POS Manage</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse {{ Request::is('pos', 'kasir') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        
        <li>
          <a href="/kasir" class="nav-link {{ Request::is('kasir') ? '' : 'collapsed' }}">
            <i class="bi bi-circle"></i><span>PO</span>
          </a>
        </li>

      </ul>
    </li>

    @endif
    @if (in_array($role, ['Pimpinan']))
    <li class="nav-item">
      <a class="nav-link {{ Request::is('pos', 'kasir') ? '' : 'collapsed' }}" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Report Manage</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse {{ Request::is('pos', 'kasir') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        <li>
          <a href="/pos" class="nav-link {{ Request::is('pos') ? '' : 'collapsed' }}">
            <i class="bi bi-circle"></i><span>Report</span>
          </a>
        </li>
      </ul>
    </li>
    @endif

  </ul>
</aside>
