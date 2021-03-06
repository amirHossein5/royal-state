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
                        <h4 class="card-title">ویرایش</h4>
                        <span><a href="{{ route('dashboard.advertises.index') }}"
                                class="btn btn-success">بازگشت</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <form class="row" action="{{ route('dashboard.advertises.update', $advertise->id) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input type="hidden" name="_method" value="put">
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="title">عنوان</label>
                                        <input value="{{ oldOrValue('title', $advertise->title) }}" name="title"
                                            type="text" id="title" class="form-control {{ errorClass($errors, 'title') }}"
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
                                            class="form-control-file {{ errorClass($errors, 'image') }}">
                                        @error('image')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="address">آدرس</label>
                                        <input value="{{ oldOrValue('address', $advertise->address) }}" name="address"
                                            type="text" id="address"
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
                                        <input value="{{ oldOrValue('floor', $advertise->floor) }}" name="floor"
                                            type="text" id="floor"
                                            class="form-control {{ errorClass($errors, 'floor') }}" placeholder="کف ...">
                                        @error('floor')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="year">سال ساخت</label>
                                        <input value="{{ oldOrValue('year', $advertise->year) }}" name="year" type="text"
                                            id="year" class="form-control {{ errorClass($errors, 'year') }}"
                                            placeholder="سال ساخت ...">
                                        @error('year')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="amount">قیمت</label>
                                        <input value="{{ oldOrValue('amount', $advertise->amount) }}" name="amount"
                                            type="text" id="amount"
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
                                        <input value="{{ oldOrValue('area', $advertise->area) }}" name="area" type="text"
                                            id="area" class="form-control {{ errorClass($errors, 'area') }}"
                                            placeholder="سال ساخت ...">
                                        @error('area')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="room">اتاق</label>
                                        <input value="{{ oldOrValue('room', $advertise->room) }}" name="room" type="text"
                                            id="room" class="form-control {{ errorClass($errors, 'room') }}"
                                            placeholder="سال ساخت ...">
                                        @error('room')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="tag">تگ</label>
                                        <input value="{{ oldOrValue('tag', $advertise->tag) }}" name="tag" type="text"
                                            id="tag" class="form-control {{ errorClass($errors, 'tag') }}"
                                            placeholder="تگ ...">
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
                                            placeholder="متن ...">{{ oldOrValue('description', $advertise->description) }}</textarea>
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
                                                <option value="0"
                                                    {{ oldOrValueSelected('storeroom', $advertise->storeroom, 0) }}>
                                                    ندارد
                                                </option>
                                                <option value="1"
                                                    {{ oldOrValueSelected('storeroom', $advertise->storeroom, 1) }}>
                                                    دارد
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
                                                <option value="0"
                                                    {{ oldOrValueSelected('balcony', $advertise->balcony, 0) }}>
                                                    ندارد
                                                </option>
                                                <option value="1"
                                                    {{ oldOrValueSelected('balcony', $advertise->balcony, 1) }}>
                                                    دارد
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
                                                <option value="ایرانی"
                                                    {{ oldOrValueSelected('toilet', $advertise->toilet, 'ایرانی') }}>
                                                    ایرانی</option>
                                                <option value="فرنگی"
                                                    {{ oldOrValueSelected('toilet', $advertise->toilet, 'فرنگی') }}>
                                                    فرنگی
                                                </option>
                                                <option value="ایرانی و فرنگی"
                                                    {{ oldOrValueSelected('toilet', $advertise->toilet, 'ایرانی و فرنگی') }}>
                                                    ایرانی و فرنگی</option>
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
                                                <option value="0"
                                                    {{ oldOrValueSelected('sell_status', $advertise->sell_status, 0) }}>
                                                    خرید</option>
                                                <option value="1"
                                                    {{ oldOrValueSelected('sell_status', $advertise->sell_status, 1) }}>
                                                    اجاره</option>
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
                                                <option value="0" {{ oldOrValueSelected('type', $advertise->type, 0) }}>
                                                    آپارتمان</option>
                                                <option value="1" {{ oldOrValueSelected('type', $advertise->type, 1) }}>
                                                    ویلایی</option>
                                                <option value="2" {{ oldOrValueSelected('type', $advertise->type, 2) }}>
                                                    زمین</option>
                                                <option value="3" {{ oldOrValueSelected('type', $advertise->type, 3) }}>
                                                    سوله</option>
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
                                                <option value="0"
                                                    {{ oldOrValueSelected('parking', $advertise->parking, 0) }}>
                                                    ندارد
                                                </option>
                                                <option value="1"
                                                    {{ oldOrValueSelected('parking', $advertise->parking, 1) }}>
                                                    دارد
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
                                                        {{ oldOrValueSelected('cat_id', $advertise->cat_id, $categorySelect->id) }}>
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
        CKEDITOR.replace('description')
    </script>
@endsection
