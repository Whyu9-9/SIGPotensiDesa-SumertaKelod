<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Admin;

class AuthController extends Controller
{
    public function loginpage(Request $request){
        $cekadmin = $request->session()->get('admin.data');
        if(!is_null($cekadmin)){
            return redirect('/admin/dashboard');
        }else{
            return view('auth.login');
        }
    }

    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;

        if(!$request->session()->has('admin')){
            $idadmin = Admin::select('id')->where('username','=',$username)->first();
            $validadmin = Admin::where('username','=',$username)->first();
            if($validadmin!=null){
                if(Hash::check($password, $validadmin->password)){
                    $request->session()->put('admin',['data'=>$validadmin, 'check'=>'admin']);
                    $get = $request->session()->get('admin');
                    return redirect('/admin/dashboard');
                }else{
                    return redirect('/login')->with('alert','Password Salah!');
                }
            }else{
                return redirect('/login')->with('alert','Username Salah!');
            }
        }else{
            $cekad = $request->session()->get('admin.data');
            if(!is_null($cekad)){
                return redirect('/admin/dashboard');
            }
        }
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/login');
    }
}
