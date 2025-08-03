@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700; font-size: 2rem;">
                    ➕ {{ __('Tambah Data Gaji Kurir') }}
                </h1>
            </div>
            <div class="col-sm-6">
                <div class="text-right">
                    <a href="{{ route('admin.gajiKurir.index') }}" class="btn" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%); color: white; border: none; border-radius: 10px; font-weight: 600; box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3); text-decoration: none; padding: 10px 20px;">
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
                    <div class="card-header text-center" style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); border: none; border-radius: 20px 20px 0 0; padding: 30px;">
                        <h3 class="card-title" style="color: white; font-weight: 700; margin: 0; font-size: 1.5rem;">
                            <i class="fas fa-truck"></i> 
                            Form Tambah Data Gaji Kurir
                        </h3>
                        <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0 0; font-size: 1rem;">
                            Isi form di bawah untuk menambahkan data gaji kurir baru
                        </p>
                    </div>
                    <div class="card-body" style="padding: 40px; background: linear-gradient(135deg, #ffeef8 0%, #ffffff 100%);">
                        <!-- Current Gaji Settings Info -->
                        <div class="alert" style="background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%); border: none; border-radius: 15px; padding: 20px; margin-bottom: 30px; border-left: 4px solid #2196f3;">
                            <h5 style="color: #1976d2; font-weight: 700; margin-bottom: 15px;">
                                <i class="fas fa-info-circle"></i> Pengaturan Gaji Saat Ini
                            </h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <p style="color: #1976d2; margin: 5px 0; font-weight: 500;">
                                        <i class="fas fa-box"></i> Paket Bawaan: 
                                        <br><span style="font-weight: 700; font-size: 1.1rem;">{{ $gajiSettings->formatted_paket_bawaan }}</span>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p style="color: #1976d2; margin: 5px 0; font-weight: 500;">
                                        <i class="fas fa-truck"></i> Paket Jemputan: 
                                        <br><span style="font-weight: 700; font-size: 1.1rem;">{{ $gajiSettings->formatted_paket_jemputan }}</span>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p style="color: #1976d2; margin: 5px 0; font-weight: 500;">
                                        <i class="fas fa-heart-broken"></i> Potongan BPJS: 
                                        <br><span style="font-weight: 700; font-size: 1.1rem;">{{ $gajiSettings->formatted_potongan_bpjs }}</span>
                                    </p>
                                </div>
                            </div>                            <div class="text-center mt-3">
                                <small style="color: #1976d2; font-style: italic;">
                                    <i class="fas fa-lightbulb"></i> Total gaji akan dihitung otomatis berdasarkan pengaturan di atas
                                </small>
                            </div>
                        </div>                        <!-- Important Notice -->
                        <div class="alert" style="background: linear-gradient(135deg, #fff3e0 0%, #ffeef8 100%); border: none; border-radius: 15px; padding: 20px; margin-bottom: 30px; border-left: 4px solid #ff9800;">
                            <h5 style="color: #f57c00; font-weight: 700; margin-bottom: 15px;">
                                <i class="fas fa-exclamation-triangle"></i> Aturan Input Data
                            </h5>
                            <p style="color: #f57c00; margin: 0; font-weight: 500;">
                                <i class="fas fa-info-circle"></i> Data gaji kurir <strong>hanya bisa diinput untuk hari ini ({{ date('d M Y') }})</strong>. 
                                Setiap kurir hanya dapat memiliki satu data gaji per hari.
                            </p>
                            <small style="color: #e65100; font-style: italic; display: block; margin-top: 8px;">
                                💡 Tips: Pastikan pilih kurir yang belum memiliki data untuk hari ini.
                            </small>
                        </div>

                        <form action="{{ route('admin.gajiKurir.store') }}" method="POST">
                            @csrf
                            
                            <!-- Kurir Selection -->
                            <div class="form-group mb-4">
                                <label for="kurir_id" style="color: #c44569; font-weight: 600; margin-bottom: 10px; font-size: 1rem;">
                                    <i class="fas fa-user" style="color: #ff6b9d; margin-right: 5px;"></i>
                                    Pilih Kurir
                                </label>                                
                                <select name="kurir_id" id="kurir_id" class="form-control @error('kurir_id') is-invalid @enderror" >
                                    <option value="">-- Pilih Kurir --</option>
                                    @foreach($kurirs as $kurir)
                                    <option value="{{ $kurir->id }}" {{ old('kurir_id') == $kurir->id ? 'selected' : '' }}>
                                        {{ $kurir->nama }}@if($kurir->nohp) - {{ $kurir->nohp }}@else - {{ $kurir->email }}@endif
                                    </option>
                                    @endforeach
                                </select>
                                @error('kurir_id')
                                <div class="invalid-feedback" style="color: #dc3545; font-weight: 500;">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                                @enderror
                            </div>                            <!-- Tanggal Kerja -->
                            <div class="form-group mb-4">
                                <label for="tanggal_kerja" style="color: #c44569; font-weight: 600; margin-bottom: 10px; font-size: 1rem;">
                                    <i class="fas fa-calendar-alt" style="color: #ff6b9d; margin-right: 5px;"></i>
                                    Tanggal Kerja (Hari Ini)
                                </label>
                                <input type="date" 
                                       name="tanggal_kerja" 
                                       id="tanggal_kerja" 
                                       class="form-control @error('tanggal_kerja') is-invalid @enderror" 
                                       value="{{ old('tanggal_kerja', date('Y-m-d')) }}"
                                       min="{{ date('Y-m-d') }}"
                                       max="{{ date('Y-m-d') }}"
                                       readonly
                                       style="border: 2px solid #f1c0e8; border-radius: 12px; padding: 15px 20px; font-size: 1rem; transition: all 0.3s ease; background: rgba(240, 248, 255, 0.9); cursor: not-allowed;"
                                       onfocus="this.style.borderColor='#2196f3'; this.style.boxShadow='0 0 0 0.2rem rgba(33, 150, 243, 0.25)'"
                                       onblur="this.style.borderColor='#f1c0e8'; this.style.boxShadow='none'">
                                <small style="color: #2196f3; font-weight: 500; margin-top: 5px; display: block;">
                                    <i class="fas fa-info-circle"></i> Input data gaji hanya untuk tanggal hari ini: {{ date('d M Y') }}
                                </small>
                                @error('tanggal_kerja')
                                <div class="invalid-feedback" style="color: #dc3545; font-weight: 500;">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Pickup -->
                            <div class="form-group mb-4">
                                <label for="pikup" style="color: #c44569; font-weight: 600; margin-bottom: 10px; font-size: 1rem;">
                                    <i class="fas fa-box" style="color: #ff6b9d; margin-right: 5px;"></i>
                                    Jumlah Pickup
                                </label>
                                <input type="number" 
                                       name="pikup" 
                                       id="pikup" 
                                       class="form-control @error('pikup') is-invalid @enderror" 
                                       value="{{ old('pikup') }}"
                                       placeholder="Masukkan jumlah pickup..."
                                       style="border: 2px solid #f1c0e8; border-radius: 12px; padding: 15px 20px; font-size: 1rem; transition: all 0.3s ease; background: rgba(255, 255, 255, 0.9);"
                                       onfocus="this.style.borderColor='#ff6b9d'; this.style.boxShadow='0 0 0 0.2rem rgba(255, 107, 157, 0.25)'; this.style.background='white'; this.style.transform='translateY(-1px)'"
                                       onblur="this.style.borderColor='#f1c0e8'; this.style.boxShadow='none'; this.style.background='rgba(255, 255, 255, 0.9)'; this.style.transform='translateY(0)'"
                                       min="0">
                                @error('pikup')
                                <div class="invalid-feedback" style="color: #dc3545; font-weight: 500;">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- PUD -->
                            <div class="form-group mb-4">
                                <label for="pud" style="color: #c44569; font-weight: 600; margin-bottom: 10px; font-size: 1rem;">
                                    <i class="fas fa-truck" style="color: #ff6b9d; margin-right: 5px;"></i>
                                    Jumlah PUD (Pickup Delivery)
                                </label>
                                <input type="number" 
                                       name="pud" 
                                       id="pud" 
                                       class="form-control @error('pud') is-invalid @enderror" 
                                       value="{{ old('pud') }}"
                                       placeholder="Masukkan jumlah PUD..."
                                       style="border: 2px solid #f1c0e8; border-radius: 12px; padding: 15px 20px; font-size: 1rem; transition: all 0.3s ease; background: rgba(255, 255, 255, 0.9);"
                                       onfocus="this.style.borderColor='#ff6b9d'; this.style.boxShadow='0 0 0 0.2rem rgba(255, 107, 157, 0.25)'; this.style.background='white'; this.style.transform='translateY(-1px)'"
                                       onblur="this.style.borderColor='#f1c0e8'; this.style.boxShadow='none'; this.style.background='rgba(255, 255, 255, 0.9)'; this.style.transform='translateY(0)'"
                                       min="0">
                                @error('pud')
                                <div class="invalid-feedback" style="color: #dc3545; font-weight: 500;">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Submit Buttons -->
                            <div class="text-center">
                                <button type="submit" class="btn" style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); color: white; border: none; border-radius: 25px; padding: 15px 40px; font-size: 1.1rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; transition: all 0.4s ease; margin-right: 10px; box-shadow: 0 8px 25px rgba(255, 107, 157, 0.35);" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 35px rgba(255, 107, 157, 0.45)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 25px rgba(255, 107, 157, 0.35)'">
                                    <i class="fas fa-save"></i> Simpan Data
                                </button>
                                <a href="{{ route('admin.gajiKurir.index') }}" class="btn" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%); color: white; border: none; border-radius: 25px; padding: 15px 40px; font-size: 1.1rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; transition: all 0.4s ease; text-decoration: none; box-shadow: 0 8px 25px rgba(108, 117, 125, 0.35);" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 35px rgba(108, 117, 125, 0.45)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 25px rgba(108, 117, 125, 0.35)'">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </form>                    </div>
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

<script>
// Function to check if kurir already has data for today
function checkKurirDataToday() {
    const kurirId = document.getElementById('kurir_id').value;
    
    if (kurirId) {
        // You can add AJAX call here to check existing data
        // For now, we'll just enable the form
        const submitBtn = document.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.style.opacity = '1';
            submitBtn.disabled = false;
        }
        
        // Show selected kurir info
        const selectedOption = document.querySelector(`#kurir_id option[value="${kurirId}"]`);
        if (selectedOption) {
            console.log('Selected kurir:', selectedOption.text);
        }
    }
}

// Add event listeners when page loads
document.addEventListener('DOMContentLoaded', function() {
    const kurirSelect = document.getElementById('kurir_id');
    const tanggalInput = document.getElementById('tanggal_kerja');
    
    if (kurirSelect) {
        kurirSelect.addEventListener('change', checkKurirDataToday);
    }
    
    // Auto-focus to kurir selection after page loads
    setTimeout(() => {
        if (kurirSelect) {
            kurirSelect.focus();
        }
    }, 500);
    
    // Log today's date for debugging
    console.log('Today\'s date:', '{{ date("Y-m-d") }}');
});
</script>
@endsection
