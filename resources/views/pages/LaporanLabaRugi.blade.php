@extends('layout.nav')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <div class="container mt-4">
        <!-- Tombol Cetak -->
        <div class="d-flex justify-content-between align-items-center mb-3 wow">
                  <h4 class="fw-bold">Laporan Laba Rugi</h4>
            <button onclick="window.print()" class="btn btn-light btn-sm btn-cetak">
                <i class="fa fa-print"></i> Cetak Laporan
            </button>
        </div>
        {{-- <form method="get" class="row gy-2 gx-3 align-items-end">
            <!-- Start Date -->
            <div class="col-md-4">
                <label for="start_date" class="form-label wow">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control"
                    value="{{ request('start_date') }}">
            </div>
    
            <!-- End Date -->
            <div class="col-md-4">
                <label for="end_date" class="form-label wow">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control"
                    value="{{ request('end_date') }}">
            </div>
    
            <!-- Aksi + Checkbox “Tampilkan Semua” -->
            <div class="col-md-4 d-flex gap-2 flex-wrap align-items-center">
                {{--  --}}

        {{-- <a href="{{ route('LaporanLabaRugi') }}"
                    class="btn btn-outline-secondary btn-sm d-flex align-items-center justify-content-center"
                    style="width: 38px; height: 38px;">
                    <i class="bi bi-arrow-clockwise"></i>
                </a> --}}
        {{-- <!-- Tombol Cari -->
    <button type="submit" class="btn btn-dark btn-sm d-flex align-items-center flex-fill">
        <i class="bi bi-search me-1"></i> Cari
    </button> --}}

        {{-- <button type="button" class="btn btn-dark btn-sm d-flex align-items-center flex-fill"
        data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus me-1"></i> Tambah
    </button> --}}

        {{--     
            </div>
        </form>  --}}
        <br>
        <!-- Area laporan yang akan dicetak -->
        <div id="laporan-area" class="bg-white text-black p-4 rounded shadow">
            <h4 class="text-center fw-bold">SUMBER BARU</h4>
            <h5 class="text-center">LAPORAN LABA RUGI</h5>
            <p class="text-center">Periode: 1 Januari 2023 – 31 Maret 2023</p>

            <div class="table-responsive mt-4">
                <table class="table table-bordered text-black">
                    <thead>
                        <tr>
                            <th colspan="2">Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Penjualan</td>
                            <td class="text-center">Rp {{ number_format($penjualanBersih, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="fw-bold bg-light text-dark">
                            <td>Total</td>
                            <td class="text-center">Rp {{ number_format($penjualanBersih, 0, ',', '.') }}</td>
                        </tr>

                        <tr>
                            <td colspan="2" class="pt-4 pb-2 fw-bold">Beban</td>
                        </tr>
                        <tr class="fw-bold bg-light text-dark">
                            <td>Total Beban</td>
                            <td class="text-center">{{ number_format($totalBeban, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="fw-bold text-success">
                            <td>Laba Bersih</td>
                            <td class="text-center">{{ number_format($labaBersih, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- CSS Khusus Print -->
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #laporan-area,
            #laporan-area * {
                visibility: visible;
            }

            #laporan-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0 auto;
            }

            .btn-cetak,
            nav,
            footer,
            .sidebar,
            .navbar {
                display: none !important;
            }

            @page {
                margin: 1.5cm;
            }
        }

        .ps-4 {
            padding-left: 2rem !important;
        }

        .text-end {
            text-align: right;
        }
    </style>
@endsection
