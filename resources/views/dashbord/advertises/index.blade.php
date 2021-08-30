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
                        @can('create', 'App\\Models\Advertise')
                            <span><a href="{{ route('dashboard.advertises.create') }}"
                                    class="btn btn-success">ایجاد</a></span>
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

                                            @can('view', $advertise)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $advertise->title }}</td>
                                                    <td>{{ $advertise->category_name }}</td>
                                                    <td>{{ $advertise->address }}</td>
                                                    <td><img style="width: 90px;"
                                                            src="{{ asset($advertise->image['350_250']) }}" alt="">

                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <li>floor : {{ $advertise->floor }}</li>
                                                            <li>year : {{ $advertise->year }}</li>
                                                            <li>storeroom : {{ $advertise->store_room_status }}</li>
                                                            <li>balcony : {{ $advertise->balcony_status }}</li>
                                                            <li>area : {{ $advertise->area }}</li>
                                                            <li>room : {{ $advertise->room }}</li>
                                                            <li>toilet : {{ $advertise->toilet }}</li>
                                                            <li>parking : {{ $advertise->parking_status }}</li>
                                                        </ul>
                                                    </td>
                                                    <td>{{ $advertise->tag }}</td>
                                                    <td>{{ $advertise->owner->full_name }}
                                                    </td>
                                                    <td style="width: 22rem;">
                                                        <a href="{{ route('dashboard.advertises.gallery.index', $advertise->id) }}"
                                                            class="btn btn-warning">گالری</a>
                                                        @if (!$advertise->deleted_at)
                                                            @can('update', $advertise)
                                                                <x-dashboard.btn-waves
                                                                    href="{{ route('dashboard.advertises.edit', $advertise->id) }}">
                                                                    ویرایش
                                                                </x-dashboard.btn-waves>
                                                            @endcan

                                                            @can('delete', $advertise)
                                                                <x-dashboard.inline-form method="delete"
                                                                    href="{{ route('dashboard.advertises.destroy', $advertise->id) }}">
                                                                    حذف
                                                                </x-dashboard.inline-form>
                                                            @endcan
                                                        @else
                                                            @can('restore', $advertise)
                                                                <x-dashboard.inline-form
                                                                    href="{{ route('dashboard.advertises.restore', ['id' => $advertise->id]) }}">
                                                                    باز گرداندن
                                                                </x-dashboard.inline-form>
                                                            @endcan

                                                            @can('forceDelete', $advertise)
                                                                <x-dashboard.inline-form :confirm="true" method="delete"
                                                                    href="{{ route('dashboard.advertises.forceDelete', ['id' => $advertise->id]) }}">
                                                                    حذف کامل
                                                                </x-dashboard.inline-form>
                                                            @endcan
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endcan

                                        @endforeach
                                    </tbody>
                                </table>

                                <section class="d-flex justify-content-center">
                                    {{ $ads->links() }}
                                </section>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
