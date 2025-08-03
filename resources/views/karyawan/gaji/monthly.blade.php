@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700; font-size: 2rem;">
                    📊 {{ __('Gaji Bulanan') }}
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.gajikaryawan.index') }}">Dashboard Gaji</a></li>
                    <li class="breadcrumb-item active">Detail Bulanan</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <!-- Period Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%); border-left: 5px solid #2196f3;">
                    <div class="card-body text-center" style="padding: 25px;">
                        <h3 style="color: #1976d2; font-weight: 700; margin: 0;">
                            <i class="fas fa-calendar-alt"></i> 
                            {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}
                        </h3>
                        <p style="color: #2196f3; margin: 10px 0 0 0;">
                            Ringkasan gaji bulanan untuk {{ $user->nama }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Statistics -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: rgb(122, 122, 122); box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);">
                    <div class="card-body text-center" style="padding: 25px;">
                        <div style="font-size: 3rem; margin-bottom: 10px;">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h3 style="font-weight: 700; margin: 0;">Rp {{ number_format($monthlyStats['total_gaji_kurir'] + $monthlyStats['total_tradisional'], 0, ',', '.') }}</h3>
                        <p style="margin: 5px 0 0 0; opacity: 0.9;">Total Gaji</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: rgb(122, 122, 122); box-shadow: 0 8px 25px rgba(240, 147, 251, 0.3);">

                    <div class="card-body text-center" style="padding: 25px;">
                        <div style="font-size: 3rem; margin-bottom: 10px;">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <h3 style="font-weight: 700; margin: 0;">{{ $monthlyStats['hari_kerja'] }}</h3>
                        <p style="margin: 5px 0 0 0; opacity: 0.9;">Hari Kerja</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: rgb(122, 122, 122); box-shadow: 0 8px 25px rgba(79, 172, 254, 0.3);">

                    <div class="card-body text-center" style="padding: 25px;">
                        <div style="font-size: 3rem; margin-bottom: 10px;">
                            <i class="fas fa-box"></i>
                        </div>
                        <h3 style="font-weight: 700; margin: 0;">{{ $monthlyStats['total_pikup'] }}</h3>
                        <p style="margin: 5px 0 0 0; opacity: 0.9;">Total Pickup</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: rgb(122, 122, 122); box-shadow: 0 8px 25px rgba(67, 233, 123, 0.3);">

                    <div class="card-body text-center" style="padding: 25px;">
                        <div style="font-size: 3rem; margin-bottom: 10px;">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h3 style="font-weight: 700; margin: 0;">{{ $monthlyStats['total_pud'] }}</h3>
                        <p style="margin: 5px 0 0 0; opacity: 0.9;">Total PUD</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <a href="{{ route('admin.gajikaryawan.index') }}" class="btn btn-secondary mr-2" style="border-radius: 25px; padding: 10px 25px;">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('admin.gajikaryawan.cetak', ['bulan' => $bulan, 'tahun' => $tahun]) }}" 
                   class="btn btn-primary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 25px; padding: 10px 25px;">
                    <i class="fas fa-print"></i> Cetak Slip Gaji
                </a>
            </div>
        </div>

        <!-- Traditional Salary Section -->
        @if($traditionalSalary)
        <div class="row mb-4">
            <div class="col-12">
                <div class="card" style="border: none; border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border: none; border-radius: 15px 15px 0 0; color: white; padding: 20px;">
                        <h4 style="margin: 0; font-weight: 600;">
                            <i class="fas fa-briefcase"></i> Gaji Tradisional (Berdasarkan Jabatan)
                        </h4>
                    </div>
                    <div class="card-body" style="padding: 25px;">
                        <div class="row">
                            <div class="col-md-6">
                                <h6><strong>Jabatan:</strong> {{ $traditionalSalary->nama_jabatan ?? '-' }}</h6>
                                <h6><strong>Gaji Pokok:</strong> Rp {{ number_format($traditionalSalary->gaji_pokok ?? 0, 0, ',', '.') }}</h6>
                                <h6><strong>Tunjangan Transportasi:</strong> Rp {{ number_format($traditionalSalary->transportasi ?? 0, 0, ',', '.') }}</h6>
                                <h6><strong>Uang Makan:</strong> Rp {{ number_format($traditionalSalary->uang_makan ?? 0, 0, ',', '.') }}</h6>
                            </div>
                            <div class="col-md-6">
                                <h6><strong>Absensi Alpha:</strong> {{ $traditionalSalary->alpha ?? 0 }} hari</h6>
                                <h6><strong>Absensi Izin:</strong> {{ $traditionalSalary->izin ?? 0 }} hari</h6>
                                <h6><strong>Total Gaji Tradisional:</strong> 
                                    <span style="color: #28a745; font-weight: 700; font-size: 1.2rem;">
                                        Rp {{ number_format($monthlyStats['total_tradisional'], 0, ',', '.') }}
                                    </span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Kurir Salary Detail -->
        @if($kurirSalaryData->count() > 0)
        <div class="row">
            <div class="col-12">
                <div class="card" style="border: none; border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 15px 15px 0 0; color: white; padding: 20px;">
                        <h4 style="margin: 0; font-weight: 600;">
                            <i class="fas fa-truck"></i> Detail Gaji Kurir Harian
                        </h4>
                    </div>
                    <div class="card-body" style="padding: 25px;">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead style="background: #f8f9fa;">
                                    <tr>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px;">Tanggal</th>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px;">Pickup</th>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px;">PUD</th>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px;">Total Gaji</th>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px;">Keterangan</th>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kurirSalaryData as $salary)
                                    <tr style="border-bottom: 1px solid #e9ecef;">
                                        <td style="padding: 15px; vertical-align: middle;">
                                            {{ \Carbon\Carbon::parse($salary->tanggal_kerja)->format('d M Y') }}
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle;">
                                            <span class="badge badge-info" style="font-size: 0.9rem; padding: 8px 12px;">
                                                {{ $salary->pikup }}
                                            </span>
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle;">
                                            <span class="badge badge-warning" style="font-size: 0.9rem; padding: 8px 12px;">
                                                {{ $salary->pud }}
                                            </span>
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle;">
                                            <strong style="color: #28a745; font-size: 1.1rem;">
                                                Rp {{ number_format($salary->total, 0, ',', '.') }}
                                            </strong>
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle;">
                                            @if($salary->keterangan)
                                                <span class="text-muted">{{ Str::limit($salary->keterangan, 30) }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle;">
                                            <a href="{{ route('admin.gajikaryawan.daily', ['date' => $salary->tanggal_kerja]) }}" 
                                               class="btn btn-sm btn-outline-primary" style="border-radius: 15px;">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot style="background: #e8f5e8; font-weight: 600;">
                                    <tr>
                                        <td style="padding: 15px; text-align: right;">
                                            <strong>TOTAL:</strong>
                                        </td>
                                        <td style="padding: 15px;">
                                            <strong style="color: #007bff;">{{ $monthlyStats['total_pikup'] }} paket</strong>
                                        </td>
                                        <td style="padding: 15px;">
                                            <strong style="color: #ffc107;">{{ $monthlyStats['total_pud'] }} paket</strong>
                                        </td>
                                        <td style="padding: 15px;">
                                            <strong style="color: #28a745; font-size: 1.2rem;">
                                                Rp {{ number_format($monthlyStats['total_gaji_kurir'], 0, ',', '.') }}
                                            </strong>
                                        </td>
                                        <td colspan="2" style="padding: 15px;"></td>
                                    </tr>
                                    <tr style="background: #d1ecf1;">
                                        <td colspan="3" style="padding: 15px; text-align: right; font-size: 1.2rem;">
                                            <strong style="color: #004085;">RATA-RATA HARIAN:</strong>
                                        </td>
                                        <td style="padding: 15px;">
                                            <strong style="color: #004085; font-size: 1.2rem;">
                                                Rp {{ number_format($monthlyStats['rata_rata_harian'], 0, ',', '.') }}
                                            </strong>
                                        </td>
                                        <td colspan="2" style="padding: 15px;"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-12">
                <div class="card" style="border: none; border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.1);">
                    <div class="card-body text-center" style="padding: 50px 20px;">
                        <div style="font-size: 4rem; color: #dee2e6; margin-bottom: 20px;">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <h5 style="color: #6c757d; margin-bottom: 10px;">Tidak Ada Data Gaji Kurir</h5>
                        <p style="color: #adb5bd;">
                            Tidak ada data gaji kurir untuk periode {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Monthly Deductions (BPJS) -->
        <div class="row">
            <div class="col-12">
                <div class="card" style="border: none; border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); margin-top: 20px;">
                    <div class="card-header" style="background: linear-gradient(135deg, #dc3545 0%, #e74c3c 100%); border: none; border-radius: 15px 15px 0 0; color: white; padding: 20px;">
                        <h4 style="margin: 0; font-weight: 600;">
                            <i class="fas fa-minus-circle"></i> Potongan Bulanan
                        </h4>
                    </div>
                    <div class="card-body" style="padding: 25px;">
                        <div class="row">
                            <div class="col-md-6">
                                <div style="background: #f8d7da; padding: 20px; border-radius: 10px; border-left: 4px solid #dc3545;">
                                    <h5 style="color: #721c24; font-weight: 600; margin-bottom: 15px;">
                                        <i class="fas fa-heart-broken"></i> Potongan BPJS
                                    </h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <strong>Per Bulan:</strong>
                                        </div>
                                        <div class="col-6 text-right">
                                            <strong style="color: #dc3545;">
                                                -Rp {{ number_format($gajiSettings->potongan_bpjs ?? 0, 0, ',', '.') }}
                                            </strong>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <small class="text-muted">Per Hari Kerja:</small>
                                        </div>
                                        <div class="col-6 text-right">
                                            <small class="text-muted">
                                                ~Rp {{ number_format(($gajiSettings->potongan_bpjs ?? 0) / max($monthlyStats['hari_kerja'], 1), 0, ',', '.') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="background: #d4edda; padding: 20px; border-radius: 10px; border-left: 4px solid #28a745;">
                                    <h5 style="color: #155724; font-weight: 600; margin-bottom: 15px;">
                                        <i class="fas fa-calculator"></i> Total Gaji Bersih
                                    </h5>
                                    <div class="row">
                                        <div class="col-8">
                                            <strong>Gaji Kotor:</strong>
                                        </div>
                                        <div class="col-4 text-right">
                                            <strong>
                                                Rp {{ number_format($monthlyStats['total_gaji_kurir'] + $monthlyStats['total_tradisional'], 0, ',', '.') }}
                                            </strong>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-8">
                                            <small>Potongan BPJS:</small>
                                        </div>
                                        <div class="col-4 text-right">
                                            <small style="color: #dc3545;">
                                                -Rp {{ number_format($gajiSettings->potongan_bpjs ?? 0, 0, ',', '.') }}
                                            </small>
                                        </div>
                                    </div>
                                    <hr style="margin: 10px 0;">
                                    <div class="row">
                                        <div class="col-8">
                                            <strong style="color: #155724; font-size: 1.1rem;">GAJI BERSIH:</strong>
                                        </div>
                                        <div class="col-4 text-right">
                                            <strong style="color: #155724; font-size: 1.2rem;">
                                                Rp {{ number_format(($monthlyStats['total_gaji_kurir'] + $monthlyStats['total_tradisional']) - ($gajiSettings->potongan_bpjs ?? 0), 0, ',', '.') }}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card" style="border: none; border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.1);">
                    <div class="card-body text-center" style="padding: 50px 20px;">
                        <div style="font-size: 4rem; color: #dee2e6; margin-bottom: 20px;">
                            <i class="fas fa-thumbs-up"></i>
                        </div>
                        <h5 style="color: #6c757d; margin-bottom: 10px;">Terima kasih telah menggunakan sistem kami</h5>
                        <p style="color: #adb5bd;">
                            Semoga informasi gaji ini bermanfaat untuk Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: fadeInUp 0.6s ease-out;
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}
</style>
@endsection
