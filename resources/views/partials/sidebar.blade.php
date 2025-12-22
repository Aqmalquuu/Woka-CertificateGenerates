<aside class="pe-app-sidebar" id="sidebar">
    <div class="pe-app-sidebar-logo px-6 d-flex align-items-center position-relative">
        <!--begin::Brand Image-->
        <a href="/" class="fs-18 fw-semibold">
            <img height="90" class="pe-app-sidebar-logo-default d-none" alt="Logo"
                src="{{ asset('assets/images/WokaCert1.png') }}">
            <img height="90" class="pe-app-sidebar-logo-light d-none" alt="Logo"
                src="{{ asset('assets/images/WokaCert2.png')}}">
            <img height="40" class="pe-app-sidebar-logo-minimize d-none" alt="Logo"
                src="{{ asset('assets/images/WokaCert.png') }}">
            <img height="40" class="pe-app-sidebar-logo-minimize-light d-none" alt="Logo"
                src="{{ asset('assets/images/WokaCert.png') }}">
            <!-- FabKin -->
        </a>
        <!--end::Brand Image-->
    </div>
    <nav class="pe-app-sidebar-menu nav nav-pills" data-simplebar id="sidebar-simplebar">
        <ul class="pe-main-menu list-unstyled">
            <li class="pe-menu-title">
                Main
            </li>

            @if (auth()->user()->role === 'admin')
                <li class="pe-slide pe-has-sub {{ request()->routeIs('admin.dashboard') ? 'active open' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="pe-nav-link">
                        <i class="bi bi-speedometer2 pe-nav-icon"></i>
                        <span class="pe-nav-content">Dashboard</span>
                    </a>
                </li>

                <li class="pe-slide pe-has-sub {{ request()->routeIs('admin.student.*') ? 'active open' : '' }}">
                    <a href="{{ route('admin.student.index') }}" class="pe-nav-link">
                        <i class="bi bi-people pe-nav-icon"></i>
                        <span class="pe-nav-content">Siswa</span>
                    </a>
                </li>

                <li class="pe-slide pe-has-sub {{ request()->routeIs('admin.program.*') ? 'active open' : '' }}">
                    <a href="{{ route('admin.program.index') }}" class="pe-nav-link">
                        <i class="bi bi-journal-code pe-nav-icon"></i>
                        <span class="pe-nav-content">Program</span>
                    </a>
                </li>

                <li
                    class="pe-slide pe-has-sub {{ request()->routeIs('admin.template-sertifikat.*') ? 'active open' : '' }}">
                    <a href="{{ route('admin.template-sertifikat.index') }}" class="pe-nav-link">
                        <i class="bi bi-palette pe-nav-icon"></i>
                        <span class="pe-nav-content">Template Sertifikat</span>
                    </a>
                </li>

                <li class="pe-slide pe-has-sub {{ request()->routeIs('admin.certificates.*') ? 'active open' : '' }}">
                    <a href="{{ route('admin.certificates.index') }}" class="pe-nav-link">
                        <i class="bi bi-award pe-nav-icon"></i>
                        <span class="pe-nav-content">Sertifikat</span>
                    </a>
                </li>
            @endif

            @if (auth()->user()->role === 'siswa')
                <li class="pe-slide pe-has-sub {{ request()->routeIs('siswa.dashboard') ? 'active open' : '' }}">
                    <a href="{{ route('siswa.dashboard') }}" class="pe-nav-link">
                        <i class="bi bi-speedometer2 pe-nav-icon"></i>
                        <span class="pe-nav-content">Dashboard</span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</aside>