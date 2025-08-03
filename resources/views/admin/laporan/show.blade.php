@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <h1 class="m-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700; font-size: 2rem; text-align: center;">
                    👤 {{ __('Cek Gaji Karyawan') }}
                </h1>
                <p class="text-center text-muted mt-2">
                    Lihat dan cetak slip gaji Anda sendiri dengan mudah
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <!-- Info Alert -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-10">
                <div class="alert alert-info" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%); border-left: 5px solid #2196f3;">
                    <div class="d-flex align-items-center">
                        <div style="font-size: 2rem; color: #2196f3; margin-right: 15px;">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div>
                            <h5 style="color: #1976d2; font-weight: 600; margin: 0;">Selamat datang, {{ auth()->user()->nama ?? auth()->user()->email }}!</h5>
                            <p style="color: #2196f3; margin: 5px 0 0 0;">
                                Anda dapat melihat dan mencetak slip gaji Anda sendiri. Pilih periode bulan dan tahun yang diinginkan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card" style="border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(102, 126, 234, 0.1);">
                    <div class="card-header text-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 20px 20px 0 0; padding: 25px;">
                        <h4 style="color: white; font-weight: 700; margin: 0;">
                            <i class="fas fa-calendar-check"></i> Pilih Periode Gaji
                        </h4>
                        <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0 0;">
                            Masukkan bulan dan tahun untuk melihat slip gaji Anda
                        </p>
                    </div>
                    <div class="card-body" style="padding: 40px;">
                        <!-- Display Validation Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger" style="border-radius: 10px; margin-bottom: 25px;">
                                <h6><i class="fas fa-exclamation-triangle"></i> Terjadi Kesalahan:</h6>
                                <ul style="margin: 10px 0 0 0;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.laporan.karyawan') }}" method="post" id="salaryForm">
                            @csrf
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

                            <!-- Tips Section -->
                            <div class="alert alert-light" style="border: 1px solid #e9ecef; border-radius: 10px; margin-bottom: 25px;">
                                <h6 style="color: #495057; margin-bottom: 10px;">
                                    <i class="fas fa-lightbulb text-warning"></i> Tips:
                                </h6>
                                <ul style="margin: 0; color: #6c757d; font-size: 0.9rem;">
                                    <li>Pilih bulan dan tahun sesuai periode kerja Anda</li>
                                    <li>Slip gaji akan langsung dicetak setelah data ditemukan</li>
                                    <li>Jika tidak ada data, artinya belum ada pencatatan gaji untuk periode tersebut</li>
                                    <li>Hubungi HRD jika ada pertanyaan tentang gaji Anda</li>
                                </ul>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-lg" 
                                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 25px; padding: 15px 40px; font-weight: 600; transition: all 0.3s ease;"
                                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(102, 126, 234, 0.3)'"
                                        onmouseout="this.style.transform='translateY(0px)'; this.style.boxShadow='none'">
                                    <i class="fas fa-search"></i> Cek & Cetak Gaji
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity or Additional Info -->
        <div class="row justify-content-center mt-4">
            <div class="col-lg-8">
                <div class="card" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                    <div class="card-body text-center" style="padding: 25px;">
                        <h6 style="color: #495057; font-weight: 600; margin-bottom: 15px;">
                            <i class="fas fa-shield-alt"></i> Keamanan & Privasi
                        </h6>
                        <p style="color: #6c757d; margin: 0; font-size: 0.9rem;">
                            Data gaji Anda aman dan hanya dapat diakses oleh Anda sendiri. 
                            Sistem ini menggunakan autentikasi yang aman untuk melindungi informasi pribadi Anda.
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
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.alert {
    animation: fadeInUp 0.8s ease-out;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('salaryForm');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    form.addEventListener('submit', function(e) {
        // Show loading state
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
        submitBtn.disabled = true;
        
        // Re-enable after a delay (in case of errors)
        setTimeout(function() {
            submitBtn.innerHTML = '<i class="fas fa-search"></i> Cek & Cetak Gaji';
            submitBtn.disabled = false;
        }, 5000);
    });
    
    // Auto-focus on first select
    document.getElementById('bulan').focus();
});
</script>
@endsection