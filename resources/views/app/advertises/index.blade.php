@extends('app.layouts.master')

@section('head-tag')
    <title>آگهی ها</title>
@endsection

@section('content')

    @include('app.layouts.partials.hero-wrap', [
    'this_page'=>'آگهی ها',
    'pages' => ['آگهی ها']
    ])


    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">

                @foreach ($advertises as $advertise)
                    <div class="col-md-4 ftco-animate">
                        <div class="properties">
                            <a href="property-single.html" class="img img-2 d-flex justify-content-center align-items-center"
                                style="background-image: url(images/properties-1.jpg);">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="icon-search2"></span>
                                </div>
                            </a>
                            <div class="p-3 text">
                                @if ($advertise->status === 0)
                                    <span class="status sale">خرید</span>
                                @else
                                    <span class="status rent">اجاره</span>
                                @endif

                                <div class="d-flex">
                                    <div class="one">
                                        <h3>
                                            <a href="property-single.html">{{ sub_str($advertise->address, 0, 10) }}</a>
                                        </h3>
                                        <p>{{ $advertise->home_type }}</p>
                                    </div>
                                    <div class="two">
                                        <span class="price">{{ number_format($advertise->amount, 3) }}
                                            تومان
                                        </span>
                                    </div>
                                </div>
                                <p>{{ $advertise->description }}</p>
                                <hr>
                                <p class="bottom-area d-flex">
                                    <span>
                                        <i class="flaticon-selection"></i>
                                        {{ $advertise->area }} متر
                                    </span>
                                    <span class="ml-auto">
                                        <i class="flaticon-bathtub"></i>
                                        {{ $advertise->toilet }}
                                    </span>
                                    <span><i class="flaticon-bed"></i>
                                        {{ $advertise->room }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="mt-5 row">
                <div class="text-center col">
                    <div class="block-27">
                        {{ $advertises->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
