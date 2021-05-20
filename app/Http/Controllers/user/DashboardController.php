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
}
