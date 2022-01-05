     <!-- .app div end -->
     <div id="sidebar" class="sidebar active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <div class="logo">
                        <a href="{{ route('hospital.home') }}"><img src="{{asset('mazer/assets/images/logo/logo.png') }}" alt="Logo" srcset=""></a>
                    </div>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
                <div class="" style="font-size: 1rem;">
                    <a href=""> {{auth('hospital')->user()->hospital_name}} </a>
                  <div class="">
                    <span></span>
                    <span> <a href="{{ route('hospital.logout') }}">Logout</a></span>
                    <span></span>
                  </div>

                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>

                    <li class="sidebar-item  ">
                        <a href="{{route('hospital.home')}}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item  ">
                        <a href="{{route('hospital.doctorsInHospital')}}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Docotors </span>
                        </a>
                    </li>
                    <li class="sidebar-item  ">
                        <a href="{{route('hospital.profile')}}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>profile </span>
                        </a>
                    </li>





                    <!-- end -->
                    <li class="sidebar-item  ">
                        <a href="{{route('hospital.manageAppoinment')}}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Appoinment </span>
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
        <!-- <p class="text-end">
            <span class="text-danger">
                {{ $today }}
            </span>
        </p> -->
    </header>

    <div class="page-heading">
