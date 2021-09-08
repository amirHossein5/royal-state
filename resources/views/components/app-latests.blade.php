@props(['type', 'items'])



<div class="sidebar-box ftco-animate">
    <h3>اخرین {{ $type }}</h3>

    @if ($type === 'آگهی ها')

        @foreach ($items as $item)
            <div class="mb-4 block-21 d-flex">
                <a class="mr-4 blog-img" href="{{ route('app.advertises.show', $item->id) }}"
                    style="background-image: url({{ asset($item->image) }});">
                </a>
                <div class="text">
                    <h3 class="heading">
                        <a href="{{ route('app.advertises.show', $item->id) }}"
                            style="font-family: Vazir !important"
                            >
                            {{ $item->title }}
                        </a>
                    </h3>
                </div>
            </div>
        @endforeach

    @elseif ($type === 'بلاگ ها')

        @foreach ($items as $item)
            <div class="mb-4 block-21 d-flex">
                <a class="mr-4 blog-img" href="{{ route('app.posts.show', $item->slug) }}"
                    style="background-image: url({{ asset($item->image) }});">
                </a>
                <div class="text">
                    <h3 class="heading">
                        <a href="{{ route('app.posts.show', $item->slug) }}"
                            style="font-family: Vazir !important"
                            >
                            {{ $item->title }}
                        </a>
                    </h3>
                    <div class="meta">
                        <div>
                            <a href="{{ route('app.posts.show', $item->slug) }}">
                                <span class="icon-calendar">
                                </span>
                                {{ jdate($item->created_at)->format('%A, %d %B %Y') }}
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('app.posts.show', $item->slug) }}">
                                <span class="icon-chat">
                                </span>
                                {{ $item->comments_count }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    @endif


</div>
