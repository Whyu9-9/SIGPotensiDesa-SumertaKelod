<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <title>SIG Potensi Desa | Peta Potensi Desa</title>
    <meta name="author" content="luckynvic@gmail.com" />
    <link href="{{asset('assets/p/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}"/>
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <script src="{{asset('leaflet/leaflet.js')}}"></script>
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
      #map { height: 100%;z-index:0;margin-top: -20px;margin-left: -100px;}
    </style>
    <link href="{{asset('assets/p/ext/customScroll/css/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/p/css/style.default.css')}}" rel="stylesheet" />
  </head>
  <body>
    <nav class="navbar navbar-default nav-fixed-top" role="navigation" id="app-nav-bar">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button
          type="button"
          class="navbar-toggle"
          data-toggle="collapse"
          data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">SIG Potensi Desa</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
          <li class="active">
            <a href="/">Home</a>
          </li>
          <li>
            <a href="about.html">About</a>
          </li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </nav>

    <div id="map"></div>
    <div class="visible-lg visible-md">
      <div id="sidemenu" class="well">
        <div style="margin:-10px;" class="panel-heading">
          <h4><i class="fas fa-map-marked"></i> List Data Desa</h4>
        </div>
        <div class="divider10"></div>
        <div class="list-group point-list-view">
          @foreach($desa as $d)
            <a href="#" class="list-group-item point-item">
              <h4 class="list-group-item-heading">{{$d->nama_desa}}</h4>
              <p class="list-group-item-text">Kecamatan: {{$d->kecamatan->nama_kecamatan}}</p>
            </a>
          @endforeach
        </div>
      </div>
    </div>
    <!-- Modal Desa -->
    <div class="modal fade left" id="modalDesa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-notify modal-info modal-side modal-top-left" role="document">
        <!--Content-->
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
    <!-- Modal Desa-->
    <!-- Bootstrap core JavaScript
        ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{asset('assets/p/js/jquery-1.10.2.min.js')}}"></script>
    <script src="{{asset('assets/p/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/p/ext/customScroll/js/jquery.mCustomScrollbar.min.js')}}"></script>
    <script src="{{asset('assets/p/ext/customScroll/js/jquery.mousewheel.min.js')}}"></script>
    <script src="{{asset('assets/p/js/application.js')}}"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
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
                url: "loadDataDesa/"+id,
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
      'maxWidth': '1000',
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
            var msgSekolah = "<ul class='list-unstyled'><li class='fw-bold text-center mb-2'>"+element['nama_sekolah']+"</li><li align='center'><img style='display: block;margin-left: auto;margin-right: auto;width: 50%;' src='../img/"+element['foto']+"'></li><li>Jenjang: "+element['jenis']+"</li><li>Alamat: "+element['alamat']+"</li><li><form action='/admin/potensi/sekolah/"+element['id']+"'><button style='margin-top:7px;display: block;margin-left: auto;margin-right: auto;' class='btn btn-primary btn-sm' type='submit'>Lihat Detail</button></form></li></ul>"
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
            var msgPasar = "<ul class='list-unstyled'><li class='fw-bold text-center mb-2'>"+element['nama_pasar']+"</li><li align='center'><img style='display: block;margin-left: auto;margin-right: auto;width: 50%;' src='../img/"+element['foto']+"'></li><li>No Telepon: "+element['telepon']+"</li><li>Alamat: "+element['alamat']+"</li><li><form action='/admin/potensi/pasar/"+element['id']+"'><button style='margin-top:7px;display: block;margin-left: auto;margin-right: auto;' class='btn btn-primary btn-sm' type='submit'>Lihat Detail</button></form></li></ul>"
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
            var msgTempatIbadah = "<ul class='list-unstyled'><li class='fw-bold text-center mb-2'>"+element['nama_tempat_ibadah']+"</li><li align='center'><img style='display: block;margin-left: auto;margin-right: auto;width: 50%;' src='../img/"+element['foto']+"'></li><li>Agama: "+element['agama']+"</li><li>Alamat: "+element['alamat']+"</li><li><form action='/admin/potensi/tempatibadah/"+element['id']+"'><button style='margin-top:7px;display: block;margin-left: auto;margin-right: auto;' class='btn btn-primary btn-sm' type='submit'>Lihat Detail</button></form></li></ul>"
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
            var msgTempatWisata = "<ul class='list-unstyled'><li class='fw-bold text-center mb-2'>"+element['nama_tempat_wisata']+"</li><li align='center'><img style='display: block;margin-left: auto;margin-right: auto;width: 50%;' src='../img/"+element['foto']+"'></li><li>No Telepon: "+element['telepon']+"</li><li>Alamat: "+element['alamat']+"</li><li><form action='/admin/potensi/tempatwisata/"+element['id']+"'><button style='margin-top:7px;display: block;margin-left: auto;margin-right: auto;' class='btn btn-primary btn-sm' type='submit'>Lihat Detail</button></form></li></ul>"
            markerTempatWisata.bindPopup(msgTempatWisata, popupwisata);
            markerTempatWisata.on('click', function() {
                markerTempatWisata.openPopup();
            });
        });
    </script>
    <script>
      (function ($) {
        $(".point-list-view").mCustomScrollbar({
          scrollButtons: {
            enable: true,
          },
          theme: "dark-thick",
          contentTouchScroll: true,
        });
      })(jQuery);
    </script>
  </body>
</html>
