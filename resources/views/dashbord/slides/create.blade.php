@extends('dashbord.layouts.master')

@section('head-tag')
    <title>اسلایدر | داشبورد</title>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">اسلایدشو</h4>
                        <span><a href="{{ route('dashboard.slides.index') }}" class="btn btn-success">بازگشت</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <form class="row" action="{{ route('dashboard.slides.create') }}" method="post"
                                enctype="multipart/form-data">

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="title">عنوان</label>
                                        <input value="{{ old('title') }}" name="title" type="text" id="title"
                                            class="form-control" placeholder="عنوان ..."
                                            {{ errorClass($errors, 'title') }}>
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="advertise_id">آگهی</label>
                                        <select name="advertise_id" id="advertise_id"
                                            {{ errorClass($errors, 'advertise_id') }}>
                                            <option value="">__</option>
                                            @foreach ($advertises as $advertise)
                                                <option value="{{ $advertise->id }}"
                                                    {{ oldEqualsSelected('advertise_id', $advertise->id) }}>
                                                    {{ $advertise->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('advertise_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="address">آدرس</label>
                                        <input value="{{ old('address') }}" name="address" type="text" id="address"
                                            class="form-control" placeholder="آدرس ..."
                                            {{ errorClass($errors, 'address') }}>
                                        @error('address')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="amount">مبلغ</label>
                                        <input value="{{ old('amount') }}" name="amount" type="text" id="amount"
                                            class="form-control" placeholder="مبلغ ..."
                                            {{ errorClass($errors, 'amount') }}>
                                        @error('amount')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="image">تصویر</label>
                                        <input name="image" type="file" id="image" class="form-control-file "
                                            {{ errorClass($errors, 'image') }}>
                                        @error('image')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>


                                <div class="col-md-12">
                                    <section class="form-group">
                                        <label for="body">متن</label>
                                        <textarea class="form-control" id="body" rows="5" name="body" placeholder="متن ..."
                                            {{ errorClass($errors, 'body') }}></textarea>
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
