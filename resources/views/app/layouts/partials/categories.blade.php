<div class="sidebar-box ftco-animate">
    <div class="categories">
        <h3>دسته بندی ها</h3>

        @foreach ($categories as $category)
            <li>
                {{ $category->name }} <span>({{ $category->count }})</span>
            </li>
        @endforeach

    </div>
</div>
