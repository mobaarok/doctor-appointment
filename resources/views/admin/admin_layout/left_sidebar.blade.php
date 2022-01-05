     <!-- .app div end -->
     <div id="sidebar" class="sidebar active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <div class="logo">
                        <a href="{{ route('admin.dashboard') }}"><img src="{{asset('mazer/assets/images/logo/rehana.png') }}" alt="Logo" srcset=""></a>
                    </div>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
                <div class="" style="font-size: 1rem;">
                    <a href=""> {{auth('admin')->user()->name}} </a>
                  <div class="d-inline">
                    <span>(</span>
                    <span> <a href="{{ route('admin.logout') }}">Logout</a></span>
                    <span>)</span>
                  </div>

                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>

                    <li class="sidebar-item">
                        <a href="{{ route('admin.dashboard')}}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{route('admin.hospital.index')}}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Hospitals</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('admin.doctor.index') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Doctors</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.doctor-degree.index') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span> Doctor's Degrees </span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.doctor-institute.index') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Doctors's Institutes</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.expertise.index') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span> Expertise/Spacalist</span>
                        </a>
                    </li>

                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>Components</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="component-alert.html">Alert</a>
                            </li>

                            <li class="submenu-item ">
                                <a href="component-tooltip.html">Tooltip</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="component-tooltip.html">Tooltip</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="component-tooltip.html">Tooltip</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="component-tooltip.html">Tooltip</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
    <!-- .sidebar div end -->
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
