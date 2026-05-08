<?php

use App\Http\Controllers\Admin\DashboardController;

/*
| Put this inside your existing admin route group.
| Example:
| Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () { ... });
*/

Route::post('/dashboard/save-all', [DashboardController::class, 'saveAll'])->name('dashboard.saveAll');
