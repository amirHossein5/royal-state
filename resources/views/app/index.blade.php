@extends('app.layouts.master')

@section('head-tag')
    <title>Royal Estate</title>
@endsection

@section('content')

    @include('app.layouts.partials.slider',['sliders'=>$sliders])

    <section class="ftco-search">
        <div class="container">
            <div class="row">
                <div class="col-md-12 search-wrap">
                    <form action="{{ route('app.advertises') }}" method="get" class="search-property">
                        <div class="row">
                            <div class="col-md align-items-end">
                                <div class="form-group">
                                    <label for="#">آدرس اگهی</label>
                                    <div class="form-field">
                                        <div class="icon"><span class="icon-pencil "></span></div>
                                        <input type="text" class="text-right form-control" name="address"
                                            placeholder="آدرس">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md align-self-end">
                                <div class="form-group">
                                    <div class="form-field">
                                        <input type="submit" value="جستوجو" class="form-control btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="py-4 text-center media block-6 services d-block">
                        <div class="d-flex justify-content-center">
                            <div class="icon"><span class="flaticon-pin"></span></div>
                        </div>
                        <div class="p-2 mt-2 media-body">
                            <h3 class="mb-3 heading">پیدا کردن خانه در هرجای </h3>
                            <p>به راحتی در هرجای ایران خانه موردنظر خود را انتخاب کنید</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="py-4 text-center media block-6 services d-block">
                        <div class="d-flex justify-content-center">
                            <div class="icon"><span class="flaticon-detective"></span></div>
                        </div>
                        <div class="p-2 mt-2 media-body">
                            <h3 class="mb-3 heading">نمایندگان فعال</h3>
                            <p>نمایندگان فعال در سراسر کشور</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-sel Searchf-stretch ftco-animate">
                    <div class="py-4 text-center media block-6 services d-block">
                        <div class="d-flex justify-content-center">
                            <div class="icon"><span class="flaticon-house"></span></div>
                        </div>
                        <div class="p-2 mt-2 media-body">
                            <h3 class="mb-3 heading">خرید و یا اجاره</h3>
                            <p>دسته بندی جدا خانه های خریدنی و یا اجاره کردنی</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="py-4 text-center media block-6 services d-block">
                        <div class="d-flex justify-content-center">
                            <div class="icon"><span class="flaticon-purse"></span></div>
                        </div>
                        <div class="p-2 mt-2 media-body">
                            <h3 class="mb-3 heading">دو سر سود</h3>
                            <p>منفعت برای خریدار و فروشنده</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-properties">
        <div class="container">
            <div class="pb-3 mb-5 row justify-content-center">
                <div class="text-center col-md-7 heading-section ftco-animate">
                    <span class="subheading">اخرین اگهی ها</span>
                    <h2 class="mb-4">اخرین اگهی ها</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="properties-slider owl-carousel ftco-animate">

                        @foreach ($latestAdvertises as $advertise)
                            <div class="item">
                                <a href="{{ route('app.advertises.show', $advertise->id) }}">
                                    <div class="properties">
                                        <a href="#" class="img d-flex justify-content-center align-items-center"
                                            style="background-image: url({{ asset($advertise->image) }});">
                                            <div class="icon d-flex justify-content-center align-items-center">
                                                <span class="icon-search2"></span>
                                            </div>
                                        </a>
                                        <div class="p-3 text">
                                            @if ($advertise->sell_status === 'خرید')
                                                <span class="status sale">خرید</span>
                                            @else
                                                <span class="status rent">اجاره</span>
                                            @endif
                                            <div class="d-flex">
                                                <div class="one">
                                                    <h3>{{ Str::substr($advertise->address, 0, 20) }}</h3>
                                                    <p>{{ $advertise->home_type }}</p>
                                                </div>
                                                <div class="two">
                                                    <span class="price">{{ $advertise->amount }} تومان</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="pb-3 mb-5 row justify-content-center">
                <div class="text-center col-md-7 heading-section ftco-animate">
                    <span class="subheading">پیشنهادات ویژه</span>
                    <h2 class="mb-4">بهترین اگهی ها</h2>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">

                @foreach ($bestAdvertises as $advertise)
                    <div class="col-sm col-md-6 col-lg ftco-animate">
                        <div class="properties">
                            <a href="{{ route('app.advertises.show', $advertise->id) }}"
                                class="img img-2 d-flex justify-content-center align-items-center"
                                style="background-image: url({{ asset($advertise->image) }});">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="icon-search2"></span>
                                </div>
                            </a>
                            <div class="p-3 text">
                                @if ($advertise->sell_status === 'خرید')
                                    <span class="status sale">خرید</span>
                                @else
                                    <span class="status rent">اجاره</span>
                                @endif
                                <div class="d-flex">
                                    <div class="one">
                                        <h3>{{ Str::substr($advertise->address, 0, 20) }}</h3>
                                        <p>{{ $advertise->home_type }}</p>
                                    </div>
                                    <div class="two">
                                        <span class="price">{{ $advertise->amount }} تومان</span>
                                    </div>
                                </div>
                                <p>{{ $advertise->description }}</p>
                                <hr>
                                <p class="bottom-area d-flex">
                                    <span><i class="mx-1 flaticon-selection"></i>متر {{ $advertise->area }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <section class="ftco-section ftco-counter img" id="section-counter"
        style="background-image: url({{ asset('app-assets/images/bg_1.jpg') }});">
        <div class="container">
            <div class="pb-3 mb-3 row justify-content-center">
                <div class="text-center col-md-7 heading-section heading-section-white ftco-animate">
                    <h2 class="mb-4">برخی اطلاعات جالب</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-4 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="text-center block-18">
                                <div class="text">
                                    <strong class="number" data-number="{{ $interstingFacts['advertise_count'] }}">
                                        {{ $interstingFacts['advertise_count'] }}
                                    </strong>
                                    <span>آگهی ها</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="text-center block-18">
                                <div class="text">
                                    <strong class="number" data-number="{{ $interstingFacts['sellers'] }}">
                                        {{ $interstingFacts['sellers'] }}
                                    </strong>
                                    <span>نمایندگان</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="text-center block-18">
                                <div class="text">
                                    <strong class="number" data-number="{{ $interstingFacts['area'] }}">
                                        {{ $interstingFacts['area'] }}
                                    </strong>
                                    <span>متراژ کلی </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="ftco-section">
        <div class="container">
            <div class="pb-3 mb-5 row justify-content-center">
                <div class="text-center col-md-7 heading-section ftco-animate">
                    <span class="subheading">مقالات</span>
                    <h2>آخرین بلاگ ها</h2>
                </div>
            </div>
            <div class="row d-flex">

                @foreach ($latestBlogs as $post)
                    <div class="col-md-3 d-flex ftco-animate">
                        <div class="blog-entry align-self-stretch">
                            <a href="blog-single.html" class="block-20"
                                style="background-image: url({{ $post->image }});">
                            </a>
                            <div class="mt-3 text d-block">
                                <h3 class="mt-3 heading"><a
                                        href="{{ route('app.posts.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>
                                <div class="mb-3 meta">
                                    <div>{{ $post->created_at }}</div>
                                    <div>{{ $post->author->name }}</div>
                                    <div><span class="icon-chat"></span> {{ $post->comments_count }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
