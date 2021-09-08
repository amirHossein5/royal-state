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
                    <div class="col-sm col-md-6 col-lg-4">
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
                                    <p class="bottom-area d-flex">
                                        <i class="mx-1 flaticon-selection"></i>
                                        <span style="direction: rtl;" class="">
                                            {{ $advertise->area }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                @endforeach

            </div>
            <h5 style="direction: rtl;">
                @if ($advertises->total() === 0)
                   متاسفانه آگهی ای

                   @if (request()->has('address'))
                    با آدرس {{ request()->address }}
                   @endif

                   پیدا نشد.
                @endif
            </h5>
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
