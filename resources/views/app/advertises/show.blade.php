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
                                <div class="item">
                                    <div class="properties-img" style="background-image: url(images/properties-1.jpg);">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="properties-img" style="background-image: url(images/properties-2.jpg);">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="properties-img" style="background-image: url(images/properties-3.jpg);">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 mb-5 col-md-12 Properties-single ftco-animate">
                            <h2>تهرانپارس شرقی</h2>
                            <p class="mb-4 rate">
                                <span class="loc"><a href="#"><i class="icon-map"></i> تهرانپارس فلکه دوم
                                        خیابان سوم پلاک ۴ واحد ۲</a></span>
                            </p>
                            <p>بهترین منقطه تهرانپارس در محله ای ساکت و بی سروصدا . تک واحدی بدون رفت و آمد بی مورد. پارکینگ
                                بزرگ با فضای زیاد افتابگیر با نور عالی نو ساز با بهترین و پیشرفته ترین ابزار های دنیا</p>
                            <div class="mt-5 mb-5 d-md-flex">
                                <ul>
                                    <li><span>متراژ : </span> ۲۰۰ متر</li>
                                    <li><span>اتاق خواب : </span> 4</li>
                                    <li><span>سرویس بهداشتی : </span> ۲</li>
                                    <li><span>پارکینگ : </span> ۱</li>
                                </ul>
                                <ul class="ml-md-5">
                                    <li><span>نوع کفپوش : </span> پارکت</li>
                                    <li><span>سال ساخت : </span> ۱۳۹۷</li>
                                    <li><span>انباری : </span> 1</li>
                                    <li><span>بالکن : </span> دارد</li>
                                </ul>
                            </div>
                            <p>بهترین منقطه تهرانپارس در محله ای ساکت و بی سروصدا . تک واحدی بدون رفت و آمد بی مورد. پارکینگ
                                بزرگ با فضای زیاد افتابگیر با نور عالی نو ساز با بهترین و پیشرفته ترین ابزار های دنیا</p>
                        </div>


                        <div class="mt-5 mb-5 col-md-12 properties-single ftco-animate">
                            <h4 class="mb-4">آگهی های مرتبط</h4>
                            <div class="row">
                                <div class="col-md-6 ftco-animate">
                                    <div class="properties">
                                        <a href="property-single.html"
                                            class="img img-2 d-flex justify-content-center align-items-center"
                                            style="background-image: url(images/properties-1.jpg);">
                                            <div class="icon d-flex justify-content-center align-items-center">
                                                <span class="icon-search2"></span>
                                            </div>
                                        </a>
                                        <div class="p-3 text">
                                            <span class="status sale">خرید</span>
                                            <div class="d-flex">
                                                <div class="one">
                                                    <h3><a href="property-single.html">تهرانپارس شرقی</a></h3>
                                                    <p>آپارتمان</p>
                                                </div>
                                                <div class="two">
                                                    <span class="price">۸۸۸۸۸ تومان</span>
                                                </div>
                                            </div>
                                            <p>با بهترین امکانات و قیمت بسیار مناسب</p>
                                            <hr>
                                            <p class="bottom-area d-flex">
                                                <span><i class="flaticon-selection"></i> ۱۰۰ متر</span>
                                                <span class="ml-auto"><i class="flaticon-bathtub"></i> ۲</span>
                                                <span><i class="flaticon-bed"></i> ۱</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 ftco-animate">
                                    <div class="properties">
                                        <a href="property-single.html"
                                            class="img img-2 d-flex justify-content-center align-items-center"
                                            style="background-image: url(images/properties-2.jpg);">
                                            <div class="icon d-flex justify-content-center align-items-center">
                                                <span class="icon-search2"></span>
                                            </div>
                                        </a>
                                        <div class="p-3 text">
                                            <span class="status sale">خرید</span>
                                            <div class="d-flex">
                                                <div class="one">
                                                    <h3><a href="property-single.html">تهرانپارس شرقی</a></h3>
                                                    <p>آپارتمان</p>
                                                </div>
                                                <div class="two">
                                                    <span class="price">۸۸۸۸۸ تومان</span>
                                                </div>
                                            </div>
                                            <p>با بهترین امکانات و قیمت بسیار مناسب</p>
                                            <hr>
                                            <p class="bottom-area d-flex">
                                                <span><i class="flaticon-selection"></i> ۱۰۰ متر</span>
                                                <span class="ml-auto"><i class="flaticon-bathtub"></i> ۲</span>
                                                <span><i class="flaticon-bed"></i> ۱</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- .col-md-8 -->
                <div class="col-lg-4 sidebar ftco-animate">

                    @include('app.layouts.partials.categories')

                    <x-app-latest :items="latestBlogs" type="بلاگ ها"/>

                </div>
            </div>
        </div>
    </section>
@endsection
