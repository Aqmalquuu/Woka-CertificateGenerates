<!DOCTYPE html>
<html lang="en">

<meta charset="utf-8" />
<title>@yield('title', ' WokaCert')</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta content="Admin & Dashboards Template" name="description" />
<meta content="Pixeleyez" name="author" />

<!-- layout setup -->
<script type="module" src="{{ asset('assets/js/layout-setup.js') }}"></script>

<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('assets/images/WokaCert.png') }}">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.css" />

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<style>
    .pe-slide.active>.pe-nav-link>.pe-nav-content {
        color: #ff7700ff;
        border-radius: 10px;
    }

    .pe-slide.active .pe-nav-icon {
        color: #ff7700ff;
    }
</style>

@yield('css')
@include('partials.head-css')

<body>

    @include('partials.header')
    @include('partials.sidebar')
    @include('partials.horizontal')

    <main class="app-wrapper">
        <div class="container-fluid">

            @include('partials.page-title')

            @yield('content')
            @include('partials.switcher')
            @include('partials.scroll-to-top')

            @include('partials.vendor-scripts')

            @yield('js')

            <script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>

            <script>
                $(document).ready(function () {
                    $('#table').DataTable();
                });
            </script>
        </div>
    </main>

</body>

</html>