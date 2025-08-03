@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <h1 class="m-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700; font-size: 2rem; text-align: center;">
                    📊 {{ __('Laporan Gaji & Analisis') }}
                </h1>
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
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: rgb(95, 94, 94); box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);">
                    <div class="card-body text-center" style="padding: 25px;">
                        <div style="font-size: 3rem; margin-bottom: 10px;">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 style="font-weight: 700; margin: 0;">{{ $totalKurir }}</h3>
                        <p style="margin: 5px 0 0 0; opacity: 0.9;">Total Kurir</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: color: rgb(95, 94, 94); box-shadow: 0 8px 25px rgba(240, 147, 251, 0.3);">
                    <div class="card-body text-center" style="padding: 25px;">
                        <div style="font-size: 3rem; margin-bottom: 10px;">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <h3 style="font-weight: 700; margin: 0;">{{ $todayGajiKurir }}</h3>
                        <p style="margin: 5px 0 0 0; opacity: 0.9;">Gaji Hari Ini</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: color: rgb(95, 94, 94); box-shadow: 0 8px 25px rgba(79, 172, 254, 0.3);">
                    <div class="card-body text-center" style="padding: 25px;">
                        <div style="font-size: 3rem; margin-bottom: 10px;">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3 style="font-weight: 700; margin: 0;">{{ $thisMonthGajiKurir }}</h3>
                        <p style="margin: 5px 0 0 0; opacity: 0.9;">Bulan Ini</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: color: rgb(95, 94, 94); box-shadow: 0 8px 25px rgba(67, 233, 123, 0.3);">
                    <div class="card-body text-center" style="padding: 25px;">
                        <div style="font-size: 3rem; margin-bottom: 10px;">
                            <i class="fas fa-cog"></i>
                        </div>
                        <h3 style="font-weight: 700; margin: 0;">{{ $gajiSettings ? 'Aktif' : 'Belum' }}</h3>
                        <p style="margin: 5px 0 0 0; opacity: 0.9;">Pengaturan Gaji</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Report Forms -->
        <div class="row">
            <!-- Individual Report -->
            <div class="col-lg-6">
                <div class="card" style="border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(102, 126, 234, 0.1);">
                    <div class="card-header text-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 20px 20px 0 0; padding: 25px;">
                        <h4 style="color: color: rgb(95, 94, 94); font-weight: 700; margin: 0;">
                            <i class="fas fa-user-tie"></i> Laporan Gaji Individual
                        </h4>
                        <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0 0;">
                            Cetak slip gaji karyawan per bulan
                        </p>
                    </div>
                    <div class="card-body" style="padding: 30px;">
                        <form action="{{ route('admin.laporan.store') }}" method="post">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="karyawan_id" style=" color: #333;">
                                    <i class="fas fa-user"></i> Nama Karyawan
                                </label>
                                <select class="form-control @error('karyawan_id') is-invalid @enderror" 
                                        name="karyawan_id" 
                                        id="karyawan_id"
                                        style="border: 2px solid #e3ebf6; border-radius: 10px; ">
                                    <option value="">-- Pilih Karyawan --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('karyawan_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('karyawan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="bulan" style="font-weight: 600; color: #333;">
                                            <i class="fas fa-calendar"></i> Bulan
                                        </label>
                                        <select class="form-control @error('bulan') is-invalid @enderror" 
                                                name="bulan" 
                                                id="bulan"
                                                style="border: 2px solid #e3ebf6; border-radius: 10px; ">
                                            <option value="">-- Pilih Bulan --</option>
                                            @for($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ old('bulan', date('n')) == $i ? 'selected' : '' }}>
                                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                            </option>
                                            @endfor
                                        </select>
                                        @error('bulan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="tahun" style="font-weight: 600; color: #333;">
                                            <i class="fas fa-calendar-alt"></i> Tahun
                                        </label>
                                        <select class="form-control @error('tahun') is-invalid @enderror" 
                                                name="tahun" 
                                                id="tahun"
                                                style="border: 2px solid #e3ebf6; border-radius: 10px; ">
                                            <option value="">-- Pilih Tahun --</option>
                                            @for($i = date('Y'); $i >= date('Y')-5; $i--)
                                            <option value="{{ $i }}" {{ old('tahun', date('Y')) == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                            @endfor
                                        </select>
                                        @error('tahun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: color: rgb(95, 94, 94); border: none; border-radius: 25px; padding: 12px 30px; font-weight: 600; transition: all 0.3s ease;">
                                    <i class="fas fa-print"></i> Cetak Laporan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Monthly Summary Report -->
            <div class="col-lg-6">
                <div class="card" style="border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(240, 147, 251, 0.1);">
                    <div class="card-header text-center" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border: none; border-radius: 20px 20px 0 0; ">
                        <h4 style="color: color: rgb(95, 94, 94); font-weight: 700; margin: 0;">
                            <i class="fas fa-chart-bar"></i> Laporan Bulanan
                        </h4>
                        <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0 0;">
                            Ringkasan gaji kurir per bulan
                        </p>
                    </div>
                    <div class="card-body" style="padding: 30px;">
                        <form action="{{ route('admin.laporan.monthly') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="bulan_monthly" style="font-weight: 600; color: #333;">
                                            <i class="fas fa-calendar"></i> Bulan
                                        </label>
                                        <select class="form-control" 
                                                name="bulan" 
                                                id="bulan_monthly"
                                                style="border: 2px solid #f1d4e5; border-radius: 10px;">
                                            <option value="">-- Pilih Bulan --</option>
                                            @for($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ date('n') == $i ? 'selected' : '' }}>
                                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                            </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="tahun_monthly" style="font-weight: 600; color: #333;">
                                            <i class="fas fa-calendar-alt"></i> Tahun
                                        </label>
                                        <select class="form-control" 
                                                name="tahun" 
                                                id="tahun_monthly"
                                                style="border: 2px solid #f1d4e5; border-radius: 10px; ">
                                            <option value="">-- Pilih Tahun --</option>
                                            @for($i = date('Y'); $i >= date('Y')-5; $i--)
                                            <option value="{{ $i }}" {{ date('Y') == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: color: rgb(95, 94, 94); border: none; border-radius: 25px; padding: 12px 30px; font-weight: 600; transition: all 0.3s ease;">
                                    <i class="fas fa-chart-line"></i> Lihat Ringkasan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Current Gaji Settings Info -->
        @if($gajiSettings)
        <div class="row mt-4">
            <div class="col-12">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%); border-left: 5px solid #2196f3;">
                    <div class="card-body" style="padding: 25px;">
                        <h5 style="color: #1976d2; font-weight: 700; margin-bottom: 20px;">
                            <i class="fas fa-info-circle"></i> Pengaturan Gaji Saat Ini
                        </h5>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <div style="font-size: 2rem; color: #2196f3; margin-bottom: 10px;">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <h4 style="color: #1976d2; font-weight: 700;">{{ $gajiSettings->formatted_paket_bawaan }}</h4>
                                    <p style="color: #2196f3; margin: 0;">Paket Bawaan</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <div style="font-size: 2rem; color: #2196f3; margin-bottom: 10px;">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                    <h4 style="color: #1976d2; font-weight: 700;">{{ $gajiSettings->formatted_paket_jemputan }}</h4>
                                    <p style="color: #2196f3; margin: 0;">Paket Jemputan</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <div style="font-size: 2rem; color: #2196f3; margin-bottom: 10px;">
                                        <i class="fas fa-heart-broken"></i>
                                    </div>
                                    <h4 style="color: #1976d2; font-weight: 700;">{{ $gajiSettings->formatted_potongan_bpjs }}</h4>
                                    <p style="color: #2196f3; margin: 0;">Potongan BPJS</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <div style="font-size: 2rem; color: #2196f3; margin-bottom: 10px;">
                                        <i class="fas fa-calculator"></i>
                                    </div>
                                    <h4 style="color: #1976d2; font-weight: 700;">{{ $gajiSettings->formatted_total_gaji }}</h4>
                                    <p style="color: #2196f3; margin: 0;">Total Per Paket</p>
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
</style>
@endsection