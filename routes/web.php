<?php

use App\Http\Controllers\Admin\AdminAdvertisementsController;
use App\Http\Controllers\Admin\AdminCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminSubCategoryController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\PostController;


Route::get('/', function () {
    return view('welcome');
});
// FrontEnd
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/news-detail/{id}', [PostController::class, 'detail'])->name('news_detail');



/**Admin */
Route::get('/admin/home', [AdminController::class, 'index'])->name('admin_home')->middleware('admin:admin');
Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin_login');
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin_logout');
Route::post('/admin/login-submit', [AdminLoginController::class, 'login_submit'])->name('admin_login_submit');
Route::get('/admin/forget-password', [AdminLoginController::class, 'forget_password'])->name('admin_forget_password');
Route::post('/admin/forget-password-submit', [AdminLoginController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
Route::get('/admin/reset-password/{token}/{email}', [AdminLoginController::class, 'reset_password'])->name('admin_reset_password');
Route::post('/admin/reset-password-submit', [AdminLoginController::class, 'reset_password_submit'])->name('admin_reset_password_submit');


Route::get('/admin/edit-profile', [AdminProfileController::class, 'index'])->name('admin_profile')->middleware('admin:admin');
Route::post('/admin/profile-edit-submit', [AdminProfileController::class, 'profile_submit'])->name('admin_profile_submit');


// Advertisement
Route::get('/admin/home-advertisement', [AdminAdvertisementsController::class, 'home_ad_show'])->name('admin_home_ad_show')->middleware('admin:admin');
Route::post('/admin/home-advertisement-update', [AdminAdvertisementsController::class, 'home_ad_update'])->name('admin_home_ad_update');

Route::get('/admin/top-advertisement', [AdminAdvertisementsController::class, 'top_ad_show'])->name('admin_top_ad_show')->middleware('admin:admin');
Route::post('/admin/top-advertisement-update', [AdminAdvertisementsController::class, 'top_ad_update'])->name('admin_top_ad_update');

Route::get('/admin/sidebar-advertisement-view', [AdminAdvertisementsController::class, 'sidebar_ad_show'])->name('admin_sidebar_ad_show')->middleware('admin:admin');
Route::get('/admin/sidebar-advertisement-create', [AdminAdvertisementsController::class, 'sidebar_ad_create'])->name('admin_sidebar_ad_create')->middleware('admin:admin');
Route::post('/admin/sidebar-advertisement-store', [AdminAdvertisementsController::class, 'sidebar_ad_store'])->name('admin_sidebar_ad_store');
Route::get('/admin/sidebar-advertisement-edit/{id}', [AdminAdvertisementsController::class, 'sidebar_ad_edit'])->name('admin_sidebar_ad_edit')->middleware('admin:admin');
Route::get('/admin/sidebar-advertisement-delete/{id}', [AdminAdvertisementsController::class, 'sidebar_ad_delete'])->name('admin_sidebar_ad_delete')->middleware('admin:admin');
Route::post('/admin/sidebar-advertisement-update/{id}', [AdminAdvertisementsController::class, 'sidebar_ad_update'])->name('admin_sidebar_ad_update');
//End Advertisement

// Admin all Route Category
Route::get('/admin/category/index', [AdminCategoryController::class, 'index'])->name('admin_category_index')->middleware('admin:admin');
Route::get('/admin/category/create', [AdminCategoryController::class, 'create'])->name('admin_category_create')->middleware('admin:admin');
Route::post('/admin/category/store', [AdminCategoryController::class, 'store'])->name('admin_category_store');
Route::get('/admin/category/edit/{id}', [AdminCategoryController::class, 'edit'])->name('admin_category_edit')->middleware('admin:admin');
Route::post('/admin/category/update/{id}', [AdminCategoryController::class, 'update'])->name('admin_category_update')->middleware('admin:admin');
Route::get('/admin/category/delete/{id}', [AdminCategoryController::class, 'delete'])->name('admin_category_delete')->middleware('admin:admin');

// Admin all Route SubCategory
Route::group(['prefix' => 'admin/subcategory/', 'middleware' => ['admin:admin']], function () {
    Route::get('index', [AdminSubCategoryController::class, 'index'])->name('admin_subcategory_index');
    Route::get('create', [AdminSubCategoryController::class, 'create'])->name('admin_subcategory_create');
    Route::post('store', [AdminSubCategoryController::class, 'store'])->name('admin_subcategory_store');
    Route::get('edit/{id}', [AdminSubCategoryController::class, 'edit'])->name('admin_subcategory_edit');
    Route::post('update/{id}', [AdminSubCategoryController::class, 'update'])->name('admin_subcategory_update');
    Route::get('delete/{id}', [AdminSubCategoryController::class, 'delete'])->name('admin_subcategory_delete');
});

// Admin all Route Post
Route::group(['prefix' => 'admin/post/', 'middleware' => ['admin:admin']], function () {
    Route::get('index', [AdminPostController::class, 'index'])->name('admin_post_index');
    Route::get('create', [AdminPostController::class, 'create'])->name('admin_post_create');
    Route::post('store', [AdminPostController::class, 'store'])->name('admin_post_store');
    Route::get('edit/{id}', [AdminPostController::class, 'edit'])->name('admin_post_edit');
    Route::post('update/{id}', [AdminPostController::class, 'update'])->name('admin_post_update');
    Route::get('delete/{id}', [AdminPostController::class, 'delete'])->name('admin_post_delete');
    Route::get('tags/delete/{id}/{id1}', [AdminPostController::class, 'TagDelete'])->name('admin_post_delete_tag');
});


// Admin all Route Setting
Route::group(['prefix' => 'admin/setting/', 'middleware' => ['admin:admin']], function () {
    Route::get('/', [AdminSettingController::class, 'index'])->name('admin_setting');
    Route::get('create', [AdminPostController::class, 'create'])->name('admin_post_create');
    Route::post('store', [AdminPostController::class, 'store'])->name('admin_post_store');
    Route::get('edit/{id}', [AdminPostController::class, 'edit'])->name('admin_post_edit');
    Route::post('update/{id}', [AdminSettingController::class, 'update'])->name('admin_setting_update');
    Route::get('delete/{id}', [AdminPostController::class, 'delete'])->name('admin_post_delete');
    Route::get('tags/delete/{id}/{id1}', [AdminPostController::class, 'TagDelete'])->name('admin_post_delete_tag');
});
