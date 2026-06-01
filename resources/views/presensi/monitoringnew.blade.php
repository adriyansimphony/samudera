@extends('layouts.admin.tabler')
@section('content')

<div class="page-header d-print-none text-white p-4 rounded-3 mb-4 shadow-sm" style="background: linear-gradient(135deg, #1f2937 0%, #111827 100%);">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle text-blue fw-bold text-uppercase tracking-wider">
                    Live Monitor
                </div>
                <h2 class="page-title text-white fw-bold fs-2">
                    Monitoring Presensi Karyawan
                </h2>
                <p class="text-muted small mb-0 mt-1">Pantau aktivitas masuk dan pulang karyawan secara real-time hari ini.</p>
            </div>
        </div>
    </div>
</div>

<div class="page-body m-0">
    <div class="container-xl">
        
        <div class="row row-cards mb-4 g-3 align-items-stretch">
            <div class="col-md-4 col-sm-12">
                <div class="card shadow-sm border-0 h-100 justify-content-center p-3">
                    <label class="form-label fw-bold text-dark mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1 text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /></svg>
                        Pilih Tanggal Log Presensi
                    </label>
                    <div class="input-icon">
                        <input type="text" value="{{ date('Y-m-d') }}" id="tanggal" name="tanggal" class="form-control form-control-lg fw-bold text-primary bg-light border-0 shadow-xs" placeholder="Pilih Tanggal" autocomplete="off" readonly style="cursor: pointer;">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" /><path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M15 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M18 14v4h4" /></svg>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8 col-sm-12">
                <div class="card shadow-sm border-0 bg-blue-lt h-100 p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="card-title mb-1 text-blue fw-bold">Status Monitoring Aktif</h4>
                            <p class="text-secondary small mb-0">Sistem melakukan pembaruan otomatis setiap kali ada karyawan yang melakukan scan presensi.</p>
                        </div>
                        <span class="badge bg-success text-success-fg animate-pulse px-3 py-2 fw-bold d-flex align-items-center">
                            <span class="blob me-2"></span> LIVE REFRESH
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cards">
            <div class="col-12">
                <div class="card shadow-sm border-0 overflow-hidden">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                        <h3 class="card-title fw-bold text-dark m-0">Log Riwayat Presensi Masuk & Pulang</h3>
                        <span class="badge bg-light text-dark border px-2 py-1" id="total-log-counter">Memuat...</span>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table table-hover mb-0">
                            <thead>
                                <tr class="bg-light text-uppercase tracking-wider fs-6">
                                    <th class="w-1 text-center fw-bold text-secondary">No.</th>
                                    <th class="fw-bold text-secondary">Karyawan</th>
                                    <th class="fw-bold text-secondary">Departemen</th>
                                    <th class="fw-bold text-secondary text-center" style="background-color: rgba(43, 187, 131, 0.05);">Jam Masuk</th>
                                    <th class="fw-bold text-secondary text-center" style="background-color: rgba(43, 187, 131, 0.05);">Foto Masuk</th>
                                    <th class="fw-bold text-secondary text-center" style="background-color: rgba(66, 153, 225, 0.05);">Jam Pulang</th>
                                    <th class="fw-bold text-secondary text-center" style="background-color: rgba(66, 153, 225, 0.05);">Foto Pulang</th>
                                    <th class="fw-bold text-secondary text-center">Status / Ket</th>
                                    <th class="w-1 text-center fw-bold text-secondary">Aksi Maps</th>
                                </tr>
                            </thead>
                            <tbody id="loadpresensi">
                                <tr>
                                    <td colspan="9" class="text-center py-5">
                                        <div class="empty py-4">
                                            <div class="empty-img">
                                                <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
                                            </div>
                                            <p class="empty-title mt-3 text-muted">Menghubungkan ke server...</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal modal-blur fade" id="modal-tampilkanpeta" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content shadow-lg border-0 rounded-4 overflow-hidden">
            <div class="modal-header text-white p-3 border-0" style="background: linear-gradient(135deg, #206bc4 0%, #1a569d 100%);">
                <h5 class="modal-title text-white d-flex align-items-center fw-bold fs-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 icon-tabler-map-pin-filled animate-bounce" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" /></svg>
                    Lokasi Presensi Geotagging Karyawan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 position-relative" id="loadmap" style="min-height: 450px; background-color: #eef2f7;">
                </div>
        </div>
    </div>
</div>

<style>
    /* UI Custom Animasi & Efek */
    .shadow-xs { box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
    
    /* Live Refresh Pulse Blob Animation */
    .animate-pulse {
        position: relative;
    }
    .blob {
        display: inline-block;
        background: #2fb344;
        border-radius: 50%;
        box-shadow: 0 0 0 0 rgba(47, 179, 68, 0.7);
        margin: 4px;
        height: 10px;
        width: 10px;
        transform: scale(1);
        animation: pulse-black 2s infinite;
    }
    @keyframes pulse-black {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(47, 179, 68, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(47, 179, 68, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(47, 179, 68, 0); }
    }
    
    /* Hover Effect untuk Baris Tabel */
    .table-hover tbody tr:hover {
        background-color: rgba(32, 107, 196, 0.03) !important;
        transition: background-color 0.2s ease-in-out;
    }
</style>
@endsection

@push('myscript')
<script>
    $(function(){
        // Konfigurasi Datepicker Premium Look
        $("#tanggal").datepicker({ 
            autoclose: true, 
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            orientation: 'bottom auto'
        });

        // AJAX Loader Main Function
        function loadpresensi(){
            var tanggal = $("#tanggal").val();
            
            // Efek skeleton loading yang rapi saat data berganti
            $("#loadpresensi").html(`
                <tr>
                    <td colspan="9" class="text-center py-5">
                        <div class="d-flex justify-content-center align-items-center py-4 text-muted">
                            <div class="spinner-border text-primary me-3" role="status"></div>
                            <span>Sinkronisasi data presensi tanggal <strong>${tanggal}</strong>...</span>
                        </div>
                    </td>
                </tr>
            `);

            $.ajax({
                type: 'POST',
                url: '/getpresensi',
                data: {
                    _token: "{{ csrf_token() }}",
                    tanggal: tanggal
                },
                cache: false,
                success: function(respond){
                    if(respond.trim() == "") {
                        $("#loadpresensi").html(`
                            <tr>
                                <td colspan="9" class="text-center py-5 text-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted mb-2 icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10v4" /><path d="M12 16v.01" /></svg>
                                    <p class="mb-0 fw-semibold">Tidak ditemukan log presensi untuk tanggal ini.</p>
                                </td>
                            </tr>
                        `);
                        $("#total-log-counter").text("0 Record");
                    } else {
                        $("#loadpresensi").html(respond);
                        
                        // Menghitung jumlah baris yang masuk untuk ditampilkan pada badge counter
                        var rowCount = $('#loadpresensi tr').length;
                        $("#total-log-counter").text(rowCount + " Data Ditemukan");
                    }
                },
                error: function() {
                    $("#loadpresensi").html(`
                        <tr>
                            <td colspan="9" class="text-center py-4 text-danger fw-semibold">
                                Gagal memuat data dari server. Silakan muat ulang halaman.
                            </td>
                        </tr>
                    `);
                    $("#total-log-counter").text("Error");
                }
            });
        }

        // Listener perubahan kalender tanggal
        $("#tanggal").change(function(e){
            loadpresensi();
        });

        // Jalankan saat pertama kali dibuka
        loadpresensi();
    });
</script>
@endpush