<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Gaji;
use App\Models\GajiKurir;
use App\Models\PotonganGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LaporanController extends Controller
{
    /**
     * Display the main report page
     */
    public function index()
    {
        $users = User::where('nama', '!=', 'admin')->get(['nama', 'id']);
        $gajiSettings = Gaji::first();
        
        // Get summary data for dashboard
        $totalKurir = User::where('nama', '!=', 'admin')->count();
        $todayGajiKurir = GajiKurir::whereDate('tanggal_kerja', today())->count();
        $thisMonthGajiKurir = GajiKurir::whereMonth('tanggal_kerja', now()->month)
                                     ->whereYear('tanggal_kerja', now()->year)
                                     ->count();
        
        return view('admin.laporan.index', compact(
            'users', 
            'gajiSettings',
            'totalKurir',
            'todayGajiKurir', 
            'thisMonthGajiKurir'
        ));
    }

    /**
     * Generate individual salary report
     */
    public function store(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'karyawan_id' => 'required|exists:users,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:' . (date('Y') + 1)
        ], [
            'karyawan_id.required' => 'Silakan pilih karyawan',
            'karyawan_id.exists' => 'Karyawan tidak valid',
            'bulan.required' => 'Silakan pilih bulan',
            'bulan.integer' => 'Bulan harus berupa angka',
            'bulan.min' => 'Bulan tidak valid',
            'bulan.max' => 'Bulan tidak valid',
            'tahun.required' => 'Silakan pilih tahun',
            'tahun.integer' => 'Tahun harus berupa angka',
            'tahun.min' => 'Tahun tidak valid (minimal 2020)',
            'tahun.max' => 'Tahun tidak valid (maksimal ' . (date('Y') + 1) . ')'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Ada kesalahan pada input. Silakan periksa kembali.');
        }

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $karyawan_id = $request->karyawan_id;
        
        // Get user info
        $user = User::find($karyawan_id);
        
        if (!$user) {
            return redirect()->back()
                ->with('error', 'Karyawan tidak ditemukan')
                ->withInput();
        }
        
        // Get traditional salary data (jika ada)
        $potongan_alpha = PotonganGaji::where('jenis_potongan', 'alpha')->get();
        $potongan_izin = PotonganGaji::where('jenis_potongan', 'izin')->get();
        
        // Traditional salary calculation
        $tanggal = str_pad($bulan, 2, '0', STR_PAD_LEFT) . $tahun;
        try {
            $traditionalSalary = DB::select("
                SELECT users.nik, users.nama, jabatan.nama as nama_jabatan, 
                       jabatan.gaji_pokok, jabatan.transportasi, jabatan.uang_makan,
                       COALESCE(absensi.alpha, 0) as alpha, COALESCE(absensi.izin, 0) as izin
                FROM users
                LEFT JOIN absensi ON absensi.user_id = users.id 
                LEFT JOIN jabatan ON jabatan.id = users.jabatan_id
                WHERE users.id = ? 
                AND (absensi.bulan = ? OR absensi.bulan IS NULL)
            ", [$karyawan_id, $tanggal]);
        } catch (\Exception $e) {
            \Log::error('Error fetching traditional salary: ' . $e->getMessage());
            $traditionalSalary = [];
        }

        // Get kurir salary data
        $kurirSalary = GajiKurir::with('kurir')
            ->where('kurir_id', $karyawan_id)
            ->whereMonth('tanggal_kerja', $bulan)
            ->whereYear('tanggal_kerja', $tahun)
            ->orderBy('tanggal_kerja', 'desc')
            ->get();

        // Get gaji settings for kurir calculations
        $gajiSettings = Gaji::first();

        // Check if any data found
        $hasData = (count($traditionalSalary) > 0) || ($kurirSalary->count() > 0);
        
        if (!$hasData) {
            return redirect()->back()
                ->with('warning', 'Tidak ditemukan data gaji untuk ' . $user->nama . ' pada periode ' . 
                       DateTime::createFromFormat('!m', $bulan)->format('F') . ' ' . $tahun)
                ->withInput();
        }

        return view('admin.laporan.cetak-gaji', compact(
            'bulan', 
            'tahun', 
            'user',
            'traditionalSalary',
            'kurirSalary',
            'potongan_alpha',
            'potongan_izin',
            'gajiSettings'
        ));
    }

    /**
     * Show summary report page
     */
    public function show()
    {
        return view('admin.laporan.show');
    }

    /**
     * Generate comprehensive monthly report
     */
    public function monthlyReport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:' . (date('Y') + 1)
        ], [
            'bulan.required' => 'Silakan pilih bulan',
            'bulan.integer' => 'Bulan harus berupa angka',
            'bulan.min' => 'Bulan tidak valid',
            'bulan.max' => 'Bulan tidak valid',
            'tahun.required' => 'Silakan pilih tahun',
            'tahun.integer' => 'Tahun harus berupa angka',
            'tahun.min' => 'Tahun tidak valid (minimal 2020)',
            'tahun.max' => 'Tahun tidak valid (maksimal ' . (date('Y') + 1) . ')'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Ada kesalahan pada input. Silakan periksa kembali.');
        }

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        // Get all kurir salary data for the month
        $kurirData = GajiKurir::with('kurir')
            ->whereMonth('tanggal_kerja', $bulan)
            ->whereYear('tanggal_kerja', $tahun)
            ->orderBy('kurir_id')
            ->orderBy('tanggal_kerja', 'desc')
            ->get();

        // Check if data exists
        if ($kurirData->count() == 0) {
            return redirect()->back()
                ->with('warning', 'Tidak ditemukan data gaji kurir untuk periode ' . 
                       DateTime::createFromFormat('!m', $bulan)->format('F') . ' ' . $tahun)
                ->withInput();
        }

        // Get summary statistics
        $totalGaji = $kurirData->sum('total');
        $totalPikup = $kurirData->sum('pikup');
        $totalPud = $kurirData->sum('pud');
        $totalKurir = $kurirData->groupBy('kurir_id')->count();

        // Get gaji settings
        $gajiSettings = Gaji::first();

        return view('admin.laporan.monthly-report', compact(
            'bulan',
            'tahun', 
            'kurirData',
            'totalGaji',
            'totalPikup',
            'totalPud',
            'totalKurir',
            'gajiSettings'
        ));
    }

    /**
     * Check individual salary for logged in user
     */
    public function cekGaji(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:' . (date('Y') + 1)
        ], [
            'bulan.required' => 'Silakan pilih bulan',
            'bulan.integer' => 'Bulan harus berupa angka',
            'bulan.min' => 'Bulan tidak valid',
            'bulan.max' => 'Bulan tidak valid',
            'tahun.required' => 'Silakan pilih tahun',
            'tahun.integer' => 'Tahun harus berupa angka',
            'tahun.min' => 'Tahun tidak valid (minimal 2020)',
            'tahun.max' => 'Tahun tidak valid (maksimal ' . (date('Y') + 1) . ')'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Ada kesalahan pada input. Silakan periksa kembali.');
        }

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $karyawan_id = auth()->id();
        
        // Get user info
        $user = User::find($karyawan_id);
        
        if (!$user) {
            return redirect()->back()
                ->with('error', 'Data pengguna tidak ditemukan. Silakan login ulang.')
                ->withInput();
        }
        
        // Get traditional salary data
        $potongan_alpha = PotonganGaji::where('jenis_potongan', 'alpha')->get();
        $potongan_izin = PotonganGaji::where('jenis_potongan', 'izin')->get();
        
        $tanggal = str_pad($bulan, 2, '0', STR_PAD_LEFT) . $tahun;
        try {
            $traditionalSalary = DB::select("
                SELECT users.nik, users.nama, jabatan.nama as nama_jabatan, 
                       jabatan.gaji_pokok, jabatan.transportasi, jabatan.uang_makan,
                       COALESCE(absensi.alpha, 0) as alpha, COALESCE(absensi.izin, 0) as izin
                FROM users
                LEFT JOIN absensi ON absensi.user_id = users.id 
                LEFT JOIN jabatan ON jabatan.id = users.jabatan_id
                WHERE users.id = ? 
                AND (absensi.bulan = ? OR absensi.bulan IS NULL)
            ", [$karyawan_id, $tanggal]);
        } catch (\Exception $e) {
            \Log::error('Error fetching traditional salary for user ' . $karyawan_id . ': ' . $e->getMessage());
            $traditionalSalary = [];
        }

        // Get kurir salary data
        $kurirSalary = GajiKurir::with('kurir')
            ->where('kurir_id', $karyawan_id)
            ->whereMonth('tanggal_kerja', $bulan)
            ->whereYear('tanggal_kerja', $tahun)
            ->orderBy('tanggal_kerja', 'desc')
            ->get();

        // Get gaji settings
        $gajiSettings = Gaji::first();

        // Check if any data found
        $hasData = (count($traditionalSalary) > 0) || ($kurirSalary->count() > 0);
        
        if (!$hasData) {
            return redirect()->back()
                ->with('warning', 'Tidak ditemukan data gaji Anda untuk periode ' . 
                       DateTime::createFromFormat('!m', $bulan)->format('F') . ' ' . $tahun . 
                       '. Silakan hubungi HRD jika ada pertanyaan.')
                ->withInput();
        }

        return view('admin.laporan.cetak-gaji-karyawan', compact(
            'bulan', 
            'tahun', 
            'user',
            'traditionalSalary',
            'kurirSalary',
            'potongan_alpha',
            'potongan_izin',
            'gajiSettings'
        ));
    }

    /**
     * Export salary report to PDF
     */
    public function exportPdf(Request $request)
    {
        // Implementation for PDF export
        // You can use libraries like TCPDF, DOMPDF, or Snappy
        
        return response()->json([
            'message' => 'PDF export feature coming soon'
        ]);
    }

    /**
     * Get report data via AJAX
     */
    public function getReportData(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $type = $request->type;

        if ($type === 'kurir') {
            $data = GajiKurir::with('kurir')
                ->whereMonth('tanggal_kerja', $bulan)
                ->whereYear('tanggal_kerja', $tahun)
                ->get();
                
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid report type'
        ]);
    }
}
