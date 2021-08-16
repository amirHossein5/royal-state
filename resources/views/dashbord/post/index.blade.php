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
                        <span><a href="{{ route('dashboard.posts.create') }}" class="btn btn-success">ایجاد</a></span>
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
                                                <td>{{ Str::substr($post->title, 0, 10) }}</td>
                                                <td>{{ $post->category->name }}</td>
                                                <td>{{ $post->author->full_name }}</td>
                                                <td><img style="width: 90px;" src="{{ asset($post->image['79_80']) }}"
                                                        alt="">
                                                </td>
                                                <td style="min-width: 16rem; text-align: left;">
                                                    @if (!$post->deleted_at)
                                                        <x-dashboard.btn-waves
                                                            href="{{ route('dashboard.posts.edit', $post->id) }}">
                                                            ویرایش
                                                        </x-dashboard.btn-waves>

                                                        <x-dashboard.inline-form mathod="delete"
                                                            href="{{ route('dashboard.posts.destroy', $post->id) }}">
                                                            حذف
                                                        </x-dashboard.inline-form>
                                                    @else
                                                        <x-dashboard.inline-form
                                                            href="{{ route('dashboard.posts.restore', ['id' => $post->id]) }}">
                                                            باز گرداندن
                                                        </x-dashboard.inline-form>

                                                        <x-dashboard.inline-form :confirm="true" method="delete"
                                                            href="{{ route('dashboard.posts.forceDelete', ['id' => $post->id]) }}">
                                                            حذف کامل
                                                        </x-dashboard.inline-form>
                                                    @endif
                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                                <x-pagination-links :class="$posts" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
