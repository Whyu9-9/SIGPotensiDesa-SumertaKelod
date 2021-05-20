<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pasar;
use App\Admin;
use App\Desa;
use Illuminate\Support\Facades\Validator;

class PasarController extends Controller
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
            $pasar = Pasar::get();
            return view('admin.pasar.index', compact('pasar','profiledata'));
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
            return view('admin.pasar.create', compact('desa','profiledata'));
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
            'nama_pasar' => 'required|unique:tb_pasar',
            'desa' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'fotopasar' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'keterangan' => 'required',
        ],$messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $images = null;
        $pasar = new Pasar();
        if($request->file('fotopasar')){
            //simpan file
            $file = $request->file('fotopasar');
            $images = time()."_".$file->getClientOriginalName();
            $pasar->foto = $images;

            $foto_upload = 'img';
            $file->move($foto_upload,$images);
        }
        $pasar->nama_pasar = $request->nama_pasar;
        $pasar->id_potensi = 4;
        $pasar->id_desa = $request->desa;
        $pasar->alamat = $request->alamat;
        $pasar->telepon = $request->telepon;
        $pasar->lat = $request->lat;
        $pasar->lng = $request->lng;
        $pasar->keterangan = $request->keterangan;
        $pasar->save();
        return redirect('admin/potensi/pasar')->with('success', 'Data Pasar Berhasil Ditambahkan');
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
            $pasar = Pasar::find($id);
            return view('admin.pasar.show', compact('pasar','desa','profiledata'));
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
            $pasar = Pasar::find($id);
            return view('admin.pasar.edit', compact('pasar','desa','profiledata'));
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
            'nama_pasar' => 'required',
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
        $pasar = Pasar::find($id);
        if($request->file('fotopasar')){
            //simpan file
            $file = $request->file('fotopasar');
            $images = time()."_".$file->getClientOriginalName();
            $pasar->foto = $images;

            $foto_upload = 'img';
            $file->move($foto_upload,$images);
        }else{
            $pasar->foto = $pasar->foto;
        }
        $pasar->nama_pasar = $request->nama_pasar;
        $pasar->id_potensi = 4;
        $pasar->id_desa = $request->desa;
        $pasar->alamat = $request->alamat;
        $pasar->telepon = $request->telepon;
        $pasar->lat = $request->lat;
        $pasar->lng = $request->lng;
        $pasar->keterangan = $request->keterangan;
        $pasar->update();
        return redirect('admin/potensi/pasar')->with('success', 'Data Pasar Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pasar = pasar::where('id',$id)->first();
        $pasar->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data Pasar');
    }
}
