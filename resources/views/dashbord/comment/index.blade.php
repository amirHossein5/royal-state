@extends('dashbord.layouts.master')

@section('head-tag')
    <title> داشبورد | نظرات</title>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">نظرات</h4>
                        <span><a href="#" class="btn btn-success disabled">ایجاد</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <div class="">
                                <table class="table zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>کاربر</th>
                                            <th>نظر</th>
                                            <th>وضعیت</th>
                                            <th>تنظیمات</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($comments as $comment)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $comment->id }}</td>
                                                <td>{{ $comment->name }}</td>
                                                <td>{{ Str::substr($comment->comment, 0, 10) }}</td>
                                                <td>
                                                    {!! $comment->approved() !!}
                                                </td>
                                                <td>
                                                    <a href="{{ route('dashboard.comments.show', $comment->id) }}"
                                                        class="btn btn-success waves-effect waves-light">نمایش</a>
                                                    <form class="d-inline"
                                                        action="{{ route('dashboard.comments.approved', $comment->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @if ($comment->approved)
                                                            <button type="submit"
                                                                class="btn btn-danger waves-effect waves-light">لغو
                                                                تایید</button>
                                                        @else
                                                            <button type="submit"
                                                                class="btn btn-success waves-effect waves-light">تایید</button>

                                                        @endif
                                                    </form>
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
