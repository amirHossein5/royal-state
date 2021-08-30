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
                        <h4 class="card-title">اسلاید</h4>
                        <span><a href="{{ route('dashboard.roles.create') }}" class="btn btn-success">ایجاد</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <div class="">
                                <table class="table zero-configuration">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>نقش</th>
                                            <th style="min-width: 16rem; text-align: left;">تنظیمات</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($roles as $role)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $loop->iteration }}</td>
                                                <td>{{ $role->display_name }}</td>
                                                <td style="min-width: 16rem; text-align: left;">

                                                    <x-dashboard.inline-form :confirm="true" method="delete"
                                                        href="{{ route('dashboard.roles.delete', $role->id) }}">
                                                        حذف
                                                    </x-dashboard.inline-form>
                                                    <x-dashboard.btn-waves
                                                        href="{{ route('dashboard.roles.edit', $role->id) }}"
                                                        color="primary" method="post" width='100%'>
                                                        ویرایش
                                                    </x-dashboard.btn-waves>
                                                    <x-dashboard.btn-waves
                                                        href="{{ route('dashboard.roles.permissions.edit', $role->id) }}"
                                                        color="warning" method="post" width='100%'>
                                                        ویرایش دسترسی ها
                                                    </x-dashboard.btn-waves>

                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                                <x-pagination-links :class="$roles" />

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
