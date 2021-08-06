<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
            //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call(function () {
            $token_path = public_path() . '/insta_token.js';
            $token = file_get_contents($token_path);

            $start = strpos($token, '"');
            $accessToken = substr($token, $start + 1, -1);

            $curl = curl_init();
            $url = "https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=$accessToken";

            curl_setopt($curl, CURLOPT_URL, $url);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

            $result = curl_exec($curl);

            $result = json_decode($result, true);

            if (isset($result['access_token'])) {
                $data = 'token="' . $result['access_token'] . '"';
                file_put_contents($token_path, $data);
            }
            curl_close($curl);
        })->monthlyOn(10, '02:31');

        $schedule->command('ce:recurring-donation')
        ->dailyAt('16:28');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands() {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

}
