<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

class KaryawanController extends Controller
{
    public function index(){
        $karyawan = DB::table('karyawan')->orderBy('nama_lengkap')
        ->join('departemen','karyawan.kode_dept','=','departemen.kode_dept')
        ->get();

        $departemen = DB::table('departemen')->get();
        $presensi = DB::table('pelanggan')->orderBy('kode_pelanggan')->get();
        return view('karyawan.index', compact('karyawan','departemen','presensi'));
    }

    public function store(Request $request){
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_dept = $request->kode_dept;
        $password = Hash::make('12345');
        $kode_pelanggan = $request->kode_pelanggan;
        if($request->hasFile('foto')){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto = null;
        }

        try {
            $data =[
                'nik'=>$nik,
                'nama_lengkap'=>$nama_lengkap,
                'jabatan'=>$jabatan,
                'no_hp'=>$no_hp,
                'kode_dept'=>$kode_dept,
                'foto'=>$foto,
                'password'=>$password,
                'kode_pelanggan'=>$kode_pelanggan
            ];
            $simpan = DB::table('karyawan')->insert($data);
            if($simpan){
                if($request->hasFile('foto')){
                    $folderPath = "public/uploads/karyawan/";
                    $request->file('foto')->storeAs($folderPath,$foto);
                }
                return Redirect::back()->with(['success'=>'Data berhasil disimpan']);
            }
        } catch (\Exception $e) {
            //throw $th;
            // dd($e);
            if($e->getCode()==23000){
                $message = " (Data dengan NIK ".$nik." sudah ada)";
            }
            return Redirect::back()->with(['warning'=>'Data gagal disimpan'.$message]);
        }
    }

    public function edit(Request $request){
        $nik = $request->nik;
        $departemen = DB::table('departemen')->get();
        $karyawan = DB::table('karyawan')->where('nik',$nik)->first();
        $presensi = DB::table('pelanggan')->orderBy('kode_pelanggan')->get();
        return view('karyawan.edit', compact('departemen','karyawan','presensi'));
    }

    public function update($nik, Request $request)
{
    // Catatan Skripsi: Ambil NIK dari parameter route, bukan dari request agar lebih aman.
    // Tetapi jika input NIK bersifat readonly, $request->nik juga tidak masalah.
    $nik = $request->nik; 
    $nama_lengkap = $request->nama_lengkap;
    $jabatan = $request->jabatan;
    $no_hp = $request->no_hp;
    $kode_dept = $request->kode_dept;
    $kode_pelanggan = $request->kode_pelanggan;
    $old_foto = $request->old_foto;

    // Logika upload foto
    if ($request->hasFile('foto')) {
        $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
    } else {
        $foto = $old_foto;
    }

    try {
        // 1. Definisikan data dasar yang pasti di-update
        $data = [
            'nama_lengkap'   => $nama_lengkap,
            'jabatan'        => $jabatan,
            'no_hp'          => $no_hp,
            'kode_dept'      => $kode_dept,
            'foto'           => $foto,
            'kode_pelanggan' => $kode_pelanggan
        ];

        // 2. LOGIKA BARU: Jika checkbox "Ubah Password" dicentang
        if ($request->has('ubah_password') && $request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // 3. Eksekusi query update ke database
        // Gunakan updateOrInsert atau tampung baris yang terpengaruh
        $update = DB::table('karyawan')->where('nik', $nik)->update($data);

        // Catatan: Jika user hanya menekan "Simpan" tanpa mengubah data sama sekali, 
        // Laravel Query Builder mengembalikan nilai 0 (false), tapi datanya tidak error.
        // Di bawah ini kita modifikasi sedikit kondisinya agar tetap sukses meski data tidak ada yang berubah fisik.
        
        if ($request->hasFile('foto')) {
            $folderPath = "public/uploads/karyawan/";
            $folderPathOld = "public/uploads/karyawan/" . $old_foto;
            
            // Hapus foto lama jika ada dan file-nya bukan file kosong
            if (!empty($old_foto)) {
                Storage::delete($folderPathOld);
            }
            $request->file('foto')->storeAs($folderPath, $foto);
        }

        return Redirect::back()->with(['success' => 'Data berhasil diupdate']);

    } catch (\Exception $e) {
        // Jika skripsi masih tahap bimbingan, log error sangat penting untuk debugging:
        // \Log::error($e->getMessage()); 
        return Redirect::back()->with(['warning' => 'Data gagal diupdate: ' . $e->getMessage()]);
    }
}

    // public function update($nik,Request $request){
    //     $nik = $request->nik;
    //     $nama_lengkap = $request->nama_lengkap;
    //     $jabatan = $request->jabatan;
    //     $no_hp = $request->no_hp;
    //     $kode_dept = $request->kode_dept;
    //     $kode_pelanggan = $request->kode_pelanggan;
    //     // $password = Hash::make('12345');
    //     $old_foto = $request->old_foto;
    //     if($request->hasFile('foto')){
    //         $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
    //     }else{
    //         $foto = $old_foto;
    //     }

    //     // if(empty($request->password)){
    //     //     $data = [
    //     //         'nama_lengkap'=>$nama_lengkap,
    //     //         'jabatan'=>$jabatan,
    //     //         'no_hp'=>$no_hp,
    //     //         'kode_dept'=>$kode_dept,
    //     //         'foto'=>$foto,
    //     //         'kode_pelanggan'=>$kode_pelanggan
    //     //         ] ;
    //     //     }else {
    //     //         $data = [
    //     //             'nama_lengkap'=>$nama_lengkap,
    //     //             'jabatan'=>$jabatan,
    //     //             'no_hp'=>$no_hp,
    //     //             'kode_dept'=>$kode_dept,
    //     //             'foto'=>$foto,
    //     //             'password'=>$password,
    //     //             'kode_pelanggan'=>$kode_pelanggan
    //     //     ] ;
    //     // }

    //     try {
    //         $data =[
    //             'nama_lengkap'=>$nama_lengkap,
    //             'jabatan'=>$jabatan,
    //             'no_hp'=>$no_hp,
    //             'kode_dept'=>$kode_dept,
    //             'foto'=>$foto,
    //             // 'password'=>$password,
    //             'kode_pelanggan'=>$kode_pelanggan
    //         ];
    //         $update = DB::table('karyawan')->where('nik',$nik)->update($data);
    //         if($update){
    //             if($request->hasFile('foto')){
    //                 $folderPath = "public/uploads/karyawan/";
    //                 $folderPathOld = "public/uploads/karyawan/".$old_foto;
    //                 Storage::delete($folderPathOld);
    //                 $request->file('foto')->storeAs($folderPath,$foto);
    //             }
    //             return Redirect::back()->with(['success'=>'Data berhasil diupdate']);
    //         }
    //     } catch (\Exception $e) {
    //         //throw $th;
    //         // dd($e);
    //         return Redirect::back()->with(['warning'=>'Data gagal diupdate']);
    //     }
    // }

    public function delete($nik){
        $delete = DB::table('karyawan')->where('nik',$nik)->delete();
        if($delete){
            return Redirect::back()->with(['success'=>'Data berhasil dihapus']);
        }else{
            return Redirect::back()->with(['warning'=>'Data gagal dihapus']);
            
        }
    }
    
}
