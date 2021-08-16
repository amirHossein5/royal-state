@extends('dashbord.layouts.master')

@section('head-tag')
    <title>ادمین / آگهی</title>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">آگهی</h4>
                        <span><a href="{{ route('dashboard.advertises.create') }}"
                                class="btn btn-success">ایجاد</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <div class="">
                                <table class="table zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>عنوان</th>
                                            <th>دسته</th>
                                            <th>آدرس</th>
                                            <th>تصویر</th>
                                            <th>مشخصات</th>
                                            <th>تگ</th>
                                            <th>کاربر</th>
                                            <th style="width: 22rem;">تنظیمات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ads as $advertise)
                                            <tr>
                                                <td>{{ $advertise->id }}</td>
                                                <td>{{ $advertise->title }}</td>
                                                <td>{{ $advertise->category->name }}</td>
                                                <td>{{ $advertise->address }}</td>
                                                <td><img style="width: 90px;"
                                                        src="{{ asset($advertise->image['350_250']) }}" alt="">

                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>floor : {{ $advertise->floor }}</li>
                                                        <li>year : {{ $advertise->year }}</li>
                                                        <li>storeroom : {{ $advertise->storeroom }}</li>
                                                        <li>balcony : {{ $advertise->balcony }}</li>
                                                        <li>area : {{ $advertise->area }}</li>
                                                        <li>room : {{ $advertise->room }}</li>
                                                        <li>toilet : {{ $advertise->toilet }}</li>
                                                        <li>parking : {{ $advertise->parking }}</li>
                                                    </ul>
                                                </td>
                                                <td>{{ $advertise->tag }}</td>
                                                <td>{{ $advertise->full_name }}
                                                </td>
                                                <td style="width: 22rem;">
                                                    <a href="{{ route('dashboard.advertises.gallery.index', $advertise->id) }}"
                                                        class="btn btn-warning">گالری</a>
                                                    @if (!$advertise->deleted_at)
                                                        <x-dashboard.btn-waves
                                                            href="{{ route('dashboard.advertises.edit', $advertise->id) }}">
                                                            ویرایش
                                                        </x-dashboard.btn-waves>

                                                        <x-dashboard.inline-form method="delete"
                                                            href="{{ route('dashboard.advertises.destroy', $advertise->id) }}">
                                                            حذف
                                                        </x-dashboard.inline-form>
                                                    @else
                                                        <x-dashboard.inline-form
                                                            href="{{ route('dashboard.advertises.restore', ['id' => $advertise->id]) }}">
                                                            باز گرداندن
                                                        </x-dashboard.inline-form>

                                                        <x-dashboard.inline-form :confirm="true" method="delete"
                                                            href="{{ route('dashboard.advertises.forceDelete', ['id' => $advertise->id]) }}">
                                                            حذف کامل
                                                        </x-dashboard.inline-form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
