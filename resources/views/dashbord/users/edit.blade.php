@extends('dashbord.layouts.master')

@section('head-tag')
    <title>کاربران | داشبورد</title>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <span><a href="#" class="btn btn-success">بازگشت</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <form class="row" action="{{ route('dashboard.users.update') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="first_name">نام</label>
                                        <input name="first_name" type="text" id="first_name" value="" class="form-control"
                                            placeholder="نام ...">
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="last_name">نام خانوادگی</label>
                                        <input name="last_name" type="text" id="last_name" value="" class="form-control"
                                            placeholder="نام خانوادگی ...">
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="avatar">تصویر</label>
                                        <input name="avatar" type="file" id="avatar" class="form-control-file">
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <section class="form-group">
                                        <button type="submit" class="btn btn-primary">ویرایش</button>
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
