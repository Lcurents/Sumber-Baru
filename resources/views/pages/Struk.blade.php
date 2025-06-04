@extends('layout.nav')

@section('content')
    <link rel="stylesheet" href="{{ asset('origalih/style.css') }}">
  <style>
    /* Container struk */
    #laporan-area {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        max-width: 380px;
        margin: 20px auto;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        padding: 16px;
    }

    /* Header struk */
    #laporan-area .text-center h3 {
        margin: 0;
        font-size: 1.25rem;
        letter-spacing: 0.5px;
    }
    #laporan-area .text-center small {
        display: block;
        margin-top: 4px;
        color: #666;
        font-size: 0.85rem;
    }
    #laporan-area hr {
        border-top: 1px dashed #ccc;
        margin: 12px 0;
    }

    /* Tabel detail */
    #laporan-area table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 8px;
    }
    #laporan-area th,
    #laporan-area td {
        padding: 8px 6px;
        font-size: 0.9rem;
        border-bottom: 1px solid #e0e0e0;
    }
    #laporan-area th {
        background: #f9f9f9;
        font-weight: 600;
        text-align: left;
    }
    #laporan-area td.text-end {
        text-align: right;
    }

    /* Baris total */
    #laporan-area .text-end.mt-4 {
        margin-top: 12px !important;
        font-size: 1rem;
        font-weight: 700;
    }

    /* Print overrides */
    @media print {
        @page { margin: 1.5cm; }
        body * { visibility: hidden; }
        #laporan-area,
        #laporan-area * { visibility: visible; }
        #laporan-area {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            box-shadow: none;
            margin: 0;
        }
        .btn-cetak,
        nav, footer, .sidebar, .navbar {
            display: none !important;
        }
    }
</style>

      <!-- Print Button (hidden in print) -->
    <div class="card-footer text-end print-hidden">
-       <button class="btn btn-dark btn-cetak" onclick="window.print()">
+       <button class="btn btn-dark btn-cetak"
+               onclick="window.print(); window.location.href='{{ route('storage') }}'">
           🖨 Cetak
       </button>
    </div>

    <!-- Receipt Area -->
    <div id="laporan-area">
        <!-- Header -->
        <div class="text-center mb-3">
            <h3 class="fw-bold mb-1">Sumber Baru</h3>
            <small id="jamWIBCetak">Waktu Cetak: --:--:-- WIB</small>
            <hr style="border-top: 2px dashed #000; margin: 12px 0;">
        </div>

        <div class="card">
            <div class="card-header text-center">
                <h4 class="mb-0">Struk Pembayaran</h4>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <p class="mb-1"><strong>No.Transaksi:</strong> {{ $transaksi->kode_transaksi }}</p>
                    <p class="mb-0"><strong>Tanggal:</strong> {{ $transaksi->created_at->format('Y-m-d') }}</p>
                    <div class="d-print-none text-muted small">
                        Jam Real-time: <span id="jamWIBLive">--:--:--</span> WIB
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detail as $item)
                            <tr>
                                <td>{{ $item->barang->Nama_Barang }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td>Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h5 class="text-end mt-4">
                    <strong>Total: Rp{{ number_format($transaksi->total, 0, ',', '.') }}</strong>
                </h5>
            </div>
        </div>
    </div>

    <!-- Live Clock Script -->
    <script>
        window.addEventListener('load', () => window.print());
        window.addEventListener('afterprint', () => {
            window.location.href = "{{ route('storage') }}";
        });

        function updateWaktu() {
            const now = new Date();
            const wib = new Date(now.toLocaleString('en-US', { timeZone: 'Asia/Jakarta' }));
            const [jam, menit, detik] = [wib.getHours(), wib.getMinutes(), wib.getSeconds()]
                .map(v => String(v).padStart(2, '0'));
            document.getElementById('jamWIBLive').textContent = `${jam}:${menit}:${detik}`;
            document.getElementById('jamWIBCetak').textContent = `Waktu Cetak: ${jam}:${menit}:${detik} WIB`;
        }
        setInterval(updateWaktu, 1000);
        updateWaktu();
    </script>
@endsection