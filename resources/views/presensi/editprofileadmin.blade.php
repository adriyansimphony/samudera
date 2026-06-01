@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle text-muted text-uppercase fw-bold">
                    Overview
                </div>
                <h2 class="page-title fw-bold">
                    Pengaturan Akun
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        
        @if(Session::get('success'))
        <div class="alert alert-important alert-success alert-dismissible shadow-sm mb-4" role="alert">
            <div class="d-flex">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                </div>
                <div>
                    {{ Session::get('success') }}
                </div>
            </div>
            <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
        @endif

        @if(Session::get('error'))
        <div class="alert alert-important alert-danger alert-dismissible shadow-sm mb-4" role="alert">
            <div class="d-flex">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v4" /><path d="M12 17v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
                </div>
                <div>
                    {{ Session::get('error') }}
                </div>
            </div>
            <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
        @endif

        <form action="/editprofileadmin/{{ $user->email }}/updateprofile" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row row-cards">
                
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow-sm border-0 text-center p-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="avatar avatar-xl rounded-circle shadow-sm bg-blue-lt fw-bold fs-1">
                                    {{ strtoupper(substr(Auth::guard('admin')->check() ? $user->nama : $user->name, 0, 2)) }}
                                </span>
                            </div>
                            <h3 class="card-title m-0 fw-bold fs-3">
                                {{ Auth::guard('admin')->check() ? $user->nama : $user->name }}
                            </h3>
                            <p class="text-muted small mt-1 mb-3">
                                {{ Auth::guard('admin')->check() ? 'Administrator System' : 'Admin Member' }}
                            </p>
                            <div class="badge bg-light text-muted border px-3 py-2 rounded-2">
                                {{ $user->email }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-transparent py-3 border-bottom">
                            <h3 class="card-title fw-bold text-dark m-0">Profil Informasi</h3>
                        </div>
                        <div class="card-body p-4">
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary">Nama Lengkap</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon text-muted">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                                    </span>
                                    <input type="text" class="form-control fw-medium text-dark" name="name" 
                                        value="{{ Auth::guard('admin')->check() ? $user->nama : $user->name }}" required placeholder="Nama Lengkap">
                                </div>
                            </div>

                            @if(Auth::guard('user')->check())
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary">Alamat Email</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon text-muted">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>
                                    </span>
                                    <input type="email" class="form-control fw-medium text-dark" value="{{ $user->email }}" name="email" placeholder="Alamat Email" autocomplete="off">
                                </div>
                            </div>
                            @endif

                            <hr class="my-4 text-muted opacity-50">

                            <div class="mb-4">
                                <h4 class="fw-bold text-dark mb-1">Ubah Keamanan Sandi</h4>
                                <p class="text-muted small">Kosongkan kolom di bawah ini jika Anda tidak ingin mengubah password akun Anda saat ini.</p>
                                
                                <div class="mt-3">
                                    <label class="form-label fw-bold text-secondary">Password Baru</label>
                                    <div class="input-icon">
                                        <span class="input-icon-addon text-muted">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" /><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M8 11v-4a4 4 0 1 1 8 0v4" /></svg>
                                        </span>
                                        <input type="password" class="form-control" name="password" placeholder="Masukkan password baru jika ingin diganti">
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <div class="card-footer bg-light py-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary fw-bold px-4 shadow-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-4 0l0 -4" /></svg>
                                Simpan Perubahan
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </form>

    </div>
</div>
@endsection