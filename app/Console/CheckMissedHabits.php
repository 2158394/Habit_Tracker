<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Habit;
use App\Models\HabitEntry;
use App\Http\Controllers\UserNotificationController;
use Carbon\Carbon;

class CheckMissedHabits extends Command
{
    protected $signature = "habits:check_missed";


    public function handle() {
        $user= Habit::distinct()->pluck('user_id');


        
    }
}
