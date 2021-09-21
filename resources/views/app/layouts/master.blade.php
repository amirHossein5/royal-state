<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('app.layouts.partials.head-tag')

    @yield('head-tag')
</head>

<body class="text-right">

    @include('app.layouts.partials.nav-bar')
    <!-- END nav -->

    @yield('content')

    @include('app.layouts.partials.footer')

    @include('app.layouts.partials.scripts')

    @yield('scripts')
    @stack('scripts')

</body>

</html>
