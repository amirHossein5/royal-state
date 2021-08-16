<!DOCTYPE html>
<html>

<head>
    @include('dashbord.layouts.partials.head-tag')
    @yield('head-tag')
</head>

<body class="overflow-hidden">
    
    <div id="app">
        @yield('content')
    </div>

</body>

</html>
