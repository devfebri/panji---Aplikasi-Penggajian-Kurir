@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700; font-size: 2rem;">
                    💰 {{ __('Data Gaji') }}
                </h1>
            </div>            <div class="col-sm-6">
                <div class="text-right">
                    @if(!$hasData)
                    <a href="{{ route('admin.gaji.create') }}" class="btn btn-primary" style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); border: none; border-radius: 10px; font-weight: 600; box-shadow: 0 4px 15px rgba(255, 107, 157, 0.3);">
                        <i class="fas fa-plus"></i> Tambah Data Gaji
                    </a>
                    @else
                    <a href="{{ route('admin.gaji.edit', $gaji->id) }}" class="btn btn-warning" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%); border: none; border-radius: 10px; font-weight: 600; box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3); color: white;">
                        <i class="fas fa-edit"></i> Edit Data Gaji
                    </a>
                    @endif
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
                        <h3 class="card-title" style="color: white; font-weight: 600;">
                            <i class="fas fa-money-bill-wave"></i> Setting Gaji Kurir
                        </h3>
                    </div>                    <div class="card-body" style="padding: 30px;">
                        @if($hasData)
                        <div class="table-responsive">
                            <table class="table table-hover" style="background: rgba(255, 255, 255, 0.9); border-radius: 12px; overflow: hidden;">
                                <thead>
                                    <tr style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%);">
                                        <th style="color: white; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; border: none; padding: 15px;">No</th>
                                        <th style="color: white; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; border: none; padding: 15px;">
                                            <i class="fas fa-box"></i> Paket Bawaan
                                        </th>
                                        <th style="color: white; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; border: none; padding: 15px;">
                                            <i class="fas fa-truck"></i> Paket Jemputan
                                        </th>
                                        <th style="color: white; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; border: none; padding: 15px;">
                                            <i class="fas fa-heart-broken"></i> Potongan BPJS
                                        </th>
                                        <th style="color: white; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; border: none; padding: 15px;">
                                            <i class="fas fa-calendar-alt"></i> Tanggal
                                        </th>
                                        <th style="color: white; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; border: none; padding: 15px; text-align: center;">
                                            <i class="fas fa-cogs"></i> Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255, 107, 157, 0.05)'; this.style.transform='scale(1.01)'" onmouseout="this.style.background=''; this.style.transform='scale(1)'">
                                        <td style="padding: 15px; vertical-align: middle; font-weight: 600; color: #c44569;">
                                            1
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle;">
                                            <span style="background: linear-gradient(135deg, #ff9ff3 0%, #ffeef8 100%); color: #c44569; padding: 8px 15px; border-radius: 20px; font-weight: 600; font-size: 0.9rem;">
                                                {{ $gaji->formatted_paket_bawaan }}
                                            </span>
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle;">
                                            <span style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); color: white; padding: 8px 15px; border-radius: 20px; font-weight: 600; font-size: 0.9rem;">
                                                {{ $gaji->formatted_paket_jemputan }}
                                            </span>
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle;">
                                            <span style="background: linear-gradient(135deg, #c44569 0%, #ff9ff3 100%); color: white; padding: 8px 15px; border-radius: 20px; font-weight: 600; font-size: 0.9rem;">
                                                {{ $gaji->formatted_potongan_bpjs }}
                                            </span>
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle; color: #c44569; font-weight: 500;">
                                            <i class="fas fa-clock" style="color: #ff6b9d; margin-right: 5px;"></i>
                                            {{ $gaji->created_at->format('d M Y') }}
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle; text-align: center;">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.gaji.show', $gaji->id) }}" class="btn btn-sm" style="background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%); color: white; border: none; border-radius: 8px; margin: 0 2px; padding: 8px 12px; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(23, 162, 184, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(23, 162, 184, 0.2)'">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.gaji.edit', $gaji->id) }}" class="btn btn-sm" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%); color: white; border: none; border-radius: 8px; margin: 0 2px; padding: 8px 12px; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(255, 193, 7, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(255, 193, 7, 0.2)'">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.gaji.destroy', $gaji->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data gaji ini? Setelah dihapus, Anda dapat membuat data baru.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm" style="background: linear-gradient(135deg, #dc3545 0%, #e91e63 100%); color: white; border: none; border-radius: 8px; margin: 0 2px; padding: 8px 12px; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(220, 53, 69, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(220, 53, 69, 0.2)'">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @else                        <div class="text-center" style="padding: 60px 20px;">
                            <div style="font-size: 5rem; color: rgba(255, 107, 157, 0.3); margin-bottom: 20px;">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <h4 style="color: #c44569; font-weight: 600; margin-bottom: 15px;">Belum Ada Data Gaji</h4>
                            <p style="color: #ff6b9d; margin-bottom: 25px;">Mulai tambahkan data gaji kurir untuk sistem payroll Anteraja</p>
                            <a href="{{ route('admin.gaji.create') }}" class="btn" style="background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); color: white; border: none; border-radius: 25px; padding: 12px 30px; font-weight: 600; text-decoration: none; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 25px rgba(255, 107, 157, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(255, 107, 157, 0.3)'">
                                <i class="fas fa-plus"></i> Tambah Data Gaji Pertama
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
