<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kecamatan;
use App\Kabupaten;
use App\Admin;
use Illuminate\Support\Facades\Validator;

class KecamatanController extends Controller
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
            $kecamatan = Kecamatan::get();
            return view('admin.kecamatan.index', compact('kecamatan','profiledata'));
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
            $kabupaten = Kabupaten::get();
            return view('admin.kecamatan.create', compact('kabupaten','profiledata'));
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
            'nama_kecamatan' => 'required|unique:tb_kecamatan',
            'id_kabupaten' => 'required',
        ],$messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $kecamatan = new Kecamatan();
        $kecamatan->nama_kecamatan = $request->nama_kecamatan;
        $kecamatan->id_kabupaten = $request->id_kabupaten;
        $kecamatan->save();
        return redirect('admin/kecamatan')->with('success', 'Data Kecamatan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            $kabupaten = Kabupaten::get();
            $kecamatan = Kecamatan::find($id);
            return view('admin.kecamatan.edit', compact('kabupaten','kecamatan','profiledata'));
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
            'nama_kecamatan' => 'required',
            'id_kabupaten' => 'required',
        ],$messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $kecamatan = Kecamatan::find($id);
        $kecamatan->nama_kecamatan = $request->nama_kecamatan;
        $kecamatan->id_kabupaten = $request->id_kabupaten;
        $kecamatan->update();
        return redirect('admin/kecamatan')->with('success', 'Data Kecamatan Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kecamatan = Kecamatan::where('id',$id)->first();
        $kecamatan->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data Kecamatan');
    }

    public function getKecamatan($id){
        $kecamatan = Kecamatan::where('id_kabupaten','=',$id)->pluck('nama_kecamatan','id');
        return json_encode($kecamatan);
    }
}
