<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Desa;
use App\Sekolah;
use App\TempatIbadah;
use App\TempatWisata;
use App\Pasar;
class DashboardController extends Controller
{
    public function about(){
        return view('user.about');
    }
    public function dashboard(){
        $desa = Desa::get();
        $sekolah = Sekolah::get();
        $pasar = Pasar::get();
        $tempatwisata = TempatWisata::get();
        $tempatibadah = TempatIbadah::get();
        return view('user.home',compact('desa','sekolah','pasar','tempatwisata','tempatibadah'));
    }

    public function loadDataDesa($id){
        $desa = Desa::find($id);
        $jumlah_sekolah = Sekolah::where('id_desa', $id)->count();
        $jumlah_pasar = Pasar::where('id_desa', $id)->count();
        $jumlah_ibadah = TempatIbadah::where('id_desa', $id)->count();
        $jumlah_wisata = TempatWisata::where('id_desa', $id)->count();
        return response()->json(['success' => 'Berhasil', 'desa' => $desa, 'jumlah_pasar' => $jumlah_pasar , 'jumlah_sekolah' => $jumlah_sekolah, 'jumlah_ibadah' => $jumlah_ibadah, 'jumlah_wisata' => $jumlah_wisata]);
    }

    public function loadDataSekolah($id){
        $sekolah = Sekolah::find($id);
        $cek = Desa::where('id',$sekolah->id_desa)->first();
        $list = Sekolah::where('id_desa',$cek->id)->get();
        $desa = Desa::get();
        return view('user.detailsekolah',compact('desa','sekolah','list'));
    }
    public function loadDataPasar($id){
        $pasar = Pasar::find($id);
        $cek = Desa::where('id',$pasar->id_desa)->first();
        $list = Pasar::where('id_desa',$cek->id)->get();
        $desa = Desa::get();
        return view('user.detailpasar',compact('desa','pasar','list'));
    }

    public function loadDataTempatIbadah($id){
        $tempatibadah = TempatIbadah::find($id);
        $cek = Desa::where('id',$tempatibadah->id_desa)->first();
        $list = TempatIbadah::where('id_desa',$cek->id)->get();
        $desa = Desa::get();
        return view('user.detailtempatibadah',compact('desa','tempatibadah','list'));
    }

    public function loadDataTempatWisata($id){
        $tempatwisata = TempatWisata::find($id);
        $cek = Desa::where('id',$tempatwisata->id_desa)->first();
        $list = TempatWisata::where('id_desa',$cek->id)->get();
        $desa = Desa::get();
        return view('user.detailtempatwisata',compact('desa','tempatwisata','list'));
    }
}
