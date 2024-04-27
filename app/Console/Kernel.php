<?php

namespace App\Console;

use App\Models\Notification;
use App\Repositories\FirebaseMessasingApiRepository;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $notifications = DB::table('notifications')
                ->select(['notifications.*', 'users.fcm_token', 'locations.name'])->join('users', 'users.id', '=', 'notifications.user_id')
                ->join('locations', 'locations.id', '=', 'notifications.location_id')
                ->where('notifications.is_read', false)->get();;

            foreach ($notifications as $notification) {
                $firebaseRepository = new FirebaseMessasingApiRepository();
                $firebaseRepository->send($notification->fcm_token, $notification->name);
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
