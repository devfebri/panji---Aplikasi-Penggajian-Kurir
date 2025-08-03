# Fitur Gaji Karyawan/Kurir - Panduan Penggunaan

## 📋 Deskripsi
Fitur ini memungkinkan setiap karyawan/kurir untuk melihat informasi gaji mereka sendiri dengan keamanan yang terjamin. Setiap user hanya dapat melihat data gaji pribadi mereka.

## 🔒 Keamanan
- **Authentication Required**: User harus login terlebih dahulu
- **Authorization**: Setiap user hanya dapat melihat gaji mereka sendiri
- **Data Scoping**: Semua query database sudah dibatasi berdasarkan user ID yang sedang login

## 🎯 Fitur Utama

### 1. Dashboard Gaji (`/admin/gaji-karyawan`)
- Tampilan ringkasan gaji bulanan dan harian
- Pilihan periode (bulan & tahun)
- Statistik gaji:
  - Total gaji kurir bulanan
  - Total pikup dan PUD
  - Jumlah hari kerja
  - Rata-rata gaji harian
- Gaji terbaru (7 hari terakhir)
- Pengaturan gaji sistem

### 2. Detail Gaji Harian (`/admin/gaji-karyawan/daily`)
- Detail gaji untuk tanggal tertentu
- Breakdown pikup dan PUD
- Perhitungan total gaji harian
- Informasi lengkap aktivitas hari tersebut

### 3. Ringkasan Gaji Bulanan (`/admin/gaji-karyawan/monthly`)
- Ringkasan seluruh gaji dalam satu bulan
- Tabel detail per tanggal
- Statistik bulanan lengkap
- Perbandingan dengan bulan sebelumnya (jika ada)

### 4. Cetak Slip Gaji (`/admin/gaji-karyawan/cetak/{bulan}/{tahun}`)
- Slip gaji resmi yang bisa dicetak
- Format profesional dengan header perusahaan
- Detail gaji pokok & tunjangan (jika ada)
- Detail gaji kurir harian
- Total gaji bersih
- Area tanda tangan HRD dan karyawan

## 💡 Jenis Gaji yang Didukung

### 1. Gaji Tradisional
- Gaji pokok dari tabel `jabatan`
- Transportasi
- Uang makan
- Potongan alpha dan izin

### 2. Gaji Kurir
- Gaji berdasarkan pikup dan PUD (Pick Up Delivery)
- Perhitungan harian
- Akumulasi bulanan

## 🔄 Alur Penggunaan

1. **Login** ke sistem
2. **Akses menu** "Gaji Karyawan" di sidebar
3. **Pilih periode** yang ingin dilihat (default: bulan berjalan)
4. **Lihat dashboard** dengan ringkasan gaji
5. **Klik detail** untuk melihat:
   - Gaji harian specific
   - Ringkasan bulanan
6. **Cetak slip gaji** jika diperlukan

## 🛡️ Validasi & Error Handling

### Validasi Input
- Format tanggal harus valid
- Bulan: 1-12
- Tahun: minimal 2020, maksimal tahun depan
- Parameter URL harus numerik

### Error Messages
- "Format tanggal tidak valid"
- "Tidak ada data gaji untuk periode tersebut"
- "Parameter bulan atau tahun tidak valid"

### Fallback
- Jika tidak ada data tradisional, tampilkan hanya gaji kurir
- Jika tidak ada data kurir, tampilkan pesan informatif
- Jika tidak ada data sama sekali, berikan panduan

## 📊 Database Tables yang Digunakan

1. **users** - Data karyawan
2. **jabatan** - Gaji pokok & tunjangan
3. **absensi** - Data kehadiran & potongan
4. **gaji_kurir** - Gaji harian kurir
5. **potongan_gaji** - Setting potongan alpha/izin
6. **gaji** - Setting sistem gaji

## 🎨 UI/UX Features

- **Responsive Design**: Tampil baik di desktop dan mobile
- **Modern Interface**: Gradient colors dan card-based layout
- **User-Friendly**: Icon dan warna yang intuitif
- **Print-Friendly**: Slip gaji optimized untuk cetak
- **Loading States**: Indikator saat memuat data
- **Empty States**: Message yang jelas saat tidak ada data

## 🔧 Technical Implementation

### Controller: `GajiKaryawanController`
- `index()` - Dashboard utama
- `showDaily()` - Detail harian  
- `showMonthly()` - Ringkasan bulanan
- `cetak()` - Generate slip gaji
- `getTraditionalSalary()` - Helper untuk gaji tradisional

### Views
- `karyawan/gaji/index.blade.php` - Dashboard
- `karyawan/gaji/daily.blade.php` - Detail harian
- `karyawan/gaji/monthly.blade.php` - Ringkasan bulanan  
- `karyawan/gaji/cetak.blade.php` - Slip gaji print

### Routes
```php
Route::get('gaji-karyawan', 'index')->name('gajikaryawan.index');
Route::get('gaji-karyawan/daily', 'showDaily')->name('gajikaryawan.daily');  
Route::get('gaji-karyawan/monthly', 'showMonthly')->name('gajikaryawan.monthly');
Route::get('gaji-karyawan/cetak/{bulan}/{tahun}', 'cetak')->name('gajikaryawan.cetak');
```

## 🚀 Cara Testing

1. Login sebagai karyawan/kurir
2. Akses `/admin/gaji-karyawan`
3. Test dengan berbagai periode
4. Coba fitur cetak
5. Pastikan tidak bisa akses data user lain

## 📋 TODO Future Enhancements

- [ ] Export to PDF
- [ ] Email slip gaji otomatis
- [ ] Notifikasi gaji baru
- [ ] Grafik trend gaji
- [ ] Perbandingan dengan periode sebelumnya
- [ ] Filter dan pencarian advanced
- [ ] API endpoint untuk mobile app

## 📝 **Update Log - Perbaikan Logika Potongan BPJS**

### Tanggal: {{ date('d F Y') }}

#### 🔄 **Perubahan yang Dilakukan:**

1. **Logika Potongan BPJS Diperbaiki**
   - ❌ **Sebelumnya**: BPJS dipotong per hari kerja
   - ✅ **Sekarang**: BPJS dipotong per bulan kerja (lebih realistis)

2. **View Daily (Gaji Harian)**
   - Potongan BPJS ditampilkan sebagai informasi saja
   - Total gaji harian tidak dikurangi BPJS
   - Ditambahkan keterangan bahwa BPJS dipotong bulanan

3. **View Monthly (Gaji Bulanan)**  
   - Ditambahkan section khusus "Potongan Bulanan"
   - Menampilkan perhitungan gaji bersih setelah potongan BPJS
   - Breakdown yang jelas antara gaji kotor dan bersih

4. **Slip Cetak**
   - Ditambahkan section "Potongan Bulanan" 
   - Summary menampilkan:
     - Sub Total Gaji Kotor
     - Potongan BPJS Bulanan  
     - Total Gaji Bersih

#### 💡 **Logika Baru:**
- **Gaji Harian**: Tidak dipotong BPJS (hanya informasi)
- **Gaji Bulanan**: BPJS dipotong dari total akumulasi bulanan
- **Slip Gaji**: Menampilkan perhitungan lengkap dengan potongan BPJS

#### 🎯 **Benefit:**
- Perhitungan lebih realistis dan sesuai praktik umum
- Karyawan lebih jelas memahami kapan BPJS dipotong
- Slip gaji lebih professional dan detailed

---

**Dibuat oleh**: GitHub Copilot  
**Tanggal**: {{ date('d F Y') }}  
**Versi**: 1.0.0
