@extends('dashbord.layouts.master')

@section('head-tag')
    <title>نقش ها | داشبورد</title>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">اسلایدشو</h4>
                        <span><a href="{{ route('dashboard.roles.index') }}" class="btn btn-success">بازگشت</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <form class="row" action="{{ route('dashboard.roles.store') }}" method="post">
                                @csrf

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="name">نام به انگلیسی</label>
                                        <input
                                            value="{{ old('name') }}"
                                            name="name"
                                            type="text"
                                            id="name" class="form-control
                                            {{ errorClass($errors, 'name') }}" placeholder="نام ..."
                                            />

                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="display_name">نام به فارسی</label>
                                        <input
                                            value="{{ old('display_name') }}"
                                            name="display_name" type="text"
                                            id="helperText" class="form-control
                                            {{ errorClass($errors, 'display_name') }}" placeholder="نام ..."
                                            />

                                        @error('display_name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
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
