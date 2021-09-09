@extends('app.layouts.master')

@section('head-tag')
    <title>آگهی ها</title>
@endsection

@section('content')

    @include('app.layouts.partials.hero-wrap', [
    'this_page'=>'آگهی ها',
    'pages' => ['آگهی ها']
    ])

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-12 ftco-animate">
                            <div class="single-slider owl-carousel">
                                @foreach ($advertise->galleries as $gallery)
                                    <div class="item">
                                        <div class="properties-img"
                                            style="background-image: url({{ asset($gallery->image) }});">
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="mt-4 mb-5 col-md-12 Properties-single ftco-animate">
                            <p class="mb-4 rate">
                                <span class="loc">
                                    <a href="#">
                                        <i class="icon-map"></i>
                                        {{ $advertise->address }}
                                    </a>
                                </span>
                            </p>
                            <h3>{{ $advertise->title }}</h3>
                            <p>
                                {!! $advertise->description !!}
                            </p>
                            <div class="mt-5 mb-5 d-md-flex">
                                <ul style="direction: rtl;">
                                    <li><span>نوع آگهی : </span> {{ $advertise->sell_status }}</li>
                                    <li><span>متراژ : </span> {{ $advertise->area }}</li>
                                    <li><span>اتاق خواب : </span> {{ $advertise->room }}</li>
                                    <li><span>سرویس بهداشتی : </span> {{ $advertise->toilet }}</li>
                                    <li><span>پارکینگ : </span> {{ $advertise->parking_status }}</li>
                                </ul>
                                <ul class="ml-md-5" style="direction: rtl;">
                                    <li><span>نوع کفپوش : </span> {{ $advertise->floor }}</li>
                                    <li><span>سال ساخت : </span> {{ $advertise->year }}</li>
                                    <li><span>انباری : </span> {{ $advertise->store_room_status }}</li>
                                    <li><span>بالکن : </span> {{ $advertise->balcony_status }}</li>
                                    <li><span>پارکینگ : </span> {{ $advertise->parking_status }}</li>
                                    <li><span>قیمت : </span> {{ numberformat($advertise->amount) }} تومان</li>
                                </ul>
                            </div>
                        </div>

                        <div class="mt-2 col-md-12">
                            <div>
                                <ul class="d-flex justify-content-between" style="direction: rtl;">
                                    @if ($advertise->owner->show_phone_number)
                                        <li>شماره تلفن : {{ $advertise->owner->phone ?? 'صاحب آگهی شماره تلفنی ثبت نکرده است' }}</li>
                                    @endif

                                    @if ($advertise->owner->show_email)
                                        <li>ایمیل : {{ $advertise->owner->email }}</li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- .col-md-8 -->
                <div class="col-lg-4 sidebar ftco-animate">

                    @include('app.layouts.partials.categories')

                    <x-app-latests :items="$latestBlogs" type="بلاگ ها" />

                </div>
            </div>
            <div class="mt-5 mb-5 col-md-12 properties-single ftco-animate">
                <h4 class="mb-4">آگهی های مرتبط</h4>
                <div class="row">
                    <div class="properties-slider owl-carousel ftco-animate">
                        @foreach ($relatedAdvertises as $advertise)
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
                                    <div class="">
                                            <div class="">
                                                                    <h3>...{{ Str::substr($advertise->address, 0, 20) }}</h3>
                                                                    <p>{{ $advertise->home_type }}</p>
                                                                </div>

                                                            </div>

                                                            <hr>
                                                            <p class=" bottom-area d-flex">
                                        <i class="mx-1 flaticon-selection"></i>
                                        <span style="direction: rtl;" class="">
                                            {{ $advertise->area }}
                                        </span>
                                        </p>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
