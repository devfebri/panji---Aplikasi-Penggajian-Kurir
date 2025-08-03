@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700; font-size: 2rem;">
                    🚚 {{ __('Data Gaji Kurir') }}
                </h1>
            </div>
            <div class="col-sm-6">
                <div class="text-right">
                    <a href="{{ route('admin.gajiKurir.create') }}" class="btn btn-primary" style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); border: none; border-radius: 10px; font-weight: 600; box-shadow: 0 4px 15px rgba(255, 107, 157, 0.3);">
                        <i class="fas fa-plus"></i> Tambah Data Gaji Kurir
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card" style="border: none; border-radius: 15px; box-shadow: 0 8px 25px rgba(255, 107, 157, 0.1);">
                    <div class="card-header" style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); border: none; border-radius: 15px 15px 0 0;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title" style="color: white; font-weight: 600; margin: 0;">
                                <i class="fas fa-truck"></i> Daftar Gaji Kurir
                            </h3>
                            <!-- Advanced Search Form -->
                            <form action="{{ route('admin.gajiKurir.index') }}" method="GET" class="d-flex align-items-center" style="flex: 1; max-width: 500px; margin-left: 20px;">
                                <div class="input-group mr-2">
                                    <input type="text" 
                                           name="search" 
                                           class="form-control" 
                                           placeholder="Cari nama kurir..." 
                                           value="{{ request('search') }}"
                                           style="border: 2px solid rgba(255,255,255,0.3); background: rgba(255,255,255,0.9); border-radius: 25px 0 0 25px; padding: 10px 15px;">
                                    <div class="input-group-append">
                                        <button class="btn" type="submit" style="background: rgba(255,255,255,0.9); border: 2px solid rgba(255,255,255,0.3); border-left: none; border-radius: 0 25px 25px 0; padding: 10px 15px;">
                                            <i class="fas fa-search" style="color: #c44569;"></i>
                                        </button>
                                    </div>
                                </div>
                                @if(request('search'))
                                <a href="{{ route('admin.gajiKurir.index') }}" class="btn btn-outline-light" style="border-radius: 25px; padding: 10px 15px; margin-right: 10px;" title="Clear Search">
                                    <i class="fas fa-times"></i>
                                </a>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 30px;">
                        <!-- Advanced Search Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card" style="background: linear-gradient(135deg, #f8f9ff 0%, #fff0f8 100%); border: 2px solid #ffeef8; border-radius: 15px; box-shadow: 0 4px 15px rgba(255, 107, 157, 0.05);">
                                    <div class="card-header" style="background: linear-gradient(135deg, #ff9ff3 0%, #ffeef8 20%); border: none; border-radius: 13px 13px 0 0; padding: 20px;">
                                        <h5 style="color: #c44569; font-weight: 700; margin: 0;">
                                            <i class="fas fa-search"></i> Pencarian & Filter
                                        </h5>
                                    </div>
                                    <div class="card-body" style="padding: 25px;">
                                        <form action="{{ route('admin.gajiKurir.index') }}" method="GET">
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="search_kurir" style="color: #c44569; font-weight: 600; margin-bottom: 8px;">
                                                        <i class="fas fa-user"></i> Nama Kurir
                                                    </label>
                                                    <input type="text" 
                                                           id="search_kurir" 
                                                           name="search" 
                                                           class="form-control" 
                                                           placeholder="Masukkan nama kurir..." 
                                                           value="{{ request('search') }}"
                                                           style="border: 2px solid #ffeef8; border-radius: 10px; padding: 12px 15px; transition: all 0.3s ease; background: rgba(255,255,255,0.9);">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="search_tanggal" style="color: #c44569; font-weight: 600; margin-bottom: 8px;">
                                                        <i class="fas fa-calendar-alt"></i> Tanggal Kerja
                                                    </label>
                                                    <input type="date" 
                                                           id="search_tanggal" 
                                                           name="tanggal" 
                                                           class="form-control" 
                                                           value="{{ request('tanggal') }}"
                                                           style="border: 2px solid #ffeef8; border-radius: 10px; padding: 12px 15px; transition: all 0.3s ease; background: rgba(255,255,255,0.9);">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label style="color: transparent; font-weight: 600; margin-bottom: 8px; display: block;">Action</label>
                                                    <div class="d-flex">
                                                        <button type="submit" class="btn me-2" style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); color: white; border: none; border-radius: 10px; padding: 12px 20px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(255, 107, 157, 0.3);">
                                                            <i class="fas fa-search"></i> Cari
                                                        </button>
                                                        <a href="{{ route('admin.gajiKurir.index') }}" class="btn btn-outline-secondary" style="border: 2px solid #ffeef8; border-radius: 10px; padding: 12px 20px; transition: all 0.3s ease; color: #c44569;">
                                                            <i class="fas fa-times"></i> Reset
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(request('search') || request('tanggal'))
                        <div class="alert alert-info" style="background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%); border: none; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 4px 15px rgba(33, 150, 243, 0.1);">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle" style="color: #1976d2; margin-right: 10px; font-size: 1.2rem;"></i>
                                <div>
                                    <strong style="color: #1976d2;">Hasil Pencarian:</strong>
                                    @if(request('search'))
                                        <span style="color: #1976d2;">Kurir: "{{ request('search') }}"</span>
                                    @endif
                                    @if(request('search') && request('tanggal')) | @endif
                                    @if(request('tanggal'))
                                        <span style="color: #1976d2;">Tanggal: {{ \Carbon\Carbon::parse(request('tanggal'))->format('d/m/Y') }}</span>
                                    @endif
                                    <div style="color: #1976d2; font-size: 0.9rem; margin-top: 5px;">
                                        Ditemukan {{ $gajiKurirs->total() }} data dari total pencarian
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        @endif

                        @if($gajiKurirs->count() > 0)
                        
                        <!-- Desktop Table -->
                        <div class="table-responsive d-none d-lg-block">
                            <table class="table table-hover" style="background: rgba(255, 255, 255, 0.9); border-radius: 12px; overflow: hidden;">
                                <thead>
                                    <tr style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%);">
                                        <th style="color: white; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; border: none; padding: 15px;">No</th>
                                        <th style="color: white; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; border: none; padding: 15px;">
                                            <i class="fas fa-user"></i> Nama Kurir
                                        </th>
                                        <th style="color: white; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; border: none; padding: 15px;">
                                            <i class="fas fa-calendar-alt"></i> Tanggal Kerja
                                        </th>
                                        <th style="color: white; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; border: none; padding: 15px;">
                                            <i class="fas fa-box"></i> Pickup
                                        </th>
                                        <th style="color: white; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; border: none; padding: 15px;">
                                            <i class="fas fa-truck"></i> PUD
                                        </th>
                                        <th style="color: white; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; border: none; padding: 15px;">
                                            <i class="fas fa-money-bill-wave"></i> Total Gaji
                                        </th>
                                        <th style="color: white; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; border: none; padding: 15px; text-align: center;">
                                            <i class="fas fa-cogs"></i> Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($gajiKurirs as $index => $gajiKurir)
                                    <tr style="transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255, 107, 157, 0.05)'; this.style.transform='scale(1.01)'" onmouseout="this.style.background=''; this.style.transform='scale(1)'">
                                        <td style="padding: 15px; vertical-align: middle; font-weight: 600; color: #c44569;">
                                            {{ $gajiKurirs->firstItem() + $index }}
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle;">
                                            <div style="display: flex; align-items: center;">
                                                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #ff9ff3 0%, #ffeef8 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                                    <i class="fas fa-user" style="color: #c44569;"></i>
                                                </div>
                                                <div>
                                                    <div style="color: #c44569; font-weight: 600;">{{ $gajiKurir->kurir->nama }}</div>
                                                    <small style="color: #ff6b9d;">{{ $gajiKurir->kurir->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle;">
                                            <span style="background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%); color: #1976d2; padding: 8px 15px; border-radius: 20px; font-weight: 600; font-size: 0.9rem;">
                                                {{ $gajiKurir->formatted_tanggal_kerja }}
                                            </span>
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle; text-align: center;">
                                            <span style="background: linear-gradient(135deg, #ff9ff3 0%, #ffeef8 100%); color: #c44569; padding: 8px 15px; border-radius: 20px; font-weight: 600; font-size: 0.9rem;">
                                                {{ $gajiKurir->formatted_pikup }}
                                            </span>
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle; text-align: center;">
                                            <span style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); color: white; padding: 8px 15px; border-radius: 20px; font-weight: 600; font-size: 0.9rem;">
                                                {{ $gajiKurir->formatted_pud }}
                                            </span>
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle;">
                                            <span style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; padding: 8px 15px; border-radius: 20px; font-weight: 600; font-size: 0.9rem;">
                                                {{ $gajiKurir->formatted_total }}
                                            </span>
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle; text-align: center;">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.gajiKurir.show', $gajiKurir->id) }}" class="btn btn-sm" style="background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%); color: white; border: none; border-radius: 8px; margin: 0 2px; padding: 8px 12px; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(23, 162, 184, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(23, 162, 184, 0.2)'">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.gajiKurir.edit', $gajiKurir->id) }}" class="btn btn-sm" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%); color: white; border: none; border-radius: 8px; margin: 0 2px; padding: 8px 12px; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(255, 193, 7, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(255, 193, 7, 0.2)'">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.gajiKurir.destroy', $gajiKurir->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data gaji kurir ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm" style="background: linear-gradient(135deg, #dc3545 0%, #e91e63 100%); color: white; border: none; border-radius: 8px; margin: 0 2px; padding: 8px 12px; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(220, 53, 69, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(220, 53, 69, 0.2)'">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile/Tablet Cards -->
                        <div class="d-block d-lg-none">
                            @foreach($gajiKurirs as $index => $gajiKurir)
                            <div class="card mb-3" style="border: none; border-radius: 15px; box-shadow: 0 4px 15px rgba(255, 107, 157, 0.1); overflow: hidden;">
                                <div class="card-header" style="background: linear-gradient(135deg, #ff9ff3 0%, #ffeef8 100%); border: none; padding: 15px;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                                <i class="fas fa-user" style="color: white;"></i>
                                            </div>
                                            <div>
                                                <h6 style="color: #c44569; font-weight: 700; margin: 0;">{{ $gajiKurir->kurir->nama }}</h6>
                                                <small style="color: #ff6b9d;">{{ $gajiKurir->kurir->email }}</small>
                                            </div>
                                        </div>
                                        <span class="badge" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; font-size: 0.9rem; padding: 8px 12px;">
                                            {{ $gajiKurir->formatted_total }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body" style="padding: 15px;">
                                    <div class="row">
                                        <div class="col-6 mb-2">
                                            <small style="color: #6c757d; font-weight: 500;">Tanggal Kerja</small>
                                            <div style="color: #1976d2; font-weight: 600;">{{ $gajiKurir->formatted_tanggal_kerja }}</div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <small style="color: #6c757d; font-weight: 500;">Total Gaji</small>
                                            <div style="color: #28a745; font-weight: 700;">{{ $gajiKurir->formatted_total }}</div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <small style="color: #6c757d; font-weight: 500;">Pickup</small>
                                            <div style="color: #c44569; font-weight: 600;">{{ $gajiKurir->formatted_pikup }}</div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <small style="color: #6c757d; font-weight: 500;">PUD</small>
                                            <div style="color: #ff6b9d; font-weight: 600;">{{ $gajiKurir->formatted_pud }}</div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <a href="{{ route('admin.gajiKurir.show', $gajiKurir->id) }}" class="btn btn-sm mx-1" style="background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%); color: white; border: none; border-radius: 8px; padding: 8px 12px;">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.gajiKurir.edit', $gajiKurir->id) }}" class="btn btn-sm mx-1" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%); color: white; border: none; border-radius: 8px; padding: 8px 12px;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.gajiKurir.destroy', $gajiKurir->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data gaji kurir ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm mx-1" style="background: linear-gradient(135deg, #dc3545 0%, #e91e63 100%); color: white; border: none; border-radius: 8px; padding: 8px 12px;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $gajiKurirs->links() }}
                        </div>
                        @else
                        <div class="text-center" style="padding: 60px 20px;">
                            <div style="font-size: 5rem; color: rgba(255, 107, 157, 0.3); margin-bottom: 20px;">
                                <i class="fas fa-truck"></i>
                            </div>
                            <h4 style="color: #c44569; font-weight: 600; margin-bottom: 15px;">Belum Ada Data Gaji Kurir</h4>
                            <p style="color: #ff6b9d; margin-bottom: 25px;">Mulai tambahkan data gaji kurir untuk sistem payroll</p>
                            <a href="{{ route('admin.gajiKurir.create') }}" class="btn" style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); color: white; border: none; border-radius: 25px; padding: 12px 30px; font-weight: 600; text-decoration: none; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 25px rgba(255, 107, 157, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(255, 107, 157, 0.3)'">
                                <i class="fas fa-plus"></i> Tambah Data Gaji Kurir Pertama
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.pagination .page-link {
    color: #c44569 !important;
    border: 1px solid #ff9ff3 !important;
    border-radius: 8px !important;
    margin: 0 2px !important;
    transition: all 0.3s ease !important;
}

.pagination .page-link:hover {
    background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%) !important;
    color: white !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 15px rgba(255, 107, 157, 0.3) !important;
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%) !important;
    border-color: #ff6b9d !important;
    color: white !important;
    box-shadow: 0 4px 15px rgba(255, 107, 157, 0.3) !important;
}

/* Form Input Focus Effects */
.form-control:focus {
    border-color: #ff6b9d !important;
    box-shadow: 0 0 0 0.2rem rgba(255, 107, 157, 0.25) !important;
    transform: translateY(-1px);
}

/* Responsive Table Improvements */
@media (max-width: 991.98px) {
    .card-header form {
        flex-direction: column !important;
        max-width: 100% !important;
        margin-left: 0 !important;
        margin-top: 15px !important;
    }
    
    .card-header .input-group {
        margin-right: 0 !important;
        margin-bottom: 10px !important;
    }
    
    .card-header .d-flex {
        flex-direction: column !important;
        align-items: stretch !important;
    }
}

/* Search Form Animations */
.form-control {
    transition: all 0.3s ease !important;
}

.form-control:hover {
    border-color: #ff9ff3 !important;
    box-shadow: 0 2px 8px rgba(255, 107, 157, 0.1) !important;
}

/* Button Hover Effects */
.btn {
    transition: all 0.3s ease !important;
}

.btn:hover {
    transform: translateY(-2px) !important;
}

/* Card Animation */
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

/* Mobile Card Improvements */
@media (max-width: 767.98px) {
    .card-body {
        padding: 20px !important;
    }
    
    .card-header {
        padding: 20px !important;
    }
    
    .alert {
        padding: 15px !important;
        font-size: 0.9rem !important;
    }
    
    .btn {
        padding: 10px 16px !important;
        font-size: 0.9rem !important;
    }
    
    .form-control {
        padding: 10px 12px !important;
        font-size: 0.9rem !important;
    }
}

/* Table Row Hover Effects */
tbody tr {
    transition: all 0.3s ease !important;
}

tbody tr:hover {
    background: rgba(255, 107, 157, 0.05) !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 15px rgba(255, 107, 157, 0.1) !important;
}

/* Empty State Improvements */
.text-center i {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

/* Loading State for Search */
.btn[type="submit"]:active {
    transform: scale(0.98) !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add loading state to search button
    const searchForms = document.querySelectorAll('form[method="GET"]');
    searchForms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mencari...';
                submitBtn.disabled = true;
            }
        });
    });

    // Auto-submit form when date is selected
    const dateInput = document.getElementById('search_tanggal');
    if (dateInput) {
        dateInput.addEventListener('change', function() {
            // Optional: Auto-submit when date changes
            // this.closest('form').submit();
        });
    }

    // Add focus effects to form inputs
    const formInputs = document.querySelectorAll('.form-control');
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.transform = 'translateY(-1px)';
            this.style.boxShadow = '0 4px 15px rgba(255, 107, 157, 0.2)';
        });

        input.addEventListener('blur', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '';
        });
    });

    // Add confirmation for delete buttons
    const deleteButtons = document.querySelectorAll('form[method="POST"] button[type="submit"]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Apakah Anda yakin ingin menghapus data gaji kurir ini?')) {
                e.preventDefault();
            }
        });
    });

    // Show/hide search form on mobile
    let searchToggle = document.createElement('button');
    searchToggle.innerHTML = '<i class="fas fa-search"></i>';
    searchToggle.className = 'btn btn-outline-light d-lg-none';
    searchToggle.style.cssText = 'border-radius: 25px; padding: 10px 15px; margin-left: 10px;';
    
    const headerActions = document.querySelector('.card-header .d-flex');
    if (headerActions && window.innerWidth < 992) {
        headerActions.appendChild(searchToggle);
        
        const mobileSearchForm = document.querySelector('.card-header form');
        if (mobileSearchForm) {
            mobileSearchForm.style.display = 'none';
            
            searchToggle.addEventListener('click', function() {
                if (mobileSearchForm.style.display === 'none') {
                    mobileSearchForm.style.display = 'block';
                    this.innerHTML = '<i class="fas fa-times"></i>';
                } else {
                    mobileSearchForm.style.display = 'none';
                    this.innerHTML = '<i class="fas fa-search"></i>';
                }
            });
        }
    }

    // Smooth scroll to results when searching
    if (window.location.search.includes('search') || window.location.search.includes('tanggal')) {
        setTimeout(() => {
            const resultsSection = document.querySelector('.alert-info');
            if (resultsSection) {
                resultsSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }, 300);
    }
});
</script>
@endsection