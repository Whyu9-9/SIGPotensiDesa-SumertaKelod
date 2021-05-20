<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sekolah;
use App\Admin;
use App\Desa;
use Illuminate\Support\Facades\Validator;

class SekolahController extends Controller
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
            $sekolah = Sekolah::get();
            return view('admin.sekolah.index', compact('sekolah','profiledata'));
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
            return view('admin.sekolah.create', compact('desa','profiledata'));
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
            'nama_sekolah' => 'required|unique:tb_sekolah',
            'desa' => 'required',
            'jenis_sekolah' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'fotosekolah' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'keterangan' => 'required',
        ],$messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $images = null;
        $sekolah = new Sekolah();
        if($request->file('fotosekolah')){
            //simpan file
            $file = $request->file('fotosekolah');
            $images = time()."_".$file->getClientOriginalName();
            $sekolah->foto = $images;

            $foto_upload = 'img';
            $file->move($foto_upload,$images);
        }
        $sekolah->nama_sekolah = $request->nama_sekolah;
        $sekolah->id_potensi = 1;
        $sekolah->id_desa = $request->desa;
        $sekolah->jenis = $request->jenis_sekolah;
        $sekolah->alamat = $request->alamat;
        $sekolah->telepon = $request->telepon;
        $sekolah->lat = $request->lat;
        $sekolah->lng = $request->lng;
        $sekolah->keterangan = $request->keterangan;
        $sekolah->save();
        return redirect('admin/potensi/sekolah')->with('success', 'Data Sekolah Berhasil Ditambahkan');
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
            $sekolah = Sekolah::find($id);
            $desa = Desa::get();
            return view('admin.sekolah.show', compact('sekolah','desa','profiledata'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        if(!$request->session()->has('admin')){
            return redirect('/login')->with('expired','Session Telah Berakhir');
        }else{
            $user = $request->session()->get('admin.data');
            $profiledata = Admin::where('username','=', $user["username"])->first();
            $sekolah = Sekolah::find($id);
            $desa = Desa::get();
            return view('admin.sekolah.edit', compact('sekolah','desa','profiledata'));
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
            'nama_sekolah' => 'required',
            'desa' => 'required',
            'jenis_sekolah' => 'required',
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
        $sekolah = Sekolah::find($id);
        if($request->file('fotosekolah')){
            //simpan file
            $file = $request->file('fotosekolah');
            $images = time()."_".$file->getClientOriginalName();
            $sekolah->foto = $images;

            $foto_upload = 'img';
            $file->move($foto_upload,$images);
        }else{
            $sekolah->foto = $sekolah->foto;
        }
        $sekolah->nama_sekolah = $request->nama_sekolah;
        $sekolah->id_potensi = 1;
        $sekolah->id_desa = $request->desa;
        $sekolah->jenis = $request->jenis_sekolah;
        $sekolah->alamat = $request->alamat;
        $sekolah->telepon = $request->telepon;
        $sekolah->lat = $request->lat;
        $sekolah->lng = $request->lng;
        $sekolah->keterangan = $request->keterangan;
        $sekolah->update();
        return redirect('admin/potensi/sekolah')->with('success', 'Data Sekolah Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sekolah = Sekolah::where('id',$id)->first();
        $sekolah->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data Sekolah');
    }
}
