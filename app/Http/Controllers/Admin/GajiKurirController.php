<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GajiKurir;
use App\Models\User;
use App\Models\Gaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GajiKurirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = GajiKurir::with('kurir');

        // Search by kurir name, email, or phone
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('kurir', function($kurirQuery) use ($search) {
                $kurirQuery->where('nama', 'like', '%' . $search . '%')
                          ->orWhere('email', 'like', '%' . $search . '%')
                          ->orWhere('nohp', 'like', '%' . $search . '%');
            });
        }

        // Filter by date
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_kerja', $request->tanggal);
        }

        $gajiKurirs = $query->latest()->paginate(10);
        
        // Preserve search parameters in pagination links
        $gajiKurirs->appends($request->only(['search', 'tanggal']));
        
        return view('admin.gajiKurir.index', compact('gajiKurirs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get kurir users (assuming role kurir or specific condition)
        $kurirs = User::all(); // Get all users for now, you can filter by role if needed
        
        // Get gaji settings
        $gajiSettings = Gaji::first();
        
        if (!$gajiSettings) {
            return redirect()->route('admin.gaji.index')
                ->with('message', 'Silakan atur data gaji terlebih dahulu!')
                ->with('alert-info', 'warning');
        }
        
        return view('admin.gajiKurir.create', compact('kurirs', 'gajiSettings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kurir_id' => 'required|exists:users,id',
            'tanggal_kerja' => 'required|date|date_equals:today',
            'pikup' => 'required|integer|min:0',
            'pud' => 'required|integer|min:0'
        ], [
            'kurir_id.required' => 'Kurir harus dipilih',
            'kurir_id.exists' => 'Kurir tidak valid',
            'tanggal_kerja.required' => 'Tanggal kerja harus diisi',
            'tanggal_kerja.date' => 'Format tanggal tidak valid',
            'tanggal_kerja.date_equals' => 'Data gaji hanya bisa diinput untuk hari ini',
            'pikup.required' => 'Jumlah pickup harus diisi',
            'pikup.integer' => 'Jumlah pickup harus berupa angka',
            'pikup.min' => 'Jumlah pickup tidak boleh negatif',
            'pud.required' => 'Jumlah PUD harus diisi',
            'pud.integer' => 'Jumlah PUD harus berupa angka',
            'pud.min' => 'Jumlah PUD tidak boleh negatif'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check if kurir already has data for today
        $existingData = GajiKurir::where('kurir_id', $request->kurir_id)
            ->where('tanggal_kerja', date('Y-m-d'))
            ->first();

        if ($existingData) {
            return redirect()->back()
                ->with('message', 'Kurir ini sudah memiliki data gaji untuk hari ini! Silakan edit data yang sudah ada.')
                ->with('alert-info', 'warning')
                ->withInput();
        }

        try {
            // Get gaji settings
            $gajiSettings = Gaji::first();
            
            if (!$gajiSettings) {
                return redirect()->back()
                    ->with('message', 'Data gaji belum diatur!')
                    ->with('alert-info', 'danger');
            }

            // Calculate total gaji (BPJS deduction is only applied monthly, not daily)
            $totalPaketBawaan = $request->pikup * $gajiSettings->paket_bawaan;
            $totalPaketJemputan = $request->pud * $gajiSettings->paket_jemputan;
            $totalGaji = $totalPaketBawaan + $totalPaketJemputan;

            GajiKurir::create([
                'kurir_id' => $request->kurir_id,
                'tanggal_kerja' => $request->tanggal_kerja,
                'pikup' => $request->pikup,
                'pud' => $request->pud,
                'total' => $totalGaji
            ]);

            return redirect()->route('admin.gajiKurir.index')
                ->with('message', 'Data gaji kurir berhasil ditambahkan!')
                ->with('alert-info', 'success');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('message', 'Terjadi kesalahan: ' . $e->getMessage())
                ->with('alert-info', 'danger');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(GajiKurir $gajiKurir)
    {
        $gajiKurir->load('kurir');
        $gajiSettings = Gaji::first();
        
        return view('admin.gajiKurir.show', compact('gajiKurir', 'gajiSettings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GajiKurir $gajiKurir)
    {
        $kurirs = User::all(); // Get all users for now, you can filter by role if needed
        $gajiSettings = Gaji::first();
        
        if (!$gajiSettings) {
            return redirect()->route('admin.gaji.index')
                ->with('message', 'Silakan atur data gaji terlebih dahulu!')
                ->with('alert-info', 'warning');
        }
        
        return view('admin.gajiKurir.edit', compact('gajiKurir', 'kurirs', 'gajiSettings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GajiKurir $gajiKurir)
    {
        $validator = Validator::make($request->all(), [
            'kurir_id' => 'required|exists:users,id',
            'tanggal_kerja' => 'required|date',
            'pikup' => 'required|integer|min:0',
            'pud' => 'required|integer|min:0'
        ], [
            'kurir_id.required' => 'Kurir harus dipilih',
            'kurir_id.exists' => 'Kurir tidak valid',
            'tanggal_kerja.required' => 'Tanggal kerja harus diisi',
            'tanggal_kerja.date' => 'Format tanggal tidak valid',
            'pikup.required' => 'Jumlah pickup harus diisi',
            'pikup.integer' => 'Jumlah pickup harus berupa angka',
            'pikup.min' => 'Jumlah pickup tidak boleh negatif',
            'pud.required' => 'Jumlah PUD harus diisi',
            'pud.integer' => 'Jumlah PUD harus berupa angka',
            'pud.min' => 'Jumlah PUD tidak boleh negatif'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check if kurir already has data for this date (excluding current record)
        $existingData = GajiKurir::where('kurir_id', $request->kurir_id)
            ->where('tanggal_kerja', $request->tanggal_kerja)
            ->where('id', '!=', $gajiKurir->id)
            ->first();

        if ($existingData) {
            return redirect()->back()
                ->with('message', 'Data gaji kurir untuk tanggal ini sudah ada! Silakan pilih tanggal lain atau edit data yang sudah ada.')
                ->with('alert-info', 'warning')
                ->withInput();
        }

        try {
            // Get gaji settings
            $gajiSettings = Gaji::first();
            
            if (!$gajiSettings) {
                return redirect()->back()
                    ->with('message', 'Data gaji belum diatur!')
                    ->with('alert-info', 'danger');
            }

            // Calculate total gaji (BPJS deduction is only applied monthly, not daily)
            $totalPaketBawaan = $request->pikup * $gajiSettings->paket_bawaan;
            $totalPaketJemputan = $request->pud * $gajiSettings->paket_jemputan;
            $totalGaji = $totalPaketBawaan + $totalPaketJemputan;

            $gajiKurir->update([
                'kurir_id' => $request->kurir_id,
                'tanggal_kerja' => $request->tanggal_kerja,
                'pikup' => $request->pikup,
                'pud' => $request->pud,
                'total' => $totalGaji
            ]);

            return redirect()->route('admin.gajiKurir.index')
                ->with('message', 'Data gaji kurir berhasil diperbarui!')
                ->with('alert-info', 'success');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('message', 'Terjadi kesalahan: ' . $e->getMessage())
                ->with('alert-info', 'danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GajiKurir $gajiKurir)
    {
        try {
            $gajiKurir->delete();

            return redirect()->route('admin.gajiKurir.index')
                ->with('message', 'Data gaji kurir berhasil dihapus!')
                ->with('alert-info', 'success');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('message', 'Terjadi kesalahan: ' . $e->getMessage())
                ->with('alert-info', 'danger');
        }
    }
}
