@extends('auth.layouts.master')

@section('content')
    <main class="mt-5 cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="text-center card-header">فراموشی رمز عبور</h3>
                    <div class="card-body">
                        <form action="{{ url('/forgot-password') }}" method="POST">
                            @csrf
                            <div class="mb-3 form-group">
                                <input type="text" name="email" placeholder="ایمیل" id="email" value="{{ old('email') }}"
                                    class="form-control">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @if (session('status'))
                                <div class="mb-4 text-sm font-medium text-green-600">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="mx-auto d-grid">
                                <button type="submit" class="btn btn-primary btn-block">بازگردانی</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
