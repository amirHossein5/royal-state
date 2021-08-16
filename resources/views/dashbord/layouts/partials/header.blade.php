    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="float-left mr-auto bookmark-wrapper d-flex align-items-center">
                        <ul></ul>
                    </div>
                    <ul class="float-right nav navbar-nav">

                        <li class="dropdown dropdown-user nav-item ">
                            <a class="dropdown-toggle nav-link dropdown-user-link flex-column" href="#"
                                data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span
                                        class="user-name text-bold-600">{{ $user->full_name }}</span>
                                    <span class="user-status active">آنلاین </span>
                            </a>
                            <div>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="dropdown-item" type="submit"><i class="feather icon-power"></i>
                                        خروج</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
