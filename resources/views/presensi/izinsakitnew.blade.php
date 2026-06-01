@extends('layouts.admin.tabler')
@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Presensi</div>
                <h2 class="page-title">Data Izin / Sakit</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        {{-- Card Filter Pencarian --}}
        <div class="card mb-3 shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Filter Pencarian Data</h3>
            </div>
            <div class="card-body">
                <form action="/presensi/izinsakit" method="GET" autocomplete="off">
                    <div class="row g-3">
                        <div class="col-md-3 col-sm-6">
                            <label class="form-label text-muted small font-weight-bold">Dari Tanggal</label>
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2z" /></svg>
                                </span>
                                <input type="text" id="dari" value="{{ Request('dari') }}" class="form-control" name="dari" placeholder="YYYY-MM-DD">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <label class="form-label text-muted small font-weight-bold">Sampai Tanggal</label>
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2z" /></svg>
                                </span>
                                <input type="text" id="sampai" value="{{ Request('sampai') }}" class="form-control" name="sampai" placeholder="YYYY-MM-DD">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <label class="form-label text-muted small font-weight-bold">Nomor Induk Karyawan</label>
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" /><path d="M9 10a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M15 8l2 0" /><path d="M15 12l2 0" /><path d="M7 16l10 0" /></svg>
                                </span>
                                <input type="text" id="nik" value="{{ Request('nik') }}" class="form-control" name="nik" placeholder="Contoh: 12345">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <label class="form-label text-muted small font-weight-bold">Nama Lengkap Karyawan</label>
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                                </span>
                                <input type="text" id="nama_lengkap" value="{{ Request('nama_lengkap') }}" class="form-control" name="nama_lengkap" placeholder="Nama Karyawan">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label class="form-label text-muted small font-weight-bold">Persetujuan</label>
                            <select name="status_approved" id="status_approved" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="0" {{ Request('status_approved') === '0' ? 'selected' : '' }}>⏳ Pending</option>
                                <option value="1" {{ Request('status_approved') == 1 ? 'selected' : '' }}>✅ Disetujui</option>
                                <option value="2" {{ Request('status_approved') == 2 ? 'selected' : '' }}>❌ Ditolak</option>
                            </select>
                        </div>
                        <div class="col-12 text-end mt-2">
                            <button class="btn btn-primary px-4 shadow-sm" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                                Terapkan Filter Pencarian
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabel Data --}}
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-vcenter table-mobile-md card-table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Tanggal</th>
                            <th>Karyawan</th>
                            <th>Jabatan</th>
                            <th class="text-center">Status</th>
                            <th>Keterangan</th>
                            <th class="text-center">Status Approve</th>
                            <th class="text-center w-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($izinsakit as $d)
                            <tr>
                                <td class="text-muted" data-label="No.">{{ $loop->iteration }}</td>
                                <td data-label="Tanggal" class="font-weight-medium text-secondary">
                                    {{ date('d F Y', strtotime($d->tgl_izin)) }}
                                </td>
                                <td data-label="Karyawan">
                                    <div class="d-flex py-1 align-items-center">
                                        <div class="flex-fill">
                                            <div class="font-weight-medium text-dark">{{ $d->nama_lengkap }}</div>
                                            <div class="text-muted small"><span class="badge bg-light text-dark font-weight-normal">{{ $d->nik }}</span></div>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Jabatan" class="text-muted">{{ $d->jabatan }}</td>
                                <td data-label="Status" class="text-center">
                                    @if($d->status == "i")
                                        <span class="badge bg-azure-lt px-2.5 py-1 font-weight-bold">Izin</span>
                                    @else
                                        <span class="badge bg-warning-lt px-2.5 py-1 font-weight-bold">Sakit</span>
                                    @endif
                                </td>
                                <td data-label="Keterangan" class="text-muted text-wrap" style="max-width: 250px;">
                                    {{ $d->keterangan }}
                                </td>
                                <td data-label="Status Approve" class="text-center">
                                    @if ($d->status_approved == "1")
                                        <span class="badge bg-success-lt font-weight-bold px-2 py-1">
                                            <span class="badge-dot bg-success me-1"></span> Disetujui
                                        </span>
                                    @elseif ($d->status_approved == "2")
                                        <span class="badge bg-danger-lt font-weight-bold px-2 py-1">
                                            <span class="badge-dot bg-danger me-1"></span> Ditolak
                                        </span>
                                    @else
                                        <span class="badge bg-warning-lt font-weight-bold px-2 py-1">
                                            <span class="badge-dot bg-warning me-1"></span> Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-list flex-nowrap justify-content-center">
                                        @if ($d->status_approved == 0)
                                            <button type="button" class="btn btn-sm btn-outline-primary btn-icon approve-btn" id_izinsakit="{{ $d->id }}" title="Proses Persetujuan">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checkup-list" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 14l2 2l4 -4" /></svg>
                                            </button>
                                        @else
                                            <a href="/presensi/{{ $d->id }}/batalkanizinsakit" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1" title="Batalkan">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" /></svg>
                                                Batal
                                            </a>    
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-off mb-2 text-secondary" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.969 8.968c.312 -.021 .642 -.032 .971 -.032c3.866 0 7 1.623 7 3.63s-3.134 3.63 -7 3.63c-.34 0 -.675 -.015 -1 -.045" /><path d="M4 6c0 1.652 2.424 3.022 5.738 3.49m2.517 -.33c2.41 -.415 3.745 -1.408 3.745 -3.16c0 -2.007 -3.134 -3.63 -7 -3.63c-3.465 0 -6.34 1.308 -6.892 3.033" /><path d="M4 6v6c0 1.589 2.254 2.914 5.307 3.426m2.933 -.404c2.61 -.442 3.76 -1.47 3.76 -3.022v-6" /><path d="M4 12v6c0 2.007 3.134 3.63 7 3.63c1.233 0 2.392 -.164 3.378 -.453m2.77 -1.22c.545 -.503 .852 -1.144 .852 -1.957v-6" /><path d="M3 3l18 18" /></svg>
                                    <p class="mb-0 font-weight-medium">Tidak ada data izin atau sakit yang ditemukan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($izinsakit->hasPages())
                <div class="card-footer d-flex align-items-center justify-content-between bg-transparent">
                    <p class="m-0 text-muted small">Menampilkan data halaman ini</p>
                    <div>
                        {{ $izinsakit->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Modal Dialog --}}
<div class="modal modal-blur fade" id="modal-izinsakit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold">Aksi Persetujuan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/presensi/approveizinsakit" method="POST">
                @csrf
                <div class="modal-body py-4">
                    <input type="hidden" id="id_izinsakit_form" name="id_izinsakit_form">
                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold mb-2">Tentukan Status Dokumen</label>
                        <select name="status_approved" id="status_approved_modal" class="form-select form-select-lg text-dark">
                            <option value="1">✅ Setujui Permohonan</option>
                            <option value="2">❌ Tolak Permohonan</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary px-4" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-4 0l0 -4" /></svg>
                        Simpan Keputusan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('myscript')
    <script>
        $(function(){
            // Perbaikan trigger class pencarian ID ganda modal
            $(".approve-btn").click(function(e){
                e.preventDefault();
                var id_izinsakit = $(this).attr("id_izinsakit");
                $("#id_izinsakit_form").val(id_izinsakit);
                $("#modal-izinsakit").modal("show");
            });

            // Datepicker setup
            $("#dari, #sampai").datepicker({ 
                autoclose: true, 
                todayHighlight: true,
                format: 'yyyy-mm-dd',
                orientation: 'bottom auto'
            });
        });
    </script>
@endpush