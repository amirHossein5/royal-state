@extends('dashbord.layouts.master')

@section('head-tag')
    <title> داشبورد | ویرایش خبر</title>
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
                            <form class="row" action="{{ route('dashboard.posts.update', $post->id) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input type="hidden" name="_method" value="put">
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="title">عنوان</label>
                                        <input name="title" type="text" id="title"
                                            value="{{ oldOrValue('title', $post->title) }}"
                                            class="form-control {{ errorClass($errors, 'title') }}" placeholder="نام ...">
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="published_at">تاریخ انتشار</label>
                                        <input name="published_at" type="date"
                                            value="{{ oldOrValue('published_at', $post->published_at) }}"
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
                                        <img src="{{ asset($post->image) }}" alt="" width="200" height="150"
                                            class="mt-4">
                                        @error('image')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <div class="form-group">
                                            <label for="cat_id">دسته والد</label>
                                            <select name="cat_id"
                                                class="select2 form-control {{ errorClass($errors, 'cat_id') }}">
                                                @foreach ($categories as $categorySelect)
                                                    <option value="{{ $categorySelect->id }}"
                                                        {{ oldOrValueSelected('cat_id', $post->cat_id, $categorySelect->id) }}>
                                                        {{ $categorySelect->name }}</option>
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
                                        <textarea class="form-control {{ errorClass($errors, 'body') }}" id="body"
                                            rows="5" name="body"
                                            placeholder="متن ...">{{ oldOrValue('body', $post->body) }}</textarea>
                                        @error('body')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </section>
                                </div>

                                <div class="col-md-6">
                                    <section class="form-group">
                                        <button type="submit" class="btn btn-primary">ویرایش</button>
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

