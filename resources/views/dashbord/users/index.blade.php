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
                        <h4 class="card-title">کاربران</h4>
                        <span><a href="#" class="btn btn-success disabled">ایجاد</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <div class="">
                                <table class="table zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ایمیل</th>
                                            <th>نام</th>
                                            <th>نام خانوادگی</th>
                                            <th>تصویر</th>
                                            <th>وضعیت</th>
                                            <th style="width: 22rem; text-align: left;">تنظیمات</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($users as $user)
                                            <tr role="row" class="even">
                                                <td class="sorting_1">{{ $loop->iteration }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->first_name }}</td>
                                                <td>{{ $user->last_name }}</td>
                                                <td><img src="{{ asset('admin-assets/images/portrait/small/avatar-s-7.jpg') }}"
                                                        style="width:6rem;" alt=""></td>
                                                <td><span class="text-danger">{{ $user->approved() }}</span></td>
                                                <td style="width: 22rem; text-align: left;">
                                                    <x-dashboard.btn-waves
                                                        href="{{ route('dashboard.users.edit', $user->id) }}">
                                                        ویرایش
                                                    </x-dashboard.btn-waves>

                                                    <x-dashboard.btn-waves
                                                        href="{{ route('dashboard.users.approved', $user->id) }}"
                                                        color="warning">
                                                        تغییر
                                                        وضعیت
                                                    </x-dashboard.btn-waves>

                                                </td>
                                            </tr>
                                        @endforeach

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
