@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700; font-size: 2rem;">
                    🌸 {{ __('Dashboard') }}
                </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="text-right">
                    <small style="color: #c44569; font-weight: 500;">
                        <i class="fas fa-calendar-alt" style="color: #ff6b9d;"></i>
                        {{ date('d F Y') }}
                    </small>
                </div>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Welcome Card -->
            <div class="col-lg-12 mb-4">
                <div class="card" style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 50%, #ff9ff3 100%); border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(255, 107, 157, 0.3);">
                    <div class="card-body" style="padding: 30px; position: relative; overflow: hidden;">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h2 style="color: rgb(109, 109, 109); font-weight: 700; margin-bottom: 10px; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                    👋 {{ __('Selamat Datang') }}, {{ auth()->user()->nama }}!
                                </h2>
                                <p style="color: rgba(66, 66, 66, 0.9); font-size: 1.1rem; margin-bottom: 0;">
                                    <i class="fas fa-sparkles"></i> Semoga hari Anda menyenangkan di sistem Anteraja!
                                </p>
                            </div>
                            <div class="col-md-4 text-right">
                                <div style="font-size: 4rem; color: rgba(255,255,255,0.2); animation: pulse 2s infinite;">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Decorative elements -->
                        <div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: rgba(255,255,255,0.1); border-radius: 50%; opacity: 0.5;"></div>
                        <div style="position: absolute; bottom: -30px; left: -30px; width: 80px; height: 80px; background: rgba(255,255,255,0.1); border-radius: 50%; opacity: 0.3;"></div>
                    </div>
                </div>
            </div>

            <!-- System Image Card -->
            <div class="col-lg-12">
                <div class="card" style="border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(255, 107, 157, 0.15); overflow: hidden;">
                    <div class="card-header text-center" style="background: linear-gradient(135deg, #ff9ff3 0%, #ffeef8 100%); border: none; padding: 25px;">
                        <h4 style="color: #5A5859FF; font-weight: 700; margin: 0;">
                            <i class="fas fa-image" style="color: #4E4D4EFF;"></i> 
                            Sistem Anteraja - Payroll Kurir
                        </h4>
                        <p style="color: #504F50FF; margin: 0; font-weight: 500;">Sistem Informasi Penggajian Mitra Kurir Professional</p>
                    </div>
                    <div class="card-body text-center" style="padding: 40px; background: linear-gradient(135deg, #ffeef8 0%, #ffffff 100%);">
                        <div style="position: relative; display: inline-block; max-width: 100%;">
                            <img src="{{asset('images/image2.jpg')}}" 
                                 alt="Sistem Anteraja" 
                                 class="img-fluid"
                                 style="max-width: 100%; height: auto; border-radius: 15px; box-shadow: 0 15px 40px rgba(255, 107, 157, 0.25); transition: all 0.4s ease; border: 3px solid rgba(255, 107, 157, 0.2);" 
                                 onmouseover="this.style.transform='scale(1.02) translateY(-5px)'; this.style.boxShadow='0 25px 60px rgba(255, 107, 157, 0.35)'; this.style.borderColor='rgba(255, 107, 157, 0.4)'" 
                                 onmouseout="this.style.transform='scale(1) translateY(0)'; this.style.boxShadow='0 15px 40px rgba(255, 107, 157, 0.25)'; this.style.borderColor='rgba(255, 107, 157, 0.2)'">
                            
                            <!-- Decorative badges -->
                            <div style="position: absolute; top: 15px; right: 15px; background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); color: white; padding: 8px 15px; border-radius: 25px; font-size: 0.85rem; font-weight: 600; box-shadow: 0 4px 15px rgba(255, 107, 157, 0.3);">
                                <i class="fas fa-heart"></i> System
                            </div>
                            
                            <div style="position: absolute; top: 15px; left: 15px; background: rgba(255, 255, 255, 0.95); color: #c44569; padding: 8px 15px; border-radius: 25px; font-size: 0.82rem; font-weight: 600; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
                                <i class="fas fa-truck"></i> Anteraja
                            </div>
                            
                            <div style="position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%); background: rgba(196, 69, 105, 0.95); color: white; padding: 10px 20px; border-radius: 25px; font-size: 0.9rem; font-weight: 600; box-shadow: 0 4px 15px rgba(196, 69, 105, 0.4);">
                                <i class="fas fa-money-bill-wave"></i> Payroll System
                            </div>
                        </div>
                        
                        <div style="margin-top: 30px; padding: 20px; background: rgba(255, 159, 243, 0.1); border-radius: 15px; border-left: 4px solid #ff9ff3;">
                            <p style="color: #c44569; font-weight: 600; margin: 0; font-size: 1.1rem;">
                                <i class="fas fa-sparkles" style="color: #ff6b9d;"></i> 
                                Sistem manajemen penggajian kurir yang modern, aman, dan user-friendly!
                            </p>
                            <div style="margin-top: 15px;">
                                <span style="display: inline-block; background: linear-gradient(135deg, #ff9ff3 0%, #ffeef8 100%); color: #c44569; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 500; margin: 0 5px 5px 0;">
                                    <i class="fas fa-users"></i> Kelola Karyawan
                                </span>
                                <span style="display: inline-block; background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); color: white; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 500; margin: 0 5px 5px 0;">
                                    <i class="fas fa-coins"></i> Laporan Gaji
                                </span>
                                <span style="display: inline-block; background: linear-gradient(135deg, #c44569 0%, #ff9ff3 100%); color: white; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 500; margin: 0 5px 5px 0;">
                                    <i class="fas fa-chart-line"></i> Analytics
                                </span>
                                <span style="display: inline-block; background: linear-gradient(135deg, #ffeef8 0%, #ff9ff3 100%); color: #c44569; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 500; margin: 0 5px 5px 0;">
                                    <i class="fas fa-shield-alt"></i> Keamanan
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes pulse {
    0% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.05); opacity: 0.8; }
    100% { transform: scale(1); opacity: 1; }
}

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

.card:hover {
    transform: translateY(-2px);
    transition: transform 0.3s ease;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .card-body {
        padding: 20px !important;
    }
    
    h1 {
        font-size: 1.5rem !important;
    }
    
    h2 {
        font-size: 1.3rem !important;
    }
    
    .img-fluid {
        max-width: 100% !important;
        height: auto !important;
    }
}
</style>
<!-- /.content -->
@endsection
