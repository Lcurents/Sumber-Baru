@extends('layout.nav')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <div class="container mt-4">
         <div class="d-flex justify-content-between align-items-center mb-3 wow">
                  <h4 class="fw-bold">Laporan Penjualan</h4>
            <button onclick="window.print()" class="btn btn-light btn-sm btn-cetak">
                <i class="bi bi-printer-fill"></i> Cetak Laporan
            </button>
        </div>

        <div id="laporan-area" class="bg-white text-dark p-4 rounded shadow">

            <h5 class="text-center fw-bold">Sumber Maju</h5>
            <h6 class="text-center">Laporan Penjualan</h6>
            <p class="text-center">
                Periode Bulan: {{ \Carbon\Carbon::parse($bulan)->translatedFormat('F Y') }}
            </p>

            <div class="table-responsive mt-3">
                <table class="table table-bordered text-dark">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Transaksi‑ID</th>
                            <th>Status Bayar</th>
                            <th>Total Penjualan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualan as $index => $row)
                            @php
                                $pembayaran = strtolower($row->status_bayar) === 'lunas' ? $row->total : 0;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $row->kode_transaksi }}</td>
                                <td class="text-center">{{ $row->status_bayar }}</td>
                                <td class="text-center">Rp{{ number_format($row->total, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr class="fw-bold table-light">
                            <td colspan="3" class="text-center">Total</td>
                            <td class="text-center">Rp{{ number_format($totalPenjualan, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * { visibility: hidden; }
            #laporan-area, #laporan-area * { visibility: visible; }
            #laporan-area { position: absolute; top: 0; left: 0; width: 100%; }
            .btn-cetak, nav, footer, .sidebar, .navbar { display: none !important; }
            @page { margin: 1.5cm; }
        }

        .text-end { text-align: right; }
        #laporan-area { font-family: 'Open Sans', sans-serif; }
    </style>
@endsection
