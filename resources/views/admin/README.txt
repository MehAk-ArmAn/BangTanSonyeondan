BTS Admin Dashboard Refactor
===========================

This package splits the huge admin dashboard Blade file into professional partial files and changes the workflow to one final Save All Changes button.

Files included:

1. resources/views/admin/dashboard.blade.php
   Replace your current admin dashboard Blade file with this.

2. resources/views/admin/dashboard/partials/*.blade.php
   Create this folder and paste all partial files inside it.

3. routes_web_snippet.php
   Add the route inside your existing admin route group.

4. DashboardController_saveAll_method.php
   Paste the imports and methods inside your existing DashboardController class.

5. admin_bulk_save_css.css
   Add this CSS to your admin CSS file.

Important:
- This assumes these table names:
  site_settings, nav_items, members, quotes, songs, gallery_items, timeline_events
- If your migrations use different names, update the DB::table('...') names in the controller method.
- Because this uses image uploads into storage/app/public, run:
  php artisan storage:link

After installing:
php artisan optimize:clear
