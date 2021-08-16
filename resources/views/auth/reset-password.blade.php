@extends('auth.layouts.master')

@section('content')
    <main class="mt-5 cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="text-center card-header">بازگردانی</h3>
                    <div class="card-body">
                        <form action="{{ url('/reset-password') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ request()->route('token') }}">
                            <div class="mb-2 form-group">
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

                            <div class="mx-auto d-grid">
                                <button type="submit" class="btn btn-primary btn-block">بازگردانی </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
