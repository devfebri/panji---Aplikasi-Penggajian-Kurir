<?php

namespace App\Http\Controllers\Karyawan;

use App\Models\User;
use App\Models\Gaji;
use App\Models\GajiKurir;
use App\Models\PotonganGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GajiKaryawanController extends Controller
{
    /**
     * Display employee's own salary information (dashboard)
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        
        // Get current month/year or from request
        $bulan = $request->get('bulan', date('n'));
        $tahun = $request->get('tahun', date('Y'));
        
        // Get traditional salary data (if exists)
        $traditionalSalary = $this->getTraditionalSalary($userId, $bulan, $tahun);
        
        // Get kurir salary data for the month
        $kurirSalaryData = GajiKurir::where('kurir_id', $userId)
            ->whereMonth('tanggal_kerja', $bulan)
            ->whereYear('tanggal_kerja', $tahun)
            ->orderBy('tanggal_kerja', 'desc')
            ->get();
        
        // Get recent kurir salary (last 7 days)
        $recentKurirSalary = GajiKurir::where('kurir_id', $userId)
            ->where('tanggal_kerja', '>=', now()->subDays(7))
            ->orderBy('tanggal_kerja', 'desc')
            ->get();
        
        // Calculate statistics
        $monthlyStats = [
            'total_gaji_kurir' => $kurirSalaryData->sum('total'),
            'total_pikup' => $kurirSalaryData->sum('pikup'),
            'total_pud' => $kurirSalaryData->sum('pud'),
            'hari_kerja' => $kurirSalaryData->count(),
            'rata_rata_harian' => $kurirSalaryData->count() > 0 ? $kurirSalaryData->avg('total') : 0
        ];
        
        // Get salary settings
        $gajiSettings = Gaji::first();
        
        return view('karyawan.gaji.index', compact(
            'user',
            'traditionalSalary',
            'kurirSalaryData',
            'recentKurirSalary',
            'monthlyStats',
            'gajiSettings',
            'bulan',
            'tahun'
        ));
    }
    
    /**
     * Show daily salary detail for a specific date
     */
    public function showDaily(Request $request)
    {
        $user = Auth::user();
        $date = $request->get('date', date('Y-m-d'));
        
        // Validate date
        if (!strtotime($date)) {
            return redirect()->back()->with('error', 'Format tanggal tidak valid.');
        }
        
        // Get kurir salary for specific date
        $dailySalary = GajiKurir::where('kurir_id', $user->id)
            ->whereDate('tanggal_kerja', $date)
            ->first();
        
        if (!$dailySalary) {
            return redirect()->back()->with('warning', 'Tidak ada data gaji untuk tanggal ' . date('d M Y', strtotime($date)));
        }
        
        // Get salary settings for calculation breakdown
        $gajiSettings = Gaji::first();
        
        return view('karyawan.gaji.daily', compact('user', 'dailySalary', 'gajiSettings', 'date'));
    }
    
    /**
     * Show monthly salary summary
     */
    public function showMonthly(Request $request)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'bulan' => 'nullable|integer|min:1|max:12',
            'tahun' => 'nullable|integer|min:2020|max:' . (date('Y') + 1)
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $bulan = $request->get('bulan', date('n'));
        $tahun = $request->get('tahun', date('Y'));
        
        // Get traditional salary
        $traditionalSalary = $this->getTraditionalSalary($user->id, $bulan, $tahun);
        
        // Get kurir salary data for the month
        $kurirSalaryData = GajiKurir::where('kurir_id', $user->id)
            ->whereMonth('tanggal_kerja', $bulan)
            ->whereYear('tanggal_kerja', $tahun)
            ->orderBy('tanggal_kerja', 'desc')
            ->get();
        
        // Calculate monthly statistics
        $monthlyStats = [
            'total_gaji_kurir' => $kurirSalaryData->sum('total'),
            'total_pikup' => $kurirSalaryData->sum('pikup'),
            'total_pud' => $kurirSalaryData->sum('pud'),
            'hari_kerja' => $kurirSalaryData->count(),
            'rata_rata_harian' => $kurirSalaryData->count() > 0 ? $kurirSalaryData->avg('total') : 0,
            'total_tradisional' => 0
        ];
        
        // Calculate traditional salary total if exists
        if ($traditionalSalary) {
            $potongan_alpha = PotonganGaji::where('jenis_potongan', 'alpha')->first();
            $potongan_izin = PotonganGaji::where('jenis_potongan', 'izin')->first();
            
            $total_potongan = 0;
            if ($potongan_alpha) $total_potongan += ($potongan_alpha->jumlah_potongan * ($traditionalSalary->alpha ?? 0));
            if ($potongan_izin) $total_potongan += ($potongan_izin->jumlah_potongan * ($traditionalSalary->izin ?? 0));
            
            $monthlyStats['total_tradisional'] = ($traditionalSalary->gaji_pokok ?? 0) + 
                                                ($traditionalSalary->transportasi ?? 0) + 
                                                ($traditionalSalary->uang_makan ?? 0) - $total_potongan;
        }
        
        // Get salary settings
        $gajiSettings = Gaji::first();
        
        return view('karyawan.gaji.monthly', compact(
            'user',
            'traditionalSalary',
            'kurirSalaryData',
            'monthlyStats',
            'gajiSettings',
            'bulan',
            'tahun'
        ));
    }
    
    /**
     * Print salary slip for employee
     */
    public function cetak($bulan, $tahun)
    {
        $user = Auth::user();
        
        // Validate parameters
        if (!is_numeric($bulan) || !is_numeric($tahun) || $bulan < 1 || $bulan > 12) {
            return redirect()->back()->with('error', 'Parameter bulan atau tahun tidak valid.');
        }
        
        // Get traditional salary
        $traditionalSalary = $this->getTraditionalSalary($user->id, $bulan, $tahun);
        
        // Get kurir salary data
        $kurirSalaryData = GajiKurir::where('kurir_id', $user->id)
            ->whereMonth('tanggal_kerja', $bulan)
            ->whereYear('tanggal_kerja', $tahun)
            ->orderBy('tanggal_kerja', 'desc')
            ->get();
        
        // Get salary settings and deduction data
        $gajiSettings = Gaji::first();
        $potongan_alpha = PotonganGaji::where('jenis_potongan', 'alpha')->get();
        $potongan_izin = PotonganGaji::where('jenis_potongan', 'izin')->get();
        
        return view('karyawan.gaji.cetak', compact(
            'user',
            'traditionalSalary', 
            'kurirSalaryData',
            'gajiSettings',
            'potongan_alpha', 
            'potongan_izin',
            'bulan', 
            'tahun'
        ));
    }
    
    /**
     * Get traditional salary data for user
     */
    private function getTraditionalSalary($userId, $bulan, $tahun)
    {
        $tanggal = str_pad($bulan, 2, '0', STR_PAD_LEFT) . $tahun;
        
        try {
            $result = DB::select("
                SELECT users.nik, users.nama, users.jenis_kelamin,
                       jabatan.nama as nama_jabatan, jabatan.gaji_pokok,
                       jabatan.transportasi, jabatan.uang_makan,
                       COALESCE(absensi.alpha, 0) as alpha, 
                       COALESCE(absensi.izin, 0) as izin
                FROM users
                LEFT JOIN absensi ON absensi.user_id = users.id AND absensi.bulan = ?
                LEFT JOIN jabatan ON jabatan.id = users.jabatan_id
                WHERE users.id = ?
            ", [$tanggal, $userId]);
            
            return $result ? $result[0] : null;
        } catch (\Exception $e) {
            \Log::error('Error fetching traditional salary: ' . $e->getMessage());
            return null;
        }
    }
}
