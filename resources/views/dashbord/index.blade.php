@extends('dashbord.layouts.master')

@section('head-tag')
    <title>داشبورد</title>

@endsection

@section('content')
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-md-12">
                <div class="text-white card bg-analytics">
                    <div class="card-content">
                        <div class="text-center card-body">
                            <img src="{{ asset('admin-assets/images/elements/decore-left.png') }}" class="img-left"
                                alt=" card-img-left">
                            <img src="{{ asset('admin-assets/images/elements/decore-right.png') }}" class="img-right"
                                alt=" card-img-right">
                            <div class="mt-0 shadow avatar avatar-xl bg-primary">
                                <div class="avatar-content">
                                    <i class="feather icon-award white font-large-1"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <h1 class="text-white">سایت املاک</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
