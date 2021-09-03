<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar"
    style="direction: rtl;">
    <div class="container">
        <a class="navbar-brand" href="{{ route('app.index') }}">Royal<span>estate</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> منو
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="ml-auto navbar-nav">

                @foreach ($menus as $menu)
                    <li class="nav-item active">
                        <a href="{{ $menu->url }}" class="nav-link">
                            {{ $menu->name }}
                        </a>
                    </li>
                @endforeach

                @auth
                    <li class="nav-item cta"><a href="{{ route('dashboard.index') }}" class="nav-link ml-lg-1 mr-lg-5">
                            <span class="m-2 icon-user"></span>داشبورد</a></li>
                @endauth

                @guest
                    <li class="nav-item cta"><a href="{{ route('login') }}" class="nav-link ml-lg-1 mr-lg-5">
                            <span class="m-2 icon-user"></span>ورود</a></li>
                    <li class="nav-item cta cta-colored"><a href="{{ route('register') }}" class="nav-link">
                            <span class="m-2 icon-pencil"></span>ثبت نام</a></li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
