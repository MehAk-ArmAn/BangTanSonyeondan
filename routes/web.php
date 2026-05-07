<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\BTSController;
use App\Http\Controllers\BtsCopyController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SongsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public website routes
|--------------------------------------------------------------------------
| These pages are visible to visitors. Admin routes stay above dynamic routes
| so /admin never gets accidentally captured by a member page.
*/
Route::get('/', [BTSController::class, 'home'])->name('home');
Route::get('/quotes', [BTSController::class, 'quotes'])->name('quotes');
Route::get('/bt21', [BTSController::class, 'bt21'])->name('bt21');
Route::get('/Bt21', [BTSController::class, 'bt21']); // old URL compatibility
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/songs', [SongsController::class, 'index'])->name('songs');
Route::get('/bts-achievements', [BTSController::class, 'achievements'])->name('achievements');
Route::get('/members/{slug}', [BTSController::class, 'memberPage'])->name('member.show');

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
| /admin/login = login page
| /admin       = dashboard after login
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::middleware('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
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

        Route::post('/timeline', [DashboardController::class, 'storeTimeline'])->name('timeline.store');
        Route::put('/timeline/{timelineEvent}', [DashboardController::class, 'updateTimeline'])->name('timeline.update');
        Route::delete('/timeline/{timelineEvent}', [DashboardController::class, 'deleteTimeline'])->name('timeline.delete');
    });
});

/* Old member URL compatibility: /Kim%20Namjoon, /Jin, etc. Keep at the very end. */
Route::get('/{name}', [BTSController::class, 'memberPage']);
