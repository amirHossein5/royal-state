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
                                            <th>نقش</th>
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
                                                <td>{{ $user->role->display_name }}</td>
                                                <td>{!! $user->approved_status !!}</td>
                                                <td style="width: 20rem; text-align: center;" class="d-flex flex-column">
                                                    @can('update', 'App\\Models\User')
                                                        <x-dashboard.btn-waves
                                                            href="{{ route('dashboard.users.edit', $user->id) }}">
                                                            ویرایش
                                                        </x-dashboard.btn-waves>
                                                    @endcan

                                                    @isAdmin()
                                                    <x-dashboard.btn-waves
                                                        href="{{ route('dashboard.users.permissions.editUserPermissions', $user->id) }}"
                                                        color="warning" class="my-1">
                                                        سطوح دسترسی
                                                    </x-dashboard.btn-waves>

                                                    <x-dashboard.btn-waves
                                                        href="{{ route('dashboard.users.role.edit', $user->id) }}"
                                                        color="danger" method="post" width='100%'>
                                                        تغییر
                                                        نقش
                                                    </x-dashboard.btn-waves>
                                                    @endIsAdmin

                                                    @can('approved', 'App\\Models\User')
                                                        <x-dashboard.inline-form
                                                            href="{{ route('dashboard.users.approved', $user->id) }}"
                                                            method="post" width='100%' margin='my-1'>
                                                            تغییر
                                                            وضعیت
                                                        </x-dashboard.inline-form>
                                                    @endcan

                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <x-pagination-links :class="$users" />

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
