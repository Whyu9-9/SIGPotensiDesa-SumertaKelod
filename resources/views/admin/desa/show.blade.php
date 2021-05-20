@extends('adminlayout.layout')
@section('title')
Manajemen Desa
@endsection
@section('header_title')
<i class="nav-icon fas fa-map-signs"></i> Manajemen Desa
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/admin/desa">Manajemen Desa</a></li>
    <li class="breadcrumb-item active"><a href="/admin/desa"></a>Detail Desa</li>
@endsection
@section('add_css')
    <style>
        #map { height: 697px; }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
@endsection
@section('add_js')
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
    <script>
        var mymap = L.map('map').setView([-8.650000, 115.216667], 12);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: '&copy; SIG Desa 2021',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1Ijoid2h5dTkiLCJhIjoiY2tsYngwa3dzMWZueDJ3bXZ1OWt0NmN5ZSJ9.bofvis1MNPWTbjq-nIBjcg'
        }).addTo(mymap);

        function initializePolygon(data){
            var arr = [];
            for(i in data) {
                var x = data[i]['lat'];
                var y = data[i]['lng'];
                arr.push([x, y]);
            }
            return arr;
        }
        var batas = {!! json_encode($desa) !!}
        var koor = jQuery.parseJSON(batas['batas_desa']);
        var pathCoords = initializePolygon(koor);
        var pathLine = L.polygon(pathCoords, {
            color: batas['warna_batas'],
            fillColor: batas['warna_batas'],
            fillOpacity: 0.4,
            nama: batas['nama_desa'],
        }).addTo(mymap);
        pathLine.on('click', function(e) {
                alert(e.target.options.nama);
        } );
    </script>
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Peta Desa</h6>
                </div>
                <div class="card-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Data Desa</h6>
                </div>
                <div class="card-body">
                        <div class="form-group">
                            <label for="kabupaten">Kabupaten/Kota</label>
                            <select name="kabupaten" id="kabupaten" class="form-control select2" disabled>
                                @foreach ($kabupaten as $k)
                                    <option value="{{$k->id}}" {{ $desa->kecamatan->id_kabupaten==$k->id ? 'selected' : '' }}>{{$k->nama_kabupaten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kecamatan</label>
                            <input type="text" class="form-control" name="nama_desa" placeholder="Masukkan nama desa" readonly value="{{$desa->kecamatan->nama_kecamatan}}">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Desa</label>
                            <input type="text" class="form-control" name="nama_desa" placeholder="Masukkan nama desa" readonly value="{{$desa->nama_desa}}">
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea placeholder="Masukan Keterangan" name="keterangan" cols="30" rows="4" class="form-control" readonly>{{$desa->keterangan}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Warna Batas</label>
                            <input type="color" class="form-control" name="warna_batas" id="color-picker" disabled value="{{$desa->warna_batas}}">
                        </div>
                        <div class="form-group">
                            <label for="">Batas Desa</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <textarea placeholder="Masukan Batas Desa" name="batas_desa" id="batas" cols="30" rows="4" readonly class="form-control" required>{{$desa->batas_desa}}</textarea>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <a href="javascript:void(0)" id="set-data"><i class="fas fa-map-marker-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection