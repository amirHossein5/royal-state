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
            <div class="row d-flex">

                @foreach ($posts as $post)
                    <div class="col-md-3 d-flex ftco-animate">
                        <div class="blog-entry align-self-stretch">
                            <a href="blog-single.html" class="block-20"
                                style="background-image: url({{ $post->image }});">
                            </a>
                            <div class="mt-3 text d-block">
                                <h3 class="mt-3 heading">
                                    <a href="{{ route('app.posts.show', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <div class="mb-3 meta">
                                    <div>
                                        <a href="{{ route('app.posts.show', $post->slug) }}">
                                            {{ $post->created_at }}
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ route('app.posts.show', $post->slug) }}">
                                            {{ $post->author->first_name }}
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ route('app.posts.show', $post->slug) }}" class="meta-chat">
                                            <span class="icon-chat"> </span>
                                            {{ $post->comments_count }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-5 row">
                    <div class="text-center col">
                        <div class="block-27">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
    </section>

@endsection
