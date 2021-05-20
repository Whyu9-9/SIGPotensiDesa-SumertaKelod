@extends('adminlayout.layout')
@section('title')
Manajemen Kecamatan
@endsection
@section('header_title')
<i class="nav-icon fas fa-landmark"></i> Manajemen Kecamatan
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="/admin/kecamatan">Manajemen Kecamatan</a></li>
<li class="breadcrumb-item active"><a href="/admin/kecamatan"></a>Tambah Data Kecamatan</li>
@endsection
@section('add_css')
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('add_js')
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,
        });
    });
</script>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
<div class="container-fluid">
    <div class="row">
    <div class="col-12 col-xs-12 col-md-12">
        <div class="card">
            @if (Session::has('error'))
                <div class="alert alert-danger">{!! Session::get('error') !!}</div>
            @endif
            @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check"></i> {{Session::get('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        <div class="card-header">
            <h3 class="card-title">Form Data Kecamatan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{route('kecamatan.store')}}">
                @csrf
                <div class="form-group">
                    <label for="kabupaten">Kabupaten/Kota</label>
                    <select name="id_kabupaten" id="kabupaten" class="form-control select2" required>
                        <option>Pilih Kabupaten</option>
                        @foreach ($kabupaten as $k)
                            <option value="{{$k->id}}">{{$k->nama_kabupaten}}</option>
                        @endforeach
                    </select>
                    <small style="color: red">
                        @error('kabupaten')
                            {{$message}}
                        @enderror
                    </small>
                </div>
                <div class="form-group">
                    <label for="">Nama Kecamatan</label>
                    <input type="text" class="form-control" name="nama_kecamatan" placeholder="Masukkan nama kecamatan" required value="{{$errors->any() ? old('nama_kecamatan') : ''}}">
                    <small style="color: red">
                        @error('nama_kecamatan')
                            {{$message}}
                        @enderror
                    </small>
                </div>
                <span><button style="margin-right:4px" type="submit" class="btn btn-success float-left"><i class="fas fa-save"></i> Tambah Kecamatan</button></span>
                <a href="/admin/kecamatan"><button type="button" class="btn btn-danger float-left mr-2"><i class="fas fa-times"></i> Kembali</button></a>
            </form>
        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection