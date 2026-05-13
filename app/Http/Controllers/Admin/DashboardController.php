<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $count = function (string $table): int {
            try {
                return Schema::hasTable($table)
                    ? DB::table($table)->count()
                    : 0;
            } catch (\Throwable $e) {
                return 0;
            }
        };

        return view('admin.dashboard', [
            'membersCount' => $count('members'),
            'learningCount' => $count('learning_materials'),
            'quizCount' => $count('quiz_games'),
            'songsCount' => $count('songs_images'),

            // Old gallery removed from dashboard.
            // New phone-style gallery uses media_items.
            'mediaGalleryCount' => $count('media_items'),

            'bt21Count' => $count('bt21_characters'),
            'quotesCount' => $count('quotes'),
            'timelineCount' => $count('timeline_events'),
            'navCount' => $count('nav_items'),
            'votesCount' => $count('votes'),
            'updatesCount' => $count('bts_updates'),
            'usersCount' => $count('users'),
        ]);
    }
}
