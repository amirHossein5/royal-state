@extends('dashbord.layouts.master')

@section('head-tag')
    <title>تنظیمات | داشبورد</title>
@endsection

@section('content')

    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <form class="row" action="{{ route('dashboard.settings.update') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="logo">لوگو</label>
                                        <input name="logo" type="file" id="logo" class="form-control">
                                    </fieldset>
                                    @error('logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    @if ($setting->logo ?? '')
                                        <section>
                                            <img src="{{ asset($setting->logo ?? '') }}" width="50px" height="50پثpx"
                                                alt="logo">
                                        </section>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="site_name">نام سایت</label>
                                        <input name="site_name" type="text" id="site_name"
                                            value="{{ oldOrValue('site_name', $setting->site_name ?? '') }}"
                                            class="form-control" placeholder="نام سایت...">
                                    </fieldset>
                                    @error('site_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="address">آدرس</label>
                                        <input name="address" type="text" id="address"
                                            value="{{ oldOrValue('address', $setting->address ?? '') }}"
                                            class="form-control" placeholder="آدرس ...">
                                    </fieldset>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="phone">تلفن</label>
                                        <input name="phone" type="number" maxlength="11" id="phone"
                                            value="{{ oldOrValue('phone', $setting->phone ?? '') }}"
                                            class="form-control" placeholder="تلفن ...">
                                    </fieldset>
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="email">ایمیل</label>
                                        <input name="email" type="email" id="email"
                                            value="{{ oldOrValue('email', $setting->email ?? '') }}"
                                            class="form-control" placeholder="ایمیل ...">
                                    </fieldset>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="short_description">توضیحات کوتاه</label>
                                        <textarea name="short_description" type="text" id="short_description"
                                            placeholder="توضیحات کوتاه ...">
                                            {{ oldOrValue('short_description', $setting->short_description ?? '') }}
                                            </textarea>
                                    </fieldset>
                                    @error('short_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="long_description">توضیحات کامل</label>
                                        <textarea name="long_description" type="text" id="long_description"
                                            class="form-control" placeholder="توضیحات کامل ...">
                                            {{ oldOrValue('long_description', $setting->long_description ?? '') }}
                                        </textarea>
                                    </fieldset>
                                    @error('long_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="social_media">صفحات اجتماعی</label>

                                        <section id="social_medias">

                                            @if (old('social_medias'))

                                                @foreach (old('social_medias') as $social_media)
                                                    <section class="mt-2 row social_media_item">

                                                        <section class="col-md-6">
                                                            <label for="">
                                                                آدرس
                                                            </label>

                                                            <input type="text" class="form-control"
                                                                value="{{ oldOrValue("social_medias[{ $loop->index }][url]", $social_media['url']) }}"
                                                                name="social_medias[{{ $loop->index }}][url]">
                                                            @error("social_medias.$loop->index.url")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </section>

                                                        <section class="col-md-6">
                                                            <label for="">
                                                                لوگو
                                                            </label>

                                                            <select name="social_medias[{{ $loop->index }}][logo]" id=""
                                                                class="form-control">
                                                                <option value="icon-twitter"
                                                                    {{ oldOrValueSelected("social_medias[{ $loop->index }][logo]", $social_media['logo'], 'icon-twitter') }}>
                                                                    twitter
                                                                </option>
                                                                <option value="icon-facebook"
                                                                    {{ oldOrValueSelected("social_medias[{ $loop->index }][logo]", $social_media['logo'], 'icon-facebook') }}>
                                                                    facebook
                                                                </option>
                                                                <option value="icon-instagram"
                                                                    {{ oldOrValueSelected("social_medias[{ $loop->index }][logo]", $social_media['logo'], 'icon-instagram') }}>
                                                                    instagram
                                                                </option>
                                                            </select>

                                                            @error("social_medias.$loop->index.logo")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </section>
                                                    </section>

                                                @endforeach

                                            @elseif ($setting->social_medias ?? '')

                                                @foreach ($setting->social_medias as $social_media)

                                                    <section class="mt-2 row social_media_item">

                                                        <section class="col-md-6">
                                                            <label for="">
                                                                آدرس
                                                            </label>

                                                            <input type="text" class="form-control"
                                                                value="{{ oldOrValue("social_medias[{ $loop->index }][url]", $social_media['url']) }}"
                                                                name="social_medias[{{ $loop->index }}][url]">

                                                            @error("social_medias.$loop->index.url")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </section>

                                                        <section class="col-md-6">
                                                            <label for="">
                                                                لوگو
                                                            </label>

                                                            <select name="social_medias[{{ $loop->index }}][logo]"
                                                                class="form-control">
                                                                <option value="icon-twitter"
                                                                    {{ oldOrValueSelected("social_medias[{ $loop->index }][logo]", $social_media['logo'], 'icon-twitter') }}>
                                                                    twitter
                                                                </option>
                                                                <option value="icon-facebook"
                                                                    {{ oldOrValueSelected("social_medias[{ $loop->index }][logo]", $social_media['logo'], 'icon-facebook') }}>
                                                                    facebook
                                                                </option>
                                                                <option value="icon-instagram"
                                                                    {{ oldOrValueSelected("social_medias[{ $loop->index }][logo]", $social_media['logo'], 'icon-instagram') }}>
                                                                    instagram
                                                                </option>
                                                            </select>

                                                            @error("social_medias.$loop->index.logo")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </section>
                                                    </section>
                                                @endforeach

                                            @endif

                                        </section>

                                        <button class="mt-3 btn btn-primary btn-block" type="button"
                                            id="add_social_media">اضافه کردن</button>

                                        <button class="mt-1 btn btn-danger btn-block " type="button"
                                            id="remove_social_media">حذف کردن</button>

                                    </fieldset>
                                </div>

                                <div class="col-md-12">
                                    <section class="form-group">
                                        <button type="submit" class="text-white btn btn-dark">ویرایش</button>
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
        CKEDITOR.replace('long_description')
        CKEDITOR.replace('short_description')

        $(document).ready(function() {

            var index = $('.social_media_item').length;

            $('#add_social_media').click(function() {

                $('#social_medias').append(`
                    <section class="mt-2 row social_media_item" >

                        <section class="col-md-6">
                            <label for="">
                                آدرس
                            </label>

                            <input type="text" class="form-control"
                                value="{{ old('social_medias[`+index+`][url]') }}"
                                name="social_medias[` + index + `][url]"
                            >
                        </section>

                        <section class="col-md-6">
                            <label for="">
                                لوگو
                            </label>

                            <select name="social_medias[` + index + `][logo]" id="" class="form-control">
                                <option value="icon-twitter"
                                    {{ oldEqualsSelected('social_medias[`+index+`][logo]', 'icon-twitter') }}
                                    >
                                        twitter
                                </option>
                                <option value="icon-facebook"
                                    {{ oldEqualsSelected('social_medias[`+index+`][logo]', 'icon-facebook') }}
                                >
                                    facebook
                                </option>
                                <option value="icon-instagram"
                                    {{ oldEqualsSelected('social_medias[`+index+`][logo]', 'icon-instagram') }}
                                >
                                    instagram
                                </option>
                            </select>
                        </section>
                    </section>
                `);

                index++
            })

            $('#remove_social_media').click(function() {
                var children = $('#social_medias').children();

                $(children[children.length -1]).remove();
            })
        })
    </script>

@endsection
