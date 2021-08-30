@extends('dashbord.layouts.master')

@section('head-tag')
    <title>اسلایدر | داشبورد</title>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">اسلایدشو</h4>
                        <span><a href="{{ route('dashboard.slides.index') }}" class="btn btn-success">بازگشت</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <form class="row" action="{{ route('dashboard.slides.store') }}" method="post">
                                @csrf
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="advertise_id">آگهی</label>
                                        <select name="advertise_id" id="advertise_id"
                                            {{ errorClass($errors, 'advertise_id') }}>
                                            <option value="">__</option>
                                            @foreach ($advertises as $advertise)
                                                <option value="{{ $advertise->id }}"
                                                    {{ oldEqualsSelected('advertise_id', $advertise->id) }}>
                                                    {{ $advertise->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('advertise_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <section class="form-group">
                                        <button type="submit" class="btn btn-primary">ایجاد</button>
                                    </section>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
