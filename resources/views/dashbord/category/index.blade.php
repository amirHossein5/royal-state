@extends('dashbord.layouts.master')

@section('head-tag')
    <title>داشبورد | دسته بندی</title>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">دسته بندی</h4>
                        @can('create', 'App\\Models\Category')
                            <span><a href="{{ route('dashboard.categories.create') }}"
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
                                            <th>نام</th>
                                            <th>دسته والد</th>
                                            <th style="min-width: 6rem; text-align: left;">تنظیمات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $category->id }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->parent_name ?? 'دسته اصلی' }}</td>
                                                <td style="min-width: 6rem; text-align: left;">

                                                    @if (!$category->deleted_at)

                                                        @can('update', $category)
                                                            <x-dashboard.btn-waves
                                                                href="{{ route('dashboard.categories.edit', $category->id) }}">
                                                                ویرایش
                                                            </x-dashboard.btn-waves>
                                                        @endcan

                                                        @can('delete', $category)
                                                            <x-dashboard.inline-form method="delete"
                                                                href="{{ route('dashboard.categories.destroy', $category->id) }}">
                                                                حذف
                                                            </x-dashboard.inline-form>
                                                        @endcan
                                                    @else

                                                        @can('restore', $category)
                                                            <x-dashboard.inline-form
                                                                href="{{ route('dashboard.categories.restore', ['id' => $category->id]) }}">
                                                                باز گرداندن
                                                            </x-dashboard.inline-form>
                                                        @endcan

                                                        @can('forceDelete', $category)
                                                            <x-dashboard.inline-form :confirm="true" method="delete"
                                                                href="{{ route('dashboard.categories.forceDelete', ['id' => $category->id]) }}">
                                                                حذف کامل
                                                            </x-dashboard.inline-form>
                                                        @endcan

                                                    @endif
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
