@extends('dashbord.layouts.master')

@section('head-tag')
    <title> داشبورد | ساخت خبر جدید</title>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">پست</h4>
                        <span><a href="{{ route('dashboard.posts.index') }}" class="btn btn-success">بازگشت</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <form class="row" action="{{ route('dashboard.posts.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="title">عنوان</label>
                                        <input value="{{ old('title') }}" name="title" type="text" id="title"
                                            class="form-control {{ errorClass($errors, 'title') }}" placeholder="نام ...">
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="published_at">تاریخ انتشار</label>
                                        <input autofocus value="{{ old('published_at') }}" name="published_at" type="date"
                                            id="published_at"
                                            class="form-control {{ errorClass($errors, 'published_at') }}">
                                        @error('published_at')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="image">تصویر</label>
                                        <input name="image" type="file" id="image"
                                            class="form-control-file {{ errorClass($errors, 'image') }}">
                                        @error('image')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <div class="form-group">
                                            <label for="cat_id">دسته</label>
                                            <select name="cat_id"
                                                class="select2 form-control  {{ errorClass($errors, 'cat_id') }}">
                                                <option value="">
                                                    دسته مورد نظر را انتخاب کنید
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ oldEqualsSelected('cat_id', $category->id) }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            @error('cat_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <section class="form-group">
                                        <label for="body">متن</label>
                                        <textarea class="form-control  {{ errorClass($errors, 'body') }}" id="body"
                                            rows="5" name="body" placeholder="متن ...">{{ old('body') }}</textarea>
                                        @error('body')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                    </section>
                                </div>
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
    </section>
@endsection

@section('script')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

    <script type="text/javascript">
        CKEDITOR.replace('body')
    </script>
@endsection
