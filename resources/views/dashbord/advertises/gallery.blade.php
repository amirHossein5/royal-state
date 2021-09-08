@extends('dashbord.layouts.master')

@section('head-tag')
    <title>ادمین / گالری</title>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">آگهی - گالری</h4>
                        <span><a href="{{ route('dashboard.advertises.index') }}"
                                class="btn btn-success">بازگشت</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <form class="row" action="{{ route('dashboard.advertises.gallery.store', $advertise->id) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="image">تصویر</label>
                                        <input name="images[]" multiple type="file" id="image"
                                            class="form-control-file {{ errorClass($errors, 'image') }}">
                                        @error('images.*')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                        @error('images')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-12">
                                    <section class="form-group">
                                        <button type="submit" class="btn btn-primary">آپلود تصویر</button>
                                    </section>
                                </div>
                            </form>
                            <div class="pt-4 mt-4 col-md-12">
                                <div class="row">
                                    @foreach ($advertise->galleries as $gallery)
                                        <div class="text-center col-md-3">
                                            <div>
                                                <img style="width: 100%;" src="{{ asset($gallery->image) }}"
                                                    alt="">
                                            </div>

                                            <form
                                                action="{{ route('dashboard.advertises.gallery.destroy', [$advertise->id, $gallery->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">حذف</button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
