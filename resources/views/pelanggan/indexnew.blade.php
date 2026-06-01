@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle text-muted text-uppercase fw-bold">
                    Data Pelanggan
                </div>
                <h2 class="page-title shadow-sm-text">
                    Data Kantor Pelanggan
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        
                        <!-- Alert Section -->
                        <div class="row">
                            <div class="col-12">
                                @if (Session::get('success'))
                                    <div class="alert alert-important alert-success alert-dismissible" role="alert">
                                        <div class="d-flex">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                                            </div>
                                            <div>{{ Session::get('success') }}</div>
                                        </div>
                                    </div>
                                @endif
                                @if (Session::get('warning'))
                                    <div class="alert alert-important alert-warning alert-dismissible" role="alert">
                                        <div class="d-flex">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M12 9v4" /><path d="M12 17h.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
                                            </div>
                                            <div>{{ Session::get('warning') }}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="row mb-3">
                            <div class="col-12">
                                <a href="#" class="btn btn-primary d-inline-flex align-items-center shadow-sm" id="btnTambahPelanggan" style="transition: all 0.2s ease;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                    Tambah Data Baru
                                </a>
                            </div>
                        </div>

                        <!-- Data Table -->
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table table-striped table-hover border">
                                <thead class="bg-light text-muted">
                                    <tr>
                                        <th class="w-1 text-center">No</th>
                                        <th>Kode Pelanggan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Lokasi Kantor</th>
                                        <th>Radius</th>
                                        <th class="w-1 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($pelanggan as $d)
                                       <tr class="align-middle">
                                            <td class="text-center text-muted fw-bold">{{ $loop->iteration }}</td>
                                            <td>
                                                <span class="badge bg-blue-lt fw-bold px-2 py-1">{{ $d->kode_pelanggan }}</span>
                                            </td>
                                            <td class="fw-semibold text-dark">{{ $d->nama_pelanggan }}</td>
                                            <td class="text-secondary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline me-1 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" /></svg>
                                                {{ $d->lokasi_pelanggan }}
                                            </td>
                                            <td>
                                                <span class="badge bg-purple-lt px-2 py-1">{{ $d->radius_pelanggan }} Meter</span>
                                            </td>
                                            <td>
                                                <div class="btn-list flex-nowrap justify-content-center">
                                                    <a href="#" class="edit btn btn-info btn-icon btn-sm shadow-xs" kode_pelanggan="{{ $d->kode_pelanggan }}" title="Edit Data" style="transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                                    </a>
                                                    <form action="/pelanggan/{{ $d->kode_pelanggan }}/delete" method="POST" class="d-inline">
                                                        @csrf
                                                        <a class="btn btn-danger btn-icon btn-sm delete-confirm shadow-xs" title="Hapus Data" style="transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                        </a>
                                                    </form>
                                                </div>
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

<!-- Modal Input -->
<div class="modal modal-blur fade" id="modal-inputpelanggan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white">Tambah Data Pelanggan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-4">
                <form action="/pelanggan/store" method="POST" id="frmPelanggan">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kode Pelanggan</label>
                        <div class="input-icon">
                            <span class="input-icon-addon text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1z" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1z" /><path d="M19 11l0 2" /></svg>
                            </span>
                            <input type="text" id="kode_pelanggan" class="form-control" name="kode_pelanggan" placeholder="Contoh: PLG001">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Pelanggan</label>
                        <div class="input-icon">
                            <span class="input-icon-addon text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                            </span>
                            <input type="text" id="nama_pelanggan" class="form-control" name="nama_pelanggan" placeholder="Nama Lengkap/Perusahaan">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Lokasi Pelanggan</label>
                        <div class="input-icon">
                            <span class="input-icon-addon text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" /></svg>
                            </span>
                            <input type="text" id="lokasi_pelanggan" class="form-control" name="lokasi_pelanggan" placeholder="Koordinat Lat, Long / Alamat">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Radius (Meter)</label>
                        <div class="input-icon">
                            <span class="input-icon-addon text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 12h-8a1 1 0 1 0 -1 1v8a9 9 0 0 0 9 -9" /><path d="M16 9a5 5 0 1 0 -7 7" /><path d="M20.486 9a9 9 0 1 0 -11.482 11.495" /></svg>
                            </span>
                            <input type="number" id="radius_pelanggan" class="form-control" name="radius_pelanggan" placeholder="Contoh: 100">
                        </div>
                    </div>
                    
                    <button class="btn btn-primary w-100 shadow-sm d-flex justify-content-center align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14l11 -11" /><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                        Simpan Data
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal modal-blur fade" id="modal-editpelanggan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title text-white">Edit Data Pelanggan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="loadeditform">
                <!-- Data AJAX dimuat di sini -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('myscript')
<script>
    $(function(){
        $("#btnTambahPelanggan").click(function(e){
            e.preventDefault();
            $("#modal-inputpelanggan").modal("show");
        });

        $(".edit").click(function(e){
            e.preventDefault();
            var kode_pelanggan = $(this).attr('kode_pelanggan');
            $.ajax({
                type: 'POST',
                url: '/pelanggan/edit',
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    kode_pelanggan: kode_pelanggan
                },
                success:function(respond){
                    $("#loadeditform").html(respond);
                }
            });
            $("#modal-editpelanggan").modal("show");
        });

        $(".delete-confirm").click(function(e){
            var form = $(this).closest('form');
            e.preventDefault();
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data pelanggan yang dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus data!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire({
                        title: "Dihapus!",
                        text: "Data sudah berhasil terhapus.",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });

        $("#frmPelanggan").submit(function(){
            var kode_pelanggan = $("#kode_pelanggan").val();
            var nama_pelanggan = $("#nama_pelanggan").val();
            var lokasi_pelanggan = $("#lokasi_pelanggan").val();
            var radius_pelanggan = $("#radius_pelanggan").val();

            if(kode_pelanggan==""){
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Kode Pelanggan wajib diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then(()=>{ $("#kode_pelanggan").focus(); });
                return false;
            } else if(nama_pelanggan==""){
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Nama pelanggan wajib diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then(()=>{ $("#nama_pelanggan").focus(); });
                return false;
            } else if(lokasi_pelanggan==""){
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Lokasi pelanggan wajib diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then(()=>{ $("#lokasi_pelanggan").focus(); });
                return false;
            } else if(radius_pelanggan==""){
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Radius pelanggan wajib diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then(()=>{ $("#radius_pelanggan").focus(); });
                return false;
            }
        });
    });
</script>
@endpush