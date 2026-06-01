<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $hariini = date("Y-m-d");
        $bulanini = date("m")*1 ; //1 atau januari pakai * 1 jika error bulan tidak muncul
        $tahunini = date("Y"); // 2023
        $nik = Auth::guard('karyawan')->user()->nik;
        $presensihariini = DB::table('presensi')->where('nik',$nik)->where('tgl_presensi',$hariini)->first();
        $historibulanini = DB::table('presensi')
        ->where('nik',$nik)
        ->whereRaw('MONTH(tgl_presensi)="'.$bulanini.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahunini.'"')
        ->orderBy('tgl_presensi')
        ->get();

        $rekappresensi = DB::table('presensi')
        ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > "08:15",1,0)) as jmlterlambat')
        ->where('nik',$nik)
        ->whereRaw('MONTH(tgl_presensi)="'.$bulanini.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahunini.'"')
        ->first();

        $leaderboard = DB::table('presensi')
        ->join('karyawan','presensi.nik','=','karyawan.nik')
        ->where('tgl_presensi',$hariini)
        ->orderBy('jam_in')
        ->get();
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        $rekapizin = DB::table('pengajuan_izin')
            ->selectRaw('SUM(IF(status = "i", 1, 0)) as jmlizin')
            ->selectRaw('SUM(IF(status = "s", 1, 0)) as jmlsakit')
            ->where('nik', $nik)
            ->whereMonth('tgl_izin', date('m')) // Mengunci bulan berjalan (Juni) secara aman
            ->whereYear('tgl_izin', date('Y'))  // Mengunci tahun berjalan (2026) secara aman
            ->where('status_approved', 1)
            ->first();

        //lama
        // $rekapizin = DB::table('pengajuan_izin')
        // ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin,SUM(IF(status="s",1,0)) as jmlsakit')
        // ->where('nik', $nik)
        // ->whereRaw('MONTH(tgl_izin)="'.$bulanini.'"')
        // ->whereRaw('YEAR(tgl_izin)="'.$tahunini.'"')
        // // yang dimunculin cuma yg diizinin
        // ->where('status_approved',1)
        // ->first();

//         // Tulis ini tepat SEBELUM baris 'return view'
// dd([
//     'NIK Karyawan Login' => $nik,
//     'Bulan Ini' => $bulanini,
//     'Tahun Ini' => $tahunini,
//     'Semua Data Izin Karyawan Ini' => DB::table('pengajuan_izin')->where('nik', $nik)->get()
// ]);

        return view('dashboard.dashboard',compact('presensihariini', 'historibulanini', 'namabulan', 'tahunini', 'bulanini', 'rekappresensi', 'leaderboard','rekapizin'));
    }

    public function dashboardadmin(){
        $hariini = date("Y-m-d");
        $rekappresensi = DB::table('presensi')
        ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > "08:00",1,0)) as jmlterlambat')
        ->where('tgl_presensi',$hariini)
        ->first();

        $rekapizin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin,SUM(IF(status="s",1,0)) as jmlsakit')
        ->where('tgl_izin',$hariini)
        // yang dimunculin cuma yg diizinin
        ->where('status_approved',1)
        ->first();
        return view('dashboard.dashboardadmin',compact('rekappresensi','rekapizin'));
    }

    // public function editprofileadmin(){
    //     $nik = Auth::guard('users')->user()->nik;
    //     $karyawan = DB::table('karyawan')->where('nik',$nik)->first();
    //     return view('presensi.editprofile', compact('karyawan'));
    // }
}
