@extends('auth.layouts.master')

@section('content')
    <main class="mt-5 cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="text-center card-header">ثبت نام</h3>
                    <div class="card-body">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="mb-3 form-group">
                                <input type="text" name="first_name" placeholder="نام" id="first_name"
                                    value="{{ old('first_name') }}" class="form-control">
                                @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 form-group">
                                <input type="text" name="last_name" placeholder="نام خانوادگی" id="last_name"
                                    value="{{ old('last_name') }}" class="form-control">
                                @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 form-group">
                                <input type="text" name="email" placeholder="ایمیل" id="email" value="{{ old('email') }}"
                                    class="form-control">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-2 form-group">
                                <input type="password" name="password" placeholder="رمز" id="password" class="form-control">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-2 form-group">
                                <input type="password" name="password_confirmation" placeholder="رمز"
                                    id="password_confirmation" class="form-control">
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-2 form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" {{ oldChecked('remember') }} name="remember">به خاطر
                                        داشته باش</label>
                                </div>
                            </div>

                            <div class="mx-auto d-grid">
                                <button type="submit" class="btn btn-primary btn-block">ثبت نام </button>
                            </div>

                            <div class="my-2 font-bold text-center d-grid">
                                <a type="submit" href="{{ route('login') }}">ورود</a>
                            </div>

                            <div class="my-2 font-bold text-center d-grid">
                                <a type="submit" href="{{ route('socialite.redirect', 'google') }}">ورود با گوگل</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
