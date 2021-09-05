<!-- BEGIN: Main Menu-->

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="flex-row nav navbar-nav">
            <li class="mr-auto nav-item">
                <a class="navbar-brand" href="{{ route('app.index') }}">
                    <div class="brand-logo"></div>
                    <h2 class="mb-0 brand-text">املاک</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="pr-0 nav-link modern-nav-toggle" data-toggle="collapse"><i
                        class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i
                        class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary"
                        data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class=" navigation-header"><span>لینک ها</span></li>
            <li class=" nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard.index') }}">
                    <i class="feather icon-mail"></i>
                    <span class="menu-title" data-i18n="Email">خانه</span>
                </a>
            </li>

            <li class=" nav-item {{ request()->is('dashboard/profile*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.profile.edit',auth()->user()->first_name) }}">
                    <i class="feather icon-check-square"></i>
                    <span class="menu-title" data-i18n="Todo">ویرایش اطلاعات پروفایل</span></a>
            </li>

            @can('viewAny', 'App\\Models\Category')
                <li class=" nav-item {{ request()->is('dashboard/categories*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.categories.index') }}">
                        <i class="feather icon-check-square"></i>
                        <span class="menu-title" data-i18n="Todo">دسته بندی</span></a>
                </li>
            @endcan

            @can('viewAny', 'App\\Models\Menu')
                <li class=" nav-item {{ request()->is('dashboard/menus*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.menus.index') }}">
                        <i class="feather icon-check-square"></i>
                        <span class="menu-title" data-i18n="Todo">منو ها</span></a>
                </li>
            @endcan

            @can('viewAny', 'App\\Models\Post')
                <li class=" nav-item {{ request()->is('dashboard/posts*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.posts.index') }}">
                        <i class="feather icon-check-square"></i>
                        <span class="menu-title" data-i18n="Todo">اخبار</span></a>
                </li>
            @endcan

            @can('viewAny', 'App\\Models\Comment')
                <li class=" nav-item {{ request()->is('dashboard/comments*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.comments.index') }}">
                        <i class="feather icon-calendar"></i>
                        <span class="menu-title" data-i18n="Calender">نظرات</span>
                    </a>
                </li>
            @endcan

            @can('viewAny', 'App\\Models\Advertise')
                <li class=" nav-item {{ request()->is('dashboard/advertises*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.advertises.index') }}">
                        <i class="feather icon-calendar"></i>
                        <span class="menu-title" data-i18n="Calender">آگهی</span>
                    </a>
                </li>
            @endcan

            @can('viewAny', 'App\\Models\Slide')
                <li class=" nav-item {{ request()->is('dashboard/slides*') ? 'active' : '' }}"><a
                        href="{{ route('dashboard.slides.index') }}">
                        <i class="feather icon-calendar"></i>
                        <span class="menu-title" data-i18n="Calender">اسلاید شو</span>
                    </a>
                </li>
            @endcan

            @can('viewAny', 'App\\Models\User')
                <li class=" nav-item {{ request()->is('dashboard/users*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.users.index') }}">
                        <i class="feather icon-calendar"></i>
                        <span class="menu-title" data-i18n="Calender">کاربران</span>
                    </a>
                </li>
            @endcan

            @isAdmin()
            <li class=" nav-item {{ request()->is('dashboard/roles*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.roles.index') }}">
                    <i class="feather icon-calendar"></i>
                    <span class="menu-title" data-i18n="Calender">نقش ها</span>
                </a>
            </li>
            @endIsAdmin


            @isAdmin()
            <li class=" nav-item {{ request()->is('dashboard/settings*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.settings.edit') }}">
                    <i class="feather icon-calendar"></i>
                    <span class="menu-title" data-i18n="Calender">تنظیمات</span>
                </a>
            </li>
            @endIsAdmin

        </ul>
    </div>
</div>
<!-- END: Main Menu-->
