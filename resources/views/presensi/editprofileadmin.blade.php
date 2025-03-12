@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            Overview
          </div>
          <h2 class="page-title">
            Edit Profile
          </h2>
        </div>
       
      </div>
    </div>
</div>


<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col">
                <form action="/editprofileadmin/{{ $admin->email }}/updateprofile" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="col">
                        <div class="form-group boxed mt-2 col-6">
                            Nama Lengkap
                            <div class="input-wrapper">
                                <input type="text" class="form-control" value="{{ $admin->name }}" name="name" placeholder="Nama Lengkap" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group boxed mt-2 col-6">
                            Email
                            <div class="input-wrapper">
                                <input type="text" class="form-control" value="{{ $admin->email }}" name="email" placeholder="Email" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group boxed mt-2 col-6">
                            Ganti Password
                            <div class="input-wrapper">
                                <input type="password" class="form-control" name="password" placeholder="Masukan password baru" autocomplete="off">
                            </div>
                        </div>
                        {{-- <div class="custom-file-upload" id="fileUpload1">
                            <input type="file" name="foto" id="fileuploadInput" accept=".png, .jpg, .jpeg">
                            <label for="fileuploadInput">
                                <span>
                                    <strong>
                                        <ion-icon name="cloud-upload-outline" role="img" class="md hydrated" aria-label="cloud upload outline"></ion-icon>
                                        <i>Tap to Upload</i>
                                    </strong>
                                </span>
                            </label>
                        </div> --}}
                        <div class="form-group boxed mt-2 col-6">
                            <div class="input-wrapper">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <ion-icon name="refresh-outline"></ion-icon>
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection