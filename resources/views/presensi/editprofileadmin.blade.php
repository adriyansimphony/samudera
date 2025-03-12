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
        @php
        $messagesuccess = Session::get('success');
        $messageerror = Session::get('error');
        @endphp
        @if(Session::get('success'))
        <div class="alert alert-success">
            {{ $messagesuccess }}
        </div>
        @endif
        <div class="row">
            <div class="col">
                <form action="/editprofileadmin/{{ $user->email }}/updateprofile" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control mt-1" name="name" 
                            value="{{ Auth::guard('admin')->check() ? $user->nama : $user->name }}" required>
                    </div>

                    {{-- <input type="email" class="form-control" name="email" value="{{ $user->email }}" required> --}}
                    @if(Auth::guard('user')->check())
                    <div class="form-group boxed mt-2 col-6">
                        Email
                        <div class="input-wrapper mt-1">
                            <input type="text" class="form-control" value="{{ $user->email }}" name="email" placeholder="Email" autocomplete="off">
                        </div>
                    </div>
                    @endif

                    <div class="form-group mt-2">
                        <label>Ganti Password</label>
                        <input type="password" class="form-control mt-1" name="password" placeholder="Masukkan password baru">
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection