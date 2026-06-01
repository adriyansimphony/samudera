@extends('layouts.admin.tabler')
@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Struktur Organisasi</div>
                <h2 class="page-title">Data Manajemen Departemen</h2>
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
                <a href="#" class="btn btn-primary px-3 shadow-sm d-inline-flex align-items-center gap-1" id="btnTambahDepartemen">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    Tambah Departemen Baru
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
                            <th>Kode Departemen</th>
                            <th>Nama Departemen</th>
                            <th class="text-center w-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($departemen as $d)
                            <tr>
                                <td class="text-muted" data-label="No">{{ $loop->iteration }}</td>
                                <td data-label="Kode Dept">
                                    <span class="badge bg-blue-lt px-2 py-1 font-weight-bold">{{ $d->kode_dept }}</span>
                                </td>
                                <td data-label="Nama Dept" class="font-weight-medium text-dark">{{ $d->nama_dept }}</td>
                                <td>
                                    <div class="btn-list flex-nowrap justify-content-center">
                                        <a href="#" class="edit btn btn-sm btn-outline-info btn-icon" kode_dept="{{ $d->kode_dept }}" title="Ubah Data">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                                        </a>
                                        <form action="/departemen/{{ $d->kode_dept }}/delete" method="POST" class="d-inline">
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-icon delete-confirm" title="Hapus Data">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-off mb-2 text-secondary" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21h18" /><path d="M19 21v-4" /><path d="M19 13v-2a2 2 0 0 0 -2 -2h-1" /><path d="M12 8v-3a2 2 0 0 0 -2 -2h-2a2 2 0 0 0 -2 2v3m0 4v7" /><path d="M3 3l18 18" /></svg>
                                    <p class="mb-0 font-weight-medium">Belum ada data departemen terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah Departemen --}}
<div class="modal modal-blur fade" id="modal-inputdepartemen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold">Form Tambah Departemen</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/departemen/store" method="POST" id="frmDepartemen">
                @csrf
                <div class="modal-body py-3">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-secondary">Kode Departemen</label>
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 9l14 0" /><path d="M5 15l14 0" /><path d="M11 4l-4 16" /><path d="M17 4l-4 16" /></svg>
                            </span>
                            <input type="text" id="kode_dept_input" class="form-control" name="kode_dept" placeholder="Contoh: HRD, IT, MKT">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-secondary">Nama Departemen</label>
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M9 21v-14a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v14" /><path d="M5 21v-14a2 2 0 0 1 2 -2h2v16" /><path d="M15 21v-4a2 2 0 0 1 2 -2h2v6" /></svg>
                            </span>
                            <input type="text" id="nama_dept_input" class="form-control" name="nama_dept" placeholder="Contoh: Human Resource Development">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batalkan</button>
                    <button class="btn btn-primary px-4 shadow-sm" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14l11 -11" /><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                        Simpan Departemen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Departemen --}}
<div class="modal modal-blur fade" id="modal-editdepartemen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title font-weight-bold">Form Perbarui Data Departemen</h5>
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
        $("#btnTambahDepartemen").click(function(e){
            e.preventDefault();
            $("#modal-inputdepartemen").modal("show");
        });

        $(".edit").click(function(e){
            e.preventDefault();
            var kode_dept = $(this).attr('kode_dept');
            $.ajax({
                type: 'POST',
                url: '/departemen/edit',
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    kode_dept: kode_dept
                },
                success:function(respond){
                    $("#loadeditform").html(respond);
                    $("#modal-editdepartemen").modal("show");
                }
            });
        });

        $(".delete-confirm").click(function(e){
            e.preventDefault();
            var form = $(this).closest('form');
            
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Menghapus departemen dapat memengaruhi relasi data karyawan terkait!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                </div>
            });
        });

        $("#frmDepartemen").submit(function(){
            var kode_dept = $("#kode_dept_input").val().trim();
            var nama_dept = $("#nama_dept_input").val().trim();
            
            if(kode_dept == ""){
                Swal.fire({ title: 'Perhatian!', text: 'Kode Departemen wajib diisi', icon: 'warning' })
                    .then(() => { $("#kode_dept_input").focus(); });
                return false;
            }
            if(nama_dept == ""){
                Swal.fire({ title: 'Perhatian!', text: 'Nama Departemen wajib diisi', icon: 'warning' })
                    .then(() => { $("#nama_dept_input").focus(); });
                return false;
            }
        });
    });
</script>
@endpush