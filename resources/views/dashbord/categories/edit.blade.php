@extends('dashbord.layouts.master')

@section('head-tag')
    <title>داشبورد | دسته بندی</title>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">دسته بندی</h4>
                        <span><a href="{{ route('dashboard.categories.index') }}" class="btn btn-success">بازگشت</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <form class="row"
                                action="{{ route('dashboard.categories.update', [$category->id, 'id' => $category->id]) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="helperText">نام دسته</label>
                                        <input value="{{ oldOrValue('name', $category->name) }}" name="name" type="text"
                                            id="helperText" class="form-control {{ errorClass($errors, 'name') }}"
                                            placeholder="نام ..." />
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
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
