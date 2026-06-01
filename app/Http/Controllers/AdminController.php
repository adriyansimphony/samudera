<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil data user/admin
        $users = DB::table('users')->orderBy('name')->get();
        return view('admin.index', compact('users'));
    }

    public function update($id, Request $request)
    {
        // Validasi input dasar
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        try {
            $data = [
                'name'  => $request->name,
                'email' => $request->email,
            ];

            // Jika checkbox "Ubah Password" dicentang dan input password diisi
            if ($request->has('ubah_password') && $request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            // Update data berdasarkan ID user
            DB::table('users')->where('id', $id)->update($data);

            return Redirect::back()->with(['success' => 'Data Admin berhasil diupdate']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Admin gagal diupdate: ' . $e->getMessage()]);
        }
    }

    // Tambahkan fungsi ini di dalam class AdminController

public function store(Request $request)
{
    // 1. Validasi Input agar data yang masuk tidak sembarangan
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email', // Email tidak boleh kembar
        'password' => 'required|min:5', // Minimal password 5 karakter demi keamanan
    ], [
        // Custom pesan error jika dosen ingin melihat validasi berbahasa Indonesia
        'email.unique' => 'Email ini sudah terdaftar di sistem!',
        'password.min' => 'Password minimal harus 5 karakter.'
    ]);

    try {
        // 2. Siapkan data yang akan dimasukkan ke database
        $data = [
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password), // Wajib di-hash bulat-bulat
            'created_at' => now(), // Opsional, penanda waktu data dibuat
            'updated_at' => now()
        ];

        // 3. Masukkan ke tabel users
        DB::table('users')->insert($data);

        return Redirect::back()->with(['success' => 'Admin Baru berhasil ditambahkan!']);

    } catch (\Exception $e) {
        return Redirect::back()->with(['warning' => 'Gagal menambahkan admin: ' . $e->getMessage()]);
    }
}
}