<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Desa;
use App\Admin;
use App\Kabupaten;
use Illuminate\Support\Facades\Validator;
class DesaController extends Controller
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
            $desa = Desa::get();
            return view('admin.desa.index', compact('desa','profiledata'));
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
            $kabupaten = Kabupaten::get();
            return view('admin.desa.create', compact('kabupaten','desa','profiledata'));
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
            'nama_desa' => 'required|unique:tb_desa',
            'batas_desa' => 'required',
            'warna_batas' => 'required',
            'kecamatan' => 'required|numeric',
            'kabupaten' => 'required|numeric',
            'keterangan' => 'required',
        ],$messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $desa = new Desa();
        $desa->nama_desa = $request->nama_desa;
        $desa->batas_desa = $request->batas_desa;
        $desa->warna_batas = $request->warna_batas;
        $desa->id_kecamatan = $request->kecamatan;
        $desa->keterangan = $request->keterangan;
        $desa->save();
        return redirect('admin/desa')->with('success', 'Data Desa Berhasil Ditambahkan');
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
            $desa = Desa::find($id);
            $kabupaten = Kabupaten::get();
            return view('admin.desa.show', compact('kabupaten','desa','profiledata'));
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
            $desa = Desa::find($id);
            $kabupaten = Kabupaten::get();
            return view('admin.desa.edit', compact('kabupaten','desa','profiledata'));
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
            'nama_desa' => 'required',
            'batas_desa' => 'required',
            'warna_batas' => 'required',
            'kecamatan' => 'required|numeric',
            'kabupaten' => 'required|numeric',
            'keterangan' => 'required',
        ],$messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $desa = Desa::find($id);
        $desa->nama_desa = $request->nama_desa;
        $desa->batas_desa = $request->batas_desa;
        $desa->warna_batas = $request->warna_batas;
        $desa->id_kecamatan = $request->kecamatan;
        $desa->keterangan = $request->keterangan;
        $desa->update();
        return redirect('admin/desa')->with('success', 'Data Desa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $desa = Desa::where('id',$id)->first();
        $desa->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data Desa');
    }
}
