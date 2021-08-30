@extends('dashbord.layouts.master')

@section('head-tag')
    <title>تقش ها | داشبورد</title>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <span><a href="{{ route('dashboard.roles.index') }}" class="btn btn-success">بازگشت</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <form class="row d-flex flex-column"
                                action="{{ route('dashboard.roles.permissions.update', $role->id) }}" method="post">
                                @csrf
                                @method('put')

                                @if ($role->id !== \App\Models\User::ADMIN_ROLE)

                                    <section class="mb-2 border-bottom-primary">
                                        <h2>دسته بندی</h2>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="category_create" value="category_create"
                                                    name="permissions[category_create]"
                                                    {{ hasPermission($permissions, 'category_create') }}>
                                                <label for="category_create">
                                                    <h5>ساخت دسته بندی</h5>
                                                </label>
                                            </div>

                                            @error('permissions.category_create')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="category_update" value="category_update"
                                                    name="permissions[category_update]"
                                                    {{ hasPermission($permissions, 'category_update') }}>
                                                <label for="category_update">
                                                    <h5>ویرایش دسته بندی</h5>
                                                </label>
                                            </div>

                                            @error('permissions.category_update')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="category_delete" value="category_delete"
                                                    name="permissions[category_delete]"
                                                    {{ hasPermission($permissions, 'category_delete') }}>
                                                <label for="category_delete">
                                                    <h5>حذف دسته بندی</h5>
                                                </label>
                                            </div>

                                            @error('permissions.category_delete')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="category_restore" value="category_restore"
                                                    name="permissions[category_restore]"
                                                    {{ hasPermission($permissions, 'category_restore') }}>
                                                <label for="category_restore">
                                                    <h5>بازیابی دسته بندی</h5>
                                                </label>
                                            </div>

                                            @error('permissions.category_restore')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="category_force_delete"
                                                    value="category_force_delete" name="permissions[category_force_delete]"
                                                    {{ hasPermission($permissions, 'category_force_delete') }}>
                                                <label for="category_force_delete">
                                                    <h5>حذف کامل دسته بندی</h5>
                                                </label>
                                            </div>
                                        </section>

                                        @error('permissions.category_force_delete')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </section>

                                    <section class="mb-2 border-bottom-primary">
                                        <h2>مقاله</h2>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="post_access_all" value="post_access_all"
                                                    name="permissions[post_access_all]"
                                                    {{ hasPermission($permissions, 'post_access_all') }}>
                                                <label for="post_access_all">
                                                    <h5>دسترسی به همه مقاله ها</h5>
                                                </label>
                                            </div>

                                            @error('permissions.post_access_all')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="post_view" value="post_view"
                                                    name="permissions[post_view]"
                                                    {{ hasPermission($permissions, 'post_view') }}>
                                                <label for="post_view">
                                                    <h5>مشاهده مقاله خود در داشبورد</h5>
                                                </label>
                                            </div>

                                            @error('permissions.post_view')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="post_update" value="post_update"
                                                    name="permissions[post_update]"
                                                    {{ hasPermission($permissions, 'post_update') }}>
                                                <label for="post_update">
                                                    <h5>ویرایش مقاله خود</h5>
                                                </label>
                                            </div>

                                            @error('permissions.post_update')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="post_create" value="post_create"
                                                    name="permissions[post_create]"
                                                    {{ hasPermission($permissions, 'post_create') }}>
                                                <label for="post_create">
                                                    <h5>ساخت مقاله</h5>
                                                </label>
                                            </div>

                                            @error('permissions.post_create')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="post_delete" value="post_delete"
                                                    name="permissions[post_delete]"
                                                    {{ hasPermission($permissions, 'post_delete') }}>
                                                <label for="post_delete">
                                                    <h5>حذف مقاله خود</h5>
                                                </label>
                                            </div>

                                            @error('permissions.post_delete')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="post_restore" value="post_restore"
                                                    name="permissions[post_restore]"
                                                    {{ hasPermission($permissions, 'post_restore') }}>
                                                <label for="post_restore">
                                                    <h5>بازیابی مقاله خود</h5>
                                                </label>
                                            </div>

                                            @error('permissions.post_restore')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="post_force_delete" value="post_force_delete"
                                                    name="permissions[post_force_delete]"
                                                    {{ hasPermission($permissions, 'post_force_delete') }}>
                                                <label for="post_force_delete">
                                                    <h5>حذف کامل مقاله خود</h5>
                                                </label>
                                            </div>
                                        </section>

                                        @error('permissions.post_force_delete')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </section>

                                    <section class="mb-2 border-bottom-primary">
                                        <h2>نظرات</h2>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="comment_view" value="comment_view"
                                                    name="permissions[comment_view]"
                                                    {{ hasPermission($permissions, 'comment_view') }}>
                                                <label for="comment_view">
                                                    <h5>مشاهده نظرات مربوط به مقاله خود</h5>
                                                </label>
                                            </div>

                                            @error('permissions.comment_view')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="comment_view_all" value="comment_view_all"
                                                    name="permissions[comment_view_all]"
                                                    {{ hasPermission($permissions, 'comment_view_all') }}>
                                                <label for="comment_view_all">
                                                    <h5>مشاهده همه نظرات</h5>
                                                </label>
                                            </div>

                                            @error('permissions.comment_view_all')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="comment_approved" value="comment_approved"
                                                    name="permissions[comment_approved]"
                                                    {{ hasPermission($permissions, 'comment_approved') }}>
                                                <label for="comment_approved">
                                                    <h5>تغییر وضعیت نظرات</h5>
                                                </label>
                                            </div>

                                            @error('permissions.comment_approved')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="comment_reply" value="comment_reply"
                                                    name="permissions[comment_reply]"
                                                    {{ hasPermission($permissions, 'comment_reply') }}>
                                                <label for="comment_reply">
                                                    <h5>پاسخ دادن به نظرات در داشبورد</h5>
                                                </label>
                                            </div>

                                            @error('permissions.comment_reply')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>
                                    </section>

                                    <section class="mb-2 border-bottom-primary">
                                        <h2>آگهی ها</h2>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="advertise_view" value="advertise_view"
                                                    name="permissions[advertise_view]"
                                                    {{ hasPermission($permissions, 'advertise_view') }}>
                                                <label for="advertise_view">
                                                    <h5>مشاهده آگهی خود</h5>
                                                </label>
                                            </div>

                                            @error('permissions.advertise_view')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="advertise_access_all"
                                                    value="advertise_access_all" name="permissions[advertise_access_all]"
                                                    {{ hasPermission($permissions, 'advertise_access_all') }}>
                                                <label for="advertise_access_all">
                                                    <h5>دسترسی به همه آگهی ها</h5>
                                                </label>
                                            </div>

                                            @error('permissions.advertise_access_all')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="advertise_create" value="advertise_create"
                                                    name="permissions[advertise_create]"
                                                    {{ hasPermission($permissions, 'advertise_create') }}>
                                                <label for="advertise_create">
                                                    <h5>ساخت آگهی</h5>
                                                </label>
                                            </div>

                                            @error('permissions.advertise_create')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="advertise_update" value="advertise_update"
                                                    name="permissions[advertise_update]"
                                                    {{ hasPermission($permissions, 'advertise_update') }}>
                                                <label for="advertise_update">
                                                    <h5>ویرایش آگهی خود</h5>
                                                </label>
                                            </div>

                                            @error('permissions.advertise_update')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="advertise_delete" value="advertise_delete"
                                                    name="permissions[advertise_delete]"
                                                    {{ hasPermission($permissions, 'advertise_delete') }}>
                                                <label for="advertise_delete">
                                                    <h5>حذف آگهی خود</h5>
                                                </label>
                                            </div>

                                            @error('permissions.advertise_delete')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="advertise_restore" value="advertise_restore"
                                                    name="permissions[advertise_restore]"
                                                    {{ hasPermission($permissions, 'advertise_restore') }}>
                                                <label for="advertise_restore">
                                                    <h5>بازیابی آگهی خود</h5>
                                                </label>
                                            </div>

                                            @error('permissions.advertise_restore')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="advertise_force_delete"
                                                    value="advertise_force_delete"
                                                    name="permissions[advertise_force_delete]"
                                                    {{ hasPermission($permissions, 'advertise_force_delete') }}>
                                                <label for="advertise_force_delete">
                                                    <h5>پاک کردن کامل آگهی خود</h5>
                                                </label>
                                            </div>

                                            @error('permissions.advertise_force_delete')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>
                                    </section>

                                    <section class="mb-2 border-bottom-primary">
                                        <h2>اسلاید شو</h2>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="slide_add" value="slide_add"
                                                    name="permissions[slide_add]"
                                                    {{ hasPermission($permissions, 'slide_add') }}>
                                                <label for="slide_add">
                                                    <h5>اضافه کردن اسلاید شو</h5>
                                                </label>
                                            </div>

                                            @error('permissions.slide_add')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="slide_delete" value="slide_delete"
                                                    name="permissions[slide_delete]"
                                                    {{ hasPermission($permissions, 'slide_delete') }}>
                                                <label for="slide_delete">
                                                    <h5>حذف اسلاید شو</h5>
                                                </label>
                                            </div>
                                        </section>

                                        @error('permissions.slide_delete')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </section>

                                    <section class="mb-2 border-bottom-primary">
                                        <h2>کاربران</h2>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="user_approved" value="user_approved"
                                                    name="permissions[user_approved]"
                                                    {{ hasPermission($permissions, 'user_approved') }}>
                                                <label for="user_approved">
                                                    <h5>تغییر وضعیت کاربر</h5>
                                                </label>
                                            </div>

                                            @error('permissions.user_approved')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </section>

                                        <section>
                                            <div>
                                                <input type="checkbox" id="user_update" value="user_update"
                                                    name="permissions[user_update]"
                                                    {{ hasPermission($permissions, 'user_update') }}>
                                                <label for="user_update">
                                                    <h5>ویرایش کاربر</h5>
                                                </label>
                                            </div>
                                        </section>

                                        @error('permissions.user_update')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </section>

                                    <section class="text-center">
                                        <input type="submit" class="btn btn-primary" value="ویرایش">
                                    </section>
                                @else
                                    <section class="p-1">
                                        <h3>ادمین همه دسترسی ها را دارد.</h3>
                                    </section>
                                @endif

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
