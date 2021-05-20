@extends('adminlayout.layout')
@section('title')
Manajemen Desa
@endsection
@section('header_title')
<i class="nav-icon fas fa-map-signs"></i> Manajemen Desa
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/admin/desa">Manajemen Desa</a></li>
    <li class="breadcrumb-item active"><a href="/admin/desa"></a>Edit Desa</li>
@endsection
@section('add_css')
    <style>
        #map { height: 730px; }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
@endsection
@section('add_js')
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
    <script>
    $(document).ready(function(e){
        $('#kabupaten').change(function(e){
            var id_kab = $('#kabupaten').val()
            if(id_kab){
                jQuery.ajax({
                    url: '/admin/kecamatan/'+id_kab,
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                        $('#kecamatan').empty();
                        $.each(data, function(key,value){
                            $('#kecamatan').append('<option value="'+key+'">'+value+'</option>');
                        });
                    },
                });
            }else{
                $('#kecamatan').empty();
            }
        });
    });
    </script>
    <script>
        $(document).ready(function(e){
            $('#kabupaten option:selected').ready(function(e){
                var id_kab = $('#kabupaten').val()
                var test = {!!json_encode($desa->kecamatan->id)!!};
                if(id_kab){
                    jQuery.ajax({
                        url: '/admin/kecamatan/'+id_kab,
                        type: "GET",
                        dataType: "json",
                        success:function(data){
                            $('#kecamatan').empty();
                            $.each(data, function(key,value){
                                if(key==test){
                                    $('#kecamatan').append('<option value="'+key+'" selected>'+value+'</option>');
                                }else{
                                    $('#kecamatan').append('<option value="'+key+'">'+value+'</option>');
                                }
                            });
                        },
                    });
                }else{
                    $('#kecamatan').empty();
                }
            });
        });
        </script>
    <script>
        let cek = 1;
        let pathLine;
        var dataline = [];
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
                var m = null;
                this.eachLayer(function (layer) {
                    if (layer instanceof L.Marker) {
                        if (layer.options.id === id) {
                            m = layer;
                        }
                    }
                });
                return m;
            }
        });
        
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
        var path = initializePolygon(koor);
        pathLine = L.polygon(path, {
            color: batas['warna_batas'],
            fillColor: batas['warna_batas'],
            fillOpacity: 0.4,
        }).addTo(mymap);

        mymap.pm.addControls({  
            position: 'topleft',
            drawCircle: false,
            drawMarker: false,
            drawCircleMarker:false,
            drawRectangle: false,
            drawPolyline: false,
            dragMode:false,
            cutPolygon: false,
            editMode: true,
            removalMode: true,
        });

        $('#set-data').on('click', function(){
            if(cek == 0){
                mymap.pm.enableDraw('Polygon', {
                    snappable: true,
                    snapDistance: 20,
                });
            }
        });

        $('#color-picker').on('change', function(){
            var color = $(this).val();
            mymap.pm.setPathOptions({
                color: color,
                fillColor: color,
                fillOpacity: 0.4,
            });
        });

        mymap.on('pm:drawstart', ({ workingLayer }) => {
            dataline = [];
            workingLayer.on('pm:vertexadded', e => {
                var c = {};
                c['lat'] = e.latlng.lat;
                c['lng'] = e.latlng.lng;
                dataline.push(
                    c
                );
            });
        });

        mymap.on('pm:remove', e=> {
            $('#batas').val("");
            mymap.pm.addControls({  
                position: 'topleft',
                drawPolygon: true,
                editMode: false,
                removalMode: false,
            });
            cek = 0;
        });
        
        mymap.on('pm:create', e => {
            console.log(e);
            $('#batas').val(JSON.stringify(dataline));
            e.layer.on('pm:update', e => {
                var id = e.layer.options.id;
                    var cs = e.layer._latlngs;
                    let c = {};
                    dataline = [];
                    cs.forEach(function(latlng){
                        for(let m = 0; m<latlng.length; m++){
                            console.log(latlng[m]);
                            dataline.push(
                                latlng[m]
                            )
                        }
                    });
                $('#batas').val(JSON.stringify(dataline));
            });
            mymap.pm.addControls({  
                position: 'topleft',
                drawPolygon: false,
                editMode: true,
                removalMode: false,
            });
            cek = 1;
        });

        pathLine.on('pm:update', e => {
            var id = e.layer.options.id;
                    var cs = e.layer._latlngs;
                    let c = {};
                    dataline = [];
                    cs.forEach(function(latlng){
                        for(let m = 0; m<latlng.length; m++){
                            console.log(latlng[m]);
                            dataline.push(
                                latlng[m]
                            )
                        }
                    });
                $('#batas').val(JSON.stringify(dataline));
        });

        $(document).ready(function(){
            $('#desa').addClass('active');
            let color = $('#color-picker').val();
            mymap.pm.setPathOptions({
                color: color,
                fillColor: color,
                fillOpacity: 0.4,
            });
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
                    <h6 class="m-0 font-weight-bold text-primary">Edit Data Desa</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('desa.update', $desa->id)}}" id="form-desa" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label for="kabupaten">Kabupaten/Kota</label>
                            <select name="kabupaten" id="kabupaten" class="form-control select2" required>
                                <option>Pilih Kabupaten</option>
                                @foreach ($kabupaten as $k)
                                    <option value="{{$k->id}}" {{ $desa->kecamatan->id_kabupaten==$k->id ? 'selected' : '' }}>{{$k->nama_kabupaten}}</option>
                                @endforeach
                            </select>
                            <small style="color: red">
                                @error('kabupaten')
                                    {{$message}}
                                @enderror
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="form-control select2" required>
                                <option>Pilih Kecamatan</option>
                                <option value=""></option>
                            </select>
                            <small style="color: red">
                                @error('kecamatan')
                                    {{$message}}
                                @enderror
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Desa</label>
                            <input type="text" class="form-control" name="nama_desa" placeholder="Masukkan nama desa" required value="{{$desa->nama_desa}}">
                            <small style="color: red">
                                @error('nama_desa')
                                    {{$message}}
                                @enderror
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea placeholder="Masukan Keterangan" name="keterangan" cols="30" rows="4" class="form-control" required>{{$desa->keterangan}}</textarea>
                            <small style="color: red">
                                @error('keterangan')
                                    {{$message}}
                                @enderror
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="">Warna Batas</label>
                            <input type="color" class="form-control" name="warna_batas" id="color-picker" required value="{{$desa->warna_batas}}">
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
                            <small style="color: red">
                                @error('batas_desa')
                                    {{$message}}
                                @enderror
                            </small>
                        </div>
                        <span><button style="margin-right:4px" type="submit" class="btn btn-primary float-left"><i class="fas fa-save"></i> Edit Desa</button></span>
                        <a href="/admin/desa"><button type="button" class="btn btn-danger float-left mr-2"><i class="fas fa-times"></i> Cancel</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection