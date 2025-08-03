@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <h1 class="m-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700; font-size: 2rem; text-align: center;">
                    💰 {{ __('Dashboard Gaji Saya') }}
                </h1>
                <p class="text-center text-muted mt-2">
                    Selamat datang, {{ $user->nama }}! Lihat informasi gaji Anda di sini.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <!-- Period Selection -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%); border-left: 5px solid #2196f3;">
                    <div class="card-body" style="padding: 20px;">
                        <form method="GET" action="{{ route('admin.gajikaryawan.index') }}" class="row align-items-end">
                            <div class="col-md-4">
                                <label for="bulan" style="font-weight: 600; color: #333;">
                                    <i class="fas fa-calendar"></i> Bulan
                                </label>
                                <select class="form-control" name="bulan" id="bulan" style="border-radius: 10px;">
                                    @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                    </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="tahun" style="font-weight: 600; color: #333;">
                                    <i class="fas fa-calendar-alt"></i> Tahun
                                </label>
                                <select class="form-control" name="tahun" id="tahun" style="border-radius: 10px;">
                                    @for($i = date('Y'); $i >= date('Y')-3; $i--)
                                    <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary" style="border-radius: 10px; padding: 10px 20px;">
                                    <i class="fas fa-search"></i> Lihat Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: rgb(117, 117, 117); box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);">
                    <div class="card-body text-center" style="padding: 25px;">
                        <div style="font-size: 3rem; margin-bottom: 10px;">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h3 style="font-weight: 700; margin: 0;">Rp {{ number_format($monthlyStats['total_gaji_kurir'], 0, ',', '.') }}</h3>
                        <p style="margin: 5px 0 0 0; opacity: 0.9;">Total Gaji Kurir</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: rgb(117, 117, 117); box-shadow: 0 8px 25px rgba(240, 147, 251, 0.3);">

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
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: rgb(117, 117, 117); box-shadow: 0 8px 25px rgba(79, 172, 254, 0.3);">

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
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: rgb(117, 117, 117); box-shadow: 0 8px 25px rgba(67, 233, 123, 0.3);">

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
                <a href="{{ route('admin.gajikaryawan.monthly', ['bulan' => $bulan, 'tahun' => $tahun]) }}" 
                   class="btn btn-lg mr-3" 
                   style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 25px; padding: 12px 30px;">
                    <i class="fas fa-chart-bar"></i> Lihat Detail Bulanan
                </a>
                <a href="{{ route('admin.gajikaryawan.cetak', ['bulan' => $bulan, 'tahun' => $tahun]) }}" 
                   class="btn btn-lg mr-3" 
                   style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border: none; border-radius: 25px; padding: 12px 30px;">
                    <i class="fas fa-print"></i> Cetak Slip Gaji
                </a>
            </div>
        </div>

        <!-- Recent Salary Data -->
        <div class="row">
            <div class="col-12">
                <div class="card" style="border: none; border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 15px 15px 0 0; color: white; padding: 20px;">
                        <h4 style="margin: 0; font-weight: 600;">
                            <i class="fas fa-history"></i> Gaji Terbaru (7 Hari Terakhir)
                        </h4>
                    </div>
                    <div class="card-body" style="padding: 25px;">
                        @if($recentKurirSalary->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead style="background: #f8f9fa;">
                                    <tr>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px;">Tanggal</th>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px;">Pickup</th>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px;">PUD</th>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px;">Total Gaji</th>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentKurirSalary as $salary)
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
                                            <a href="{{ route('admin.gajikaryawan.daily', ['date' => $salary->tanggal_kerja]) }}" 
                                               class="btn btn-sm btn-outline-primary" style="border-radius: 15px;">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center" style="padding: 50px 20px;">
                            <div style="font-size: 4rem; color: #dee2e6; margin-bottom: 20px;">
                                <i class="fas fa-inbox"></i>
                            </div>
                            <h5 style="color: #6c757d; margin-bottom: 10px;">Belum Ada Data Gaji Terbaru</h5>
                            <p style="color: #adb5bd;">
                                Tidak ada data gaji kurir dalam 7 hari terakhir.
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Salary Settings Info -->
        @if($gajiSettings)
        <div class="row mt-4">
            <div class="col-12">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #e8f5e8 0%, #f0f8ff 100%); border-left: 5px solid #28a745;">
                    <div class="card-body" style="padding: 25px;">
                        <h5 style="color: #155724; font-weight: 700; margin-bottom: 20px;">
                            <i class="fas fa-info-circle"></i> Informasi Tarif Gaji
                        </h5>
                        <div class="row text-center">
                            <div class="col-md-3">
                                <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                                    <div style="font-size: 2rem; color: #28a745; margin-bottom: 10px;">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <h4 style="color: #155724; font-weight: 700;">{{ $gajiSettings->formatted_paket_bawaan }}</h4>
                                    <p style="color: #28a745; margin: 0;">Paket Bawaan</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                                    <div style="font-size: 2rem; color: #28a745; margin-bottom: 10px;">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                    <h4 style="color: #155724; font-weight: 700;">{{ $gajiSettings->formatted_paket_jemputan }}</h4>
                                    <p style="color: #28a745; margin: 0;">Paket Jemputan</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                                    <div style="font-size: 2rem; color: #dc3545; margin-bottom: 10px;">
                                        <i class="fas fa-heart-broken"></i>
                                    </div>
                                    <h4 style="color: #721c24; font-weight: 700;">{{ $gajiSettings->formatted_potongan_bpjs }}</h4>
                                    <p style="color: #dc3545; margin: 0;">Potongan BPJS</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                                    <div style="font-size: 2rem; color: #007bff; margin-bottom: 10px;">
                                        <i class="fas fa-calculator"></i>
                                    </div>
                                    <h4 style="color: #004085; font-weight: 700;">{{ $gajiSettings->formatted_total_gaji }}</h4>
                                    <p style="color: #007bff; margin: 0;">Total Per Paket</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
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
