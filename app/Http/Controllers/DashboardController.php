<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data statistik dari database
        $totalAgenda = Agenda::count();
        $mingguIni = Agenda::whereBetween('start_date', [
            Carbon::now()->startOfWeek(), 
            Carbon::now()->endOfWeek()
        ])->count();
        $selesai = Agenda::where('status', 'selesai')->count();
        $eventAktif = Agenda::where('start_date', '>=', Carbon::now())->count();

        // Mengambil 4 agenda mendatang terdekat
        $agendasMendatang = Agenda::where('start_date', '>=', now())
                            ->orderBy('start_date', 'asc')
                            ->take(4)
                            ->get();

        return view('dashboard', compact(
            'totalAgenda', 
            'mingguIni', 
            'selesai', 
            'eventAktif', 
            'agendasMendatang'
        ));
    }
}