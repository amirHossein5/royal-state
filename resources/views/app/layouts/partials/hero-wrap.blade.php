<div class="hero-wrap" style="background-image: url({{ asset('app-assets/images/bg_1.jpg') }});">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="text-center col-md-9 ftco-animate">
                <p class="breadcrumbs"  data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                    <span class="mr-2">
                        <a href="{{ route('app.index') }}">خانه</a>
                    </span>

                    @foreach ($pages as $page)
                        <span class="mr-1">
                            {{ $page }}
                        </span>
                    @endforeach

                </p>
                <h1 class="mb-3 bread">{{ $this_page }}</h1>
            </div>
        </div>
    </div>
</div>
