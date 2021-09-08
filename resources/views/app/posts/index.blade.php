@extends('app.layouts.master')

@section('head-tag')
    <title>بلاگ ها</title>
@endsection

@section('content')

    @include('app.layouts.partials.hero-wrap', [
    'this_page'=>'بلاگ ها',
    'pages' => ['بلاگ ها']
    ])

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row d-flex justify-content-center">

                @foreach ($posts as $post)
                    <div class="d-flex ftco-animate col-md-3 col-sm col-lg-4">
                        <div class="blog-entry align-self-stretch w-100">
                            <a href="{{ route('app.posts.show', $post->slug) }}" class="block-20"
                                style="background-image: url({{ $post->image }});">
                            </a>
                            <div class="mt-3 text d-block">
                                <h3 class="mt-3 heading" style="min-height: 4rem">
                                    <a href="{{ route('app.posts.show', $post->slug) }}"
                                        style="font-family: Vazir !important">{{ $post->title }}</a>
                                </h3>
                                <div class="mb-3 meta">
                                    <div>{{ jDate()->forge($post->created_at)->format('%A, %d %B %Y') }}</div>
                                    <div>{{ $post->author->first_name }}</div>
                                    <div><span class="icon-chat"></span> {{ $post->comments_count }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <section class="d-flex justify-content-center">
                {{ $posts->links() }}
            </section>
    </section>

@endsection
