@extends('dashbord.layouts.master')

@section('head-tag')
    <title>داشبورد | منو</title>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">منو</h4>
                        @can('create', 'App\\Models\Menu')
                            <span><a href="{{ route('dashboard.menus.create') }}" class="btn btn-success">ایجاد</a></span>
                        @endcan
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <div class="___class_+?8___">
                                <table class="table zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>نام</th>
                                            <th>دسته والد</th>
                                            <th>آدرس</th>
                                            <th>نوع</th>
                                            <th style="min-width: 6rem; text-align: left;">تنظیمات</th>
                                        </tr>
                                    </thead>
                                    <tbody id="menus">
                                        @foreach ($menus as $menu)
                                            <tr role="row" class="odd" id="menuItem">
                                                <td class="sorting_1" id="id">{{ $loop->iteration }}</td>
                                                <td>{{ $menu->name }}</td>
                                                <td>{{ $menu->parent_name ?? 'دسته اصلی' }}</td>
                                                <td>{{ $menu->url }}</td>
                                                <td>{{ __($menu->type) }}</td>

                                                <td style="min-width: 6rem; text-align: left;">

                                                    @can('update', $menu)
                                                        <x-dashboard.btn-waves
                                                            href="{{ route('dashboard.menus.edit', $menu->slug) }}">
                                                            ویرایش
                                                        </x-dashboard.btn-waves>
                                                    @endcan

                                                    @can('delete', $menu)
                                                        <x-dashboard.inline-form method="delete"
                                                            href="{{ route('dashboard.menus.destroy', $menu->id) }}">
                                                            حذف
                                                        </x-dashboard.inline-form>
                                                    @endcan

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <section class="text-center">
                                    <button id="addMore" class="btn btn-secondary">بیشتر</button>
                                </section>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')

    <script src="{{ asset('js/addMorePagination.js') }}"></script>

    <script type='text/javascript'>
        $(document).ready(function() {
            addMorePagination(
                "#menus",
                '#menuItem',
                '#addMore',
                '#id',
                5,
                @json($menus->lastPage()),
                @json($menus->path()));
        })
    </script>

@endsection
