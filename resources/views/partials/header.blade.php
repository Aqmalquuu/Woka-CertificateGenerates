<!-- Begin Header -->
<header class="app-header" id="appHeader">
    <div class="container-fluid w-100">
        <div class="d-flex align-items-center">
            @if (session('success'))
                <div id="alert-success" class="position-fixed top-0 start-50 translate-middle-x mt-4 z-50">

                    <div class="d-flex align-items-center gap-3 px-4 py-3 rounded-3 shadow-lg
                                       bg-success-subtle text-success border border-success-subtle
                                       animate-slide-down" role="alert">
                        <!-- Icon -->
                        <div class="flex-shrink-0">
                            <i class="bi bi-check-circle-fill fs-5"></i>
                        </div>

                        <!-- Text -->
                        <div class="flex-grow-1 fw-medium">
                            {{ session('success') }}
                        </div>

                        <!-- Close -->
                        <button type="button" class="btn-close ms-2" aria-label="Close" onclick="closeAlert()">
                        </button>
                    </div>
                </div>

                <style>
                    @keyframes slideDown {
                        from {
                            opacity: 0;
                            transform: translate(-50%, -10px);
                        }

                        to {
                            opacity: 1;
                            transform: translate(-50%, 0);
                        }
                    }

                    .animate-slide-down {
                        animation: slideDown .35s ease-out;
                    }
                </style>

                <script>
                    function closeAlert() {
                        const el = document.getElementById('alert-success');
                        if (el) {
                            el.style.opacity = '0';
                            el.style.transform = 'translate(-50%, -10px)';
                            setTimeout(() => el.remove(), 300);
                        }
                    }

                    // Auto close
                    setTimeout(() => {
                        closeAlert();
                    }, 4000);
                </script>
            @endif

            @if (session('error'))
                <div id="alert-danger" class="position-fixed top-0 start-50 translate-middle-x mt-4 z-50">

                    <div class="d-flex align-items-center gap-3 px-4 py-3 rounded-3 shadow-lg
                                       bg-danger-subtle text-danger border border-danger-subtle
                                       animate-slide-down" role="alert">
                        <!-- Icon -->
                        <div class="flex-shrink-0">
                            <i class="bi bi-check-circle-fill fs-5"></i>
                        </div>

                        <!-- Text -->
                        <div class="flex-grow-1 fw-medium">
                            {{ session('error') }}
                        </div>

                        <!-- Close -->
                        <button type="button" class="btn-close ms-2" aria-label="Close" onclick="closeAlert()">
                        </button>
                    </div>
                </div>

                <style>
                    @keyframes slideDown {
                        from {
                            opacity: 0;
                            transform: translate(-50%, -10px);
                        }

                        to {
                            opacity: 1;
                            transform: translate(-50%, 0);
                        }
                    }

                    .animate-slide-down {
                        animation: slideDown .35s ease-out;
                    }
                </style>

                <script>
                    function closeAlert() {
                        const el = document.getElementById('alert-danger');
                        if (el) {
                            el.style.opacity = '0';
                            el.style.transform = 'translate(-50%, -10px)';
                            setTimeout(() => el.remove(), 300);
                        }
                    }

                    // Auto close
                    setTimeout(() => {
                        closeAlert();
                    }, 5000);
                </script>
            @endif


            <div class="me-auto">
                <div class="d-inline-flex align-items-center gap-5">
                    <a href="index" class="fs-18 fw-semibold">
                        <img height="30" class="header-sidebar-logo-default d-none" alt="Logo"
                            src="{{ asset('assets/images/logo-dark.png') }}">
                        <img height="30" class="header-sidebar-logo-light d-none" alt="Logo"
                            src="{{ asset('assets/images/logo-light.png') }}">
                        <img height="30" class="header-sidebar-logo-small d-none" alt="Logo"
                            src="{{ asset('assets/images/logo-md.png') }}">
                        <img height="30" class="header-sidebar-logo-small-light d-none" alt="Logo"
                            src="{{ asset('assets/images/logo-md-light.png') }}">
                    </a>
                    <button type="button"
                        class="vertical-toggle btn btn-light-light text-muted icon-btn fs-5 rounded-pill"
                        id="toggleSidebar">
                        <i class="bi bi-arrow-bar-left header-icon"></i>
                    </button>
                    <button type="button"
                        class="horizontal-toggle btn btn-light-light text-muted icon-btn fs-5 rounded-pill d-none"
                        id="toggleHorizontal">
                        <i class="ri-menu-2-line header-icon"></i>
                    </button>
                </div>
            </div>
            <div class="flex-shrink-0 d-flex align-items-center gap-1">
                <button type="button" class="btn header-btn d-none d-md-block" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                    <i class="bi bi-search"></i>
                </button>
                <div class="dark-mode-btn" id="toggleMode">
                    <button class="btn header-btn active" id="lightModeBtn">
                        <i class="bi bi-brightness-high"></i>
                    </button>
                    <button class="btn header-btn" id="darkModeBtn">
                        <i class="bi bi-moon-stars"></i>
                    </button>
                </div>
                <div class="dropdown pe-dropdown-mega d-none d-md-block">
                    <button class="header-profile-btn btn gap-1 text-start" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span class="header-btn btn position-relative">
                            <div class="img-fluid rounded-circle bg-primary text-white dark:bg-secondary dark:text-light d-flex justify-content-center align-items-center me-2 shadow-sm"
                                style="width: 32px; height: 32px; font-size: 15px; font-weight: bold;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span
                                class="position-absolute translate-middle badge border border-light rounded-circle bg-success"><span
                                    class="visually-hidden">unread messages</span></span>
                        </span>
                        <div class="d-none d-lg-block pe-2">
                            <span class="d-block mb-0 fs-13 fw-semibold">{{ Auth::user()->name }}</span>
                            <span class="d-block mb-0 fs-12 text-muted">{{ Auth::user()->email }}</span>
                        </div>
                    </button>
                    <div class="dropdown-menu dropdown-mega-sm header-dropdown-menu p-3">
                        <div class="border-bottom pb-2 mb-2 d-flex align-items-center gap-2">
                            <div class="img-fluid rounded-circle bg-primary text-white dark:bg-secondary dark:text-light d-flex justify-content-center align-items-center me-2 shadow-sm"
                                style="width: 32px; height: 32px; font-size: 15px; font-weight: bold;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <a href="javascript:void(0)">
                                    <h6 class="mb-0 lh-base">{{ Auth::user()->name }}</h6>
                                </a>
                                <p class="mb-0 fs-13 text-muted">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <ul class="list-unstyled mb-1 border-bottom pb-1">
                            <li><a class="dropdown-item" href="{{ route('siswa.profil') }}"><i
                                        class="bi bi-person me-1"></i>
                                    View Profile</a></li>
                            <li><a class="dropdown-item" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i
                                        class="bi bi-gear me-1"></i>
                                    Settings</a></li>
                        </ul>
                        <ul class="list-unstyled mb-0">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END Header -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 bg-transparent">
            <div class="d-flex justify-content-between align-items-center bg-body">
                <div class="d-flex align-items-center border-0 px-3">
                    <i class="bi bi-search me-2"></i>
                    <input class="d-flex w-full py-3 bg-transparent border-0 focus-ring" placeholder="Search Here.."
                        autocomplete="off" autocorrect="off" spellcheck="false" aria-autocomplete="list" role="combobox"
                        aria-expanded="true" type="text">
                </div>
                <button type="button" class="btn-close pe-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-body mt-4">
                <p class="font-normal mb-2">Searching For...</p>
                <span class="badge bg-light-subtle border text-body">Analytics <i class="ri-close-line"></i></span>
                <span class="badge bg-light-subtle border text-body">Project <i class="ri-close-line"></i></span>
                <span class="badge bg-light-subtle border text-body">Eccomerce <i class="ri-close-line"></i></span>
                <span class="badge bg-light-subtle border text-body">CRM <i class="ri-close-line"></i></span>
                <span class="badge bg-light-subtle border text-body">Logistics <i class="ri-close-line"></i></span>
                <span class="badge bg-light-subtle border text-body">Academy <i class="ri-close-line"></i></span>
            </div>
        </div>
    </div>
</div>