@extends('app.layouts.master')

@section('head-tag')
    <title>درباره ما </title>
@endsection

@section('content')

    @include('app.layouts.partials.hero-wrap', [
        'this_page'=>'درباره ما',
        'pages' => ['درباره ما']
    ])

    <section class="ftco-section ftc-no-pb">
        <div class="container">
            <div class="row no-gutters d-flex justify-content-center">

                <div class="col-md-7 wrap-about pb-md-5 ftco-animate">
                    <div class="mb-5 heading-section heading-section-wo-line pl-md-5">
                        <div class="pl-md-5 ml-md-5">
                            <span class="subheading">خلاصه وبسایت</span>
                        </div>
                    </div>
                    <div class="mb-5 pl-md-5 ml-md-5">
                        {!! $setting->long_description !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
