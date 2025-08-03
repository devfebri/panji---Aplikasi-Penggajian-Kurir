@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700; font-size: 2rem;">
                    👁️ {{ __('Detail Data Gaji') }}
                </h1>
            </div>
            <div class="col-sm-6">
                <div class="text-right">
                    <a href="{{ route('admin.gaji.index') }}" class="btn" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%); color: white; border: none; border-radius: 10px; font-weight: 600; box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3); text-decoration: none; padding: 10px 20px; margin-right: 8px;">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('admin.gaji.edit', $gaji->id) }}" class="btn" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%); color: white; border: none; border-radius: 10px; font-weight: 600; box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3); text-decoration: none; padding: 10px 20px;">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Main Info Card -->
                <div class="card" style="border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(255, 107, 157, 0.15); margin-bottom: 30px;">
                    <div class="card-header text-center" style="background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%); border: none; border-radius: 20px 20px 0 0; padding: 30px;">
                        <h3 class="card-title" style="color: white; font-weight: 700; margin: 0; font-size: 1.6rem; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                            <i class="fas fa-money-bill-wave"></i> 
                            Detail Data Gaji ID: #{{ $gaji->id }}
                        </h3>
                        <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0 0; font-size: 1rem;">
                            Informasi lengkap data gaji kurir Anteraja
                        </p>
                    </div>
                    <div class="card-body" style="padding: 40px; background: linear-gradient(135deg, #e0f7fa 0%, #ffffff 100%);">
                        <!-- Gaji Details -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div style="background: linear-gradient(135deg, #ff9ff3 0%, #ffeef8 100%); border-radius: 15px; padding: 25px; border-left: 5px solid #ff6b9d; height: 100%;">
                                    <div style="display: flex; align-items: center; margin-bottom: 15px;">
                                        <div style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); color: white; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; box-shadow: 0 4px 15px rgba(255, 107, 157, 0.3);">
                                            <i class="fas fa-box" style="font-size: 1.2rem;"></i>
                                        </div>
                                        <div>
                                            <h5 style="color: #c44569; font-weight: 700; margin: 0;">Paket Bawaan</h5>
                                            <small style="color: #ff6b9d; font-weight: 500;">Per paket delivery</small>
                                        </div>
                                    </div>
                                    <h3 style="color: #c44569; font-weight: 700; margin: 0; font-size: 1.8rem;">
                                        {{ $gaji->formatted_paket_bawaan }}
                                    </h3>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <div style="background: linear-gradient(135deg, #ff6b9d 0%, #ffc1e3 100%); border-radius: 15px; padding: 25px; border-left: 5px solid #c44569; height: 100%;">
                                    <div style="display: flex; align-items: center; margin-bottom: 15px;">
                                        <div style="background: linear-gradient(135deg, #c44569 0%, #ff6b9d 100%); color: white; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; box-shadow: 0 4px 15px rgba(196, 69, 105, 0.3);">
                                            <i class="fas fa-truck" style="font-size: 1.2rem;"></i>
                                        </div>
                                        <div>
                                            <h5 style="color: white; font-weight: 700; margin: 0; text-shadow: 0 1px 3px rgba(0,0,0,0.2);">Paket Jemputan</h5>
                                            <small style="color: rgba(255,255,255,0.9); font-weight: 500;">Per paket pickup</small>
                                        </div>
                                    </div>
                                    <h3 style="color: white; font-weight: 700; margin: 0; font-size: 1.8rem; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                        {{ $gaji->formatted_paket_jemputan }}
                                    </h3>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <div style="background: linear-gradient(135deg, #c44569 0%, #8e3b5a 100%); border-radius: 15px; padding: 25px; border-left: 5px solid #dc3545; height: 100%;">
                                    <div style="display: flex; align-items: center; margin-bottom: 15px;">
                                        <div style="background: linear-gradient(135deg, #dc3545 0%, #e91e63 100%); color: white; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);">
                                            <i class="fas fa-heart-broken" style="font-size: 1.2rem;"></i>
                                        </div>
                                        <div>
                                            <h5 style="color: white; font-weight: 700; margin: 0; text-shadow: 0 1px 3px rgba(0,0,0,0.2);">Potongan BPJS</h5>
                                            <small style="color: rgba(255,255,255,0.9); font-weight: 500;">Deduksi kesehatan</small>
                                        </div>
                                    </div>
                                    <h3 style="color: white; font-weight: 700; margin: 0; font-size: 1.8rem; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                        {{ $gaji->formatted_potongan_bpjs }}
                                    </h3>
                                </div>
                            </div>
                              
                        </div>
                    </div>
                </div>

                <!-- Calculation Breakdown -->
                <div class="card" style="border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(255, 107, 157, 0.15); margin-bottom: 30px;">
                    <div class="card-header" style="background: linear-gradient(135deg, #ff9ff3 0%, #ffeef8 100%); border: none; border-radius: 20px 20px 0 0; padding: 25px;">
                        <h4 style="color: #c44569; font-weight: 700; margin: 0;">
                            <i class="fas fa-calculator"></i> Rincian Perhitungan
                        </h4>
                    </div>
                    <div class="card-body" style="padding: 30px; background: rgba(255, 255, 255, 0.9);">
                        <div class="calculation-steps">
                            <div class="step" style="display: flex; align-items: center; padding: 15px; margin-bottom: 15px; background: rgba(255, 159, 243, 0.1); border-radius: 10px; border-left: 4px solid #ff9ff3;">
                                <div style="background: #ff9ff3; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-weight: 700;">1</div>
                                <div style="flex: 1;">
                                    <span style="color: #c44569; font-weight: 600;">Paket Bawaan:</span>
                                    <span style="color: #ff6b9d; font-weight: 700; margin-left: 10px;">Total Paket x {{ $gaji->formatted_paket_bawaan }}</span>
                                </div>
                            </div>
                            
                            <div class="step" style="display: flex; align-items: center; padding: 15px; margin-bottom: 15px; background: rgba(255, 107, 157, 0.1); border-radius: 10px; border-left: 4px solid #ff6b9d;">
                                <div style="background: #ff6b9d; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-weight: 700;">2</div>
                                <div style="flex: 1;">
                                    <span style="color: #c44569; font-weight: 600;">Paket Jemputan:</span>
                                    <span style="color: #ff6b9d; font-weight: 700; margin-left: 10px;">Total Paket x {{ $gaji->formatted_paket_jemputan }}</span>

                                </div>
                            </div>
                            
                            <div class="step" style="display: flex; align-items: center; padding: 15px; margin-bottom: 15px; background: rgba(196, 69, 105, 0.1); border-radius: 10px; border-left: 4px solid #c44569;">
                                <div style="background: #c44569; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-weight: 700;">3</div>
                                <div style="flex: 1;">
                                    <span style="color: #c44569; font-weight: 600;">Dikurangi Potongan BPJS:</span>
                                    <span style="color: #dc3545; font-weight: 700; margin-left: 10px;">- {{ $gaji->formatted_potongan_bpjs }}</span>
                                </div>
                            </div>
                              
                        </div>
                    </div>
                </div>

                <!-- Meta Information -->
                <div class="card" style="border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(255, 107, 157, 0.15);">
                    <div class="card-header" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%); border: none; border-radius: 20px 20px 0 0; padding: 25px;">
                        <h4 style="color: white; font-weight: 700; margin: 0;">
                            <i class="fas fa-info-circle"></i> Informasi Sistem
                        </h4>
                    </div>
                    <div class="card-body" style="padding: 30px; background: rgba(248, 249, 250, 0.9);">
                        <div class="row">
                            <div class="col-md-6">
                                <p style="color: #6c757d; margin: 10px 0; font-weight: 500;">
                                    <i class="fas fa-calendar-plus" style="color: #28a745; margin-right: 8px;"></i>
                                    <strong>Dibuat:</strong> {{ $gaji->created_at->format('d F Y, H:i') }} WIB
                                </p>
                                <p style="color: #6c757d; margin: 10px 0; font-weight: 500;">
                                    <i class="fas fa-calendar-edit" style="color: #ffc107; margin-right: 8px;"></i>
                                    <strong>Diperbarui:</strong> {{ $gaji->updated_at->format('d F Y, H:i') }} WIB
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p style="color: #6c757d; margin: 10px 0; font-weight: 500;">
                                    <i class="fas fa-hashtag" style="color: #17a2b8; margin-right: 8px;"></i>
                                    <strong>ID Data:</strong> #{{ $gaji->id }}
                                </p>
                                <p style="color: #6c757d; margin: 10px 0; font-weight: 500;">
                                    <i class="fas fa-building" style="color: #ff6b9d; margin-right: 8px;"></i>
                                    <strong>Sistem:</strong> Anteraja Payroll
                                </p>
                            </div>
                        </div>
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

.calculation-steps .step:hover {
    transform: translateX(5px);
    transition: transform 0.3s ease;
}
</style>
@endsection
