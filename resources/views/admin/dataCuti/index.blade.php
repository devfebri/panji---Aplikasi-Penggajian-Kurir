@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 d-flex justify-content-between">
                <h1 class="m-0">{{ __('Penggajuan Cuti Tahunan') }}</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-0">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Nik</th>
                                        <th>Tanggal Pengajuan Cuti</th>
                                        <th>Keterangan Pengajuan Cuti</th>
                                        <th>Verifikasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($loadCuti as $data)
                                    <tr>
                                        <td>{{ $data->nama_karyawan }}</td>
                                        <td>{{ $data->email_karyawan }}</td>
                                        <td>{{ $data->nik_karyawan }}</td>
                                        <td>{{ date("d-m-Y", strtotime($data->tgl_cuti)) }}</td>
                                        <td>{{ $data->keterangan }}</td>
                                        <td>
                                            <button type="button" class="btn-sm btn-success" id="btn-update-verifikasi" onclick="onVerif('{{$data->id}}')"><i class="fa fa-check"></i></button>
                                            <button type="button" class="btn-sm btn-danger btn-batal" onclick="onBatal('{{$data->id}}')"><i class="fa fa-ban"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->


                </div>

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Judul Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="">Alasan Ditolak</label>
                <br>
                <input type="text" name="txtAlasan" id="txtAlasan">
                <input type="hidden" name="txtId" id="txtId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger" id="btnSimpan">Simpan</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script>

$(document).ready(function() {
        $('#btnSimpan').on('click', function() {
            // Lakukan operasi simpan di sini
            simpanPerubahan();
        });
    });
    
    function simpanPerubahan() {
        // Ambil nilai dari input atau elemen lainnya dalam modal
        var alasan = $('#txtAlasan').val();
        var id = $('#txtId').val(); // hiddenId adalah ID input hidden yang menyimpan nilai id

        // Lakukan operasi simpan, contohnya menggunakan AJAX
        $.ajax({
            url: '{{ Route("admin.absensis.batalCuti") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                'id': id,
                'alasan': alasan
            },
            success: function(response) {
                // Tambahkan logika penanganan sukses di sini
                console.log('Data berhasil disimpan');
                // Tutup modal setelah berhasil disimpan
                $('#exampleModal').modal('hide');
            },
            error: function(xhr, status, error) {
                // Tambahkan logika penanganan error di sini
                console.error('Terjadi kesalahan:', error);
            }
        });
    }

    function onVerif(id) {
        $.ajax({
            url: "{{ Route('admin.absensis.terimaCuti') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                'id': id,
            },
            success: function(response) {
                alert("Data Cuti Berhasil Di Update");
                location.reload();
            },
            error: function(request, status, error) {
                errorMessage(request);
            }
        });
    }

    function onBatal(id) {
        $('#exampleModal').modal('show');
        $('#txtId').val(id);
    }
</script>
@endsection