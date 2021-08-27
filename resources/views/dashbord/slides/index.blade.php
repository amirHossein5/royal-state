@extends('dashbord.layouts.master')

@section('head-tag')
    <title>اسلایدر | داشبورد</title>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">اسلاید</h4>
                        <span><a href="{{ route('dashboard.slides.create') }}" class="btn btn-success">ایجاد</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <div class="">
                                <table class="table zero-configuration">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>عنوان</th>
                                            <th>لینک</th>
                                            <th>آدرس</th>
                                            <th>مبلغ</th>
                                            <th>تصویر</th>
                                            <th style="min-width: 16rem; text-align: left;">تنظیمات</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $loop->iteration }}</td>
                                            <td>{{ $slide->title }}</td>
                                            <td>{{ $slide->url }}</td>
                                            <td>{{ $slide->address }}</td>
                                            <td>{{ $slide->amount }} تومان</td>
                                            <td><img style="width: 90px;"
                                                    src="../admin-assets/images/elements/apple-watch.png" alt="">
                                            </td>
                                            <td style="min-width: 16rem; text-align: left;">
                                                <a href="" class="btn btn-info waves-effect waves-light">ویرایش</a>
                                                <x-dashboard.inline-form :confirm="true" method="delete"
                                                    href="{{ route('dashboard.slides.destroy', $category->id) }}">
                                                    حذف
                                                </x-dashboard.inline-form>
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>
                                <x-pagination-links :class="$categories" />

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
