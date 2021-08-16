@extends('dashbord.layouts.master')

@section('head-tag')
    <title> داشبورد | نظرات</title>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">نظرات</h4>
                        <span><a href="{{ route('dashboard.comments.index') }}" class="btn btn-success">بازگشت</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <div class="row">
                                <div class="col-md-12">
                                    {{-- <h2>{{ $comment->user()->full_name() }}</h2> --}}
                                    <p>{{ $comment->comment }}</p>
                                </div>

                                <div class="pt-4 mt-4 col-md-12 border-top">
                                    <form
                                        action="{{ route('dashboard.comments.store', ['post_id' => $comment->post->id]) }}"
                                        method="post">
                                        @csrf
                                        <section class="form-group">
                                            <label for="comment">پاسخ</label>
                                            <textarea class="form-control " id="comment" rows="5" name="comment"
                                                placeholder="پاسخ ..."
                                                {{ errorClass($errors, 'comment') }}>{{ old('comment') }}</textarea>
                                            @error('comment')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>
                                        <div class="col-md-6">
                                            <section class="form-group">
                                                <button type="submit" class="btn btn-primary">ایجاد</button>
                                            </section>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
