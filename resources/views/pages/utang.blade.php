@extends('layout.nav')

@section('content')
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Styling global -->
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
    </style>
    <style>
        @media (max-width: 576px) {
            .card {
                margin: 0.1 !important;
                border-radius: 1 !important;
                box-shadow: none !important;
            }

            .card-body {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }

            .container-fluid {
                padding-left: 0 !important;
                padding-right: 0 !important;
            }

            main {
                padding-left: 0 !important;
                padding-right: 0 !important;
            }

            body {
                overflow-x: hidden !important;
            }

        }
    </style>

    <style>
        .pagination {
            display: flex;
            justify-content: center;
            padding: 0.5rem;
            list-style: none;
            border-radius: 10px;
            background-color: #212529;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .pagination li {
            margin: 0 2px;
        }

        .pagination a,
        .pagination span {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
            color: #212529;
            font-weight: 500;
            background-color: white;
            transition: 0.3s ease;
        }

        .pagination .active span {
            background-color: #212529;
            color: white;
            font-weight: bold;
        }

        .pagination a:hover {
            background-color: #e2e6ea;
            color: #212529;
        }

        .pagination .disabled span {
            color: #ccc;
            pointer-events: none;
        }
    </style>


    <main>
        <h1 class="title wow">Utang</h1>
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <div class="container-fluid p-0 m-0">
            <div class="card">
                <div class="card-body">
                    <!-- Filter Form -->
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
                                <a href="{{ route('utangpiutang') }}"
                                    class="btn btn-outline-secondary btn-sm d-flex align-items-center justify-content-center">
                                    <i class="bi bi-arrow-clockwise"></i>
                                </a>
                                <button type="submit" class="btn btn-outline-dark btn-sm flex-fill">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                                <button type="button" class="btn btn-outline-dark btn-sm flex-fill" data-bs-toggle="modal"
                                    data-bs-target="#modalTambah">
                                    <i class="bi bi-plus"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </form>


                    <!-- Tabel Data -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-hover text-nowrap">
                            <thead class="text-center wow">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Biaya</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="wow">
                                @forelse ($transaksi as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $item->created_at }}</td>
                                        <td class="text-center">Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $item->jatuh_tempo }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                data-bs-target="#modalDeskripsi-{{ $item->id }}">
                                                <i class="bi bi-eye"></i> View
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            @if ($item->status === 'belum')
                                                <form action="{{ route('utangpiutang.selesaikan', ['id' => $item->id]) }}"
                                                    method="POST" class="d-inline-block"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menyelesaikan transaksi ini?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-warning">
                                                        <i class="bi bi-check-circle"></i> Selesaikan
                                                    </button>
                                                </form>
                                            @elseif ($item->status === 'selesai')
                                                <button type="button" class="btn btn-sm btn-success" disabled>
                                                    <i class="bi bi-check-circle"></i> Lunas
                                                </button>
                                            @endif
                                            <form action="{{ route('utangpiutang.delete', ['id' => $item->id]) }}"
                                                method="POST" class="d-inline-block">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger"
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
                            <tr class="fw-bold table-light">
                                <td colspan="2" class="text-center">Total</td>
                                <td class="text-center">Rp{{ number_format($totalBelumLunas, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                        {{-- Tampilkan link pagination --}}
                        <div class="d-flex justify-content-center">
                            {{ $transaksi->links() }}
                        </div>

                    </div>

                    <!-- Modal View Deskripsi -->
                    @foreach ($transaksi as $item)
                        <div class="modal fade" id="modalDeskripsi-{{ $item->id }}" tabindex="-1"
                            aria-labelledby="deskripsiModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Deskripsi Barang</h5>
                                        <button type="button"
                                            class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 32px; height: 32px; padding: 0;" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true" class="text-white fs-5">x</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="table-responsive w-100">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr class="WOW">
                                                        <th class="text-center">No</th>
                                                        <th class="text-center">Transaksi</th>
                                                        <th class="text-center">Barang</th>
                                                        <th class="text-center">Quantity</th>
                                                        <th class="text-center">Harga Satuan</th>
                                                        <th class="text-center">Subtotal</th>
                                                        <th class="text-center">Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="WOW">
                                                    @php $count = 1; @endphp
                                                    @foreach ($detail->where('transaksi_id', $item->id) as $d)
                                                        <tr class="WOW">
                                                            <td class="text-center">{{ $count++ }}</td>
                                                            <td class="text-center">{{ $item->jenis }}</td>
                                                            <td class="text-center">{{ $d->nama_barang }}</td>
                                                            <td class="text-center">{{ $d->quantity }}</td>
                                                            <td class="text-center">
                                                                Rp{{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
                                                            <td class="text-center">
                                                                Rp{{ number_format($d->subtotal, 0, ',', '.') }}</td>
                                                            <td class="text-center">
                                                                {{ $item->status }}({{ $item->updated_at }}) </td>
                                                        </tr>
                                                    @endforeach
                                                    @if ($detail->where('transaksi_id', $item->id)->count() == 0)
                                                        <tr>
                                                            <td colspan="6" class="text-center text-muted">Tidak ada
                                                                data transaksi detail.</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                            {{-- Tampilkan link pagination --}}


                                        </div>
                                        <p class="mb-0 mt-3 text-muted"><strong>Catatan:</strong>
                                            {{ $item->deskripsi ?? '-' }}</p>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    <!-- Modal Tambah -->
                    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="tambahModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('utangpiutang.post') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" id="edit-id" name="id">

                                        <!-- Jenis Transaksi -->
                                        <!-- Jenis -->
                                        {{-- <div class="mb-3">
                                            <label for="edit-jenis" class="form-label">Jenis</label>
                                            <select class="form-select" id="edit-jenis" name="jenis" required>
                                                <option value="">-</option>
                                                <option value="Utang">Utang</option>
                                                <option value="Piutang">Piutang</option>
                                            </select>
                                        </div> --}}
                                        <input type="hidden" name="jenis" value="Utang">

                                        <!-- Biaya -->
                                        <div class="mb-3">
                                            <label for="edit-biaya" class="form-label">Biaya</label>
                                            <input type="number" class="form-control" id="edit-biaya" name="biaya"
                                                required>
                                        </div>

                                        <!-- Deskripsi (Opsional) -->
                                        <div class="mb-3">
                                            <label for="edit-deskripsi" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" id="edit-deskripsi" name="deskripsi" placeholder="Opsional..."></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit-deskripsi" class="form-label">Jatuh Tempo</label>
                                            <input type="date" class="form-control" name="jatuh_tempo">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- jQuery + Event Script -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            // Inisialisasi Select2
                            $('.select-barang').select2({
                                dropdownParent: $('#modalTambah'), // Ini ID modal kamu
                                width: '100%',
                                placeholder: 'Pilih barang',
                                allowClear: true
                            });

                            // Isi form edit dari data baris
                            $('.btn-edit').on('click', function() {
                                let row = $(this).closest('tr');
                                $('#edit-id').val(row.data('id'));
                                $('#edit-biaya').val(row.data('biaya'));
                                $('#edit-kategori').val(row.data('kategori'));
                                $('#edit-deskripsi').val(row.data('deskripsi'));
                            });

                            // Tampilkan deskripsi
                            $('.btn-view-deskripsi').on('click', function() {
                                let row = $(this).closest('tr');
                                $('#isiDeskripsi').text(row.data('deskripsi'));
                            });
                        });


                        // Bagan hidden
                        document.addEventListener('DOMContentLoaded', function() {
                            const jenisSelect = document.getElementById('edit-jenis');
                            const formBarang = document.getElementById('form-barang');
                            const formQuantity = document.getElementById('form-quantity');

                            function toggleFormFields() {
                                const jenis = jenisSelect.value.toLowerCase();

                                if (jenis === 'utang') {
                                    formBarang.style.display = 'block';
                                    formQuantity.style.display = 'block';
                                } else if (jenis === 'piutang') {
                                    formBarang.style.display = 'none';
                                    formQuantity.style.display = 'none';
                                } else {
                                    formBarang.style.display = 'none';
                                    formQuantity.style.display = 'none';
                                }
                            }

                            // Initial state
                            toggleFormFields();

                            // Update on change
                            jenisSelect.addEventListener('change', toggleFormFields);
                        });
                    </script>

                    <!-- Bootstrap JS -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                </div>
            </div>
        </div>
    </main>
@endsection
