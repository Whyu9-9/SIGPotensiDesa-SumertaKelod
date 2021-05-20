@extends('adminlayout.layout')
@section('title')
Manajemen Potensi Desa
@endsection
@section('header_title')
<i class="nav-icon fas fa-th"></i> Manajemen Potensi Desa
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/admin/potensi/tempatwisata"></a>Manajemen Tempat Wisata</li>
    <li class="breadcrumb-item active"><a href=""></a>Tambah Tempat Wisata</li>
@endsection
@section('add_css')
<style>
    #map { height: 1085px; }
</style>
<link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
@endsection
@section('add_js')
<script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
            $('#propic').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
    $("#fototempatwisata").change(function() {
        readURL(this);
    });
</script>
<script>
    var cek = 0;
    let pathLine;

    var tempatWisataIcon = L.icon({
        iconUrl: '/assets/marker/vacant-land.png',

        iconSize:     [20, 30], 
        iconAnchor:   [16, 32], 
        popupAnchor:  [0, -16] 
    });

    var mymap = L.map('map').setView([-8.650000, 115.216667], 12);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: '&copy; SIG Desa 2021',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1Ijoid2h5dTkiLCJhIjoiY2tsYngwa3dzMWZueDJ3bXZ1OWt0NmN5ZSJ9.bofvis1MNPWTbjq-nIBjcg'
    }).addTo(mymap);

    L.Map.include({
        getMarkerById: function (id) {
            var marker = null;
            this.eachLayer(function (layer) {
                if (layer instanceof L.Marker) {
                    if (layer.options.id === id) {
                        marker = layer;
                    }
                }
            });
            return marker;
        }
    });

    mymap.pm.addControls({  
        position: 'topleft',
        drawCircle: false,
        drawMarker: false,
        drawCircleMarker:false,
        drawRectangle: false,
        drawPolyline: false,
        drawPolygon: false,
        dragMode:false,
        editMode: false,
        cutPolygon: false,
        removalMode: false,
    });

    function makePolygon(data){
        var c = [];
        for(i in data) {
            var x = data[i]['lat'];
            var y = data[i]['lng'];
            c.push([x, y]);
        }
        return c;
    }

    $('#datadesa').on('change', function(){
        var myDesa = {!! json_encode($desa->toArray()) !!}
        console.log(myDesa);
        myDesa.forEach(element => {
            if($('#datadesa').val() == element['id']){
                for(; Object.keys(mymap._layers).length > 1;) {
                    mymap.removeLayer(mymap._layers[Object.keys(mymap._layers)[1]]);
                    cek = 0;
                }
                var koor = jQuery.parseJSON(element['batas_desa']);
                var id = jQuery.parseJSON(element['id']);
                var pathCoords = makePolygon(koor);
                pathLine = L.polygon(pathCoords, {
                    id: element['id'],
                    color: element['warna_batas'],
                    fillColor: element['warna_batas'],
                    fillOpacity: 0.4,
                    nama: element['nama_desa'],
                }).addTo(mymap);
            }

        });

        if($('#datadesa').val()==''){
            mymap.pm.addControls({
                editMode: false,
                drawMarker: false,
                removalMode: false,
            });
        }else if($('#datadesa').val()!=''){
            mymap.pm.enableDraw('Marker', {
                snappable: true,
                snapDistance: 20,
                markerStyle: {
                    draggable: true,
                    icon: tempatWisataIcon,
                },
            });
        }
    });

    mymap.on('pm:create', e => {
    let shape = e.shape;
        if (shape == 'Marker') {
            let lat = e.marker._latlng.lat;
            let lng = e.marker._latlng.lng;
            $('#lat').val(lat);
            $('#lng').val(lng);
            mymap.pm.disableDraw('Marker', {
                snappable: true,
                snapDistance: 20,
            });
            cek = 1;
            mymap.pm.addControls({
                editMode: true,
                drawMarker: false,
                removalMode: true,
            });

            e.marker.on('pm:edit', ({layer}) => {
                $('#lat').val(layer._latlng.lat);
                $('#lng').val(layer._latlng.lng);
            });

            e.marker.on('pm:remove', ({layer}) => {
                $('#lat').val('');
                $('#lng').val('');
                mymap.pm.addControls({
                    editMode: false,
                    drawMarker: true,
                    removalMode: false,
                });
                cek = 0;
            });
        }
    });
</script>
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Map</h6>
                    </div>
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Data Tempat Wisata</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tempatwisata.store') }}" id="form-desa" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="desa">Lokasi Desa</label>
                                <select class="form-control" data-live-search="true" id="datadesa" rows="3" name="desa" required>
                                  <option value="" >Pilih desa</option>
                                    @foreach ($desa as $d)
                                        <option value="{{$d->id}}">{{$d->nama_desa}}</option>
                                    @endforeach
                                </select>
                                <small style="color: red">
                                    @error('datadesa')
                                        {{$message}}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="">Foto Tempat Wisata</label>
                                <div>
                                    <div align="center" class='col'>
                                        <img src="{{asset('img/tempatwisata.png')}}" class="mb-3" style="border:solid #000 3px;height:60%;width:80%;" id="propic">
                                    </div>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fototempatwisata" name="fototempatwisata" onchange="this.nextElementSibling.innerText = this.files[0].name">
                                    <label for="fototempatwisata" class="custom-file-label foto">.jpg/.png</label>
                                    <small style="color: red">
                                        @error('fototempatwisata')
                                            {{$message}}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Tempat Wisata</label>
                                <input type="text" class="form-control" name="nama_tempat_wisata" placeholder="Masukkan nama tempat wisata" required value="{{$errors->any() ? old('nama_tempat_wisata') : ''}}">
                                <small style="color: red">
                                    @error('nama_tempat_wisata')
                                        {{$message}}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="">Latitude</label>
                                <input type="text" class="form-control" name="lat" id="lat" readonly required value="{{$errors->any() ? old('lat') : ''}}">
                                <small style="color: red">
                                    @error('lat')
                                        {{$message}}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="">Longitude</label>
                                <input type="text" class="form-control" name="lng" id="lng" readonly required value="{{$errors->any() ? old('lng') : ''}}">
                                <small style="color: red">
                                    @error('lng')
                                        {{$message}}
                                    @enderror
                                </small>
                            </div> 
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" class="form-control" name="alamat" placeholder="Masukkan alamat tempatwisata" required value="{{$errors->any() ? old('alamat') : ''}}">
                                <small style="color: red">
                                    @error('alamat')
                                        {{$message}}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="">Telepon</label>
                                <input type="text" class="form-control" name="telepon" placeholder="Masukkan telepon tempatwisata" required value="{{$errors->any() ? old('telepon') : ''}}">
                                <small style="color: red">
                                    @error('telepon')
                                        {{$message}}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <textarea placeholder="Masukan Keterangan" name="keterangan" cols="30" rows="4" class="form-control" required>{{$errors->any() ? old('keterangan') : ''}}</textarea>
                                <small style="color: red">
                                    @error('keterangan')
                                        {{$message}}
                                    @enderror
                                </small>
                            </div>                       
                            <span><button style="margin-right:4px" type="submit" class="btn btn-success float-left"><i class="fas fa-save"></i> Simpan Data</button></span>
                        <a href="/admin/potensi/tempatwisata"><button type="button" class="btn btn-danger float-left mr-2"><i class="fas fa-times"></i> Kembali</button></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection