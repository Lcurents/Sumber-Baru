@extends('layout.nav')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3 wow">
            <h4 class="fw-bold">Laporan Minimum Stok</h4>
            <button onclick="window.print()" class="btn btn-success btn-sm">
                <i class="fa fa-print"></i> Cetak
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
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>

            <!-- Aksi + Checkbox “Tampilkan Semua” -->
            <div class="col-md-4 d-flex gap-2 flex-wrap align-items-center">
                {{--  --}}

                {{-- <a href="{{ route('LaporanMinimum') }}"
                    class="btn btn-outline-secondary btn-sm d-flex align-items-center justify-content-center"
                    style="width: 38px; height: 38px;">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
                <!-- Tombol Cari -->
                <button type="submit" class="btn btn-dark btn-sm d-flex align-items-center flex-fill">
                    <i class="bi bi-search me-1"></i> Cari
                </button>

                <button type="button" class="btn btn-dark btn-sm d-flex align-items-center flex-fill"
                    data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="bi bi-plus me-1"></i> Tambah
                </button>


            </div>
        </form>  --}}
        <br>
        <div class="table-responsive bg-white shadow rounded p-3" id="laporan-area">
            <h5 class="text-center mb-4">Minimum Stock Report</h5>
            <table class="table table-bordered text-dark table-hover">
                <thead class="table-light text-center">
                    <tr>

                        <th>Id Barang</th>
                        <th>Nama Barang</th>
                        <th>Quantity Minimum</th>
                        <th>Current Quantity</th>
                        <th>Satuan</th>


                    </tr>

                </thead>
                <tbody>
                    @foreach ($barangs as $barang)
                        <tr>
                            <td class="text-center">{{ $barang->ID }}</td>
                            <td class="text-center">{{ $barang->Nama_Barang }}</td>
                            <td class="text-center">{{ $barang->minimumbeli }}</td>
                            <td class="text-center">{{ $barang->Quantity }}</td>
                            <td class="text-center">{{ $barang->nama_satuan }}</td>


                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

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
            }

            .btn,
            nav,
            .sidebar,
            footer {
                display: none !important;
            }

            @page {
                margin: 1.5cm;
            }
        }
    </style>
@endsection
