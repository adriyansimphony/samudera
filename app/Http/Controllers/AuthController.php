<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function proseslogin(Request $request)
    {
        // $pass = 123;
        // echo Hash::make($pass);

        if (Auth::guard('karyawan')->attempt(['nik' => $request->nik, 'password' => $request->password])) {
            return redirect('/dashboard');
        } else {
            return redirect('/')->with(['warning' => 'Nik / Password Salah']);
        }
    }

    public function proseslogout(){
        if(Auth::guard('karyawan')->check()){
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }
    }

    public function proseslogoutadmin(){

        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }
    
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        }
    
        return redirect('/panel');
        // if(Auth::guard('user')->check()){
        //     Auth::guard('user')->logout();
        //     return redirect('/panel');
        // }
    }

    public function prosesloginadmin(Request $request)
    {
        // $pass = 123;
        // echo Hash::make($pass);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember'); // Cek apakah checkbox dicentang

        // Coba login dengan guard admin dulu
    if (Auth::guard('admin')->attempt($credentials, $remember)) {
        if ($remember) {
            Cookie::queue('remember_email', $request->email, 43200); // Simpan 30 hari
        } else {
            Cookie::queue(Cookie::forget('remember_email'));
        }
        return redirect('/panel/dashboardadmin');
    }

    // Jika gagal, coba login dengan guard user
    if (Auth::guard('user')->attempt($credentials, $remember)) {
        if ($remember) {
            Cookie::queue('remember_email', $request->email, 43200); 
        } else {
            Cookie::queue(Cookie::forget('remember_email'));
        }
        return redirect('/panel/dashboardadmin');
    }


        // if (Auth::guard('admin')->attempt($credentials, $remember)) {
        //     return redirect('/panel/dashboardadmin');
        // } elseif (Auth::guard('user')->attempt($credentials, $remember)) {
        //     return redirect('/panel/dashboardadmin');
        // }
    
        return redirect('/panel')->with(['warning' => 'Email atau Password Salah']);
        // if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
        //     return redirect('/panel/dashboardadmin');
        // } else {
        //     return redirect('/panel')->with(['warning' => 'Email atau Password Salah']);
        // }
    }

        // public function proseslogoutroot(){
        //     if(Auth::guard('admin')->check()){
        //         Auth::guard('admin')->logout();
        //         return redirect('/panel');
        //     }
        // }

        // public function prosesloginroot(Request $request)
        // {
        //     // $pass = 123;
        //     // echo Hash::make($pass);

        //     if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
        //         return redirect('/panel/dashboardadmin');
        //     } else {
        //         return redirect('/panel')->with(['warning' => 'Email atau Password Salah']);
        //     }
        // }
}