@extends('dashbord.layouts.master')

@section('head-tag')
    <title> داشبورد | اخبار </title>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">اخبار</h4>
                        @can('create', 'App\\Models\Post')
                            <span><a href="{{ route('dashboard.posts.create') }}" class="btn btn-success">ایجاد</a></span>
                        @endcan
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="">
                                <table class="table zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>
                                            <th>عنوان</th>
                                            <th>دسته</th>
                                            <th>نویسنده</th>
                                            <th>تصویر</th>
                                            <th style="min-width: 16rem; text-align: left;">تنظیمات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)

                                            <tr role="row" class="odd">
                                                <td class="sorting_1"></td>
                                                <td>{{ Str::substr($post->title, 0, 10) }}...</td>
                                                <td>{{ $post->category_name }}</td>
                                                <td>{{ $post->author->full_name }}</td>
                                                <td><img style="width: 90px;" src="{{ asset($post->image['79_80']) }}"
                                                        alt="">
                                                </td>
                                                <td style="min-width: 16rem; text-align: left;">
                                                    @if (!$post->deleted_at)
                                                        @can('update', 'App\\Models\Post')
                                                            <x-dashboard.btn-waves
                                                                href="{{ route('dashboard.posts.edit', $post->slug) }}">
                                                                ویرایش
                                                            </x-dashboard.btn-waves>
                                                        @endcan

                                                        @can('delete', 'App\\Models\Post')
                                                            <x-dashboard.inline-form method="delete"
                                                                href="{{ route('dashboard.posts.destroy', $post->id) }}">
                                                                حذف
                                                            </x-dashboard.inline-form>
                                                        @endcan
                                                    @else

                                                        @can('delete', 'App\\Models\Post')

                                                            <x-dashboard.inline-form
                                                                href="{{ route('dashboard.posts.restore', ['id' => $post->id]) }}">
                                                                باز گرداندن
                                                            </x-dashboard.inline-form>
                                                        @endcan

                                                        @can('forceDelete', 'App\\Models\Post')
                                                            <x-dashboard.inline-form :confirm="true" method="delete"
                                                                href="{{ route('dashboard.posts.forceDelete', ['id' => $post->id]) }}">
                                                                حذف کامل
                                                            </x-dashboard.inline-form>
                                                        @endcan
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <section class="text-center">
                                    <button class="btn btn-secondary" id="addMore">بیشتر</button>
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
    <script src="{{}}"></script>
@endsection
