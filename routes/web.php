<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Models\Agenda; // Pastikan Model Agenda sudah ada
use App\Models\User;

Route::get('/agendas/calendar', [AgendaController::class, 'calendar'])->name('agendas.calendar');

Route::get('/kasih-role', function() {
    $user = User::where('email', 'email_kamu@gmail.com')->first(); // Ganti pakai email akunmu
    $user->assignRole('administrator');
    return "Selamat! Akun " . $user->name . " sekarang sudah jadi Admin.";
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    
    // DASHBOARD: Tambahkan SEMUA variabel yang bikin error di sini
  // DASHBOARD: Lengkap dengan semua variabel pendukung
Route::get('/dashboard', function () {
    $totalAgenda = Agenda::count();
    $mingguIni = Agenda::whereBetween('start_date', [now()->startOfWeek(), now()->endOfWeek()])->count();
    
    try {
        $selesai = Agenda::where('status', 'selesai')->count();
        $eventAktif = Agenda::whereIn('status', ['proses', 'sedang berlangsung'])->count();
    } catch (\Exception $e) {
        $selesai = 0;
        $eventAktif = 0;
    }

    $agendasMendatang = Agenda::where('start_date', '>=', now())->orderBy('start_date', 'asc')->take(5)->get();

    // Data grafik 7 hari terakhir berdasarkan tanggal pembuatan
    $chartData = [];
    $chartLabels = [];
    $maxCount = 1;
    
    for ($i = 6; $i >= 0; $i--) {
        $date = now()->subDays($i);
        $count = Agenda::whereDate('created_at', $date->toDateString())->count();
        $chartData[] = $count;
        $chartLabels[] = $date->translatedFormat('D'); // Sen, Sel, etc.
        if ($count > $maxCount) {
            $maxCount = $count;
        }
    }
    
    $chartHeights = array_map(function($count) use ($maxCount) {
        return ($count / $maxCount) * 100;
    }, $chartData);

    return view('dashboard', compact(
        'totalAgenda', 
        'mingguIni', 
        'selesai', 
        'eventAktif', 
        'agendasMendatang',
        'chartHeights',
        'chartLabels'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/agendas/print', [AgendaController::class, 'print'])->name('agendas.print');
    Route::get('/agendas', [AgendaController::class, 'index'])->name('agendas.index');

    // Role Logic Administrator & Guru/Staff
    Route::middleware(['role:administrator|guru/staff'])->group(function () {
        Route::get('/agendas/create', [AgendaController::class, 'create'])->name('agendas.create');
        Route::post('/agendas', [AgendaController::class, 'store'])->name('agendas.store');
        Route::get('/agendas/{agenda}/edit', [AgendaController::class, 'edit'])->name('agendas.edit');
        Route::put('/agendas/{agenda}', [AgendaController::class, 'update'])->name('agendas.update');
        Route::delete('/agendas/{agenda}', [AgendaController::class, 'destroy'])->name('agendas.destroy');
        
        // Category Management
        Route::resource('categories', CategoryController::class)->except(['show']);
    });
    
    // Role Logic Administrator Only
    Route::middleware(['role:administrator'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
    });

    Route::get('/agendas/{agenda}', [AgendaController::class, 'show'])->name('agendas.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';