@extends('app.layouts.master')

@section('head-tag')
    <title>بلاگ ها</title>
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
                    {!! $post->body !!}

                    <div class="pt-5 mt-5">
                        <h3 class="mb-5">نظرات</h3>
                        <ul class="comment-list" id="allComments">

                            @foreach ($comments as $comment)

                                <li class="p-2 border rounded border-primary comment" id="comment">

                                    <div class="flex-row mb-2 d-flex justify-content-between align-items-baseline">
                                        <div class="meta">

                                            @if (auth()->user()->id === $comment->user_id)
                                                <form method="post"
                                                    action="{{ route('app.comments.destroy', $comment->id) }}"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')

                                                    <button type="submit" class="rounded btn btn-danger btn-sm">حذف</button>
                                                </form>
                                            @endif

                                            <small>
                                                {{ jDate()->forge($comment->created_at)->format('%A, %d %B %Y, H:i:s') }}
                                            </small>

                                        </div>
                                        <h5>{{ $comment->user->full_name }}</h3>
                                    </div>
                                    <div class="comment-body">
                                        <p style="direction: rtl;">{{ $comment->comment }}</p>
                                        <p><span class="reply" style="cursor: pointer;"
                                                onclick="replyTo({{ $comment->id }})">پاسخ</span></p>
                                    </div>
                                    @foreach ($comment->children as $comment)
                                        @include('app.layouts.partials.comments-children',['comment'=>$comment])
                                    @endforeach
                                </li>
                            @endforeach


                        </ul>

                        @if ($comments->hasMorePages())
                            <section class="text-center">
                                <button type="button" class="rounded btn btn-secondary" id="addMore">بیشتر</button>
                            </section>
                        @endif
                        <!-- END comment-list -->

                        <div class="pt-5 comment-form-wrap">
                            <h3 class="mb-5">درج نظر</h3>
                            <form action="{{ route('app.comments.store', $post->slug) }}" id="commentForm" method="POST"
                                class="p-5 bg-light">
                                @csrf

                                @guest
                                    <section class="row">
                                        <div class="form-group col-md-6">
                                            <label for="name">نام</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" required
                                                value="{{ old('first_name') }}">

                                            @error('first_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">نام خانوادگی </label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" required
                                                value="{{ old('last_name') }}">

                                            @error('last_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </section>

                                    <div class="form-group">
                                        <label for="email">ایمیل</label>
                                        <input type="email" class="form-control" name="email" id="email" required
                                            value="{{ old('email') }}">

                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <section class="row">
                                        <div class="form-group col-md-6">
                                            <label for="password">رمز عبور</label>
                                            <input type="password" name="password" class="form-control" id="password">

                                            @error('password')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="confirmation_password"> تکرار رمز عبور</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                id="confirmation_password">

                                            @error('confirmation_password')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </section>

                                @endguest

                                <div class="form-group">
                                    <label for="comment">پیام</label>
                                    <textarea style="direction: rtl;" name="comment" id="comment" cols="30" rows="10"
                                        class="form-control">{{ old('comment') }}</textarea>

                                    @error('comment')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
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

                    <x-app-latests :items="$latestAdvertises" type="آگهی ها" />

                </div>
            </div>
    </section> <!-- .section -->
@endsection

@section('scripts')

    <script type="text/javascript">
        function replyTo(id) {
            var position = $('.comment-form-wrap').offset().top;

            $('html,body').animate({
                scrollTop: position
            }, 300)

            var replyToInput = $('#commentForm').find('input[name="replyTo"]');

            if (replyToInput.length !== 0) {
                $(replyToInput).attr('value', id)

                return true;
            }

            $('#commentForm').append(`<input name="replyTo" type="hidden" value="${id}"/>`);

            return true;
        }

        $(document).ready(function() {

            const totalPages = @json($comments->lastPage());
            var page = 2;

            $('#addMore').click(function() {

                if (!@json($comments->hasMorePages()) || page > totalPages) {
                    return false;
                }

                $('#addMore').text('...درحال لود')

                $.ajax({
                    type: "get",
                    url: @json($comments->path()) + `?page=${page}`,
                    success: function(response) {
                        var responseHtml = $(response).find('#allComments').html();

                        $('#allComments').append(responseHtml);

                        page += 1;

                        $('#addMore').text('بیشتر')

                        if (page > totalPages) {
                            $('#addMore').remove();
                        }
                    }
                });

            })
        })
    </script>
    {{-- {{dd($comments->nextPageUrl())}} --}}
@endsection
