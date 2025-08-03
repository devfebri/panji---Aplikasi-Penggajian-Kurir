@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700; font-size: 2rem;">
                    ✏️ {{ __('Edit Data Gaji') }}
                </h1>
            </div>
            <div class="col-sm-6">
                <div class="text-right">
                    <a href="{{ route('admin.gaji.index') }}" class="btn" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%); color: white; border: none; border-radius: 10px; font-weight: 600; box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3); text-decoration: none; padding: 10px 20px;">
                        <i class="fas fa-arrow-left"></i> Kembali
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
                <div class="card" style="border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(255, 107, 157, 0.15);">
                    <div class="card-header text-center" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%); border: none; border-radius: 20px 20px 0 0; padding: 30px;">
                        <h3 class="card-title" style="color: white; font-weight: 700; margin: 0; font-size: 1.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                            <i class="fas fa-edit"></i> 
                            Form Edit Data Gaji Kurir
                        </h3>
                        <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0 0; font-size: 1rem;">
                            Perbarui data gaji ID: #{{ $gaji->id }}
                        </p>
                    </div>
                    <div class="card-body" style="padding: 40px; background: linear-gradient(135deg, #fff8e1 0%, #ffffff 100%);">
                        <form action="{{ route('admin.gaji.update', $gaji->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                         
                            
                            <!-- Paket Bawaan -->
                            <div class="form-group mb-4">
                                <label for="paket_bawaan" style="color: #c44569; font-weight: 600; margin-bottom: 10px; font-size: 1rem;">
                                    <i class="fas fa-box" style="color: #ff6b9d; margin-right: 5px;"></i>
                                    Paket Bawaan (Rp)
                                </label>
                                <input type="number" 
                                       name="paket_bawaan" 
                                       id="paket_bawaan" 
                                       class="form-control @error('paket_bawaan') is-invalid @enderror" 
                                       value="{{ old('paket_bawaan', $gaji->paket_bawaan) }}"
                                       placeholder="Masukkan nominal paket bawaan..."
                                       style="border: 2px solid #f1c0e8; border-radius: 12px; padding: 15px 20px; font-size: 1rem; transition: all 0.3s ease; background: rgba(255, 255, 255, 0.9);"
                                       onfocus="this.style.borderColor='#ff6b9d'; this.style.boxShadow='0 0 0 0.2rem rgba(255, 107, 157, 0.25)'; this.style.background='white'; this.style.transform='translateY(-1px)'"
                                       onblur="this.style.borderColor='#f1c0e8'; this.style.boxShadow='none'; this.style.background='rgba(255, 255, 255, 0.9)'; this.style.transform='translateY(0)'"
                                       step="1000"
                                       min="0">
                                @error('paket_bawaan')
                                <div class="invalid-feedback" style="color: #dc3545; font-weight: 500;">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Paket Jemputan -->
                            <div class="form-group mb-4">
                                <label for="paket_jemputan" style="color: #c44569; font-weight: 600; margin-bottom: 10px; font-size: 1rem;">
                                    <i class="fas fa-truck" style="color: #ff6b9d; margin-right: 5px;"></i>
                                    Paket Jemputan (Rp)
                                </label>
                                <input type="number" 
                                       name="paket_jemputan" 
                                       id="paket_jemputan" 
                                       class="form-control @error('paket_jemputan') is-invalid @enderror" 
                                       value="{{ old('paket_jemputan', $gaji->paket_jemputan) }}"
                                       placeholder="Masukkan nominal paket jemputan..."
                                       style="border: 2px solid #f1c0e8; border-radius: 12px; padding: 15px 20px; font-size: 1rem; transition: all 0.3s ease; background: rgba(255, 255, 255, 0.9);"
                                       onfocus="this.style.borderColor='#ff6b9d'; this.style.boxShadow='0 0 0 0.2rem rgba(255, 107, 157, 0.25)'; this.style.background='white'; this.style.transform='translateY(-1px)'"
                                       onblur="this.style.borderColor='#f1c0e8'; this.style.boxShadow='none'; this.style.background='rgba(255, 255, 255, 0.9)'; this.style.transform='translateY(0)'"
                                       step="1000"
                                       min="0">
                                @error('paket_jemputan')
                                <div class="invalid-feedback" style="color: #dc3545; font-weight: 500;">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Potongan BPJS -->
                            <div class="form-group mb-4">
                                <label for="potongan_bpjs" style="color: #c44569; font-weight: 600; margin-bottom: 10px; font-size: 1rem;">
                                    <i class="fas fa-heart-broken" style="color: #ff6b9d; margin-right: 5px;"></i>
                                    Potongan BPJS (Rp)
                                </label>
                                <input type="number" 
                                       name="potongan_bpjs" 
                                       id="potongan_bpjs" 
                                       class="form-control @error('potongan_bpjs') is-invalid @enderror" 
                                       value="{{ old('potongan_bpjs', $gaji->potongan_bpjs) }}"
                                       placeholder="Masukkan nominal potongan BPJS..."
                                       style="border: 2px solid #f1c0e8; border-radius: 12px; padding: 15px 20px; font-size: 1rem; transition: all 0.3s ease; background: rgba(255, 255, 255, 0.9);"
                                       onfocus="this.style.borderColor='#ff6b9d'; this.style.boxShadow='0 0 0 0.2rem rgba(255, 107, 157, 0.25)'; this.style.background='white'; this.style.transform='translateY(-1px)'"
                                       onblur="this.style.borderColor='#f1c0e8'; this.style.boxShadow='none'; this.style.background='rgba(255, 255, 255, 0.9)'; this.style.transform='translateY(0)'"
                                       step="1000"
                                       min="0">
                                @error('potongan_bpjs')
                                <div class="invalid-feedback" style="color: #dc3545; font-weight: 500;">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                                @enderror
                            </div>

                         

                            <!-- Submit Buttons -->
                            <div class="text-center">
                                <button type="submit" class="btn" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%); color: white; border: none; border-radius: 25px; padding: 15px 40px; font-size: 1.1rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; transition: all 0.4s ease; margin-right: 10px; box-shadow: 0 8px 25px rgba(255, 193, 7, 0.35);" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 35px rgba(255, 193, 7, 0.45)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 25px rgba(255, 193, 7, 0.35)'">
                                    <i class="fas fa-save"></i> Update Data
                                </button>
                                <a href="{{ route('admin.gaji.index') }}" class="btn" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%); color: white; border: none; border-radius: 25px; padding: 15px 40px; font-size: 1.1rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; transition: all 0.4s ease; text-decoration: none; box-shadow: 0 8px 25px rgba(108, 117, 125, 0.35);" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 35px rgba(108, 117, 125, 0.45)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 25px rgba(108, 117, 125, 0.35)'">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </form>
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
</style>
@endsection
