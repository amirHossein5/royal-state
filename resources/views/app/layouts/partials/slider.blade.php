<section class="home-slider owl-carousel">

    @foreach ($sliders as $slider)
        <div class="slider-item" style="background-image:url({{ asset($slide->advertise->image) }});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-md-end align-items-center justify-content-end">
                    <div class="p-4 col-md-6 text ftco-animate" style="direction: rtl;">
                        <h1 class="mb-3 location d-block"><i
                                class="icon-my_location"></i>{{ $slider->advertise->address }}</h1>
                        <p>{{ $slider->advertise->description }}</p>
                        <span class="price">{{ $slider->advertise->amount }} تومان </span>
                        <a href="{{ route('app.advertises.show', $slide->advertise->id) }}"
                            class="p-3 px-4 btn-custom bg-primary">مشاهده
                            جزئیات<span class="mr-1 icon-plus"></span></a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</section>
