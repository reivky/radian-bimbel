{{-- <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <!-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div> -->
        <div class="sidebar-brand-text mx-3">Radian Admin
            <!-- <sup>2</sup> -->
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('components*') ? 'active' : '' }}">
        <a class="nav-link" href="/components">
            <i class="fas fa-fw fa-cog"></i>
            <span>Komponen</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data
    </div>
    <li class="nav-item {{ Request::is('students*') || Request::is('teachers*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/students">Data Siswa</a>
                <a class="collapse-item" href="/teachers">Data Pengajar</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Data Pendaftar -->
    <li class="nav-item {{ Request::is('registrants*') ? 'active' : '' }}">
        <a class="nav-link" href="/registrants">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Pendaftar Baru</span></a>
    </li>
    <li class="nav-item {{ Request::is('schedules*') ? 'active' : '' }}">
        <a class="nav-link" href="/schedules">
            <i class="fas fa-fw fa-graduation-cap"></i>
            <span>Jadwal Les</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pages
    </div>
    <!-- Nav Item - Halaman Utama -->
    <li class="nav-item">
        <a class="nav-link" href="/" target="_blank">
            <i class="fas fa-fw fa-home"></i>
            <span>Halaman Utama</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul> --}}

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <!-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div> -->
        <div class="sidebar-brand-text mx-3">Radian Admin <!-- <sup>2</sup> --></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item  {{ Request::is('dashboard*') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('components*') ? 'active' : '' }}">
        <a class="nav-link" href="/components">
            <i class="fas fa-fw fa-cog"></i>
            <span>Komponen</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data
    </div>
            
    <!-- Nav Item - Data Pengajar -->
    <li class="nav-item {{ Request::is('teachers*') ? 'active' : '' }}">
        <a class="nav-link" href="/teachers">
            <i class="fa-solid fa-list"></i>
            <span>Data Pengajar</span></a>
    </li>
    <!-- Nav Item - Data Siswa -->
    <li class="nav-item {{ Request::is('students*') ? 'active' : '' }}">
        <a class="nav-link" href="/students">
            <i class="fa-solid fa-list"></i>
            <span>Data Siswa</span></a>
    </li>
    <!-- Nav Item - Data Pendaftar -->
    <li class="nav-item {{ Request::is('registrants*') ? 'active' : '' }}">
        <a class="nav-link" href="/registrants">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Pendaftar Baru</span></a>
    </li>
    <li class="nav-item {{ Request::is('schedules*') ? 'active' : '' }}">
        <a class="nav-link" href="/schedules">
            <i class="fas fa-fw fa-graduation-cap"></i>
            <span>Jadwal Les</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pages
    </div>
    <!-- Nav Item - Halaman Utama -->
    <li class="nav-item">
        <a class="nav-link" href="/" target="_blank">
            <i class="fas fa-fw fa-home"></i>
            <span>Halaman Utama</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>