<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TempatIbadah;
use App\Admin;
use App\Desa;
use Illuminate\Support\Facades\Validator;

class TempatIbadahController extends Controller
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
            $tempatibadah = TempatIbadah::get();
            return view('admin.tempatibadah.index', compact('tempatibadah','profiledata'));
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
            return view('admin.tempatibadah.create', compact('desa','profiledata'));
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
            'nama_tempat_ibadah' => 'required|unique:tb_tempat_ibadah',
            'desa' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'fototempatibadah' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'keterangan' => 'required',
        ],$messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $images = null;
        $tempatibadah = new TempatIbadah();
        if($request->file('fototempatibadah')){
            //simpan file
            $file = $request->file('fototempatibadah');
            $images = time()."_".$file->getClientOriginalName();
            $tempatibadah->foto = $images;

            $foto_upload = 'img';
            $file->move($foto_upload,$images);
        }
        $tempatibadah->nama_tempat_ibadah = $request->nama_tempat_ibadah;
        $tempatibadah->id_potensi = 3;
        $tempatibadah->id_desa = $request->desa;
        $tempatibadah->agama = $request->agama;
        $tempatibadah->alamat = $request->alamat;
        $tempatibadah->lat = $request->lat;
        $tempatibadah->lng = $request->lng;
        $tempatibadah->keterangan = $request->keterangan;
        $tempatibadah->save();
        return redirect('admin/potensi/tempatibadah')->with('success', 'Data Tempat Ibadah Berhasil Ditambahkan');
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
            $tempatibadah = TempatIbadah::find($id);
            $desa = Desa::get();
            return view('admin.tempatibadah.show', compact('tempatibadah','desa','profiledata'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if(!$request->session()->has('admin')){
            return redirect('/login')->with('expired','Session Telah Berakhir');
        }else{
            $user = $request->session()->get('admin.data');
            $profiledata = Admin::where('username','=', $user["username"])->first();
            $tempatibadah = TempatIbadah::find($id);
            $desa = Desa::get();
            return view('admin.tempatibadah.edit', compact('tempatibadah','desa','profiledata'));
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
            'nama_tempat_ibadah' => 'required',
            'desa' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'keterangan' => 'required',
        ],$messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $images = null;
        $tempatibadah = TempatIbadah::find($id);
        if($request->file('fototempatibadah')){
            //simpan file
            $file = $request->file('fototempatibadah');
            $images = time()."_".$file->getClientOriginalName();
            $tempatibadah->foto = $images;

            $foto_upload = 'img';
            $file->move($foto_upload,$images);
        }else{
            $tempatibadah->foto = $tempatibadah->foto;
        }
        $tempatibadah->nama_tempat_ibadah = $request->nama_tempat_ibadah;
        $tempatibadah->id_potensi = 3;
        $tempatibadah->id_desa = $request->desa;
        $tempatibadah->agama = $request->agama;
        $tempatibadah->alamat = $request->alamat;
        $tempatibadah->lat = $request->lat;
        $tempatibadah->lng = $request->lng;
        $tempatibadah->keterangan = $request->keterangan;
        $tempatibadah->update();
        return redirect('admin/potensi/tempatibadah')->with('success', 'Data Tempat Ibadah Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tempatibadah = TempatIbadah::where('id',$id)->first();
        $tempatibadah->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data Tempat Ibadah');
    }
}
