@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Admin</div>
                <h2 class="page-title">Data Admin / User</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if (Session::get('success'))
                                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                                @endif
                                @if (Session::get('warning'))
                                    <div class="alert alert-warning">{{ Session::get('warning') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <a href="#" class="btn btn-primary" id="btnTambahAdmin">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                    Tambah Data
                                </a>
                            </div>
                        </div>
                        <div class="modal modal-blur fade" id="modalTambahAdmin" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form action="/admin/store" method="POST" id="formTambahAdmin">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Data Admin Baru</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Lengkap</label>
                                                <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control" placeholder="Masukkan password (Min. 5 karakter)" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Admin</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th style="width: 20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d->name }}</td>
                                            <td>{{ $d->email }}</td>
                                            <td class="text-muted">
                                                <span>&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;</span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-sm btn-edit-admin" 
                                                   data-id="{{ $d->id }}" 
                                                   data-name="{{ $d->name }}" 
                                                   data-email="{{ $d->email }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                                    Edit
                                                </a>
                                                
                                                <form action="/admin/{{ $d->id }}/delete" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm delete-confirm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modalEditAdmin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="formEditAdmin">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" id="edit_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="edit_email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" id="admin_ubah_password" name="ubah_password" value="1">
                            <span class="form-check-label">Apakah Anda ingin mengubah password?</span>
                        </label>
                    </div>
                    <div class="mb-3" id="admin_field_password" style="display: none;">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password" id="edit_password" class="form-control" placeholder="Masukkan password baru">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.btn-edit-admin').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Ambil data dari atribut tombol yang di-klik
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const email = this.getAttribute('data-email');
            
            // Masukkan data ke dalam field modal
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            
            // Ubah action form secara dinamis mengarah ke ID admin yang bersangkutan
            document.getElementById('formEditAdmin').setAttribute('action', '/admin/' + id + '/update');
            
            // Reset state checkbox password ketika modal dibuka ulang
            document.getElementById('admin_ubah_password').checked = false;
            document.getElementById('admin_field_password').style.display = 'none';
            document.getElementById('edit_password').removeAttribute('required');
            document.getElementById('edit_password').value = '';

            // Tampilkan Modal (Gunakan vanilla bootstrap bawaan Tabler)
            var myModal = new bootstrap.Modal(document.getElementById('modalEditAdmin'));
            myModal.show();
        });
    });

    // Logika Toggle Muncul/Sembunyikan Field Password di Modal Admin
    document.getElementById('admin_ubah_password').addEventListener('change', function() {
        const fieldPass = document.getElementById('admin_field_password');
        const inputPass = document.getElementById('edit_password');
        
        if (this.checked) {
            fieldPass.style.display = 'block';
            inputPass.setAttribute('required', 'required');
        } else {
            fieldPass.style.display = 'none';
            inputPass.removeAttribute('required');
            inputPass.value = '';
        }
    });

    // Logika untuk menampilkan Modal Tambah Admin
    document.getElementById('btnTambahAdmin').addEventListener('click', function(e) {
        e.preventDefault();
        
        // Reset form tambah agar bersih setiap kali tombol diklik ulang
        document.getElementById('formTambahAdmin').reset();
        
        // Tampilkan Modal Tambah menggunakan Bootstrap bawaan Tabler
        var modalTambah = new bootstrap.Modal(document.getElementById('modalTambahAdmin'));
        modalTambah.show();
    });
</script>
@endsection