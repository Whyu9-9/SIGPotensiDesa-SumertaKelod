<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kabupaten;
use App\Admin;
use Illuminate\Support\Facades\Validator;

class KabupatenController extends Controller
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
            $kabupaten = Kabupaten::get();
            return view('admin.kabupaten.index', compact('kabupaten','profiledata'));
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
            return view('admin.kabupaten.create', compact('profiledata'));
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
            'nama_kabupaten' => 'required|unique:tb_kabupaten',
        ],$messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $kabupaten = new Kabupaten();
        $kabupaten->nama_kabupaten = $request->nama_kabupaten;
        $kabupaten->save();
        return redirect('admin/kabupaten')->with('success', 'Data Kabupaten Berhasil Ditambahkan');
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
    public function edit($id, Request $request)
    {
        if(!$request->session()->has('admin')){
            return redirect('/login')->with('expired','Session Telah Berakhir');
        }else{
            $user = $request->session()->get('admin.data');
            $profiledata = Admin::where('username','=', $user["username"])->first();
            $kabupaten = Kabupaten::find($id);
            return view('admin.kabupaten.edit', compact('kabupaten','profiledata'));
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
            'nama_kabupaten' => 'required',
        ],$messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $kabupaten = Kabupaten::find($id);
        $kabupaten->nama_kabupaten = $request->nama_kabupaten;
        $kabupaten->update();
        return redirect('admin/kabupaten')->with('success', 'Data Kabupaten Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kabupaten = Kabupaten::where('id',$id)->first();
        $kabupaten->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data Kabupaten');
    }
}
