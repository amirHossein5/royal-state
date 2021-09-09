@extends('dashbord.layouts.master')

@section('head-tag')
    <title>داشبورد | پروفایل </title>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">پروفایل</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <form class="row"
                                action="{{ route('dashboard.profile.update', ['id' => $user->id]) }}" method="post">
                                @csrf
                                @method('put')

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="helperText">نام </label>
                                        <input value="{{ oldOrValue('first_name', $user->first_name) }}" name="first_name"
                                            type="text" id="helperText"
                                            class="form-control {{ errorClass($errors, 'first_name') }}"
                                            placeholder="نام ..." />
                                        @error('first_name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="helperText">نام خانوادگی </label>
                                        <input value="{{ oldOrValue('last_name', $user->last_name) }}" name="last_name"
                                            type="text" id="helperText"
                                            class="form-control {{ errorClass($errors, 'last_name') }}"
                                            placeholder="نام خانوادگی  ..." />
                                        @error('last_name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="helperText">ایمیل</label>
                                        <input value="{{ oldOrValue('email', $user->email) }}" name="email" type="text"
                                            id="helperText" class="form-control {{ errorClass($errors, 'email') }}"
                                            placeholder="ایمیل  ..." />
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="helperText">تلفن</label>
                                        <input value="{{ oldOrValue('phone', $user->phone) }}" name="phone" type="text"
                                            id="helperText" class="form-control {{ errorClass($errors, 'phone') }}"
                                            placeholder="تلفن  ..." />
                                        @error('phone')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <input name="show_phone_number" type="hidden" value="0">
                                        <label>
                                            <input {{ oldOrValueChecked('show_phone_number', $user->show_phone_number) }}
                                                name="show_phone_number" value="1" type="checkbox" id="helperText"
                                                class="{{ errorClass($errors, 'show_phone_number') }}" />
                                            نمایش شماره تلفن در آگهی ها
                                        </label>
                                        @error('show_phone_number')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>

                                    <fieldset class="form-group">
                                        <input name="show_email" type="hidden" value="0">
                                        <label>
                                            <input {{ oldOrValueChecked('show_email', $user->show_email) }}
                                                name="show_email" type="checkbox" value="1" id="show_email"
                                                class="{{ errorClass($errors, 'show_email') }}" />
                                            نمایش ایمیل در آگهی ها
                                        </label>
                                        @error('show_email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            بروزرسانی
                                        </button>
                                    </fieldset>
                                </div>
                            </form>

                            <div class="pt-2 mt-2 mb-3 border-top col-md-12">
                                <div class="col-md-6">
                                    <form action="{{ route('dashboard.profile.resetPassword', $user->id) }}"
                                        method="POST">
                                        @csrf

                                        <div class="mb-2 form-group">
                                            <input type="password" name="current_password" placeholder="رمز عبور فغلی"
                                                id="current_password" class="form-control">
                                            @error('current_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-2 form-group">
                                            <input type="password" name="password" placeholder="رمز" id="password"
                                                class="form-control">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-2 form-group">
                                            <input type="password" name="password_confirmation" placeholder="تکرار رمز"
                                                id="password_confirmation" class="form-control">
                                            @error('password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mx-auto d-grid">
                                            <button type="submit" class="btn btn-primary btn-block">تغییر رمز </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="pt-2 border-top">
                                <form class="d-inline"
                                    action="{{ route('dashboard.profile.destroy', ['email' => $user->email]) }}"
                                    method="post" onclick="return window.confirm('مطمین هستید؟')">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">
                                        حذف حساب کاربری
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
