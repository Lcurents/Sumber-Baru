@extends('layout.nav')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <div class="container mt-4">
        <!-- Tombol Cetak -->
        <div class="d-flex justify-content-between align-items-center mb-3 wow">
                  <h4 class="fw-bold">Laporan Pembelian</h4>
            <button onclick="window.print()" class="btn btn-primary btn-sm btn-cetak">
                <i class="fa fa-print"></i> Cetak Pembelian
            </button>
        </div>
        <form method="get" class="row gy-2 gx-3 align-items-end">
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

                <a href="{{ route('LaporanPembelian') }}"
                    class="btn btn-outline-secondary btn-sm d-flex align-items-center justify-content-center"
                    style="width: 38px; height: 38px;" title="Reset filter">
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
        </form>
        <br>
        <!-- Area laporan -->
        <div id="laporan-area" class="bg-light text-dark p-4 rounded shadow">
            <h5 class="text-center fw-bold">Toko Sumber Maju</h5>
            <h6 class="text-center">Laporan Pembelian </h6>

            <table class="table table-striped table-bordered mt-4">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kode Barang</th>
                        <th>Supplier</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @forelse ($pembelian as $index => $item)
                        @php
                            $subtotal = $item->jumlah * $item->harga;
                            $grandTotal += $subtotal;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}</td>
                            <td class="text-center">{{ $item->kode }}</td>
                            <td class="text-center">{{ $item->supplier }}</td>
                            <td class="text-center">{{ $item->nama }}</td>
                            <td class="text-center">{{ $item->jumlah }}</td>
                            <td class="text-center">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="text-center">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data pembelian pada periode ini.
                            </td>
                        </tr>
                    @endforelse
                    <tr class="fw-bold table-info">
                        <td></td>
                        <td colspan="6" class="text-center">Total Keseluruhan</td>
                        <td class="text-center">Rp{{ number_format($grandTotal, 0, ',', '.') }}</td>
                    </tr>
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
    </style>
@endsection
