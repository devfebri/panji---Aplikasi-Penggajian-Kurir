@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 d-flex justify-content-between">
                <h1 class="m-0">Input Kehadiran</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card p-4">
            <form class="form-horizontal" action="{{route('admin.karyawan.store')}}" method="POST" >
                @csrf
                <div class="box-body">
                    
                    <div class="form-group" style="width: 350px;">
                        <label>Pilihan Presensi</label>
                        <select class="form-control" id="txtAbsen" name="txtAbsen">
                            <option value="">-Pilih-</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Sakit">Sakit</option>
                            {{-- <option value="Alpha">Alpha</option> --}}
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Absen Masuk</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection