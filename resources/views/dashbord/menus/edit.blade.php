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
                        <span><a href="{{ route('dashboard.menus.index') }}" class="btn btn-success">بازگشت</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <form class="row"
                                action="{{ route('dashboard.menus.update', ['id' => $menu->id]) }}" method="post">
                                @csrf
                                @method('put')

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="helperText">نام </label>
                                        <input value="{{ oldOrValue('name', $menu->name) }}" name="name" type="text"
                                            id="helperText" class="form-control {{ errorClass($errors, 'name') }}"
                                            placeholder="نام ..." />
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="helperText">آدرس </label>
                                        <select name="url" id="url" class="form-control">
                                            @foreach ($urls as $url)
                                                <option value="{{ $url }}"
                                                    {{ oldOrValueSelected('url', $menu->url, $url) }}>
                                                    {{ $url }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('url')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="helperText">نوع </label>
                                        <select name="type" id="type" class="form-control">

                                            <option value="header"
                                                {{ oldOrValueSelected('type', $menu->type, 'header') }}>
                                                {{ __('header') }}
                                            </option>
                                            <option value="footer"
                                                {{ oldOrValueSelected('type', $menu->type, 'footer') }}>
                                                {{ __('footer') }}
                                            </option>

                                        </select>
                                        @error('type')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-6" id='parent_id'>
                                    <fieldset class="form-group">
                                        <div class="form-group">
                                            <label for="helperText">دسته والد</label>
                                            <select id="parent_id" name="parent_id"
                                                class="select2 form-control {{ errorClass($errors, 'parent_id') }}">
                                                <option value="">درصورت وجود والد انتخاب
                                                    شود</option>
                                                @foreach ($menus as $item)

                                                    <option value="{{ $item->id }}"
                                                        {{ oldOrValueSelected('parent_id', $menu->parent->id ?? '', $item->id) }}>
                                                        {{ $item->name }}
                                                    </option>

                                                @endforeach
                                            </select>
                                            @error('parent_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            بروزرسانی
                                        </button>
                                    </fieldset>
                                </div>
                            </form>
                            {{dd($errors->all())}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {

            if ($('#type').val() === 'header') {
                $('#parent_id').hide();
            }

            $('#type').change(function() {

                if (this.value !== 'header') {
                    $('#parent_id').show();
                } else {
                    $('#parent_id').hide();
                }

            });
        })
    </script>
@endsection
