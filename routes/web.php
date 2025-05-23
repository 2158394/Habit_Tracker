<?php

use App\Http\Controllers\Habitstable;
use App\Http\Controllers\HabitsTableController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PomodoroController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ChartController;

use Illuminate\Support\Facades\Auth;

// use App\Http\Controllers\StatsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('welcome');
});
// Route::get('/', [Habitstable::class, 'show']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/habits', [HabitsTableController::class, 'show'])->name('habits.show');
    Route::post('/habits/entry', [HabitsTableController::class, 'store'])->name('habits.store');
    // Route::post('/habits/entries/store', [HabitsTableController::class, 'storeEntry'])->name('habits.entries.store');
    Route::post('/habits/entries/store', [HabitsTableController::class, 'storeEntry'])->name('habits.entries.store');
    Route::delete('/habits/{habit}', [HabitsTableController::class, 'destroy'])->name('habits.destroy');

    

    Route::get('/pomodoro', [PomodoroController::class, 'show'])->name('pomodoro.show');

    Route::post('/api/pomodoro/start', [PomodoroController::class, 'start'])->name('pomodoro.start');
    Route::post('/api/pomodoro/complete', [PomodoroController::class, 'complete'])->name('pomodoro.complete');

    Route::get('/todos', [TodoController::class, 'index'])->name('todo.index');
    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
    Route::patch('/todos/{todo}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');
    Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');

    Route::get('/todos/{todo}/edit', [TodoController::class, 'edit'])->name('todos.edit');
    Route::patch('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update');


    Route::get('/journal', [JournalController::class, 'show'])->name('journal.show');
    Route::post('/journal', [JournalController::class, 'store'])->name('journal.store');


    // Route::get('api/pomodoro/stats', [StatsController::class, 'getPomodoroStats'])->name('stats.getPomodoroStats');
    Route::get('stats/pomodoro', [StatsController::class, 'getPomodoroStats'])->name('stats.pomodoro');
    Route::get('stats/todo', [StatsController::class, 'getTodoListStats'])->name('stats.todo');
    Route::get('stats/habit', [StatsController::class, 'getHabitTableStats'])->name('stats.habit');

    Route::get('/dashboard', [HomepageController::class, 'show'])->name('dashboard');

    Route::get('/testing', [StatsController::class, 'overallAnalysis'])->name('testing');

    // Route::get('/notification', [UserNotificationController::class, 'show'])->name('notification.show');
    Route::get('/notification', [NotificationController::class, 'index']);
    Route::post('/notification/mark-read/{id}', [NotificationController::class, 'markAsRead']);
    Route::get('/mood-vs-habits', [ChartController::class, 'moodVsHabits']);
    Route::get('/mood-vs-journal', [ChartController::class, 'moodVsJournal']);
    Route::get('/pomodoro-vs-productivity', [ChartController::class, 'pomodoroVsProductivity']);
    Route::get('/journal-vs-productivity', [ChartController::class, 'journalVsProductivity']);

    // Route::get('/dashboard', [HomepageController::class, 'show'])->name('homepage.show');

});

require __DIR__.'/auth.php';

