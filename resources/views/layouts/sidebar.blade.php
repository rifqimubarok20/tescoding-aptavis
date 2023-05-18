<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-text mx-3">Info Klasemen</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('klasemen') ? 'active' : '' }}">
        <a class="nav-link" href="/klasemen">
            <i class="fas fa-fw fa-home"></i>
            <span>Klasemen</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item {{ Request::is('team') ? 'active' : '' }}">
        <a class="nav-link" href="/team">
            <i class="fas fa-shield-alt"></i>
            <span>Klub</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item {{ Request::is('match') ? 'active' : '' }}">
        <a class="nav-link" href="/match">
            <i class="fas fa-stopwatch"></i>
            <span>Pertandingan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
