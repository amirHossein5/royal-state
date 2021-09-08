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
                        @can('create', 'App\\Models\Slide')
                            <span><a href="{{ route('dashboard.slides.create') }}" class="btn btn-success">ایجاد</a></span>
                        @endcan
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <div class="">
                                <table class="table zero-configuration">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>عنوان</th>
                                            <th>آدرس</th>
                                            <th>مبلغ</th>
                                            <th>تصویر</th>
                                            <th style="min-width: 16rem; text-align: left;">تنظیمات</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($slides as $slide)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $loop->iteration }}</td>
                                                <td>{{ $slide->advertise->title }}</td>
                                                <td>{{ $slide->advertise->address }}</td>
                                                <td>{{ $slide->advertise->amount }} تومان</td>
                                                <td><img style="width: 90px;"
                                                        src="{{ asset($slide->advertise->image) }}" alt="">
                                                </td>
                                                <td style="min-width: 16rem; text-align: left;">
                                                    @can('delete', 'App\\Models\Slide')
                                                        <x-dashboard.inline-form :confirm="true" method="delete"
                                                            href="{{ route('dashboard.slides.destroy', $slide->id) }}">
                                                            حذف
                                                        </x-dashboard.inline-form>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                                <x-pagination-links :class="$slides" />

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
