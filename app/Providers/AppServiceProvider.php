<?php

namespace App\Providers;

use App\Models\Bt21Character;
use App\Models\Member;
use App\Models\NavItem;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Reserved for future service bindings.
    }

    public function boot(): void
    {
        /**
         * Shared public data.
         *
         * This block is wrapped in try/catch so the website will not crash during:
         * - first install before migrations
         * - cPanel deployment while DB credentials are being changed
         * - php artisan commands that run before tables exist
         */
        $settings = [];
        $members = collect();
        $bt21Characters = collect();
        $navItems = collect([
            (object) ['label' => 'Home', 'url' => '/'],
            (object) ['label' => 'Members', 'url' => '/#members'],
            (object) ['label' => 'Timeline', 'url' => '/bts-achievements'],
            (object) ['label' => 'Learn', 'url' => '/learn'],
            (object) ['label' => 'Leaderboard', 'url' => '/leaderboard'],
            (object) ['label' => 'Songs', 'url' => '/songs'],
            (object) ['label' => 'Gallery', 'url' => '/gallery'],
            (object) ['label' => 'Quotes', 'url' => '/quotes'],
            (object) ['label' => 'Vote', 'url' => '/vote'],
        ]);

        try {
            if (Schema::hasTable('site_settings')) {
                $settings = SiteSetting::pluck('value', 'key')->toArray();
            }

            if (Schema::hasTable('members')) {
                $members = Member::where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->get();
            }

            if (Schema::hasTable('nav_items')) {
                $dbNavItems = NavItem::where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->get(['label', 'url']);

                if ($dbNavItems->isNotEmpty()) {
                    $navItems = $dbNavItems;
                }
            }

            if (Schema::hasTable('bt21_characters')) {
                $bt21Characters = Bt21Character::where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->get();
            }
        } catch (Throwable $exception) {
            // Never throw DB errors from shared view data during deployment.
        }

        View::share('siteSettings', $settings);
        View::share('members', $members);
        View::share('navItems', $navItems);
        View::share('footerBt21Characters', $bt21Characters);

        View::share('adminEmail', $settings['admin_email'] ?? 'hello@bangtansonyeondan.com');
        View::share('location', $settings['location'] ?? 'ARMY Hub');
        View::share('name', $settings['creator_name'] ?? 'Mehak Arman');
        View::share('phone', $settings['phone'] ?? '');

        View::share('instagram', $settings['instagram'] ?? '');
        View::share('linkedIn', $settings['linkedin'] ?? '');
        View::share('twitter', $settings['twitter'] ?? '');
        View::share('youtube', $settings['youtube'] ?? '');
        View::share('tiktok', $settings['tiktok'] ?? '');
        View::share('pinterest', $settings['pinterest'] ?? '');
        View::share('facebook', $settings['facebook'] ?? '');
        View::share('whatsappChannel', $settings['whatsapp_channel'] ?? '');
    }
}

