@extends('layout.nav')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <div class="container mt-4">
        <!-- Tombol Cetak -->
        <div class="d-flex justify-content-between align-items-center mb-3 wow">
                  <h4 class="fw-bold">Laporan Beban Operasional</h4>
            <button onclick="window.print()" class="btn btn-light btn-sm btn-cetak">
                <i class="fa fa-print"></i> Cetak Laporan
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

            <!-- Aksi + Tombol -->
            <div class="col-md-4 d-flex gap-2 flex-wrap align-items-center">
                <a href="{{ route('laporanbbn.index') }}"
                    class="btn btn-outline-secondary btn-sm d-flex align-items-center justify-content-center"
                    style="width: 38px; height: 38px;">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
                <button type="submit" class="btn btn-dark btn-sm d-flex align-items-center flex-fill">
                    <i class="bi bi-search me-1"></i> Cari
                </button>

                <button type="button" class="btn btn-dark btn-sm d-flex align-items-center flex-fill"
                    data-bs-toggle="modal" data-bs-target="#modaltambah">
                    <i class="bi bi-plus me-1"></i> Tambah
                </button>
            </div>
        </form>
        <br>

        <!-- Area laporan -->
        <div id="laporan-area" class="bg-white text-dark p-4 rounded shadow">
            <h5 class="text-center fw-bold">PT. SumberBaru</h5>
            <h6 class="text-center">Laporan Beban Operasional</h6>

            <div class="table-responsive mt-3">
                <table class="table table-bordered text-dark">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Beban</th>
                            <th>Quantity Beban</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporanBbns as $laporan)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-justifay">{{ $laporan->nama }}</td>
                                <td class="text-center">Rp {{ number_format($laporan->quantity, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $laporan->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <button class="btn" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-{{ $laporan->id }}"
                                        style="background-color:#dc3545; border-color:#dc3545; color: white;">
                                        🗑️ Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Delete (per baris) -->
                            <div class="modal fade" id="deleteModal-{{ $laporan->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="deleteModalLabel-{{ $laporan->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content card">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button"
                                                class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 32px; height: 32px; padding: 0;" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true" class="text-white fs-5">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <p>Apakah Anda yakin ingin menghapus Data Beban
                                                <strong>{{ $laporan->nama }}</strong>?
                                            </p>
                                            <svg width="100" height="100" viewBox="0 0 200 200" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M96.9689 18.25C98.3161 15.9167 101.684 15.9167 103.031 18.25L172.313 138.25C173.66 140.583 171.976 143.5 169.282 143.5H30.718C28.0237 143.5 26.3397 140.583 27.6869 138.25L96.9689 18.25Z"
                                                    stroke="#9F1C1C" stroke-width="13" stroke-linejoin="round" />
                                                <path
                                                    d="M103.664 81.875L102.773 105.383H96.75L95.8594 81.875H103.664ZM95.6484 112.672C95.6484 111.625 96.0234 110.742 96.7734 110.023C97.5234 109.305 98.5156 108.945 99.75 108.945C100.969 108.945 101.945 109.305 102.68 110.023C103.43 110.742 103.805 111.625 103.805 112.672C103.805 113.734 103.43 114.625 102.68 115.344C101.945 116.047 100.969 116.398 99.75 116.398C98.5156 116.398 97.5234 116.047 96.7734 115.344C96.0234 114.625 95.6484 113.734 95.6484 112.672Z"
                                                    fill="#9F1C1C" />
                                            </svg>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('laporanbbn.destroy', $laporan) }}" method="POST"
                                                class="ml-2">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn"
                                                    style="background-color:#dc3545; color: white;">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Akhir Modal Delete -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah (diletakkan di luar loop) -->
    <div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content card">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Beban</h4>
                    <button type="button"
                        class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 32px; height: 32px; padding: 0;" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white fs-5">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('laporanbbn.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" name="quantity" required>
                        </div>

                        <br>
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-danger mx-4" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary mx-4">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Tambah -->

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

        .text-end {
            text-align: right;
        }
    </style>
@endsection
