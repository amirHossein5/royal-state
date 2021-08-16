<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('dashbord.layouts.partials.head-tag')
    @yield('head-tag')
</head>

<body class="vertical-layout vertical-menu-modern 2-columns navbar-floating footer-static " data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    @include('dashbord.layouts.partials.header')

    @include('dashbord.layouts.partials.main-menu')



    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            <div class="content-body">
                @yield('content')
            </div>

        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('dashbord.layouts.partials.scripts')

    @if (session()->has('success'))
        @include('dashbord.layouts.partials.sweetalert-success')
    @endif

    @if (session()->has('failed'))
        @include('dashbord.layouts.partials.sweetalert-failed')
    @endif

    @yield('script')

</body>

</html>
