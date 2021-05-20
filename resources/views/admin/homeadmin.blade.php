@extends('adminlayout.layout')
@section('title')
Dashboard
@endsection
@section('header_title')
<i class="nav-icon fas fa-tachometer-alt"></i> Dashboard
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href=""></a>Dashboard Admin</li>
    <li class="breadcrumb-item active"><a href=""></a>Peta Keseluruhan</li>
@endsection
@section('add_css')
  <style>
    .sekolah .leaflet-popup-tip,
      .sekolah .leaflet-popup-content-wrapper {
          background: #124429;
          color: #ffffff;
      }
      .pasar .leaflet-popup-tip,
      .pasar .leaflet-popup-content-wrapper {
          background: #291749;
          color: #ffffff;
      }
      .ibadah .leaflet-popup-tip,
      .ibadah .leaflet-popup-content-wrapper {
          background: #008b8b;
          color: #ffffff;
      }
      .wisata .leaflet-popup-tip,
      .wisata .leaflet-popup-content-wrapper {
          background: #614b00;
          color: #ffffff;
      }
    button {
      position: absolute;
      top: 150px;
      left: 29px;
      
      background-color: #fff;
      font-size: 1.2em;
      border:0;
      box-shadow: 0 1px 5px rgba(0,0,0,0.65);
      border-radius: 4px;
      color: black;
      z-index: 1100;
    }
    #map { height: 500px; }
  </style>
@endsection
@section('add_js')
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
  $(document).ready(function() {
    $('#locate').click( function() {
      mymap.locate({setView: true, maxZoom: 16});
    });
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
  function loadDataDesa(id){
        $.ajax({
            url: "/admin/loadDataDesa/"+id,
            method: 'get',
            success: function(result){
                console.log(result);
                $("#jumlah_sekolah").text("Jumlah Sekolah : " + result.jumlah_sekolah);
                $("#jumlah_pasar").text("Jumlah Pasar : " + result.jumlah_pasar);
                $("#jumlah_ibadah").text("Jumlah Tempat Ibadah : " + result.jumlah_ibadah);
                $("#jumlah_wisata").text("Jumlah Tempat Wisata : " + result.jumlah_wisata);
                $("#nama_desa").text("Nama Desa: "+result.desa['nama_desa']);
                $("#modalDesa").modal('show');    
            }
        });
    }
  var desa = {!! json_encode($desa->toArray()) !!}
        desa.forEach(element => {
            var cor = jQuery.parseJSON(element['batas_desa']);
            var id = jQuery.parseJSON(element['id']);
            var path = initializePolygon(cor);
            var pathLine = L.polygon(path, {
                id: element['id'],
                color: element['warna_batas'],
                fillColor: element['warna_batas'],
                fillOpacity: 0.4,
                nama: element['nama_desa'],
            }).addTo(mymap);

            pathLine.on('click', function(e) {
              loadDataDesa(e.target.options.id);
            } );
          
  });
  var popupsekolah =
  {
  'maxWidth': '500',
  'className' : 'sekolah'
  }
  var popuppasar =
  {
  'maxWidth': '1000',
  'className' : 'pasar'
  }
  var popupwisata =
  {
  'maxWidth': '1000',
  'className' : 'wisata'
  }
  var popupibadah =
  {
  'maxWidth': '1000',
  'className' : 'ibadah'
  }
  var schoolIcon = L.icon({
    iconUrl: '/assets/marker/schools.png',

    iconSize:     [20, 30], 
    iconAnchor:   [16, 32], 
    popupAnchor:  [0, -16] 
  });
  var pasarIcon = L.icon({
    iconUrl: '/assets/marker/retail-stores.png',

    iconSize:     [20, 30], 
    iconAnchor:   [16, 32], 
    popupAnchor:  [0, -16] 
  });
  var tempatWisataIcon = L.icon({
    iconUrl: '/assets/marker/vacant-land.png',

    iconSize:     [20, 30], 
    iconAnchor:   [16, 32], 
    popupAnchor:  [0, -16] 
  });
  var tempatIbadahIcon = L.icon({
    iconUrl: '/assets/marker/religious-organizations.png',

    iconSize:     [20, 30], 
    iconAnchor:   [16, 32], 
    popupAnchor:  [0, -16] 
  });
  let sekolah = {!! json_encode($sekolah) !!}
    sekolah.forEach(element => {
        let markerSekolah = L.marker([element.lat, element.lng], {
            icon: schoolIcon,
        }).bindPopup().addTo(mymap);
        var msgSekolah = "<ul class='list-unstyled'><li class='fw-bold text-center mb-2'>"+element['nama_sekolah']+"</li><li align='center'><img style='display: block;margin-left: auto;margin-right: auto;width: 50%;' src='../img/"+element['foto']+"'></li><li>Jenjang: "+element['jenis']+"</li><li>Alamat: "+element['alamat']+"</li><li><a style='margin-top:7px;display: block;margin-left: auto;margin-right: auto;' class='btn btn-primary btn-sm text-white' action='/admin/potensi/sekolah/"+element['id']+"'>Lihat Detail</a></li></ul>"
        markerSekolah.bindPopup(msgSekolah, popupsekolah);
        markerSekolah.on('click', function() {
            markerSekolah.openPopup();
        });
    });
    let pasar = {!! json_encode($pasar) !!}
    pasar.forEach(element => {
        let markerPasar = L.marker([element.lat, element.lng], {
            icon: pasarIcon,
        }).bindPopup().addTo(mymap);
        var msgPasar = "<ul class='list-unstyled'><li class='fw-bold text-center mb-2'>"+element['nama_pasar']+"</li><li align='center'><img style='display: block;margin-left: auto;margin-right: auto;width: 50%;' src='../img/"+element['foto']+"'></li><li>No Telepon: "+element['telepon']+"</li><li>Alamat: "+element['alamat']+"</li><li><a style='margin-top:7px;display: block;margin-left: auto;margin-right: auto;' class='btn btn-primary btn-sm text-white' href='/admin/potensi/pasar/"+element['id']+"'>Lihat Detail</a></li></ul>"
        markerPasar.bindPopup(msgPasar, popuppasar);
        markerPasar.on('click', function() {
            markerPasar.openPopup();
        });
    });
    let tempatibadah = {!! json_encode($tempatibadah) !!}
    tempatibadah.forEach(element => {
        let markerTempatIbadah = L.marker([element.lat, element.lng], {
            icon: tempatIbadahIcon,
        }).bindPopup().addTo(mymap);
        var msgTempatIbadah = "<ul class='list-unstyled'><li class='fw-bold text-center mb-2'>"+element['nama_tempat_ibadah']+"</li><li align='center'><img style='display: block;margin-left: auto;margin-right: auto;width: 50%;' src='../img/"+element['foto']+"'></li><li>Agama: "+element['agama']+"</li><li>Alamat: "+element['alamat']+"</li><li><a style='margin-top:7px;display: block;margin-left: auto;margin-right: auto;' class='btn btn-primary btn-sm text-white' href='/admin/potensi/tempatibadah/"+element['id']+"'>Lihat Detail</a></li></ul>"
        markerTempatIbadah.bindPopup(msgTempatIbadah, popupibadah);
        markerTempatIbadah.on('click', function() {
            markerTempatIbadah.openPopup();
        });
    });
    let tempatwisata = {!! json_encode($tempatwisata) !!}
    tempatwisata.forEach(element => {
        let markerTempatWisata = L.marker([element.lat, element.lng], {
            icon: tempatWisataIcon,
        }).bindPopup().addTo(mymap);
        var msgTempatWisata = "<ul class='list-unstyled'><li class='fw-bold text-center mb-2'>"+element['nama_tempat_wisata']+"</li><li align='center'><img style='display: block;margin-left: auto;margin-right: auto;width: 50%;' src='../img/"+element['foto']+"'></li><li>No Telepon: "+element['telepon']+"</li><li>Alamat: "+element['alamat']+"</li><li><a style='display: block;margin-left: auto;margin-right: auto;margin-top:5px;' class='btn btn-primary btn-sm text-white' href='/admin/potensi/tempatwisata/"+element['id']+"'>Lihat Detail</a></li></ul>"
        markerTempatWisata.bindPopup(msgTempatWisata, popupwisata);
        markerTempatWisata.on('click', function() {
            markerTempatWisata.openPopup();
        });
    });
</script>
@endsection
@section('content')
<section class="content">
  <div class="container-fluid">
  <div class="col-lg-12">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h5 class="m-0">Peta Potensi Desa Keseluruhan</h5>
      </div>
      <div class="card-body">
        <div id="map"></div>
        <button id='locate'>
          <i class="fas fa-crosshairs"></i>
        </button>
      </div>
    </div>
  </div>
  
</section>
<div class="modal fade" id="modalDesa">
  <div class="modal-dialog">
    <div class="modal-content">
          <!--Header-->
          <div class="modal-header">
            <h3 style="font-style: bold" class="modal-title" id="nama_desa"></h3>
          </div>
          <!--Body-->
          <div class="modal-body">
              <div class="text-left mt-3 ml-1">
                  <p id="jumlah_pasar"></p>
                  <p id="jumlah_sekolah"></p>
                  <p id="jumlah_ibadah"></p>
                  <p id="jumlah_wisata"></p>
              </div>
          </div>
          <!--Footer-->
          <div class="modal-footer justify-content-center">
              <a type="button" class="btn btn-danger" data-dismiss="modal">Tutup</a>
          </div>
      </div>
  <!--/.Content-->
  </div>
</div>
@endsection