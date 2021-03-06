<?php

use App\Http\Controllers\App\HomeController;
use App\Http\Controllers\App\PostController as AppPostController;
use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\SlideController;
use App\Http\Controllers\Dashboard\CommentController;
use App\Http\Controllers\Dashboard\GalleryController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\AdvertiseController;
use App\Http\Controllers\App\AdvertiseController as AppAdvertiseController;
use App\Http\Controllers\App\CommentController as AppCommentController;
use App\Http\Controllers\App\MenuController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::name('dashboard.')->middleware(['auth', 'verified','UserIsEnable'])->prefix('dashboard')
    ->namespace('Dashboard')->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('index');

        //edit profile informaiton
        Route::name('profile.')->prefix('profile/')->group(function () {
            Route::get('/edit/{user:first_name}', [ProfileController::class, 'edit'])->name('edit');
            Route::post('/{user:id}/reset-password',[ProfileController::class,'resetPassword'])->name('resetPassword');
            Route::put('/', [ProfileController::class, 'update'])->name('update');
            Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        });

        //categories
        Route::name('categories.')->middleware('can:viewAny,App\Models\Category')->prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::put('/update/{category}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/destroy/{category}', [CategoryController::class, 'destroy'])->name('destroy');
            Route::delete('/force-delete/{id}', [CategoryController::class, 'forceDelete'])->name('forceDelete');
            Route::post('/restore/{id}', [CategoryController::class, 'restore'])->name('restore');
        });

        //menus
        Route::name('menus.')->middleware('can:viewAny,App\Models\Menu')->prefix('menus')->group(function () {
            Route::get('/', [MenuController::class, 'index'])->name('index');
            Route::get('/create', [MenuController::class, 'create'])->name('create');
            Route::get('/edit/{menu:slug}', [MenuController::class, 'edit'])->name('edit');
            Route::put('/', [MenuController::class, 'update'])->name('update');
            Route::post('/store', [MenuController::class, 'store'])->name('store');
            Route::delete('/destroy/{id}', [MenuController::class, 'destroy'])->name('destroy');
        });

        //posts
        Route::name('posts.')->middleware('can:viewAny,App\Models\Post')->prefix('posts')->group(function () {
            Route::get('/', [PostController::class, 'index'])->name('index');
            Route::get('/create', [PostController::class, 'create'])->name('create');
            Route::post('/store', [PostController::class, 'store'])->name('store');
            Route::get('/edit/{post:slug}', [PostController::class, 'edit'])->name('edit');
            Route::put('/update/{post}', [PostController::class, 'update'])->name('update');
            Route::delete('/destroy/{post}', [PostController::class, 'destroy'])->name('destroy');
            Route::delete('/force-delete/{id}', [PostController::class, 'forceDelete'])->name('forceDelete');
            Route::post('/restore/{id}', [PostController::class, 'restore'])->name('restore');
        });

        //comments
        Route::name('comments.')->middleware('can:viewAny,App\Models\Comment')->prefix('comments')->group(function () {
            Route::get('/', [CommentController::class, 'index'])->name('index');
            Route::get('/show/{comment}', [CommentController::class, 'show'])->name('show');
            Route::post('/store/', [CommentController::class, 'store'])->name('store');
            Route::post('/approved/{comment}', [CommentController::class, 'approved'])->name('approved');
        });

        //advertises
        Route::name('advertises.')->middleware('can:viewAny,App\Models\Advertise')->prefix('advertises')->group(function () {
            Route::get('/', [AdvertiseController::class, 'index'])->name('index');
            Route::get('/create', [AdvertiseController::class, 'create'])->name('create');
            Route::post('/store', [AdvertiseController::class, 'store'])->name('store');
            Route::get('/edit/{advertise}', [AdvertiseController::class, 'edit'])->name('edit');
            Route::put('/update/{advertise}', [AdvertiseController::class, 'update'])->name('update');
            Route::delete('/destroy/{advertise}/', [AdvertiseController::class, 'destroy'])->name('destroy');
            Route::delete('/force-delete/{id}', [AdvertiseController::class, 'forceDelete'])->name('forceDelete');
            Route::post('/restore/{id}', [AdvertiseController::class, 'restore'])->name('restore');

            Route::name('gallery.')->prefix('{advertise}/')->group(function () {
                Route::get('/gallery', [GalleryController::class, 'show'])->name('index');
                Route::post('/gallery/store', [GalleryController::class, 'store'])->name('store');
                Route::delete('/gallery/{gallery}/destroy', [GalleryController::class, 'destroy'])->name('destroy');
            });
        });

        //slides
        Route::name('slides.')->middleware('can:viewAny,App\Models\Slide')->prefix('slides')->group(function () {
            Route::get('/', [SlideController::class, 'index'])->name('index');
            Route::get('/create', [SlideController::class, 'create'])->name('create');
            Route::post('/store', [SlideController::class, 'store'])->name('store');
            Route::delete('/{slide}/destroy', [SlideController::class, 'destroy'])->name('destroy');
        });


        //users
        Route::name('users.')->middleware('can:viewAny,App\Models\User')->prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');

            Route::prefix('/{user}')->group(function () {
                Route::get('/edit', [UserController::class, 'edit'])->name('edit');
                Route::put('/update', [UserController::class, 'update'])->name('update');
                Route::post('/approved', [UserController::class, 'approved'])->name('approved');


                Route::middleware('isAdmin')->group(function () {
                    Route::prefix('/permissions')->name('permissions.')->group(function () {
                        Route::get('/edit', [PermissionController::class, 'editUserPermissions'])->name('editUserPermissions');
                        Route::put('/', [PermissionController::class, 'updateUserPermissions'])->name('updateUserPermissions');
                    });

                    Route::prefix('/role')->name('role.')->group(function () {
                        Route::get('/edit', [UserController::class, 'editUserRole'])->name('edit');
                        Route::put('/', [UserController::class, 'updateUserRole'])->name('update');
                    });
                });
            });
        });

        //roles
        Route::name('roles.')->middleware('isAdmin')->prefix('roles')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('index');
            Route::get('/create', [RoleController::class, 'create'])->name('create');
            Route::post('/', [RoleController::class, 'store'])->name('store');
            Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit');
            Route::put('/{role}/', [RoleController::class, 'update'])->name('update');
            Route::delete('/{role}/', [RoleController::class, 'delete'])->name('delete');

            Route::prefix('/{role}/permissions')->name('permissions.')->group(function () {
                Route::get('/edit', [PermissionController::class, 'editRolesPermissions'])->name('edit');
                Route::put('/', [PermissionController::class, 'updateRolesPermissions'])->name('update');
            });
        });

        //settings
        Route::name('settings.')->middleware('isAdmin')->prefix('settings')->group(function () {
            Route::get('/edit', [SettingController::class, 'edit'])->name('edit');
            Route::put('/', [SettingController::class, 'update'])->name('update');
        });
    });



/*
|--------------------------------------------------------------------------
| App Routes
|--------------------------------------------------------------------------
*/
Route::name('app.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/advertises', [AppAdvertiseController::class, 'index'])->name('advertises');
    Route::get('/advertises/{advertise}', [AppAdvertiseController::class, 'show'])->name('advertises.show');
    Route::get('/posts', [AppPostController::class, 'index'])->name('posts');
    Route::get('/posts/{post:slug}', [AppPostController::class, 'show'])->name('posts.show');
    Route::post('/posts/{post:slug}/comments', [AppCommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}',[AppCommentController::class, 'destroy'])->name('comments.destroy');
});



/*
|--------------------------------------------------------------------------
| Socialite routes
|--------------------------------------------------------------------------
*/
Route::prefix('/auth/{driver}')->name('socialite.')->middleware('guest')->group(function () {
    Route::get('/redirect', [SocialiteController::class, 'redirect'])->name('redirect');
    Route::get('/callback', [SocialiteController::class, 'handleCallback'])->name('callback');
});
