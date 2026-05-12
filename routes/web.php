<?php

use App\Http\Controllers\BtsUpdateController;
use App\Http\Controllers\Admin\BtsUpdatesController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Bt21Controller;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\LearningMaterialsController;
use App\Http\Controllers\Admin\MembersController;
use App\Http\Controllers\Admin\NavigationController;
use App\Http\Controllers\Admin\QuizzesController;
use App\Http\Controllers\Admin\QuotesController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SongsController as AdminSongsController;
use App\Http\Controllers\Admin\TimelineController;
use App\Http\Controllers\Admin\VotesController;
use App\Http\Controllers\Auth\PublicAuthController;
use App\Http\Controllers\BTSController;
use App\Http\Controllers\BtsCopyController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SongsController;
use App\Http\Controllers\UserDashboardController;
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

/* Learning gallery pages - no quizzes mixed inside. */
Route::get('/learn', [LearningController::class, 'index'])->name('learn.index');
Route::get('/learn/{slug}', [LearningController::class, 'show'])->name('learn.show');

/* Blooket-style quiz arena - separate from learning material. */
Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
Route::get('/quizzes/{quiz:slug}', [QuizController::class, 'show'])->name('quizzes.show');
Route::get('/leaderboard', [LearningController::class, 'leaderboard'])->name('leaderboard');
Route::get('/army', [UserDashboardController::class, 'community'])->name('profiles.index');
Route::get('/u/{profile}', [UserDashboardController::class, 'publicProfile'])->name('profiles.show');
Route::get('/updates', [BtsUpdateController::class, 'index'])->name('updates.index');
Route::get('/updates/{update:slug}', [BtsUpdateController::class, 'show'])->name('updates.show');

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
    Route::post('/quizzes/{quiz:slug}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
});

/* Vote system */
Route::get('/vote', [VoteController::class, 'index'])->name('vote.index');
Route::post('/vote', [VoteController::class, 'store'])->name('vote.store');

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
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::post('/settings/password', [SettingsController::class, 'password'])->name('settings.password');

        Route::resource('/navigation', NavigationController::class)->except(['show', 'create', 'edit']);
        Route::resource('/members', MembersController::class)->only(['index', 'update']);
        Route::resource('/songs', AdminSongsController::class)->except(['show', 'create', 'edit']);
        Route::resource('/gallery', AdminGalleryController::class)->except(['show', 'create', 'edit']);
        Route::resource('/quotes', QuotesController::class)->except(['show', 'create', 'edit']);
        Route::resource('/timeline', TimelineController::class)->except(['show', 'create', 'edit']);
        Route::resource('/bt21', Bt21Controller::class)->except(['show', 'create', 'edit']);
        Route::resource('/learning-materials', LearningMaterialsController::class)->except(['show', 'create', 'edit']);
        Route::resource('/quizzes', QuizzesController::class)->except(['show', 'create', 'edit']);
        Route::post('/quizzes/{quiz}/questions', [QuizzesController::class, 'storeQuestion'])->name('quizzes.questions.store');
        Route::put('/quiz-questions/{question}', [QuizzesController::class, 'updateQuestion'])->name('quiz-questions.update');
        Route::delete('/quiz-questions/{question}', [QuizzesController::class, 'destroyQuestion'])->name('quiz-questions.destroy');
        Route::resource('/updates', BtsUpdatesController::class)->except(['show', 'create', 'edit']);
        Route::get('/votes', [VotesController::class, 'index'])->name('votes.index');
    });
});

/* Old member URL compatibility: /Kim%20Namjoon, /Jin, etc. Keep at the very end. */
Route::get('/{name}', [BTSController::class, 'memberPage']);
