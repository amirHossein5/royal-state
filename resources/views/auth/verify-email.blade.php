@extends('auth.layouts.master')

@section('content')
    <main class="mt-5 cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="mb-4 text-sm font-medium text-green-600">
                                {{ session('status') ? 'ایمیل فرستاده شد' : '' }}
                            </div>
                        @endif

                        <form action="{{ route('verification.send') }}" method="POST">
                            @csrf

                            <div class="mx-auto d-grid">
                                <button type="submit" class="btn btn-primary btn-block">راستی آزمایی ایمیل</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
