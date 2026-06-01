<form action="/karyawan/{{ $karyawan->nik }}/update" method="POST" id="frmKaryawan" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1z" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1z" /><path d="M19 11l0 2" /></svg>
                </span>
                <input type="text" readonly id="nik" value="{{ $karyawan->nik }}" class="form-control" name="nik" placeholder="NIK">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                </span>
                <input type="text" id="nama_lengkap" value="{{ $karyawan->nama_lengkap }}" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-braille" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 5a1 1 0 1 0 2 0a1 1 0 0 0 -2 0z" /><path d="M7 5a1 1 0 1 0 2 0a1 1 0 0 0 -2 0z" /><path d="M7 19a1 1 0 1 0 2 0a1 1 0 0 0 -2 0z" /><path d="M16 12h.01" /><path d="M8 12h.01" /><path d="M16 19h.01" /></svg>
                </span>
                <input type="text" id="jabatan" value="{{ $karyawan->jabatan }}" class="form-control" name="jabatan" placeholder="Jabatan">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                </span>
                <input type="text" id="no_hp" value="{{ $karyawan->no_hp }}" class="form-control" name="no_hp" placeholder="No HP">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <input type="file" name="foto" class="form-control">
                <input type="hidden" name="old_foto" value="{{ $karyawan->foto }}">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
            <select name="kode_dept" id="kode_dept" class="form-select">
                <option value="">Departemen</option>
                @foreach ($departemen as $d)
                <option {{ $karyawan->kode_dept==$d->kode_dept ? 'selected' : '' }} value="{{ $d->kode_dept }}">{{ $d->nama_dept }}</option>
                    
                @endforeach
            </select>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <select name="kode_pelanggan" id="kode_pelanggan" class="form-select">
                <option value="">Presensi</option>
                @foreach ($presensi as $d)
                <option {{ $karyawan->kode_pelanggan==$d->kode_pelanggan ? 'selected' : '' }} value="{{ $d->kode_pelanggan }}">{{ strtoupper($d->nama_pelanggan) }}</option>
                    
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <label class="form-check">
                <input class="form-check-input" type="checkbox" name="ubah_password" id="ubah_password" value="1">
                <span class="form-check-label">Apakah Anda ingin mengubah password?</span>
            </label>
        </div>
    </div>

    <div class="row mt-2" id="field_password" style="display: none;">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" /><path d="M12 16m0 1a1 1 0 0 1 1 -1h0a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h0a1 1 0 0 1 -1 -1z" /><path d="M8 11v-4a4 4 0 0 1 8 0v4" /></svg>
                </span>
                <input type="password" id="password" class="form-control" name="password" placeholder="Masukkan Password Baru">
            </div>
        </div>
    </div>
    <div class="row mt-2">
    <div class="row mt-2">
        <div class="col-12">
            <div class="form-group">
                <button class="btn btn-primary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14l11 -11" /><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                    Simpan
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    document.getElementById('ubah_password').addEventListener('change', function() {
        const fieldPassword = document.getElementById('field_password');
        const inputPassword = document.getElementById('password');
        
        if (this.checked) {
            fieldPassword.style.display = 'block'; // Munculkan field
            inputPassword.setAttribute('required', 'required'); // Wajib diisi kalau dicentang
        } else {
            fieldPassword.style.display = 'none';  // Sembunyikan field
            inputPassword.removeAttribute('required'); // Tidak wajib diisi
            inputPassword.value = ''; // Reset isian password jika batal dicentang
        }
    });
</script>