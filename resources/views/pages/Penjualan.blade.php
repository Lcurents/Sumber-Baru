@extends('layout.nav')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        label,
        input,
        button,
        select,
        table,
        th,
        td {
            font-family: 'Open Sans', sans-serif;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table.table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: center;
            vertical-align: middle;
            padding: 12px 8px;
            white-space: nowrap;
        }

        .btn-info,
        .btn-danger {
            padding: 4px 8px;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: scroll;
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>

    <div class="container-fluid wow">
        <h1 class="title">Penjualan</h1>

        <div class="card">
            <div class="card-body">
                <form method="get" class="row g-3">
                    <div class="row align-items-end">
                        <div class="col-12 col-md-6">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control"
                                value="{{ request('start_date') }}">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control"
                                value="{{ request('end_date') }}">
                        </div>

                        <div class="col-12 d-flex flex-wrap gap-2 mt-3">
                            <a href="{{ route('Penjualan') }}"
                                class="btn btn-outline-secondary btn-sm d-flex align-items-center justify-content-center">
                                <i class="bi bi-arrow-clockwise"></i>
                            </a>
                            <button type="submit" class="btn btn-outline-dark btn-sm flex-fill">
                                <i class="bi bi-search"></i> Cari
                            </button>

                        </div>
                    </div>
                </form>


                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover">
                        <thead class="text-center wow">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                                <th>Pembayaran</th>
                                <th>Deskripsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="wow">
                            @forelse ($transaksi as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                                    <td>{{ $item->status_bayar }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modalDeskripsi-{{ $item->id }}">
                                            <i class="bi bi-eye"></i> View
                                        </button>
                                    </td>
                                    <td>
                                        <form action="{{ route('transaksi.delete', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Hapus data ini?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Tidak ada data transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center">
                    {{ $transaksi->links() }}
                </div>

                @foreach ($transaksi as $item)
                    <div class="modal fade" id="modalDeskripsi-{{ $item->id }}" tabindex="-1"
                        aria-labelledby="deskripsiModalLabel-{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Deskripsi Barang</h5>
                                    <button type="button" class="btn btn-danger rounded-circle"
                                        data-bs-dismiss="modal">x</button>
                                </div>
                                <div class="modal-body">
                                    @if ($item->status_bayar === 'Kredit')
                                        <p><strong>Tanggal Masuk: {{ $item->created_at }}</strong></p>
                                        <p>Nama Pemesan: {{ $item->nama }}</strong></p>
                                        <p><strong>Kontak Pemsesan:{{ $item->no_hp }}</strong></p>
                                    @endif
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Transaksi</th>
                                                    <th>Barang</th>
                                                    <th>Quantity</th>
                                                    <th>Harga Beli</th>
                                                    <th>Subtotal</th>
                                                    @if ($item->jenis === 'Pengeluaran')
                                                        <th>Jatuh Tempo</th>
                                                    @endif
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $count = 1; @endphp
                                                @foreach ($detail->where('transaksi_id', $item->id) as $d)
                                                    <tr>
                                                        <td>{{ $count++ }}</td>
                                                        <td>{{ $item->jenis }}</td>
                                                        <td>{{ $d->nama_barang }}</td>
                                                        <td>{{ $d->quantity }}</td>
                                                        <td>Rp{{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
                                                        <td>Rp{{ number_format($d->subtotal, 0, ',', '.') }}</td>
                                                        @if ($item->jenis === 'Pengeluaran')
                                                            <td>{{ $item->jatuh_tempo ?? '-' }}</td>
                                                        @endif
                                                        <td>
                                                            @if ($item->status_bayar === 'Lunas' || $item->status_piutang === 'selesai')
                                                                Lunas
                                                            @else
                                                                Belum Lunas
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @if ($detail->where('transaksi_id', $item->id)->count() == 0)
                                                    <tr>
                                                        <td colspan="6" class="text-center text-muted">Tidak ada data
                                                            detail transaksi.</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <p class="mt-3 text-muted"><strong>Catatan:</strong> {{ $item->deskripsi ?? '-' }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach



            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-barang').select2({
                dropdownParent: $('#modalTambah'),
                width: '100%',
                placeholder: 'Pilih barang',
                allowClear: true
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const jenisSelect = document.getElementById('edit-jenis');
            const formBarang = document.getElementById('form-barang');
            const formQuantity = document.getElementById('form-quantity');

            function toggleFormFields() {
                const jenis = jenisSelect.value;

                if (jenis === 'Pengeluaran') {
                    formBarang.style.display = 'block';
                    formQuantity.style.display = 'block';
                } else {
                    formBarang.style.display = 'none';
                    formQuantity.style.display = 'none';
                }
            }

            toggleFormFields();
            jenisSelect.addEventListener('change', toggleFormFields);
        });
    </script>
@endsection
