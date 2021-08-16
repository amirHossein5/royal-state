@extends('auth.layouts.master')

@section('content')
    <main class="mt-5 cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="text-center card-header">ورود</h3>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="mb-4 text-sm font-medium text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
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
                                <div class="checkbox">
                                    <label><input type="checkbox" {{ oldChecked('remember') }} name="remember">به خاطر
                                        داشته باش</label>
                                </div>
                            </div>

                            <div class="mx-auto d-grid">
                                <button type="submit" class="btn btn-primary btn-block">ورود</button>
                            </div>

                            <div class="my-2 text-center d-grid">
                                <a type="submit" href="{{ route('register') }}">ثبت نام</a>
                            </div>

                            <div class="my-2 text-center d-grid">
                                <a type="submit" href="{{ url('/forgot-password') }}">فراموشی رمز </a>
                            </div>

                            <div class="my-2 font-bold text-center d-grid">
                                <a type="submit" href="{{ route('socialite.redirect','google') }}">ورود با گوگل</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
