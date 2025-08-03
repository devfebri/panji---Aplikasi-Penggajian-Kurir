<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <title>Slip Gaji - {{ $user->nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: black;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #333;
            padding-bottom: 20px;
        }
        .company-info {
            margin-bottom: 20px;
        }
        .employee-info {
            margin-bottom: 30px;
        }
        .salary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .salary-table th, .salary-table td {
            border: 1px solid #333;
            padding: 10px;
            text-align: left;
        }
        .salary-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .total-row {
            background-color: #e8f5e8;
            font-weight: bold;
        }
        .signature {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            text-align: center;
            width: 200px;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin: 20px 0;
        }
        .period-info {
            background-color: #e3f2fd;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        @media print {
            body { margin: 0; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>PT. INDONESIA DAMAI</h1>
        <h2>Slip Gaji Pegawai</h2>
    </div>

    <div class="employee-info">
        <table style="width:100%; margin-bottom: 20px;">
            <tr>
                <td width="20%"><strong>Nama Karyawan</strong></td>
                <td width="30px">:</td>
                <td>{{ $user->nama }}</td>
            </tr>
            <tr>
                <td><strong>NIK</strong></td>
                <td>:</td>
                <td>{{ $user->nik ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td>:</td>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <td><strong>No. HP</strong></td>
                <td>:</td>
                <td>{{ $user->nohp ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Periode</strong></td>
                <td>:</td>
                <td>{{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}</td>
            </tr>
        </table>
    </div>

    <!-- Traditional Salary Section -->
    @if(isset($traditionalSalary) && count($traditionalSalary) > 0)
        <div class="period-info">
            <h4><i class="fas fa-briefcase"></i> Gaji Tradisional (Berdasarkan Jabatan)</h4>
        </div>
        
        @foreach($traditionalSalary as $item)
        <table class="salary-table">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Keterangan</th>
                    <th width="25%">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Jabatan</td>
                    <td>{{ $item->nama_jabatan ?? '-' }}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Gaji Pokok</td>
                    <td>Rp {{ number_format($item->gaji_pokok ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Tunjangan Transportasi</td>
                    <td>Rp {{ number_format($item->transportasi ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Uang Makan</td>
                    <td>Rp {{ number_format($item->uang_makan ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Absensi Alpha ({{ $item->alpha ?? 0 }} hari)</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Absensi Izin ({{ $item->izin ?? 0 }} hari)</td>
                    <td>-</td>
                </tr>
                @php 
                    $potongan_gaji_alpha = isset($potongan_alpha[0]) ? $potongan_alpha[0]->jumlah_potongan : 0;
                    $potongan_gaji_izin = isset($potongan_izin[0]) ? $potongan_izin[0]->jumlah_potongan : 0;
                    $total_potongan = ($potongan_gaji_alpha * ($item->alpha ?? 0)) + ($potongan_gaji_izin * ($item->izin ?? 0));
                    $total_gaji_tradisional = ($item->gaji_pokok ?? 0) + ($item->transportasi ?? 0) + ($item->uang_makan ?? 0) - $total_potongan;
                @endphp
                <tr>
                    <td>7</td>
                    <td>Total Potongan</td>
                    <td>Rp {{ number_format($total_potongan, 0, ',', '.') }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="2" style="text-align: right;"><strong>TOTAL GAJI TRADISIONAL</strong></td>
                    <td><strong>Rp {{ number_format($total_gaji_tradisional, 0, ',', '.') }}</strong></td>
                </tr>
            </tbody>
        </table>
        @endforeach
    @endif

    <!-- Kurir Salary Section -->
    @if(isset($kurirSalary) && $kurirSalary->count() > 0)
        <div class="period-info">
            <h4><i class="fas fa-truck"></i> Gaji Kurir (Berdasarkan Paket)</h4>
            @if($gajiSettings)
                <p>Tarif: Paket Bawaan Rp {{ number_format($gajiSettings->paket_bawaan, 0, ',', '.') }}, 
                   Paket Jemputan Rp {{ number_format($gajiSettings->paket_jemputan, 0, ',', '.') }}, 
                   Potongan BPJS Rp {{ number_format($gajiSettings->potongan_bpjs, 0, ',', '.') }}</p>
            @endif
        </div>

        <table class="salary-table">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Tanggal</th>
                    <th width="10%">Pickup</th>
                    <th width="10%">PUD</th>
                    <th width="15%">Gaji Harian</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $totalGajiKurir = 0;
                    $totalPickup = 0;
                    $totalPud = 0;
                @endphp
                @foreach($kurirSalary as $index => $gaji)
                    @php
                        $totalGajiKurir += $gaji->total;
                        $totalPickup += $gaji->pikup;
                        $totalPud += $gaji->pud;
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($gaji->tanggal_kerja)->format('d/m/Y') }}</td>
                        <td>{{ $gaji->pikup }}</td>
                        <td>{{ $gaji->pud }}</td>
                        <td>Rp {{ number_format($gaji->total, 0, ',', '.') }}</td>
                        <td>{{ $gaji->keterangan ?? '-' }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="2" style="text-align: right;"><strong>TOTAL</strong></td>
                    <td><strong>{{ $totalPickup }}</strong></td>
                    <td><strong>{{ $totalPud }}</strong></td>
                    <td><strong>Rp {{ number_format($totalGajiKurir, 0, ',', '.') }}</strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    @endif

    <!-- No Data Message -->
    @if((!isset($traditionalSalary) || count($traditionalSalary) == 0) && (!isset($kurirSalary) || $kurirSalary->count() == 0))
        <div class="no-data">
            <h4>Tidak Ada Data Gaji</h4>
            <p>Tidak ditemukan data gaji untuk periode {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}.</p>
            <p>Silakan periksa periode lain atau hubungi administrator.</p>
        </div>
    @endif

    <!-- Grand Total -->
    @if((isset($traditionalSalary) && count($traditionalSalary) > 0) || (isset($kurirSalary) && $kurirSalary->count() > 0))
        @php
            $grandTotal = 0;
            if(isset($traditionalSalary) && count($traditionalSalary) > 0) {
                $grandTotal += $total_gaji_tradisional ?? 0;
            }
            if(isset($kurirSalary) && $kurirSalary->count() > 0) {
                $grandTotal += $totalGajiKurir ?? 0;
            }
        @endphp
        
        @if($grandTotal > 0)
        <table class="salary-table" style="margin-top: 30px;">
            <tr class="total-row" style="background-color: #d1ecf1; font-size: 1.2em;">
                <td style="text-align: right; padding: 15px;"><strong>TOTAL GAJI KESELURUHAN</strong></td>
                <td style="width: 25%; padding: 15px;"><strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
            </tr>
        </table>
        @endif
    @endif

    <!-- Signature Section -->
    <div class="signature">
        <div class="signature-box">
            <p><strong>Yang Menerima,</strong></p>
            <br><br><br>
            <p><strong>{{ $user->nama }}</strong></p>
        </div>
        <div class="signature-box">
            <p><strong>Lombok, {{ date('d M Y') }}</strong></p>
            <p><strong>PT. Indonesia Damai</strong></p>
            <br><br><br>
            <p>_____________________</p>
            <p><strong>HRD Manager</strong></p>
        </div>
    </div>

<script>
    // Auto print when page loads
    window.onload = function() {
        window.print();
    }
</script>
</body>
</html>