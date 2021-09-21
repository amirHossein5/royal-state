@extends('dashbord.layouts.master')

@section('head-tag')
    <title> داشبورد | نظرات</title>

    @livewireStyles()
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

                                        @can('view', $comment)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $loop->iteration }}</td>
                                                <td>{{ $comment->user->full_name }}</td>
                                                <td>{{ Str::substr($comment->comment, 0, 10) }}</td>
                                                <td>
                                                    @livewire('dashboard.comment.approved-status',[
                                                    'status'=> $comment->approved , 'commentId' => $comment->id
                                                    ],key($loop->index))
                                                </td>
                                                <td>
                                                    <a href="{{ route('dashboard.comments.show', $comment->id) }}"
                                                        class="btn btn-success waves-effect waves-light">نمایش</a>

                                                    @can('approved', 'App\\Models\Comment')
                                                        @livewire('dashboard.comment.change-status',[
                                                        'comment' => $comment
                                                        ])
                                                    @endcan

                                                </td>
                                            </tr>
                                        @endcan

                                    @endforeach

                                </tbody>
                                </table>

                                <section class="d-flex justify-content-center">
                                    {{ $comments->links() }}
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

    @livewireScripts()

@endsection
