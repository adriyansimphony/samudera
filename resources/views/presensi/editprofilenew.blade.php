@extends('layouts.presensi')
@section('header')
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Edit Profile</div>
    <div class="right"></div>
</div>
@endsection

@section('content')
<div class="main-premium-wrapper pb-5" style="background-color: #f8fafc; min-height: 100vh; padding-top: 5rem;">
    <div class="container mb-5 pb-5">
        
        <div class="row">
            <div class="col-12">
                @if(Session::get('success'))
                <div class="alert alert-success d-flex align-items-center rounded-3 border-0 shadow-sm p-2 mb-3" style="background-color: #ecfdf5; color: #065f46;">
                    <ion-icon name="checkmark-circle" class="me-2" style="font-size: 22px; color: #10b981;"></ion-icon>
                    <div class="small fw-semibold">{{ Session::get('success') }}</div>
                </div>
                @endif
                @if(Session::get('error'))
                <div class="alert alert-danger d-flex align-items-center rounded-3 border-0 shadow-sm p-2 mb-3" style="background-color: #fef2f2; color: #991b1b;">
                    <ion-icon name="alert-circle" class="me-2" style="font-size: 22px; color: #ef4444;"></ion-icon>
                    <div class="small fw-semibold">{{ Session::get('error') }}</div>
                </div>
                @endif
            </div>
        </div>

        <form action="/presensi/{{ $karyawan->nik }}/updateprofile" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <div class="position-relative d-inline-block">
                        <div class="avatar-container shadow-md rounded-circle p-1 bg-white" style="border: 2px solid #e2e8f0;">
                            @if(!empty($karyawan->foto))
                                @php $path = Storage::url('uploads/karyawan/'.$karyawan->foto); @endphp
                                <img id="avatar-img" src="{{ url($path) }}" alt="Avatar" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; display: block;">
                            @else
                                <img id="avatar-img" src="https://placeholder.co/150x150/f1f5f9/64748b?text=User" alt="Avatar Default" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; display: block;">
                            @endif
                        </div>
                        <label for="fileuploadInput" class="position-absolute bottom-0 end-0 bg-primary text-white d-flex align-items-center justify-content-center rounded-circle shadow" 
                               style="width: 32px; height: 32px; cursor: pointer; border: 2px solid #fff; transition: all 0.2s;">
                            <ion-icon name="camera-sharp" style="font-size: 16px;"></ion-icon>
                        </label>
                    </div>
                    <h4 class="mt-2 mb-0 fw-bold text-dark" style="letter-spacing: -0.2px;">{{ $karyawan->nama_lengkap }}</h4>
                    <p class="text-muted small fw-medium mb-0">ID Karyawan: <span class="text-primary fw-bold">{{ $karyawan->nik }}</span></p>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-3">
                    
                    <div class="input-modern-group mb-3">
                        <span class="input-icon-left"><ion-icon name="person-outline"></ion-icon></span>
                        <div class="input-field-box">
                            <label class="input-label-active">Nama Lengkap</label>
                            <input type="text" class="form-control-modern" value="{{ $karyawan->nama_lengkap }}" name="nama_lengkap" placeholder="Nama Lengkap" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="input-modern-group mb-3">
                        <span class="input-icon-left"><ion-icon name="phone-portrait-outline"></ion-icon></span>
                        <div class="input-field-box">
                            <label class="input-label-active">Nomor Handphone</label>
                            <input type="text" class="form-control-modern" value="{{ $karyawan->no_hp }}" name="no_hp" placeholder="No. HP" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="input-modern-group mb-2">
                        <span class="input-icon-left"><ion-icon name="lock-closed-outline"></ion-icon></span>
                        <div class="input-field-box">
                            <label class="input-label-active">Ganti Password</label>
                            <input type="password" class="form-control-modern" name="password" placeholder="Biarkan kosong jika tidak diubah" autocomplete="off">
                        </div>
                    </div>

                    <input type="file" name="foto" id="fileuploadInput" accept=".png, .jpg, .jpeg" class="d-none">

                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-5 btn-upload-trigger" id="fileUploadContainer" style="cursor: pointer;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary-lt rounded-3 p-2 d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <ion-icon name="image-outline" class="text-primary" style="font-size: 22px;"></ion-icon>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold text-dark" style="font-size: 13px;" id="upload-text">Ganti Foto Profil</h5>
                            <p class="text-muted small mb-0" style="font-size: 11px;" id="upload-subtext">Ketuk untuk mengambil/pilih file</p>
                        </div>
                    </div>
                    <ion-icon name="chevron-forward-outline" class="text-muted" style="font-size: 18px;"></ion-icon>
                </div>
            </div>

            <div class="px-1" style="margin-bottom: 80px;"> 
                <button type="submit" class="btn btn-primary w-100 rounded-pill shadow-md py-3 fw-bold d-flex align-items-center justify-content-center" 
                        style="letter-spacing: 0.3px; font-size: 14px; background: linear-gradient(135deg, #206bc4 0%, #17539b 100%); border: 0;">
                    <ion-icon name="checkmark-sharp" class="me-2" style="font-size: 18px;"></ion-icon>
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>

<style>
    .shadow-md { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important; }
    .bg-primary-lt { background-color: rgba(32, 107, 196, 0.08) !important; }

    .input-modern-group {
        display: flex;
        align-items: center;
        border-bottom: 1px solid #f1f5f9;
        padding: 8px 0;
    }
    .input-modern-group:focus-within {
        border-bottom-color: #206bc4;
    }
    .input-icon-left {
        color: #94a3b8;
        font-size: 20px;
        margin-right: 12px;
        display: flex;
        align-items: center;
    }
    .input-modern-group:focus-within .input-icon-left {
        color: #206bc4;
    }
    .input-field-box {
        flex: 1;
    }
    .input-label-active {
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 0px;
        display: block;
    }
    .form-control-modern {
        display: block;
        width: 100%;
        border: 0;
        background: transparent;
        padding: 2px 0;
        font-size: 14px;
        font-weight: 500;
        color: #1e293b;
    }
    .form-control-modern:focus {
        outline: none;
        box-shadow: none;
    }
    .btn-upload-trigger:active {
        background-color: #f1f5f9 !important;
    }
</style>

<script>
    document.getElementById('fileUploadContainer').addEventListener('click', function() {
        document.getElementById('fileuploadInput').click();
    });

    document.getElementById('fileuploadInput').addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            var fileName = e.target.files[0].name;
            document.getElementById('upload-text').innerHTML = `<span class="text-success fw-bold">Foto Siap Dijurnal!</span>`;
            document.getElementById('upload-subtext').innerText = fileName;
            
            var reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('avatar-img').src = event.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endsection