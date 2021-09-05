@extends('app.layouts.master')

@section('head-tag')
    <title>بلاگ ها</title>
@endsection

@section('content')

    @include('app.layouts.partials.hero-wrap', [
    'this_page'=>'بلاگ ها',
    'pages' => ['بلاگ ها']
    ])

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate">
                    <h2 class="mb-3">{{ $post->title }}</h2>
                    {!! $post->description !!}

                    <div class="pt-5 mt-5">
                        <h3 class="mb-5">نظرات</h3>
                        <ul class="comment-list">

                            @foreach ($post->comments as $comment)

                                <li class="comment">
                                    <div class="vcard bio">
                                        <img src="images/person_1.jpg" alt="Image placeholder">
                                    </div>
                                    <div class="comment-body">
                                        <h3>{{ $comment->user->full_name }}</h3>
                                        <div class="meta">{{ $comment->created_at }}</div>
                                        <p>{{ $comment->comment }}</p>
                                        <p><a href="#" class="reply">پاسخ</a></p>
                                    </div>
                                </li>

                                <li class="comment">
                                    <div class="vcard bio">
                                        <img src="images/person_1.jpg" alt="Image placeholder">
                                    </div>
                                    <div class="comment-body">
                                        <h3>نیما کریمی</h3>
                                        <div class="meta">۲/۲/۱۳۹۸ ۲۲:۲۱</div>
                                        <p>خیلی عالی بود ممنون</p>
                                        <p><a href="#" class="reply">پاسخ</a></p>
                                    </div>

                                    <ul class="children">
                                        <li class="comment">
                                            <div class="vcard bio">
                                                <img src="images/person_1.jpg" alt="Image placeholder">
                                            </div>
                                            <div class="comment-body">
                                                <h3>نیما کریمی</h3>
                                                <div class="meta">۲/۲/۱۳۹۸ ۲۲:۲۱</div>
                                                <p>خیلی عالی بود ممنون</p>
                                                <p><a href="#" class="reply">پاسخ</a></p>
                                            </div>


                                            <ul class="children">
                                                <li class="comment">
                                                    <div class="vcard bio">
                                                        <img src="images/person_1.jpg" alt="Image placeholder">
                                                    </div>
                                                    <div class="comment-body">
                                                        <h3>نیما کریمی</h3>
                                                        <div class="meta">۲/۲/۱۳۹۸ ۲۲:۲۱</div>
                                                        <p>خیلی عالی بود ممنون</p>
                                                        <p><a href="#" class="reply">پاسخ</a></p>
                                                    </div>
                                                    <ul class="children">
                                                        <li class="comment">
                                                            <div class="vcard bio">
                                                                <img src="images/person_1.jpg" alt="Image placeholder">
                                                            </div>
                                                            <div class="comment-body">
                                                                <h3>نیما کریمی</h3>
                                                                <div class="meta">۲/۲/۱۳۹۸ ۲۲:۲۱</div>
                                                                <p>خیلی عالی بود ممنون</p>
                                                                <p><a href="#" class="reply">پاسخ</a></p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>

                                <li class="comment">
                                    <div class="vcard bio">
                                        <img src="images/person_1.jpg" alt="Image placeholder">
                                    </div>
                                    <div class="comment-body">
                                        <h3>نیما کریمی</h3>
                                        <div class="meta">۲/۲/۱۳۹۸ ۲۲:۲۱</div>
                                        <p>خیلی عالی بود ممنون</p>
                                        <p><a href="#" class="reply">پاسخ</a></p>
                                    </div>
                                </li>
                        </ul>
                        <!-- END comment-list -->

                        <div class="pt-5 comment-form-wrap">
                            <h3 class="mb-5">درج نظر</h3>
                            <form action="{{ route('app.comments.store') }}" method="POST" class="p-5 bg-light">

                                @guest
                                    <section class="row">
                                        <div class="form-group col-md-6">
                                            <label for="name">نام</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name"
                                                required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">خانوادگی نام</label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" required>
                                        </div>
                                    </section>

                                    <div class="form-group">
                                        <label for="email">ایمیل</label>
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>
                                    <section class="row">
                                        <div class="form-group col-md-6">
                                            <label for="password">رمز عبور</label>
                                            <input type="url" name="password" class="form-control" id="password">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="confirmation_password"> تکرار رمز عبور</label>
                                            <input type="url" name="confirmation_password" class="form-control"
                                                id="confirmation_password">
                                        </div>
                                    </section>

                                @endguest

                                <div class="form-group">
                                    <label for="comment">پیام</label>
                                    <textarea name="comment" id="comment" cols="30" rows="10"
                                        class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="ارسال نطر" class="px-4 py-3 btn btn-primary">
                                </div>

                            </form>
                        </div>
                    </div>

                </div> <!-- .col-md-8 -->
                <div class="col-lg-4 sidebar ftco-animate">

                    @include('app.layouts.partials.categories')

                    <x-app-latest :items="latestBlogs" type="آگهی ها" />

                </div>
            </div>
    </section> <!-- .section -->
@endsection
