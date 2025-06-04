@extends('layout.nav')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3 wow">
            <h4 class="fw-bold">Laporan Stok Gudang - Barang yang Akan Dibeli</h4>
            <button onclick="window.print()" class="btn btn-primary btn-sm">
                <i class="fa fa-print"></i> Cetak
            </button>
        </div>

        <br>
        <div id="laporan-area" class="bg-white text-dark p-4 rounded shadow">
            <h5 class="text-center fw-bold">Sumber Maju</h5>
            <h6 class="text-center">Laporan Barang yang Akan Dibeli</h6>

            <div class="table-responsive mt-4">
                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Nama Barang</th>
                            <th>Kode Barang</th>
                            <th>Quantity</th>
                            <th>Minimum Stok</th>
                            <th>Supplier</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->Nama_Barang }}</td>
                                <td>{{ $item->kode_barang }}</td>
                                <td>{{ $item->Quantity }}</td>
                                <td>{{ $item->minimumbeli }}</td>
                                <td>{{ $item->nama_supplier }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Tidak ada barang yang perlu dibeli.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <style>
        @media print {
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
                    top: 0;
                    left: 0;
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

            .text-end {
                text-align: right;
            }

            #laporan-area {
                font-family: 'Open Sans', sans-serif;
            }
        }
    </style>
@endsection
