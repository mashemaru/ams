<?php

namespace App\Console;

use App\Task;
use App\User;
use App\Notification;
use App\NotificationSettings;
use App\Events\LiveNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
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
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            Task::where('due_date', '<', Carbon::now())
                        ->where('status', '!=', 'complete')
                        ->update(['status' => 'overdue']);

            $tasks = Task::where('due_date', '<=', Carbon::now()->subDays(5))->get();
 
            if($tasks->isNotEmpty()) {
                foreach($tasks as $task) {
                    if($task->status == 'overdue') {
                        Notification::create([
                            'user_id' => $task->asigned_to,
                            'text'    => 'Your <strong>Task ('.$task->task_name.')</strong> is overdue.',
                        ]);
                        event(new LiveNotification('Your Task ('.$task->task_name.') is overdue.',$task->asigned_to));
                    } else {
                        Notification::create([
                            'user_id' => $task->asigned_to,
                            'text'    => 'You have an approaching deadline on <strong>Task ('.$task->task_name.')</strong>',
                        ]);
                        event(new LiveNotification('You have an approaching deadline on Task ('.$task->task_name.')',$task->asigned_to));
                    }
                }
            }

        })->daily();

        if (Schema::hasTable('notification_settings')) {
            $notifs = NotificationSettings::where('enabled', true)->get();
            if($notifs) {
                foreach ($notifs as $notif) {
                    $schedule->call(function() use ($notif) {
                        if($notif->name == 'syllabus') {
                            $users = User::role(['department-staff','department-secretary'])->get();
                            if($users) {
                                foreach($users as $user) {
                                    Notification::create([
                                        'user_id' => $user->id,
                                        'text'    => 'Update All <strong>Course Syllabus</strong>',
                                    ]);
                                    event(new LiveNotification('Update All Course Syllabus',$user->id));
                                }
                            }
                        } else {

                        }
                    })->cron($notif->cron)->timezone('Asia/Manila');
                }
            }
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
