@extends('dashbord.layouts.master')

@section('head-tag')
    <title>کاربران | داشبورد</title>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    
                    <div class="card-header">
                        <span><a href="{{route('dashboard.users.index')}}" class="btn btn-success">بازگشت</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <form class="row" action="{{ route('dashboard.users.role.update', $user->id) }}" method="post">
                                @csrf
                                @method('put')

                                <section class="col-12">
                                    <h3>{{ $user->full_name }}</h3>
                                </section>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="role_id">نقش</label>
                                        <select name="role_id" id="role_id">

                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ oldOrValueSelected('role_id', $user->role->id, $role->id) }}>
                                                    {{ $role->display_name }}</option>
                                            @endforeach

                                        </select>
                                    </fieldset>
                                    @error('role_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <section class="form-group">
                                        <button type="submit" class="btn btn-primary">ویرایش</button>
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
