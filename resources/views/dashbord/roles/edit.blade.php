@extends('dashbord.layouts.master')

@section('head-tag')
    <title>داشبورد |  نقش ها</title>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">نقش ها</h4>
                        <span><a href="{{ route('dashboard.roles.index') }}" class="btn btn-success">بازگشت</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <form class="row" action="{{ route('dashboard.roles.update', $role->id) }}" method="post">
                                @csrf
                                @method('put')

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="name">نام به انگلیسی</label>
                                        <input
                                            value="{{ oldOrValue('name', $role->name) }}"
                                            name="name" type="text"
                                            id="name" class="form-control
                                            {{ errorClass($errors, 'name') }}"
                                            placeholder="نام ..."
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
                                            value="{{ oldOrValue('display_name', $role->display_name) }}"
                                            name="display_name"
                                            type="text"
                                            id="helperText"
                                            class="form-control
                                            {{ errorClass($errors, 'display_name') }}"
                                            placeholder="نام ..."
                                            />

                                        @error('display_name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-12">
                                    <fieldset class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            بروزرسانی
                                        </button>
                                    </fieldset>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
