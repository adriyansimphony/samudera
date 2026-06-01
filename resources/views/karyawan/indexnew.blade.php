@extends('layouts.admin.tabler')
@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Karyawan</div>
                <h2 class="page-title">Data Manajemen Karyawan</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        {{-- Alert Notifikasi --}}
        @if (Session::get('success'))
            <div class="alert alert-important alert-success alert-dismissible shadow-sm mb-3" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                    </div>
                    <div>{{ Session::get('success') }}</div>
                </div>
                <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

        @if (Session::get('warning'))
            <div class="alert alert-important alert-warning alert-dismissible shadow-sm mb-3" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01m0 -6.01v6a9 9 0 1 1 -9 9a9 9 0 0 1 9 -9z" /></svg>
                    </div>
                    <div>{{ Session::get('warning') }}</div>
                </div>
                <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

        {{-- Panel Aksi Atas --}}
        <div class="row mb-3">
            <div class="col-12 text-start">
                <a href="#" class="btn btn-primary px-3 shadow-sm d-inline-flex align-items-center gap-1" id="btnTambahkaryawan">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M16 19h6" /><path d="M19 16v6" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4" /></svg>
                    Tambah Karyawan Baru
                </a>
            </div>
        </div>

        {{-- Tabel Utama --}}
        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-vcenter table-mobile-md card-table table-striped table-hover">
                    <thead>
                        <tr class="text-secondary small font-weight-bold">
                            <th class="w-1">No</th>
                            <th>Profil</th>
                            <th>NIK</th>
                            <th>Jabatan</th>
                            <th>Kontak</th>
                            <th>Departemen</th>
                            <th>ID Presensi</th>
                            <th class="text-center w-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($karyawan as $d)
                            @php
                                $path = Storage::url('uploads/karyawan/'.$d->foto);
                            @endphp
                            <tr>
                                <td class="text-muted" data-label="No">{{ $loop->iteration }}</td>
                                <td data-label="Profil">
                                    <div class="d-flex py-1 align-items-center gap-2">
                                        @if (empty($d->foto))
                                            <span class="avatar avatar-md rounded-circle border shadow-inner" style="background-image: url({{ asset('assets/img/ava.png') }})"></span>
                                        @else
                                            <span class="avatar avatar-md rounded-circle border shadow-inner" style="background-image: url({{ url($path) }})"></span>
                                        @endif
                                        <div class="font-weight-medium text-dark">{{ $d->nama_lengkap }}</div>
                                    </div>
                                </td>
                                <td data-label="NIK" class="font-weight-medium text-secondary">{{ $d->nik }}</td>
                                <td data-label="Jabatan" class="text-muted">{{ $d->jabatan }}</td>
                                <td data-label="Kontak">
                                    <div class="text-dark small d-flex align-items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp text-success" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" /><path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" /></svg>
                                        {{ $d->no_hp }}
                                    </div>
                                </td>
                                <td data-label="Departemen">
                                    <span class="badge bg-blue-lt px-2 py-1 font-weight-bold">{{ $d->nama_dept }}</span>
                                </td>
                                <td data-label="ID Presensi">
                                    <span class="badge bg-dark-lt font-weight-medium px-2 py-1">{{ $d->kode_pelanggan }}</span>
                                </td>
                                <td>
                                    <div class="btn-list flex-nowrap justify-content-center">
                                        <a href="#" class="edit btn btn-sm btn-outline-info btn-icon" nik="{{ $d->nik }}" title="Ubah Data">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                                        </a>
                                        <form action="/karyawan/{{ $d->nik }}/delete" method="POST" class="d-inline">
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-icon delete-confirm" title="Hapus Data">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-minus mb-2 text-secondary" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 11h6m-3 -3v6" /><path d="M14 20a4 4 0 0 0 4 -4v-2a4 4 0 0 0 -4 -4h-4c-.037 0 -.073 0 -.11 .001" /><path d="M12 4m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /></svg>
                                    <p class="mb-0 font-weight-medium">Belum ada data karyawan terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah Karyawan --}}
<div class="modal modal-blur fade" id="modal-inputkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold">Form Tambah Karyawan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/karyawan/store" method="POST" id="frmKaryawan" enctype="multipart/form-data">
                @csrf
                <div class="modal-body py-3">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-secondary">Nomor Induk Karyawan (NIK)</label>
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id-badge" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 3m0 3a3 3 0 0 1 3 -3h8a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-8a3 3 0 0 1 -3 -3z" /><path d="M12 7m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M10 13l4 0" /><path d="M10 16l4 0" /></svg>
                            </span>
                            <input type="text" id="nik" class="form-control" name="nik" placeholder="Masukkan NIK">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-secondary">Nama Lengkap</label>
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                            </span>
                            <input type="text" id="nama_lengkap" class="form-control" name="nama_lengkap" placeholder="Nama Sesuai KTP">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-secondary">Jabatan Pekerjaan</label>
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-briefcase" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /><path d="M12 12l0 .01" /><path d="M3 13a20 20 0 0 0 18 0" /></svg>
                            </span>
                            <input type="text" id="jabatan" class="form-control" name="jabatan" placeholder="Contoh: Staff IT, HRD">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-secondary">Nomor Handphone (WhatsApp)</label>
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                            </span>
                            <input type="text" id="no_hp" class="form-control" name="no_hp" placeholder="Contoh: 0812345678x">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-secondary">Foto Resmi Profil Karyawan</label>
                        <input type="file" name="foto" class="form-control">
                        <div class="form-hint text-muted small">Format berkas opsional: JPG, PNG (Maks. 2MB).</div>
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label font-weight-bold small text-secondary">Penempatan Departemen</label>
                                <select name="kode_dept" id="kode_dept" class="form-select text-dark">
                                    <option value="">Pilih Departemen</option>
                                    @foreach ($departemen as $d)
                                        <option {{ Request('kode_dept')==$d->kode_dept ? 'selected' : '' }} value="{{ $d->kode_dept }}">{{ $d->nama_dept }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label font-weight-bold small text-secondary">Lokasi Mesin Presensi</label>
                                <select name="kode_pelanggan" id="kode_pelanggan" class="form-select text-dark">
                                    <option value="">Pilih Lokasi</option>
                                    @foreach ($presensi as $d)
                                        <option value="{{ $d->kode_pelanggan }}">{{ strtoupper($d->nama_pelanggan) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batalkan</button>
                    <button class="btn btn-primary px-4 shadow-sm" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4.646 4.646a.5 .5 0 0 1 .708 0l14 14a.5 .5 0 0 1 0 .708l-1.414 1.414a.5 .5 0 0 1 -.708 0l-14 -14a.5 .5 0 0 1 0 -.708l1.414 -1.414z" /><path d="M19 8v-3a2 2 0 0 0 -2 -2h-7" /><path d="M14 11h-4v-4" /></svg>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Karyawan --}}
<div class="modal modal-blur fade" id="modal-editkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title font-weight-bold">Form Perbarui Data Karyawan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3" id="loadeditform">
                {{-- Form AJAX dimuat di sini --}}
            </div>
        </div>
    </div>
</div>
@endsection

@push('myscript')
<script>
    $(function(){
        $("#btnTambahkaryawan").click(function(e){
            e.preventDefault();
            $("#modal-inputkaryawan").modal("show");
        });

        $(".edit").click(function(e){
            e.preventDefault();
            var nik = $(this).attr('nik');
            $.ajax({
                type: 'POST',
                url: '/karyawan/edit',
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    nik: nik
                },
                success:function(respond){
                    $("#loadeditform").html(respond);
                    $("#modal-editkaryawan").modal("show");
                }
            });
        });

        $(".delete-confirm").click(function(e){
            e.preventDefault();
            var form = $(this).closest('form');
            
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data karyawan ini akan dihapus permanen dari sistem!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus Data!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                </div>
            });
        });

        $("#frmKaryawan").submit(function(){
            var nik = $("#nik").val().trim();
            var nama_lengkap = $("#nama_lengkap").val().trim();
            var jabatan = $("#jabatan").val().trim();
            var no_hp = $("#no_hp").val().trim();
            var kode_dept = $("#kode_dept").val();
            
            if(nik == ""){
                Swal.fire({ title: 'Perhatian!', text: 'NIK wajib diisi', icon: 'warning' })
                    .then(() => { $("#nik").focus(); });
                return false;
            }
            if(nama_lengkap == ""){
                Swal.fire({ title: 'Perhatian!', text: 'Nama lengkap wajib diisi', icon: 'warning' })
                    .then(() => { $("#nama_lengkap").focus(); });
                return false;
            }
            if(jabatan == ""){
                Swal.fire({ title: 'Perhatian!', text: 'Jabatan wajib diisi', icon: 'warning' })
                    .then(() => { $("#jabatan").focus(); });
                return false;
            }
            if(no_hp == ""){
                Swal.fire({ title: 'Perhatian!', text: 'Nomor HP aktif wajib diisi', icon: 'warning' })
                    .then(() => { $("#no_hp").focus(); });
                return false;
            }
            if(kode_dept == ""){
                Swal.fire({ title: 'Perhatian!', text: 'Silakan pilih departemen', icon: 'warning' })
                    .then(() => { $("#kode_dept").focus(); });
                return false;
            }
        });
    });
</script>
@endpush