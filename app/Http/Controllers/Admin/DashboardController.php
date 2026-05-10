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
        return view('admin.dashboard', [
            'settingsCount' => SiteSetting::count(),
            'navCount' => NavItem::count(),
            'membersCount' => Member::count(),
            'songsCount' => SongImage::count(),
            'galleryCount' => GalleryImage::count(),
            'quotesCount' => Quote::count(),
            'timelineCount' => TimelineEvent::count(),
            'usersCount' => User::count(),
            'bt21Count' => Bt21Character::count(),
            'votesCount' => Vote::count(),
        ]);
    }
}
