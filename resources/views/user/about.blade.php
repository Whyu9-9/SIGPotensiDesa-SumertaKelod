@extends('userlayout.layout')
@section('content')
<div class="container">
    <div class="jumbotron">
        <div class="container">
            <img style="display: block;margin-left: auto;margin-right: auto;width: 20%;border:solid #000 3px;" src="{{asset('img/1618519185_4x6.jpg')}}" class="mb-3" id="propic">
            <h1 align="center"><b>SIG Potensi Desa</b></h1>
            <h5 align="center">v 1.0.0</h5>
            <p align="center">
                Developed by Wahyu.
            </p>
            <p align="center">
                <a style="background-color: black;color:white;" class="btn" href="https://github.com/Whyu9-9" target="_blank"><i class="fab fa-github"></i> My Github</a>
            </p>
            <br>
            <div class="col-xs-12">
                <div class="row point-info">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 align="center">Technology Used</h3>
                        </div>
                        <div class="panel-body">
                            <table align="center" style="width: 60%" class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col">Technology</th>
                                    <th scope="col">Version</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>Laravel (Backend Framework)</td>
                                    <td>7.0</td>
                                  </tr>
                                  <tr>
                                    <td>jQuery</td>
                                    <td>1.10.2</td>
                                  </tr>
                                  <tr>
                                    <td>Bootstrap</th>
                                    <td>4.0</td>
                                  </tr>
                                  <tr>
                                    <td>Mapbox</th>
                                    <td>2.2.0</td>
                                  </tr>
                                  <tr>
                                    <td>Geoman</th>
                                    <td>2.11.1</td>
                                  </tr>
                                  <tr>
                                    <td>Leaflet</th>
                                    <td>1.7.1</td>
                                  </tr>
                                  <tr>
                                    <td>Admin LTE(Admin Dashboard)</th>
                                    <td>3.0</td>
                                  </tr>
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection