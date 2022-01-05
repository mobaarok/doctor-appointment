<div class="page-wrap">
    <div class="app-sidebar colored">
        <div class="sidebar-header">
            <a class="header-brand" href="index.html">
                <div class="logo-img">
                    <!-- <img src="{{ asset('template/src/img/brand-white.svg') }}" class="header-brand-img" alt="lavalite">  -->
                </div>
                <span class="text">Doc App</span>
            </a>
            <button type="button" class="nav-toggle"><i data-toggle="expanded"
                    class="ik ik-toggle-right toggle-icon"></i></button>
            <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
        </div>
        <div class="sidebar-content">
            <div class="nav-container">
                <nav id="main-menu-navigation" class="navigation-main">
                    <div class="nav-lavel">Navigation</div>
                    <div class="nav-item">
                        <a href="{{ route('admin.dashboard')}}">
                            <i class="ik ik-monitor"></i>
                            <span>Dashboard</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{route('admin.hospital.index')}}">
                            <i class="ik ik-home"></i>
                            <span>Hospital</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('admin.doctor.index') }}">
                            <i class="ik ik-user-plus"></i>
                            <span>Doctor</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('admin.doctor-degree.index') }}">
                            <i class="ik ik-feather"></i>
                            <span>Doctor Degree</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('admin.doctor-institute.index') }}">
                            <i class="ik ik-feather"></i>
                            <span>Doctor Institute</span>
                        </a>
                    </div>

                    <div class="nav-item">
                        <a href="{{ route('admin.expertise.index') }}">
                            <i class="ik ik-feather"></i>
                            <span> Expertise/Spacalist </span>
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
