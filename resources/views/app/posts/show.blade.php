@extends('app.layouts.master')

@section('head-tag')
    <title>بلاگ ها</title>

    @livewireStyles()
@endsection

@section('content')

    @include('app.layouts.partials.hero-wrap', [
    'this_page'=>'بلاگ ',
    'pages' => ['بلاگ']
    ])

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate">
                    <section style="overflow: auto;">
                        {!! $post->body !!}
                    </section>

                    <div class="pt-5 mt-5">
                        <h3 class="mb-5">نظرات</h3>

                        @livewire('post.load-more-comments',['postId' => $post->id])

                        <!-- END comment-list -->

                        <div class="pt-5 comment-form-wrap">
                            <h3 class="mb-5">درج نظر</h3>

                            @livewire('post.create-comment',['post'=>$post])

                        </div>
                    </div>

                </div> <!-- .col-md-8 -->
                <div class="col-lg-4 sidebar ftco-animate">
                    @include('app.layouts.partials.categories')

                    <x-app-latests :items="$latestAdvertises" type="آگهی ها" />

                </div>
            </div>
    </section> <!-- .section -->
@endsection

@section('scripts')

    @livewireScripts()

@endsection
