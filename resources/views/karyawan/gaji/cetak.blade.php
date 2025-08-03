<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji - {{ $user->nama }} - {{ date('F Y', mktime(0, 0, 0, $bulan, 1, $tahun)) }}</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: white;
        }
        
        .slip-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 2px solid #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        
        .company-name {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        
        .slip-title {
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }
        
        .employee-info {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .info-row {
            display: table-row;
        }
        
        .info-label, .info-value {
            display: table-cell;
            padding: 3px 5px;
            vertical-align: top;
        }
        
        .info-label {
            width: 150px;
            font-weight: bold;
        }
        
        .salary-section {
            margin-bottom: 20px;
        }
        
        .section-title {
            font-size: 14px;
            font-weight: bold;
            background-color: #f0f0f0;
            padding: 8px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        
        .salary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        
        .salary-table th,
        .salary-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        
        .salary-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        
        .amount {
            text-align: right;
            font-weight: bold;
        }
        
        .total-row {
            background-color: #e9ecef;
            font-weight: bold;
        }
        
        .summary-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        
        .summary-table td {
            border: 1px solid #333;
            padding: 10px;
            font-weight: bold;
        }
        
        .summary-label {
            background-color: #f0f0f0;
            width: 60%;
        }
        
        .summary-amount {
            text-align: right;
            width: 40%;
        }
        
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        
        .signature-area {
            margin-top: 50px;
            text-align: center;
        }
        
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            
            .slip-container {
                margin: 0;
                padding: 15px;
                border: none;
                max-width: none;
            }
            
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="slip-container">
        <!-- Header -->
        <div class="header">
            <div class="company-name">PT. ODADING INDONESIA</div>
            <div class="slip-title">SLIP GAJI KARYAWAN</div>
            <div>Periode: {{ date('F Y', mktime(0, 0, 0, $bulan, 1, $tahun)) }}</div>
        </div>

        <!-- Employee Information -->
        <div class="employee-info">
            <div class="info-row">
                <div class="info-label">NIK</div>
                <div class="info-value">: {{ $user->nik ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Nama Karyawan</div>
                <div class="info-value">: {{ $user->nama }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Jabatan</div>
                <div class="info-value">: {{ $user->jabatan->nama ?? 'Kurir' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Jenis Kelamin</div>
                <div class="info-value">: {{ $user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
            </div>
        </div>

        @if($traditionalSalary)
        <!-- Traditional Salary Section -->
        <div class="salary-section">
            <div class="section-title">Gaji Pokok & Tunjangan</div>
            <table class="salary-table">
                <thead>
                    <tr>
                        <th>Komponen</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @if($traditionalSalary->gaji_pokok)
                    <tr>
                        <td>Gaji Pokok</td>
                        <td class="amount">Rp {{ number_format($traditionalSalary->gaji_pokok, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                    @if($traditionalSalary->transportasi)
                    <tr>
                        <td>Transportasi</td>
                        <td class="amount">Rp {{ number_format($traditionalSalary->transportasi, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                    @if($traditionalSalary->uang_makan)
                    <tr>
                        <td>Uang Makan</td>
                        <td class="amount">Rp {{ number_format($traditionalSalary->uang_makan, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>

            @if(($traditionalSalary->alpha ?? 0) > 0 || ($traditionalSalary->izin ?? 0) > 0)
            <div class="section-title">Potongan</div>
            <table class="salary-table">
                <thead>
                    <tr>
                        <th>Jenis Potongan</th>
                        <th>Jumlah Hari</th>
                        <th>Potongan per Hari</th>
                        <th>Total Potongan</th>
                    </tr>
                </thead>
                <tbody>
                    @if(($traditionalSalary->alpha ?? 0) > 0)
                        @foreach($potongan_alpha as $pa)
                        <tr>
                            <td>Alpha</td>
                            <td>{{ $traditionalSalary->alpha }} hari</td>
                            <td class="amount">Rp {{ number_format($pa->jumlah_potongan, 0, ',', '.') }}</td>
                            <td class="amount">Rp {{ number_format($pa->jumlah_potongan * $traditionalSalary->alpha, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    @endif
                    @if(($traditionalSalary->izin ?? 0) > 0)
                        @foreach($potongan_izin as $pi)
                        <tr>
                            <td>Izin</td>
                            <td>{{ $traditionalSalary->izin }} hari</td>
                            <td class="amount">Rp {{ number_format($pi->jumlah_potongan, 0, ',', '.') }}</td>
                            <td class="amount">Rp {{ number_format($pi->jumlah_potongan * $traditionalSalary->izin, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            @endif
        </div>
        @endif

        @if($kurirSalaryData->count() > 0)
        <!-- Kurir Salary Section -->
        <div class="salary-section">
            <div class="section-title">Gaji Kurir Harian</div>
            <table class="salary-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Pikup</th>
                        <th>PUD</th>
                        <th>Total Gaji</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kurirSalaryData as $salary)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($salary->tanggal_kerja)) }}</td>
                        <td class="amount">{{ $salary->pikup }}</td>
                        <td class="amount">{{ $salary->pud }}</td>
                        <td class="amount">Rp {{ number_format($salary->total, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                    <tr class="total-row">
                        <td><strong>TOTAL</strong></td>
                        <td class="amount"><strong>{{ $kurirSalaryData->sum('pikup') }}</strong></td>
                        <td class="amount"><strong>{{ $kurirSalaryData->sum('pud') }}</strong></td>
                        <td class="amount"><strong>Rp {{ number_format($kurirSalaryData->sum('total'), 0, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endif

        <!-- Monthly Deductions Section -->
        @if($gajiSettings && $gajiSettings->potongan_bpjs)
        <div class="salary-section">
            <div class="section-title">Potongan Bulanan</div>
            <table class="salary-table">
                <thead>
                    <tr>
                        <th>Jenis Potongan</th>
                        <th>Periode</th>
                        <th>Jumlah Potongan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>BPJS Kesehatan</td>
                        <td>{{ date('F Y', mktime(0, 0, 0, $bulan, 1, $tahun)) }}</td>
                        <td class="amount">Rp {{ number_format($gajiSettings->potongan_bpjs, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endif

        <!-- Summary -->
        <table class="summary-table">
            @if($traditionalSalary)
            <?php
                $total_potongan = 0;
                if ($potongan_alpha->count() > 0) {
                    foreach($potongan_alpha as $pa) {
                        $total_potongan += $pa->jumlah_potongan * ($traditionalSalary->alpha ?? 0);
                    }
                }
                if ($potongan_izin->count() > 0) {
                    foreach($potongan_izin as $pi) {
                        $total_potongan += $pi->jumlah_potongan * ($traditionalSalary->izin ?? 0);
                    }
                }
                $gaji_bersih_tradisional = ($traditionalSalary->gaji_pokok ?? 0) + 
                                         ($traditionalSalary->transportasi ?? 0) + 
                                         ($traditionalSalary->uang_makan ?? 0) - $total_potongan;
            ?>
            <tr>
                <td class="summary-label">Total Gaji Pokok & Tunjangan</td>
                <td class="summary-amount">Rp {{ number_format($gaji_bersih_tradisional, 0, ',', '.') }}</td>
            </tr>
            @endif
              @if($kurirSalaryData->count() > 0)
            <tr>
                <td class="summary-label">Total Gaji Kurir</td>
                <td class="summary-amount">Rp {{ number_format($kurirSalaryData->sum('total'), 0, ',', '.') }}</td>
            </tr>
            @endif

            <?php 
                $total_gaji_kotor = ($traditionalSalary ? $gaji_bersih_tradisional : 0) + $kurirSalaryData->sum('total');
                $potongan_bpjs = $gajiSettings->potongan_bpjs ?? 0;
                $total_gaji_bersih = $total_gaji_kotor - $potongan_bpjs;
            ?>
            
            <tr>
                <td class="summary-label">Sub Total Gaji Kotor</td>
                <td class="summary-amount">Rp {{ number_format($total_gaji_kotor, 0, ',', '.') }}</td>
            </tr>
            
            @if($potongan_bpjs > 0)
            <tr>
                <td class="summary-label">Potongan BPJS Bulanan</td>
                <td class="summary-amount" style="color: #dc3545;">-Rp {{ number_format($potongan_bpjs, 0, ',', '.') }}</td>
            </tr>
            @endif
            
            <tr style="background-color: #d1ecf1; font-size: 14px;">
                <td class="summary-label"><strong>TOTAL GAJI BERSIH</strong></td>
                <td class="summary-amount">
                    <strong>Rp {{ number_format($total_gaji_bersih, 0, ',', '.') }}</strong>
                </td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="footer">
            <p>Dicetak pada: {{ date('d F Y, H:i') }} WIB</p>
        </div>

        <div class="signature-area">
            <table style="width: 100%; margin-top: 40px;">
                <tr>
                    <td style="width: 50%; text-align: center;">
                        <p>Mengetahui,</p>
                        <p><strong>HRD</strong></p>
                        <br><br><br>
                        <p>________________</p>
                    </td>
                    <td style="width: 50%; text-align: center;">
                        <p>Penerima,</p>
                        <p><strong>{{ $user->nama }}</strong></p>
                        <br><br><br>
                        <p>________________</p>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Print Button (Hidden when printing) -->
        <div class="no-print" style="text-align: center; margin-top: 30px;">
            <button onclick="window.print()" style="background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 14px;">
                <i class="fas fa-print"></i> Cetak Slip Gaji
            </button>
            <button onclick="window.history.back()" style="background-color: #6c757d; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; margin-left: 10px;">
                <i class="fas fa-arrow-left"></i> Kembali
            </button>
        </div>
    </div>

    <script>
        // Auto print when page loads (optional)
        // window.onload = function() { window.print(); }
    </script>
</body>
</html>
