@extends('layout.nav')

@section('content')
    <style>
        .contents {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .balance-box {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: 0.2s ease;
        }

        .balance-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .subject-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .subject-row h3 {
            font-size: 16px;
            color: #555;
        }

        .subject-row h2 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        a.text-decoration-none {
            color: inherit;
        }

        .sapaan-box {
            background: linear-gradient(135deg, #fff4cc, #ffe6b3);
            border-left: 6px solid #ff9800;
            color: #5c4300;
            transition: all 0.3s ease;
        }

        .sapaan-box:hover {
            background: linear-gradient(135deg, #ffedcc, #fff3d9);
            transform: translateY(-2px);
        }
    </style>
    @php
        date_default_timezone_set('Asia/Jakarta');
        $user = auth()->user();
        $nama = $user->name ?? 'Pengguna';
        $jam = date('H');

        if ($jam < 11) {
            $salam = '🌅 Selamat pagi';
        } elseif ($jam < 15) {
            $salam = '☀️ Selamat siang';
        } elseif ($jam < 19) {
            $salam = '🌇 Selamat sore';
        } else {
            $salam = '🌙 Selamat malam';
        }

        // Array sapaan random yang akan dipilih sekali
        $ucapan = [
            'Semoga harimu penuh rejeki dan senyuman.',
            'Jangan lupa minum air putih dan tetap semangat 💪.',
            'Dashboard ini menunggumu untuk bikin perubahan!',
            'Langit cerah, semoga target hari ini pun tercapai!',
            'Santai tapi produktif, itu baru keren!',
            'Jangan lupa cek stok dan utang hari ini ya!',
            'Bisnis besar dimulai dari langkah rapi, seperti login ini.',
            'Toko rapi, hati pun tenang. Semangat bekerja!',
            'Transaksi kecil hari ini, bisa jadi untung besar esok hari!',
            'Stok cukup, semangat penuh, pelanggan pun puas!',
            'Hari baru, peluang baru. Yuk catat dengan rapi!',
            'Data yang rapi bikin bisnis makin pasti.',
            'Cek laporan dulu, biar keputusan nggak asal gas!',
            'Jangan tunggu stok habis baru panik — cek sekarang juga!',
            'Cuan datang ke toko yang rajin dicatat!',
            'Laba rugi bukan soal angka, tapi soal kendali.',
            'Kalau capek, rehat. Tapi jangan lupa simpan transaksi 😄',
            'Setiap klik hari ini adalah investasi untuk besok!',
        ];

        // Pilih satu secara acak per render
        $pesan = $ucapan[array_rand($ucapan)];
    @endphp

    <div class="sapaan-box shadow-sm rounded-3 mb-4 p-3 px-4">
        <h5 class="mb-1"><strong>{{ $salam }}, {{ strtolower($nama) }}!</strong></h5>
        <small class="text-muted text-black">Selamat Bekerja</small>
    </div>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <div class="contents">
        <div class="container-fluid p-0 m-0">
            <div class="container-fluid">
                <div class="bagian-chart">
                    <canvas id="lineChart" height="120"></canvas>
                </div>
                <div class="row g-3">

                    {{-- Baris 1 --}}
                    <div class="col-md-4">
                        <a href="{{ route('Penjualan') }}" class="text-decoration-none">
                            <div class="card balance-box">
                                <div class="subject-row">
                                    <div class="text wow">
                                        <h3 class="wow">Jumlah Penjualan</h3>
                                        <h2 class="wow">{{ $totalPemasukanCount }}</h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('LaporanPenjualan') }}" class="text-decoration-none">
                            <div class="card balance-box">
                                <div class="subject-row">
                                    <div class="text wow">
                                        <h3 class="wow">Total Pemasukan</h3>
                                        <h2 class="wow">{{ number_format($totalPemasukan, 0, ',', '.') }}</h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('LaporanPembelian') }}" class="text-decoration-none">
                            <div class="card balance-box">
                                <div class="subject-row">
                                    <div class="text wow">
                                        <h3 class="wow">Total Pengeluaran</h3>
                                        <h2 class="wow">{{ number_format($totalPengeluaran, 0, ',', '.') }}</h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    {{-- Baris 2 --}}
                    <div class="col-md-4">
                        <a href="{{ route('storage') }}" class="text-decoration-none">
                            <div class="card balance-box">
                                <div class="subject-row">
                                    <div class="text wow">
                                        <h3 class="wow">Total Barang</h3>
                                        <h2 class="wow">{{ $data['total_barang'] }}</h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('LaporanYangDibeli') }}" class="text-decoration-none">
                            <div class="card balance-box">
                                <div class="subject-row">
                                    <div class="text wow">
                                        <h3 class="wow">Total Barang Habis</h3>
                                        <h2 class="wow">{{ $data['barang_habis']->count() }}</h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('utangpiutang') }}" class="text-decoration-none">
                            <div class="card balance-box">
                                <div class="subject-row">
                                    <div class="text wow">
                                        <h3 class="wow">Jumlah Utang</h3>
                                        <h2 class="wow">{{ number_format($jumlahUtang, 0, ',', '.') }}</h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    {{-- Baris 3 --}}
                    <div class="col-md-4">
                        <a href="{{ route('Piutang') }}" class="text-decoration-none">
                            <div class="card balance-box">
                                <div class="subject-row">
                                    <div class="text wow">
                                        <h3 class="wow">Jumlah Piutang</h3>
                                        <h2 class="wow">{{ number_format($jumlahPiutang, 0, ',', '.') }}</h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('LaporanLabaRugi') }}" class="text-decoration-none">
                            <div class="card balance-box">
                                <div class="subject-row">
                                    <div class="text wow">
                                        <h3 class="wow">Total Keuntungan</h3>
                                        <h2 class="wow">{{ number_format($keuntungan, 0, ',', '.') }}</h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div> <!-- End of .row -->


                {{-- panggil Chart.js --}}
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const ctx = document.getElementById('lineChart').getContext('2d');
                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: {!! json_encode($labels) !!},
                                datasets: [{
                                        label: 'Pemasukan',
                                        data: {!! json_encode($pemasukan) !!},
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        fill: false,
                                    },
                                    {
                                        label: 'Pengeluaran',
                                        data: {!! json_encode($pengeluaran) !!},
                                        borderColor: 'rgba(255, 99, 132, 1)',
                                        fill: false,
                                    },
                                    {
                                        label: 'Keuntungan',
                                        data: {!! json_encode($keuntunganGrafik) !!},
                                        borderColor: 'rgba(87, 221, 45, 0.8)',
                                        fill: false,
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                interaction: {
                                    mode: 'index',
                                    intersect: false
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            callback: v => v.toLocaleString()
                                        }
                                    }
                                }
                            }
                        });
                    });
                </script>

            </div>
        </div>
    </div>
@endsection
