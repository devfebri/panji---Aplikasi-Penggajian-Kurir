@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700; font-size: 2rem;">
                    📈 {{ __('Laporan Bulanan Gaji Kurir') }}
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.laporan.index') }}">Laporan</a></li>
                    <li class="breadcrumb-item active">Laporan Bulanan</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: rgb(61, 60, 60); box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);">
                    <div class="card-body text-center" style="padding: 25px;">
                        <div style="font-size: 3rem; margin-bottom: 10px;">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 style="font-weight: 700; margin: 0;">{{ $totalKurir }}</h3>
                        <p style="margin: 5px 0 0 0; opacity: 0.9;">Total Kurir Aktif</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: rgb(61, 60, 60); box-shadow: 0 8px 25px rgba(240, 147, 251, 0.3);">

                    <div class="card-body text-center" style="padding: 25px;">
                        <div style="font-size: 3rem; margin-bottom: 10px;">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h3 style="font-weight: 700; margin: 0;">Rp {{ number_format($totalGaji, 0, ',', '.') }}</h3>
                        <p style="margin: 5px 0 0 0; opacity: 0.9;">Total Gaji</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: rgb(61, 60, 60); box-shadow: 0 8px 25px rgba(79, 172, 254, 0.3);">

                    <div class="card-body text-center" style="padding: 25px;">
                        <div style="font-size: 3rem; margin-bottom: 10px;">
                            <i class="fas fa-box"></i>
                        </div>
                        <h3 style="font-weight: 700; margin: 0;">{{ $totalPikup }}</h3>
                        <p style="margin: 5px 0 0 0; opacity: 0.9;">Total Paket Pickup</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: rgb(61, 60, 60); box-shadow: 0 8px 25px rgba(67, 233, 123, 0.3);">

                    <div class="card-body text-center" style="padding: 25px;">
                        <div style="font-size: 3rem; margin-bottom: 10px;">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h3 style="font-weight: 700; margin: 0;">{{ $totalPud }}</h3>
                        <p style="margin: 5px 0 0 0; opacity: 0.9;">Total Paket PUD</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Report Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%); border-left: 5px solid #2196f3;">
                    <div class="card-body text-center" style="padding: 25px;">
                        <h3 style="color: #1976d2; font-weight: 700; margin: 0;">
                            <i class="fas fa-calendar-alt"></i> 
                            Laporan Gaji Kurir - {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}
                        </h3>
                        <p style="color: #2196f3; margin: 10px 0 0 0;">
                            Ringkasan lengkap gaji semua kurir untuk periode yang dipilih
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary mr-2" style="border-radius: 25px; padding: 10px 25px;">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button onclick="window.print()" class="btn btn-primary mr-2" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 25px; padding: 10px 25px;">
                    <i class="fas fa-print"></i> Cetak Laporan
                </button>
                {{-- <button onclick="exportToPdf()" class="btn btn-success" style="border-radius: 25px; padding: 10px 25px;">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </button> --}}
            </div>
        </div>

        <!-- Data Table -->
        <div class="row">
            <div class="col-12">
                <div class="card" style="border: none; border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 15px 15px 0 0; color: rgb(90, 89, 89); padding: 20px;">
                        <h4 style="margin: 0; font-weight: 600;">
                            <i class="fas fa-table"></i> Detail Gaji Kurir
                        </h4>
                    </div>
                    <div class="card-body" style="padding: 25px;">
                        @if($kurirData->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="reportTable">
                                <thead style="background: #f8f9fa;">
                                    <tr>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px;">No</th>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px;">Tanggal</th>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px;">Nama Kurir</th>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px;">Pickup</th>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px;">PUD</th>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px;">Total Gaji</th>
                                        <th style="font-weight: 600; color: #495057; border: none; padding: 15px;">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kurirData as $index => $data)
                                    <tr style="border-bottom: 1px solid #e9ecef;">
                                        <td style="padding: 15px; vertical-align: middle;">{{ $index + 1 }}</td>
                                        <td style="padding: 15px; vertical-align: middle;">
                                            {{ \Carbon\Carbon::parse($data->tanggal_kerja)->format('d M Y') }}
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle;">
                                            <strong>{{ $data->kurir->nama ?? $data->kurir->email }}</strong>
                                            @if($data->kurir->nohp)
                                            <br><small class="text-muted">{{ $data->kurir->nohp }}</small>
                                            @endif
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle;">
                                            <span class="badge badge-info" style="font-size: 0.9rem; padding: 8px 12px;">
                                                {{ $data->pikup }} paket
                                            </span>
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle;">
                                            <span class="badge badge-warning" style="font-size: 0.9rem; padding: 8px 12px;">
                                                {{ $data->pud }} paket
                                            </span>
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle;">
                                            <strong style="color: #28a745; font-size: 1.1rem;">
                                                Rp {{ number_format($data->total, 0, ',', '.') }}
                                            </strong>
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle;">
                                            @if($data->keterangan)
                                                <span class="text-muted">{{ $data->keterangan }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot style="background: #f8f9fa; font-weight: 600;">
                                    <tr>
                                        <td colspan="3" style="padding: 15px; text-align: right; font-size: 1.1rem;">
                                            <strong>TOTAL:</strong>
                                        </td>
                                        <td style="padding: 15px;">
                                            <strong style="color: #007bff;">{{ $totalPikup }} paket</strong>
                                        </td>
                                        <td style="padding: 15px;">
                                            <strong style="color: #ffc107;">{{ $totalPud }} paket</strong>
                                        </td>
                                        <td style="padding: 15px;">
                                            <strong style="color: #28a745; font-size: 1.2rem;">
                                                Rp {{ number_format($totalGaji, 0, ',', '.') }}
                                            </strong>
                                        </td>
                                        <td style="padding: 15px;"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        @else
                        <div class="text-center" style="padding: 50px 20px;">
                            <div style="font-size: 4rem; color: #dee2e6; margin-bottom: 20px;">
                                <i class="fas fa-inbox"></i>
                            </div>
                            <h5 style="color: #6c757d; margin-bottom: 10px;">Tidak Ada Data</h5>
                            <p style="color: #adb5bd;">
                                Belum ada data gaji kurir untuk bulan {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}.
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Current Gaji Settings -->
        @if($gajiSettings)
        <div class="row mt-4">
            <div class="col-12">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #e8f5e8 0%, #f0f8ff 100%); border-left: 5px solid #28a745;">
                    <div class="card-body" style="padding: 25px;">
                        <h5 style="color: #155724; font-weight: 700; margin-bottom: 20px;">
                            <i class="fas fa-cog"></i> Pengaturan Gaji (Referensi Perhitungan)
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

@media print {
    .btn, .breadcrumb, .card-header {
        display: none !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>

<script>
function exportToPdf() {
    // Simple implementation - you can enhance this with actual PDF library
    alert('Fitur export PDF akan segera hadir!');
    
    // For now, just trigger print
    window.print();
}

// Add search functionality if needed
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('reportTable');
    if (table) {
        // You can add DataTables or similar functionality here
        console.log('Report table loaded with ' + table.rows.length + ' rows');
    }
});
</script>
@endsection
