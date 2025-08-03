<?php

namespace App\Http\Controllers\Karyawan;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\PermintaanCuti;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan') . $request->get('tahun');

        if ($bulan === '') {
            $bulanSaatIni = ltrim(date('m') . date('Y'), '0');
            $absensis = Absensi::with('user')->where('bulan', $bulanSaatIni)->where('user_id', Auth()->user()->id)->get();
        } else {
            $absensis = Absensi::with('user')->where('bulan', $bulan)->where('user_id', Auth()->user()->id)->get();
        }

        return view('admin.karyawan.index', compact('absensis'));
    }

    public function show(Request $request)
    {
        // $bulan = $request->get('bulan') . $request->get('tahun');

        // $userId = Auth()->user()->id;
        // if ($bulan === '') {
        //     $bulanSaatIni = ltrim(date('m') . date('Y'), '0');
        //     $absensis = DB::select("
        //     SELECT users.*, jabatan.nama as nama_jabatan
        //     FROM users 
        //     JOIN jabatan ON users.jabatan_id = jabatan.id 
        //     WHERE NOT EXISTS (
        //         SELECT * FROM absensi 
        //         WHERE bulan = ?
        //         AND users.id = absensi.user_id
        //     ) AND users.id = ?
        // ", [$bulanSaatIni, $userId]);
        // } else {
        //     $absensis = DB::select("
        //     SELECT users.*, jabatan.nama as nama_jabatan
        //     FROM users
        //     JOIN jabatan ON users.jabatan_id = jabatan.id
        //     WHERE NOT EXISTS (
        //         SELECT * FROM absensi
        //         WHERE bulan = ?
        //         AND users.id = absensi.user_id
        //     ) AND users.id = ?
        // ", [$bulan, $userId]);
        // }

        return view('admin.karyawan.show');
    }

    public function store(Request $request)
    {

        DB::beginTransaction();
        try {

            $absenHadir = '';
            $absenSakit = '';
            $absenAlpha = '';
            if($request->input('txtAbsen') == 'Hadir'){
                $absenHadir = 1;
            }elseif ($request->input('txtAbsen') == 'Sakit') {
                $absenSakit = 1;
            }
            else{
                $absenAlpha = 1;
            }
            // Ganti $id dengan ID yang sesuai
            $absen = Absensi::create([
                'user_id' => Auth()->user()->id,
                'bulan' => $tgl = ltrim(date('m').date('Y'), '0'),
                'hadir' => !empty($absenHadir) ? 1 : 0,
                'izin' => !empty($absenSakit) ? 1 : 0,
                'alpha' => !empty($absenAlpha) ? 1 : 0,
                'created_at' => now(),
            ]);

            if ($absen) {
                DB::commit();
                return view('admin.karyawan.show');
            } else {
                return redirect()->route('admin.karyawan.show')->with('failed', 'Gagal');
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
        }
        //     $request->validate([
        //         'hadir[]' => 'nullable|number',
        //         'izin[]' => 'nullable|number',
        //         'alpha[]' => 'nullable|number'
        //     ]);

        //     foreach ($request->karyawan_id as $key => $id) {
        //         $input['user_id'] = $id;
        //         $input['bulan'] = $request->bulan;
        //         $input['hadir'] = $request->hadir[$key];
        //         $input['izin'] = $request->izin[$key];
        //         $input['alpha'] = $request->alpha[$key];
        //         if ($input['hadir'] === 0 || $input['hadir'] || $input['izin'] === 0 || $input['izin'] || $input['alpha'] === 0 || $input['alpha']) {
        //             Absensi::create($input);
        //         }
        //     }

        //     return redirect()->back()->with([
        //         'message' => 'berhasil di edit',
        //         'alert-info' => 'success'
        //     ]);
    }

    function cuti()
    {
        $count = Cuti::where('nik_karyawan',  Auth()->user()->nik)->where('cuti_status', 1)->where('alasan_ditolak', null)->count();
        $loadCuti = Cuti::where('nik_karyawan',  Auth()->user()->nik)->where('cuti_status', 1)->whereNotNull('alasan_ditolak')->get();
        return view('admin.karyawan.cuti', compact('count', 'loadCuti'));
    }

    function prosescuti(Request $request)
    {
        try {
            $simpanCuti = Cuti::create([
                'nama_karyawan' => Auth()->user()->nama,
                'email_karyawan' => Auth()->user()->email,
                'nik_karyawan' => Auth()->user()->nik,
                'keterangan' => $request->input('txtKeterangan'),
                'tgl_cuti' => $request->input('txtCuti'),
                'cuti_status' => 0,
                'created_at' => now(),
                'updated_at' => null

            ]);

            return response()->json(['status' => 200]);
        } catch (\Throwable $th) {

            return response()->json(['status' => 500, 'pesan' =>  $th->getMessage()], 500);
        }
    }
}
