<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Administrative\AuthController;
use App\Http\Controllers\Administrative\HomeController;
use App\Http\Controllers\Administrative\RoleController;
use App\Http\Controllers\Administrative\UserController;
use App\Http\Controllers\Administrative\PermissionController;
use App\Http\Controllers\Administrative\TeacherController;
use App\Http\Controllers\Administrative\NewsController;
use App\Http\Controllers\Administrative\EventController;
use App\Http\Controllers\Administrative\GalleryController;
use App\Http\Controllers\Administrative\NoticeController;
use App\Http\Controllers\Administrative\DownloadController;
use App\Http\Controllers\Administrative\PopupNoticeController;
use App\Http\Controllers\Administrative\ClassRoutineController;
use App\Http\Controllers\Administrative\AdmissionController;
use App\Http\Controllers\Administrative\ContactInboxController;
use App\Http\Controllers\Administrative\PageController;

// Frontend Controllers
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\AcademicsController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\GalleryController as FrontendGalleryController;

Auth::routes();

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/academics', [AcademicsController::class, 'index'])->name('academics');
Route::get('/teachers', [FrontendController::class, 'teachers'])->name('teachers');
Route::get('/news', [FrontendController::class, 'news'])->name('news');
Route::get('/news/{slug}', [FrontendController::class, 'newsDetail'])->name('news.detail');
Route::get('/events', [FrontendController::class, 'events'])->name('events');
Route::get('/gallery', [FrontendGalleryController::class, 'index'])->name('gallery');
Route::get('/notices', [FrontendController::class, 'notices'])->name('notices');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Admin Routes
Route::get('/admin',  function () {
    return redirect()->route('administrative.login');
});
Route::get('/admin/login', [AuthController::class, 'index'])->name('administrative.login');

Route::post('login', [AuthController::class, 'authenticate'])->name('login.post');

Route::namespace('Administrative')->middleware('auth')->prefix('administrative')->name('administrative.')->group(function () {

    Route::get('/', function () {
        return redirect()->route('administrative.dashboard');
    });


    // Dashboard
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::post('/summernote/upload', [HomeController::class, 'uploadImage'])->name('summernote.upload');

    // Role
    Route::prefix('role')->group(function () {
        Route::get('/list', [RoleController::class, 'index'])->name('role');
        Route::get('role-data', [RoleController::class, 'data'])->name('role.data');
        Route::get('create', [RoleController::class, 'create'])->name('role.create');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::put('update/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::post('create', [RoleController::class, 'store'])->name('role.store');
        Route::delete('delete/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
    });

    // Permission
    Route::prefix('permission')->group(function () {
        Route::get('/list', [PermissionController::class, 'index'])->name('permission');
        Route::get('permission-data', [PermissionController::class, 'data'])->name('permission.data');
        Route::get('create', [PermissionController::class, 'create'])->name('permission.create');
        Route::get('edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
        Route::put('update/{id}', [PermissionController::class, 'update'])->name('permission.update');
        Route::post('create', [PermissionController::class, 'store'])->name('permission.store');
        Route::delete('delete/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');
    });

    // User
    Route::prefix('user')->group(function () {
        Route::get('/list', [UserController::class, 'index'])->name('user');
        Route::get('user-data', [UserController::class, 'data'])->name('user.data');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::get('create', [UserController::class, 'create'])->name('user.create');
        Route::post('create', [UserController::class, 'store'])->name('user.store');
        Route::get('get-create-form', [UserController::class, 'getCreateForm'])->name('user.get.create.form');
        Route::get('get-edit-form', [UserController::class, 'getEditForm'])->name('user.get.edit.form');
    });

    // Teacher
    Route::prefix('teachers')->group(function () {
        Route::get('/list', [TeacherController::class, 'index'])->name('teachers');
        Route::get('teacher-data', [TeacherController::class, 'data'])->name('teachers.data');
        Route::get('create', [TeacherController::class, 'create'])->name('teachers.create');
        Route::get('edit/{id}', [TeacherController::class, 'edit'])->name('teachers.edit');
        Route::put('update/{id}', [TeacherController::class, 'update'])->name('teachers.update');
        Route::post('create', [TeacherController::class, 'store'])->name('teachers.store');
        Route::delete('delete/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
    });

    // News
    Route::prefix('news')->group(function () {
        Route::get('/list', [NewsController::class, 'index'])->name('news');
        Route::get('news-data', [NewsController::class, 'data'])->name('news.data');
        Route::get('create', [NewsController::class, 'create'])->name('news.create');
        Route::get('edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
        Route::put('update/{id}', [NewsController::class, 'update'])->name('news.update');
        Route::post('create', [NewsController::class, 'store'])->name('news.store');
        Route::delete('delete/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
    });

    // Events
    Route::prefix('events')->group(function () {
        Route::get('/list', [EventController::class, 'index'])->name('events');
        Route::get('event-data', [EventController::class, 'data'])->name('events.data');
        Route::get('create', [EventController::class, 'create'])->name('events.create');
        Route::get('edit/{id}', [EventController::class, 'edit'])->name('events.edit');
        Route::put('update/{id}', [EventController::class, 'update'])->name('events.update');
        Route::post('create', [EventController::class, 'store'])->name('events.store');
        Route::delete('delete/{id}', [EventController::class, 'destroy'])->name('events.destroy');
    });

    // Gallery
    Route::prefix('gallery')->group(function () {
        Route::get('/list', [GalleryController::class, 'index'])->name('gallery');
        Route::get('gallery-data', [GalleryController::class, 'data'])->name('gallery.data');
        Route::get('create', [GalleryController::class, 'create'])->name('gallery.create');
        Route::get('edit/{id}', [GalleryController::class, 'edit'])->name('gallery.edit');
        Route::put('update/{id}', [GalleryController::class, 'update'])->name('gallery.update');
        Route::post('create', [GalleryController::class, 'store'])->name('gallery.store');
        Route::delete('delete/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
    });

    // Notices
    Route::prefix('notices')->group(function () {
        Route::get('/list', [NoticeController::class, 'index'])->name('notices');
        Route::get('notice-data', [NoticeController::class, 'data'])->name('notices.data');
        Route::get('create', [NoticeController::class, 'create'])->name('notices.create');
        Route::get('edit/{id}', [NoticeController::class, 'edit'])->name('notices.edit');
        Route::put('update/{id}', [NoticeController::class, 'update'])->name('notices.update');
        Route::post('create', [NoticeController::class, 'store'])->name('notices.store');
        Route::delete('delete/{id}', [NoticeController::class, 'destroy'])->name('notices.destroy');
    });

    // Downloads
    Route::prefix('downloads')->group(function () {
        Route::get('/list', [DownloadController::class, 'index'])->name('downloads');
        Route::get('download-data', [DownloadController::class, 'data'])->name('downloads.data');
        Route::get('create', [DownloadController::class, 'create'])->name('downloads.create');
        Route::get('edit/{id}', [DownloadController::class, 'edit'])->name('downloads.edit');
        Route::put('update/{id}', [DownloadController::class, 'update'])->name('downloads.update');
        Route::post('create', [DownloadController::class, 'store'])->name('downloads.store');
        Route::delete('delete/{id}', [DownloadController::class, 'destroy'])->name('downloads.destroy');
    });

    // Popup Notices
    Route::prefix('popup-notices')->group(function () {
        Route::get('/list', [PopupNoticeController::class, 'index'])->name('popup-notices');
        Route::get('popup-notice-data', [PopupNoticeController::class, 'data'])->name('popup-notices.data');
        Route::get('create', [PopupNoticeController::class, 'create'])->name('popup-notices.create');
        Route::get('edit/{id}', [PopupNoticeController::class, 'edit'])->name('popup-notices.edit');
        Route::put('update/{id}', [PopupNoticeController::class, 'update'])->name('popup-notices.update');
        Route::post('create', [PopupNoticeController::class, 'store'])->name('popup-notices.store');
        Route::delete('delete/{id}', [PopupNoticeController::class, 'destroy'])->name('popup-notices.destroy');
    });

    // Class Routines
    Route::prefix('class-routines')->group(function () {
        Route::get('/list', [ClassRoutineController::class, 'index'])->name('class-routines');
        Route::get('routine-data', [ClassRoutineController::class, 'data'])->name('class-routines.data');
        Route::get('create', [ClassRoutineController::class, 'create'])->name('class-routines.create');
        Route::get('edit/{id}', [ClassRoutineController::class, 'edit'])->name('class-routines.edit');
        Route::put('update/{id}', [ClassRoutineController::class, 'update'])->name('class-routines.update');
        Route::post('create', [ClassRoutineController::class, 'store'])->name('class-routines.store');
        Route::delete('delete/{id}', [ClassRoutineController::class, 'destroy'])->name('class-routines.destroy');
    });

    // Admissions
    Route::prefix('admissions')->group(function () {
        Route::get('/list', [AdmissionController::class, 'index'])->name('admissions');
        Route::get('admission-data', [AdmissionController::class, 'data'])->name('admissions.data');
        Route::get('edit/{id}', [AdmissionController::class, 'edit'])->name('admissions.edit');
        Route::put('update/{id}', [AdmissionController::class, 'update'])->name('admissions.update');
        Route::delete('delete/{id}', [AdmissionController::class, 'destroy'])->name('admissions.destroy');
    });

    // Contact Inbox
    Route::prefix('inbox')->group(function () {
        Route::get('/list', [ContactInboxController::class, 'index'])->name('inbox');
        Route::get('message-data', [ContactInboxController::class, 'data'])->name('inbox.data');
        Route::get('show/{id}', [ContactInboxController::class, 'show'])->name('inbox.show');
        Route::delete('delete/{id}', [ContactInboxController::class, 'destroy'])->name('inbox.destroy');
    });

    // Pages
    Route::prefix('pages')->group(function () {
        Route::get('/list', [PageController::class, 'index'])->name('pages');
        Route::get('page-data', [PageController::class, 'data'])->name('pages.data');
        Route::get('create', [PageController::class, 'create'])->name('pages.create');
        Route::get('edit/{id}', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('update/{id}', [PageController::class, 'update'])->name('pages.update');
        Route::post('create', [PageController::class, 'store'])->name('pages.store');
        Route::delete('delete/{id}', [PageController::class, 'destroy'])->name('pages.destroy');
    });
});
