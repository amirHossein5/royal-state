<div class="sidebar-box ftco-animate">
    <div class="categories">
        <h3>دسته بندی ها</h3>

        @foreach ($categories as $name => $count)
            <li>
                @if (request()->routeIs('app.advertises.show'))
                    <a href="{{ route('app.posts', ['category' => $name]) }}">
                        {{ $name }} <span>({{ $count }})</span>
                    </a>
                @else
                    <a href="{{ route('app.advertises', ['category' => $name]) }}">
                        {{ $name }} <span>({{ $count }})</span>
                    </a>
                @endif
            </li>
        @endforeach

    </div>
</div>
