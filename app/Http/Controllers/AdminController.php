<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->orderBy('name')->get();
        // $karyawan = DB::table('karyawan')->orderBy('nama_lengkap')
        return view('admin.index', compact('users'));
    }
}
