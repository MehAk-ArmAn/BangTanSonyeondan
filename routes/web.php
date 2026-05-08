<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\PublicAuthController;
use App\Http\Controllers\BTSController;
use App\Http\Controllers\BtsCopyController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\SongsController;
use App\Http\Controllers\UserDashboardController;
use App\Models\ProfileAsset;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public website routes
|--------------------------------------------------------------------------
*/
Route::get('/', [BTSController::class, 'home'])->name('home');
Route::get('/quotes', [BTSController::class, 'quotes'])->name('quotes');
Route::get('/bt21', [BTSController::class, 'bt21'])->name('bt21');
Route::get('/Bt21', [BTSController::class, 'bt21']);
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/songs', [SongsController::class, 'index'])->name('songs');
Route::get('/search', [BTSController::class, 'search'])->name('search');
Route::get('/bts-achievements', [BTSController::class, 'achievements'])->name('achievements');
Route::get('/members/{slug}', [BTSController::class, 'memberPage'])->name('member.show');

/* Learning + quiz pages */
Route::get('/learn', [LearningController::class, 'index'])->name('learn.index');
Route::get('/learn/{slug}', [LearningController::class, 'show'])->name('learn.show');
Route::get('/leaderboard', [LearningController::class, 'leaderboard'])->name('leaderboard');

/* Public auth */
Route::middleware('guest')->group(function () {
    Route::get('/login', [PublicAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [PublicAuthController::class, 'login'])->name('login.store');
    Route::get('/register', [PublicAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [PublicAuthController::class, 'register'])->name('register.store');
    Route::get('/auth/google', [PublicAuthController::class, 'googleNotice'])->name('google.notice');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [PublicAuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::post('/dashboard/checkin', [UserDashboardController::class, 'checkin'])->name('user.checkin');
    Route::get('/profile', [UserDashboardController::class, 'profile'])->name('profile.edit');
    Route::put('/profile', [UserDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/assets/{asset}/unlock', [UserDashboardController::class, 'unlockAsset'])->name('profile.assets.unlock');
    Route::post('/learn/{lesson}/submit', [LearningController::class, 'submit'])->name('learn.submit');
});

/* Vote system */
Route::get('/vote', [BTSController::class, 'showVoteForm'])->name('vote');
Route::post('/vote', [BTSController::class, 'handleVote'])->name('vote.store');

/* Old image helper route kept because some existing content may use route('bts.image'). */
Route::get('/bts', fn () => response()->file(public_path('imgs/btsssss.jfif')))->name('bts.image');

/* Existing CRUD page from the original project. */
Route::resource('bts_copies', BtsCopyController::class)->except(['show']);

/*
|--------------------------------------------------------------------------
| Admin panel routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::middleware('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/dashboard/save-all', [DashboardController::class, 'saveAll'])->name('dashboard.saveAll');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::post('/settings', [DashboardController::class, 'updateSettings'])->name('settings.update');
        Route::post('/password', [DashboardController::class, 'updatePassword'])->name('password.update');

        Route::post('/nav', [DashboardController::class, 'storeNav'])->name('nav.store');
        Route::put('/nav/{navItem}', [DashboardController::class, 'updateNav'])->name('nav.update');
        Route::delete('/nav/{navItem}', [DashboardController::class, 'deleteNav'])->name('nav.delete');

        Route::put('/members/{member}', [DashboardController::class, 'updateMember'])->name('members.update');

        Route::post('/quotes', [DashboardController::class, 'storeQuote'])->name('quotes.store');
        Route::put('/quotes/{quote}', [DashboardController::class, 'updateQuote'])->name('quotes.update');
        Route::delete('/quotes/{quote}', [DashboardController::class, 'deleteQuote'])->name('quotes.delete');

        Route::post('/gallery', [DashboardController::class, 'storeGallery'])->name('gallery.store');
        Route::delete('/gallery/{galleryImage}', [DashboardController::class, 'deleteGallery'])->name('gallery.delete');

        Route::post('/songs', [DashboardController::class, 'storeSong'])->name('songs.store');
        Route::put('/songs/{songImage}', [DashboardController::class, 'updateSong'])->name('songs.update');
        Route::delete('/songs/{songImage}', [DashboardController::class, 'deleteSong'])->name('songs.delete');

        Route::post('/bt21', [DashboardController::class, 'storeBt21'])->name('bt21.store');
        Route::put('/bt21/{bt21Character}', [DashboardController::class, 'updateBt21'])->name('bt21.update');
        Route::delete('/bt21/{bt21Character}', [DashboardController::class, 'deleteBt21'])->name('bt21.delete');

        Route::post('/timeline', [DashboardController::class, 'storeTimeline'])->name('timeline.store');
        Route::put('/timeline/{timelineEvent}', [DashboardController::class, 'updateTimeline'])->name('timeline.update');
        Route::delete('/timeline/{timelineEvent}', [DashboardController::class, 'deleteTimeline'])->name('timeline.delete');
    });
});

/* Old member URL compatibility: /Kim%20Namjoon, /Jin, etc. Keep at the very end. */
Route::get('/{name}', [BTSController::class, 'memberPage']);
