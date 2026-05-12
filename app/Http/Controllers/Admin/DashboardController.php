<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bt21Character;
use App\Models\GalleryImage;
use App\Models\Member;
use App\Models\NavItem;
use App\Models\Quote;
use App\Models\SiteSetting;
use App\Models\SongImage;
use App\Models\TimelineEvent;
use App\Models\User;
use App\Models\Vote;

class DashboardController extends Controller
{
    public function index()
    {
        $count = function (string $table): int {
            try {
                return \Illuminate\Support\Facades\Schema::hasTable($table)
                    ? \Illuminate\Support\Facades\DB::table($table)->count()
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
            'galleryCount' => $count('gallery_images'),
            'bt21Count' => $count('bt21_characters'),
            'quotesCount' => $count('quotes'),
            'timelineCount' => $count('timeline_events'),
            'navCount' => $count('nav_items'),
            'votesCount' => $count('votes'),
            'updatesCount' => $count('bts_updates'),
        ]);
    }
}
