@extends('dashbord.layouts.master')

@section('head-tag')
    <title>ادمین / آگهی</title>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">آگهی</h4>
                        <span><a href="{{ route('dashboard.advertises.index') }}"
                                class="btn btn-success">بازگشت</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <form class="row" action="{{ route('dashboard.advertises.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="title">عنوان</label>
                                        <input value="{{ old('title') }}" name="title" type="text" id="title"
                                            class="form-control {{ errorClass($errors, 'title') }}"
                                            placeholder="عنوان ...">
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>



                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="image">تصویر</label>
                                        <input name="image" type="file" id="image"
                                            class="form-control-file {{ errorClass($errors, 'file') }}">
                                        @error('image')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="address">آدرس</label>
                                        <input value="{{ old('address') }}" name="address" type="text" id="address"
                                            class="form-control {{ errorClass($errors, 'address') }}"
                                            placeholder="آدرس ...">
                                        @error('address')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="floor">کف</label>
                                        <input value="{{ old('floor') }}" name="floor" type="text" id="floor"
                                            class="form-control {{ errorClass($errors, 'floor') }}" placeholder="کف ...">
                                        @error('floor')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="year">سال ساخت</label>
                                        <input value="{{ old('year') }}" name="year" type="number" id="year"
                                            class="form-control {{ errorClass($errors, 'year') }}"
                                            placeholder="سال ساخت ...">
                                        @error('year')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="amount">قیمت</label>
                                        <input value="{{ old('amount') }}" name="amount" type="number" id="amount"
                                            class="form-control {{ errorClass($errors, 'amount') }}"
                                            placeholder="قیمت ...">
                                        @error('amount')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="area">متراژ</label>
                                        <input value="{{ old('area') }}" name="area" type="text" id="area"
                                            class="form-control {{ errorClass($errors, 'area') }}"
                                            placeholder="سال ساخت ...">
                                        @error('area')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="room">اتاق</label>
                                        <input value="{{ old('room') }}" name="room" type="number" id="room"
                                            class="form-control {{ errorClass($errors, 'room') }}"
                                            placeholder="اتاق ...">
                                        @error('room')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="tag">تگ</label>
                                        <input value="{{ old('tag') }}" name="tag" type="text" id="tag"
                                            class="form-control {{ errorClass($errors, 'tag') }}" placeholder="تگ ...">
                                        @error('tag')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>


                                <div class="col-md-12">
                                    <section class="form-group">
                                        <label for="description">متن</label>
                                        <textarea class="form-control {{ errorClass($errors, 'description') }}"
                                            id="description" rows="5" name="description"
                                            placeholder="متن ...">{{ old('description') }}</textarea>
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </section>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <div class="form-group">
                                            <label for="storeroom">انبار</label>
                                            <select name="storeroom"
                                                class="select2 form-control {{ errorClass($errors, 'storeroom') }}">
                                                <option value="0" {{ oldEqualsSelected('storeroom', 0) }}>ندارد
                                                </option>
                                                <option value="1" {{ oldEqualsSelected('storeroom', 1) }}>دارد
                                                </option>
                                            </select>
                                            @error('storeroom')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <div class="form-group">
                                            <label for="balcony">بالکن</label>
                                            <select name="balcony"
                                                class="select2 form-control {{ errorClass($errors, 'balcony') }}">
                                                <option value="0" {{ oldEqualsSelected('balcony', 0) }}>ندارد
                                                </option>
                                                <option value="1" {{ oldEqualsSelected('balcony', 1) }}>دارد
                                                </option>
                                            </select>
                                            @error('balcony')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <div class="form-group">
                                            <label for="toilet">توالت</label>
                                            <select name="toilet"
                                                class="select2 form-control {{ errorClass($errors, 'toilet') }}">
                                                <option {{ oldEqualsSelected('toilet', 'ایرانی') }} value="ایرانی">
                                                    ایرانی</option>
                                                <option {{ oldEqualsSelected('toilet', 'فرنگی') }} value="فرنگی">
                                                    فرنگی
                                                </option>
                                                <option {{ oldEqualsSelected('toilet', 'ایرانی و فرنگی') }}
                                                    value="ایرانی و فرنگی">ایرانی و فرنگی</option>
                                            </select>
                                            @error('toilet')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <div class="form-group">
                                            <label for="sell_status">نوع آگهی</label>
                                            <select name="sell_status"
                                                class="select2 form-control {{ errorClass($errors, 'sell_status') }}">
                                                <option value="0" {{ oldEqualsSelected('sell_status', 0) }}>خرید
                                                </option>
                                                <option value="1" {{ oldEqualsSelected('sell_status', 1) }}>اجاره
                                                </option>
                                            </select>
                                            @error('sell_status')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <div class="form-group">
                                            <label for="type">نوع ملک</label>
                                            <select name="type"
                                                class="select2 form-control {{ errorClass($errors, 'type') }}">
                                                <option {{ oldEqualsSelected('type', 0) }} value="0">آپارتمان
                                                </option>
                                                <option {{ oldEqualsSelected('type', 1) }} value="1">ویلایی
                                                </option>
                                                <option {{ oldEqualsSelected('type', 2) }} value="2">زمین
                                                </option>
                                                <option {{ oldEqualsSelected('type', 3) }} value="3">سوله
                                                </option>
                                            </select>
                                            @error('type')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <div class="form-group">
                                            <label for="parking">پارکینگ</label>
                                            <select name="parking"
                                                class="select2 form-control {{ errorClass($errors, 'parking') }}">
                                                <option value="0" {{ oldEqualsSelected('parking', 0) }}>ندارد
                                                </option>
                                                <option value="1" {{ oldEqualsSelected('parking', 1) }}>دارد
                                                </option>
                                            </select>
                                            @error('parking')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <div class="form-group">
                                            <label for="cat_id">دسته</label>
                                            <select name="cat_id"
                                                class="select2 form-control {{ errorClass($errors, 'cat_id') }}">
                                                @foreach ($categories as $categorySelect)
                                                    <option value="{{ $categorySelect->id }}"
                                                        {{ oldEqualsSelected('cat_id', $categorySelect->id) }}>
                                                        {{ $categorySelect->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('cat_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </fieldset>
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

@section('scripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

    <script type="text/javascript">
        CKEDITOR.replace('body')
    </script>
@endsection
