<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CertificateController as PublicCertificateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\Volunteer\DashboardController;
use App\Http\Controllers\Volunteer\IdCardController;
use App\Http\Controllers\Volunteer\ProfileController;
use App\Http\Controllers\Volunteer\TaskActionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public site
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/achievements', [PageController::class, 'achievements'])->name('achievements');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/{album}', [GalleryController::class, 'show'])->name('gallery.show');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{event:slug}/register', [EventController::class, 'register'])->name('events.register');

Route::get('/volunteer', [VolunteerController::class, 'show'])->name('volunteer.apply.form');
Route::post('/volunteer', [VolunteerController::class, 'store'])->name('volunteer.apply');

Route::get('/donate', [DonateController::class, 'show'])->name('donate.show');
Route::post('/donate', [DonateController::class, 'store'])->name('donate.store');
Route::get('/donations/{donation}/receipt', [DonateController::class, 'receipt'])->name('donate.receipt');

Route::get('/feedback', [FeedbackController::class, 'show'])->name('feedback.show');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/certificates', [PublicCertificateController::class, 'info'])->name('certificates.info');
Route::get('/verify', [VerifyController::class, 'form'])->name('verify.form');
Route::get('/verify/{code}', [VerifyController::class, 'verify'])->name('verify.code');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blog.show');

Route::view('/privacy-policy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');

/*
|--------------------------------------------------------------------------
| Auth (volunteers & admins)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Volunteer portal
|--------------------------------------------------------------------------
*/
Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::patch('/tasks/{assignment}', [TaskActionController::class, 'update'])->name('tasks.update');
    Route::get('/id-card', [IdCardController::class, 'show'])->name('idcard.show');
    Route::get('/id-card/download', [IdCardController::class, 'download'])->name('idcard.download');
    Route::get('/certificates/{certificate}/download', [IdCardController::class, 'certificatePdf'])->name('certificates.download');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| Admin panel
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', App\Http\Middleware\EnsureUserIsAdmin::class])->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('home');

    Route::resource('volunteers', Admin\VolunteerController::class)->only(['index', 'show']);
    Route::patch('/volunteers/{volunteer}/decision', [Admin\VolunteerController::class, 'decide'])->name('volunteers.decide');
    Route::get('/volunteers/{volunteer}/id-card', [Admin\VolunteerController::class, 'idCardPdf'])->name('volunteers.idcard');
    Route::get('/volunteers/{volunteer}/id-proof', [Admin\VolunteerController::class, 'viewIdProof'])->name('volunteers.idproof');

    Route::resource('tasks', Admin\TaskController::class)->except(['show']);
    Route::patch('/assignments/{assignment}/verify', [Admin\TaskController::class, 'verifyAssignment'])->name('assignments.verify');

    Route::resource('certificates', Admin\CertificateController::class)->only(['index', 'create', 'store']);
    Route::get('/certificates/{certificate}/pdf', [Admin\CertificateController::class, 'pdf'])->name('certificates.pdf');

    Route::resource('events', Admin\EventController::class)->except(['show']);

    Route::get('/gallery', [Admin\GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/create', [Admin\GalleryController::class, 'create'])->name('gallery.create');
    Route::post('/gallery', [Admin\GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/{album}/edit', [Admin\GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/gallery/{album}', [Admin\GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{album}', [Admin\GalleryController::class, 'destroy'])->name('gallery.destroy');
    Route::delete('/photos/{photo}', [Admin\GalleryController::class, 'destroyPhoto'])->name('photos.destroy');

    Route::get('/donations/export', [Admin\DonationController::class, 'export'])->name('donations.export');
    Route::get('/donations', [Admin\DonationController::class, 'index'])->name('donations.index');
    Route::patch('/donations/{donation}', [Admin\DonationController::class, 'update'])->name('donations.update');

    Route::get('/feedbacks', [Admin\FeedbackController::class, 'index'])->name('feedbacks.index');
    Route::patch('/feedbacks/{feedback}', [Admin\FeedbackController::class, 'update'])->name('feedbacks.update');
    Route::delete('/feedbacks/{feedback}', [Admin\FeedbackController::class, 'destroy'])->name('feedbacks.destroy');

    Route::get('/messages', [Admin\MessageController::class, 'index'])->name('messages.index');
    Route::patch('/messages/{message}/read', [Admin\MessageController::class, 'markRead'])->name('messages.read');

    Route::resource('blog', Admin\BlogController::class)->except(['show']);

    Route::get('/content', [Admin\ContentController::class, 'edit'])->name('content.edit');
    Route::put('/content', [Admin\ContentController::class, 'update'])->name('content.update');
});
