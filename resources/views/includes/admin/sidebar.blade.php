<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ url('dashboard') }}">P-Mas</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ url('dashboard') }}">PM</a>
    </div>

    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link active" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i>
          <span>Dashbaord</span></a>
      </li>
        <li class="menu-header">Pages</li>
        <li class="dropdown {{ Request::is(['category*','complaint*']) ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-bullhorn"></i> <span>Pengaduan</span></a>
          <ul class="dropdown-menu">
            <li class="{{ Request::is('complaint*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('complaint.index') }}">Data Pengaduan</a></li>
            <li class="{{ Request::is('category*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('category.index') }}">Kategori Pengaduan</a></li>
          </ul>
        </li>
        <li class="dropdown {{ Request::is(['users*','masyarakats*']) ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Users</span></a>
          <ul class="dropdown-menu">
            <li class="{{ Request::is('user*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('user.index') }}">Pengguna</a></li>
          </ul>
        </li>
        <li class="{{ Request::is('report*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('report.index') }}"><i class="fas fa-book"></i>
            <span>Laporan Pengaduan</span></a>
        </li>
    </ul>
  </aside>
