@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700; font-size: 2rem;">
                    📅 {{ __('Gaji Harian') }}
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.gajikaryawan.index') }}">Dashboard Gaji</a></li>
                    <li class="breadcrumb-item active">Detail Harian</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <!-- Date Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%); border-left: 5px solid #2196f3;">
                    <div class="card-body text-center" style="padding: 25px;">
                        <h3 style="color: #1976d2; font-weight: 700; margin: 0;">
                            <i class="fas fa-calendar-alt"></i> 
                            {{ \Carbon\Carbon::parse($date)->format('d F Y') }}
                        </h3>
                        <p style="color: #2196f3; margin: 10px 0 0 0;">
                            Detail gaji kurir untuk {{ $user->nama }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Salary Breakdown -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card" style="border: none; border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 15px 15px 0 0; color: rgb(110, 110, 110); padding: 20px;">
                        <h4 style="margin: 0; font-weight: 600;">
                            <i class="fas fa-calculator"></i> Rincian Perhitungan Gaji
                        </h4>
                    </div>
                    <div class="card-body" style="padding: 30px;">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead style="background: #f8f9fa;">
                                    <tr>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px;">Keterangan</th>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px; text-align: center;">Jumlah</th>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px; text-align: right;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding: 15px;">
                                            <strong><i class="fas fa-box text-info"></i> Paket Pickup (Bawaan)</strong>
                                            <br><small class="text-muted">Rp {{ number_format($gajiSettings->paket_bawaan ?? 0, 0, ',', '.') }} per paket</small>
                                        </td>
                                        <td style="padding: 15px; text-align: center;">
                                            <span class="badge badge-info" style="font-size: 1.1rem; padding: 10px 15px;">
                                                {{ $dailySalary->pikup }}
                                            </span>
                                        </td>
                                        <td style="padding: 15px; text-align: right;">
                                            <strong style="color: #28a745; font-size: 1.1rem;">
                                                Rp {{ number_format(($dailySalary->pikup * ($gajiSettings->paket_bawaan ?? 0)), 0, ',', '.') }}
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 15px;">
                                            <strong><i class="fas fa-truck text-warning"></i> Paket PUD (Jemputan)</strong>
                                            <br><small class="text-muted">Rp {{ number_format($gajiSettings->paket_jemputan ?? 0, 0, ',', '.') }} per paket</small>
                                        </td>
                                        <td style="padding: 15px; text-align: center;">
                                            <span class="badge badge-warning" style="font-size: 1.1rem; padding: 10px 15px;">
                                                {{ $dailySalary->pud }}
                                            </span>
                                        </td>
                                        <td style="padding: 15px; text-align: right;">
                                            <strong style="color: #28a745; font-size: 1.1rem;">
                                                Rp {{ number_format(($dailySalary->pud * ($gajiSettings->paket_jemputan ?? 0)), 0, ',', '.') }}
                                            </strong>
                                        </td>
                                    </tr>                                    <tr style="background: #f8f9fa;">
                                        <td style="padding: 15px;">
                                            <strong><i class="fas fa-equals text-success"></i> Total Gaji Harian</strong>
                                            <br><small class="text-muted">Potongan BPJS diperhitungkan pada slip gaji bulanan</small>
                                        </td>
                                        <td style="padding: 15px; text-align: center;">
                                            <span class="badge badge-success" style="font-size: 1.1rem; padding: 10px 15px;">
                                                {{ $dailySalary->pikup + $dailySalary->pud }} total
                                            </span>
                                        </td>
                                        <td style="padding: 15px; text-align: right;">
                                            <strong style="color: #28a745; font-size: 1.2rem;">
                                                Rp {{ number_format((($dailySalary->pikup * ($gajiSettings->paket_bawaan ?? 0)) + ($dailySalary->pud * ($gajiSettings->paket_jemputan ?? 0))), 0, ',', '.') }}
                                            </strong>
                                        </td>                                    </tr>
                                </tbody>
                                <tfoot style="background: #e8f5e8;">                                    <tr>
                                        <td colspan="2" style="padding: 20px; text-align: right; font-size: 1.3rem;">
                                            <strong style="color: #155724;">TOTAL GAJI HARIAN:</strong>
                                        </td>
                                        <td style="padding: 20px; text-align: right;">
                                            <strong style="color: #155724; font-size: 1.5rem;">
                                                Rp {{ number_format((($dailySalary->pikup * ($gajiSettings->paket_bawaan ?? 0)) + ($dailySalary->pud * ($gajiSettings->paket_jemputan ?? 0))), 0, ',', '.') }}
                                            </strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">                <!-- Summary Card -->
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3); margin-bottom: 20px;">
                    <div class="card-body text-center" style="padding: 25px;">
                        <div style="font-size: 3rem; margin-bottom: 15px;">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h2 style="font-weight: 700; margin: 0;">Rp {{ number_format((($dailySalary->pikup * ($gajiSettings->paket_bawaan ?? 0)) + ($dailySalary->pud * ($gajiSettings->paket_jemputan ?? 0))), 0, ',', '.') }}</h2>
                        <p style="margin: 10px 0 0 0; opacity: 0.9; font-size: 1.1rem;">Gaji Harian</p>
                        <small style="opacity: 0.8; font-size: 0.85rem;">
                            <i class="fas fa-info-circle"></i> Potongan BPJS hanya dipotong bulanan
                        </small>
                    </div>
                </div>
                
                <!-- Statistics -->
                <div class="card" style="border: none; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: #f8f9fa; border: none; border-radius: 15px 15px 0 0; padding: 20px;">
                        <h5 style="margin: 0; font-weight: 600; color: #495057;">
                            <i class="fas fa-chart-pie"></i> Statistik Kerja
                        </h5>
                    </div>
                    <div class="card-body" style="padding: 20px;">
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <div style="background: #e3f2fd; padding: 15px; border-radius: 10px;">
                                    <div style="font-size: 2rem; color: #2196f3; margin-bottom: 10px;">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <h4 style="color: #1976d2; font-weight: 700; margin: 0;">{{ $dailySalary->pikup }}</h4>
                                    <p style="color: #2196f3; margin: 5px 0 0 0; font-size: 0.9rem;">Pickup</p>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div style="background: #fff3e0; padding: 15px; border-radius: 10px;">
                                    <div style="font-size: 2rem; color: #ff9800; margin-bottom: 10px;">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                    <h4 style="color: #f57c00; font-weight: 700; margin: 0;">{{ $dailySalary->pud }}</h4>
                                    <p style="color: #ff9800; margin: 5px 0 0 0; font-size: 0.9rem;">PUD</p>
                                </div>
                            </div>
                        </div>
                        
                        @if($dailySalary->keterangan)
                        <div style="background: #e8f5e8; padding: 15px; border-radius: 10px; margin-top: 15px;">
                            <h6 style="color: #155724; font-weight: 600; margin-bottom: 10px;">
                                <i class="fas fa-sticky-note"></i> Keterangan:
                            </h6>
                            <p style="color: #155724; margin: 0; font-style: italic;">
                                "{{ $dailySalary->keterangan }}"
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="card" style="border: none; border-radius: 15px; background: #f8f9fa;">
                    <div class="card-body text-center" style="padding: 20px;">
                        <a href="{{ route('admin.gajikaryawan.index') }}" class="btn btn-secondary btn-block mb-2" style="border-radius: 10px;">
                            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                        </a>
                        <a href="{{ route('admin.gajikaryawan.cetak', ['bulan' => \Carbon\Carbon::parse($date)->month, 'tahun' => \Carbon\Carbon::parse($date)->year]) }}" 
                           class="btn btn-primary btn-block" style="border-radius: 10px;">
                            <i class="fas fa-print"></i> Cetak Slip Gaji
                        </a>
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
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}
</style>
@endsection
