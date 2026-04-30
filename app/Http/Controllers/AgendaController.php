<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    // 1. Menampilkan daftar agenda (Semua Role bisa akses)
    
    public function index(Request $request)
    {
        // Gunakan pagination agar tidak berat saat data banyak
        $query = Agenda::with(['category', 'user']);

        // Filter berdasarkan kategori jika dipilih di dropdown
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Search sederhana (Opsional)
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $agendas = $query->latest()->paginate(10);
        $categories = Category::all();

        return view('agendas.index', compact('agendas', 'categories'));
    }

    // 2. Form Tambah Agenda
    public function create()
    {
        $categories = Category::all();
        return view('agendas.create', compact('categories'));
    }

    // 3. Simpan Agenda ke Database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:mendatang,selesai', // Tambahkan status agar sinkron dengan badge
        ]);

        $validated['user_id'] = Auth::id();

        Agenda::create($validated);

        return redirect()->route('agendas.index')->with('success', 'Agenda sekolah berhasil ditambahkan!');
    }

    // 4. Form Edit Agenda
    public function edit(Agenda $agenda)
    {
        // Keamanan: Guru/Staff tidak bisa edit punya orang lain
        if (Auth::user()->hasRole('guru/staff') && $agenda->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit agenda ini.');
        }

        $categories = Category::all();
        return view('agendas.edit', compact('agenda', 'categories'));
    }

    // 5. Update Agenda
    public function update(Request $request, Agenda $agenda)
    {
        if (Auth::user()->hasRole('guru/staff') && $agenda->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:mendatang,selesai',
        ]);

        $agenda->update($validated);

        return redirect()->route('agendas.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        if (Auth::user()->hasRole('guru/staff') && $agenda->user_id !== Auth::id()) {
            abort(403);
        }

        $agenda->delete();
        return redirect()->route('agendas.index')->with('success', 'Agenda telah dihapus.');
    }

    // 7. Tampilkan Detail Agenda
    public function show(Agenda $agenda)
    {
        return view('agendas.show', compact('agenda'));
    }

    public function print(Request $request)
    {
        $query = Agenda::with(['category', 'user']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $agendas = $query->latest()->get();

        return view('agendas.print', compact('agendas'));
    }

    public function calendar()
{
    // Mengambil semua data agenda
    $agendas = Agenda::all()->map(function ($agenda) {
        return [
            'id' => $agenda->id,
            'title' => $agenda->title,
            'start' => $agenda->start_date, // Pastikan formatnya YYYY-MM-DD
            'end'   => $agenda->end_date ?? $agenda->start_date,
            'url' => route('agendas.show', $agenda->id),
            // Custom color berdasarkan kategori (opsional)
            'backgroundColor' => $this->getCategoryColor($agenda->category_id),
            'borderColor' => 'transparent',
        ];
    });

    return view('agendas.calendar', compact('agendas'));
}

// Fungsi pembantu untuk warna (opsional)
private function getCategoryColor($categoryId)
{
    $colors = [
        1 => '#FCD34D', // Exam (Kuning)
        2 => '#6366F1', // Meeting (Indigo)
        3 => '#EC4899', // Event (Pink)
        4 => '#10B981', // Holiday (Hijau)
    ];
    return $colors[$categoryId] ?? '#3B82F6'; // Default Biru
}
}