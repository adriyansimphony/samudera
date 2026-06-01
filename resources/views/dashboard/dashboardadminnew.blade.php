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
                    Dashboard Admin
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards g-3">

            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm card-link card-bg-hover bg-success-lt border-0 shadow-sm transition-all duration-200" style="cursor: default;">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-success text-white avatar avatar-md rounded-3 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-fingerprint" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18.9 7a8 8 0 0 1 1.1 5v1a6 6 0 0 0 .8 3" /><path d="M8 11a4 4 0 0 1 8 0v1a10 10 0 0 0 2 6" /><path d="M12 11v2a14 14 0 0 0 2.5 8" /><path d="M8 15a18 18 0 0 0 1.8 6" /><path d="M4.9 19a22 22 0 0 1 -.9 -7v-1a8 8 0 0 1 12 -6.95" /></svg>
                                </span>
                            </div>
                            <div class="col ms-2">
                                <div class="text-secondary text-uppercase fw-bold fs-6 tracking-wider mb-1">
                                    Karyawan Hadir
                                </div>
                                <div class="h1 mb-0 fw-extrabold text-success">
                                    {{ $rekappresensi->jmlhadir }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm card-link card-bg-hover bg-info-lt border-0 shadow-sm transition-all duration-200" style="cursor: default;">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-info text-white avatar avatar-md rounded-3 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-text" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 9l1 0" /><path d="M9 13l6 0" /><path d="M9 17l6 0" /></svg>
                                </span>
                            </div>
                            <div class="col ms-2">
                                <div class="text-secondary text-uppercase fw-bold fs-6 tracking-wider mb-1">
                                    Karyawan Izin
                                </div>
                                <div class="h1 mb-0 fw-extrabold text-info">
                                    {{ $rekapizin->jmlizin ?? 0 }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm card-link card-bg-hover bg-warning-lt border-0 shadow-sm transition-all duration-200" style="cursor: default;">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-warning text-white avatar avatar-md rounded-3 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-medical" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M10 14l4 0" /><path d="M12 12l0 4" /></svg>
                                </span>
                            </div>
                            <div class="col ms-2">
                                <div class="text-secondary text-uppercase fw-bold fs-6 tracking-wider mb-1">
                                    Karyawan Sakit
                                </div>
                                <div class="h1 mb-0 fw-extrabold text-warning">
                                    {{ $rekapizin->jmlsakit ?? 0 }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm card-link card-bg-hover bg-danger-lt border-0 shadow-sm transition-all duration-200" style="cursor: default;">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-danger text-white avatar avatar-md rounded-3 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-x" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20.926 13.15a9 9 0 1 0 -7.835 7.784" /><path d="M12 7v5l2 2" /><path d="M22 22l-5 -5" /><path d="M17 22l5 -5" /></svg>
                                </span>
                            </div>
                            <div class="col ms-2">
                                <div class="text-secondary text-uppercase fw-bold fs-6 tracking-wider mb-1">
                                    Karyawan Terlambat
                                </div>
                                <div class="h1 mb-0 fw-extrabold text-danger">
                                    {{ $rekappresensi->jmlterlambat }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* Custom Styling tambahan untuk efek UI yang lebih halus */
    .card-bg-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08) !important;
    }
    .transition-all {
        transition-property: all;
    }
    .duration-200 {
        transition-duration: 200ms;
    }
</style>
@endsection