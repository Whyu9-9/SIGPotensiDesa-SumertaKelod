<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TempatWisata;
use App\Admin;
use App\Desa;
use Illuminate\Support\Facades\Validator;

class TempatWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->session()->has('admin')){
            return redirect('/login')->with('expired','Session Telah Berakhir');
        }else{
            $user = $request->session()->get('admin.data');
            $profiledata = Admin::where('username','=', $user["username"])->first();
            $tempatwisata = TempatWisata::get();
            return view('admin.tempatwisata.index', compact('tempatwisata','profiledata'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!$request->session()->has('admin')){
            return redirect('/login')->with('expired','Session Telah Berakhir');
        }else{
            $user = $request->session()->get('admin.data');
            $profiledata = Admin::where('username','=', $user["username"])->first();
            $desa = Desa::get();
            return view('admin.tempatwisata.create', compact('desa','profiledata'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Kolom :attribute Wajib Diisi!',
            'unique' => 'Kolom :attribute Tidak Boleh Sama!',
            'numeric' => 'Kolom :attribute wajib diisi!',
		];

        $validator = Validator::make($request->all(), [
            'nama_tempat_wisata' => 'required|unique:tb_tempat_wisata',
            'desa' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'fototempatwisata' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'keterangan' => 'required',
        ],$messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $images = null;
        $tempatwisata = new TempatWisata();
        if($request->file('fototempatwisata')){
            //simpan file
            $file = $request->file('fototempatwisata');
            $images = time()."_".$file->getClientOriginalName();
            $tempatwisata->foto = $images;

            $foto_upload = 'img';
            $file->move($foto_upload,$images);
        }
        $tempatwisata->nama_tempat_wisata = $request->nama_tempat_wisata;
        $tempatwisata->id_potensi = 2;
        $tempatwisata->id_desa = $request->desa;
        $tempatwisata->alamat = $request->alamat;
        $tempatwisata->telepon = $request->telepon;
        $tempatwisata->lat = $request->lat;
        $tempatwisata->lng = $request->lng;
        $tempatwisata->keterangan = $request->keterangan;
        $tempatwisata->save();
        return redirect('admin/potensi/tempatwisata')->with('success', 'Data Tempat Wisata Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if(!$request->session()->has('admin')){
            return redirect('/login')->with('expired','Session Telah Berakhir');
        }else{
            $user = $request->session()->get('admin.data');
            $profiledata = Admin::where('username','=', $user["username"])->first();
            $desa = Desa::get();
            $tempatwisata = TempatWisata::find($id);
            return view('admin.tempatwisata.show', compact('tempatwisata','desa','profiledata'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        if(!$request->session()->has('admin')){
            return redirect('/login')->with('expired','Session Telah Berakhir');
        }else{
            $user = $request->session()->get('admin.data');
            $profiledata = Admin::where('username','=', $user["username"])->first();
            $desa = Desa::get();
            $tempatwisata = TempatWisata::find($id);
            return view('admin.tempatwisata.edit', compact('tempatwisata','desa','profiledata'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'Kolom :attribute Wajib Diisi!',
            'unique' => 'Kolom :attribute Tidak Boleh Sama!',
            'numeric' => 'Kolom :attribute wajib diisi!',
		];

        $validator = Validator::make($request->all(), [
            'nama_tempat_wisata' => 'required',
            'desa' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'keterangan' => 'required',
        ],$messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $images = null;
        $tempatwisata = TempatWisata::find($id);
        if($request->file('fototempatwisata')){
            //simpan file
            $file = $request->file('fototempatwisata');
            $images = time()."_".$file->getClientOriginalName();
            $tempatwisata->foto = $images;

            $foto_upload = 'img';
            $file->move($foto_upload,$images);
        }else{
            $tempatwisata->foto = $tempatwisata->foto;
        }
        $tempatwisata->nama_tempat_wisata = $request->nama_tempat_wisata;
        $tempatwisata->id_potensi = 2;
        $tempatwisata->id_desa = $request->desa;
        $tempatwisata->alamat = $request->alamat;
        $tempatwisata->telepon = $request->telepon;
        $tempatwisata->lat = $request->lat;
        $tempatwisata->lng = $request->lng;
        $tempatwisata->keterangan = $request->keterangan;
        $tempatwisata->update();
        return redirect('admin/potensi/tempatwisata')->with('success', 'Data Tempat Wisata Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tempatwisata = TempatWisata::where('id',$id)->first();
        $tempatwisata->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data Tempat Wisata');
    }
}
