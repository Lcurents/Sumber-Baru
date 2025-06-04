@extends('layout.nav')

@section('content')

    <style>
        .cart-sidebar {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.95);
            width: 95%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            background: #ffffff;
            z-index: 1050;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, opacity 0.3s ease;
            opacity: 0;
            visibility: hidden;
        }

        .cart-sidebar.show {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
            visibility: visible;
        }

        .cart-divider {
            border-top: 1px solid #dee2e6;
            margin: 1rem 0;
        }

        .cart-empty {
            padding: 40px 10px;
            color: #888;
            font-size: 14px;
            text-align: center;
        }

        .btn-checkout {
            border: none;
            background: linear-gradient(135deg, #ffc107, #fcd54e);
            color: #000;
            font-weight: bold;
            padding: 10px;
            border-radius: 10px;
            width: 100%;
            transition: background 0.3s ease;
        }

        .btn-outline-dark {
            background: linear-gradient(135deg, #ffb300, #f9ca24);
        }

        .btn-checkout:hover {
            background: linear-gradient(135deg, #ffb300, #f9ca24);
        }

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-delay-1 {
            animation-delay: 0.1s;
        }

        .fade-in-delay-2 {
            animation-delay: 0.2s;
        }

        .fade-in-delay-3 {
            animation-delay: 0.3s;
        }

        .fade-in-delay-4 {
            animation-delay: 0.4s;
        }

        .produk-card {
            border-radius: 18px;
            background: #ffffff;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: all 0.3s ease-in-out;
        }

        .produk-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 30px rgba(0, 0, 0, 0.15);
        }

        .btn-cart-custom {
            border-radius: 10px;
            background: linear-gradient(135deg, #ffb300, #f9ca24);
            color: black;
            transition: background-color 0.2s ease;
        }

        .btn-cart-custom:hover {
            background-color: #ffb300, #f9ca24;
        }
    </style>

    <!-- (rest of the unchanged content stays as it is) -->


    <!-- HEADER -->
    <div class="container my-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="wow">Produk Toko Bangunan</h2>
            </div>
            <div class="col-md-6 text-end">
                <a href="#" class="btn btn-outline-dark" id="openCart">
                    <i class="fas fa-shopping-cart"></i> Keranjang
                </a>
            </div>
        </div>
    </div>

    <!-- SIDEBAR KERANJANG -->
    <div id="cartBox" class="cart-sidebar">
        <button type="button" id="closeCart"
            class="btn btn-light position-absolute top-0 end-0 m-2 rounded-circle d-flex align-items-center justify-content-center"
            style="width: 30px; height: 30px;">
            <span class="text-dark fs-5">×</span>
        </button>

        <h5 class="mb-1 fw-bold text-primary">🛒 Keranjang kamu</h5>
        <small class="text-muted">{{ count($keranjang) }} item</small>
        <div class="cart-divider"></div>

        @if (count($keranjang) === 0)
            <div class="cart-empty fade-in">
                <i class="fas fa-box-open fa-3x mb-3 text-secondary"></i>
                <p class="text-muted">Keranjang kosong.</p>
            </div>
        @else
            <div class="cart-items">
                @foreach ($keranjang as $item)
                    <div class="cart-item border-0 shadow-sm p-2 mb-3 fade-in fade-in-delay-{{ ($loop->index % 4) + 1 }}"
                        style="border-radius: 12px;">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('document/' . $item->gambar) }}" alt="{{ $item->Nama_Barang }}"
                                style="width: 50px; height: 50px; object-fit: cover;" class="me-3 rounded">
                            <div>
                                <div class="fw-bold">{{ $item->Nama_Barang }}</div>
                                <small class="text-muted">Rp {{ number_format($item->harga, 0, ',', '.') }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="cart-divider"></div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="fw-semibold">Total:</span>
            <span class="fw-semibold text-dark">
                Rp{{ number_format($keranjang->sum(fn($item) => $item->harga * $item->jumlah_barang), 0, ',', '.') }}
            </span>
        </div>

        <form action="{{ route('keranjang.checkout') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-2">
                <label for="status_pembayaran" class="form-label">Metode Pembayaran</label>
                <select name="status_pembayaran" id="status_pembayaran" class="form-control form-control-sm" required>
                    <option value="">Pilih</option>
                    <option value="Kredit">Kredit</option>
                    <option value="Lunas">Lunas</option>
                </select>
            </div>

            <div class="mb-3" id="metodePembayaranBox" style="display: none;">
                <label for="metode_pembayaran" class="form-label">Jenis Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran" class="form-control form-control-sm">
                    <option value="">Pilih</option>
                    <option value="tunai">Tunai</option>
                    <option value="transfer">Transfer</option>
                </select>
            </div>

            <div class="mb-3" id="jatuhtempo" style="display: none;">
                <label for="jatuhtempo" class="form-label">Jatuh Tempo</label>
                <input type="date" class="form-control form-control-sm" name="jatuhtempo">
            </div>

            <div class="mb-3" id="namapemesan" style="display: none;">
                <label for="namapemesan" class="form-label">Nama Pemesan</label>
                <input type="text" class="form-control form-control-sm" name="nama_pemesan" >
            </div>

            <div class="mb-3" id="no_hp" style="display: none;">
                <label for="no_hp" class="form-label">Nomor HP</label>
                <input type="tel" class="form-control form-control-sm" name="no_hp"  pattern="[0-9]{10,15}"
                    placeholder="08xxxxxxxxxx">
            </div>
            <button type="submit" class="btn btn-checkout mt-2">
                Selesaikan Pesanan
            </button>
        </form>
    </div>

    <!-- PRODUK -->
    <div class="container my-4">
        <div class="row g-4">
            @foreach ($query as $item)
                <div class="col-md-3 fade-in fade-in-delay-{{ ($loop->index % 4) + 1 }}">
                    <div class="card text-center produk-card" data-qty="{{ $item->Quantity }}"
                        data-minim="{{ $item->minimumbeli }}">
                        <img src="{{ asset('document/' . $item->gambar) }}" class="img-fluid mb-2"
                            alt="{{ $item->Nama_Barang }}" style="max-height: 120px; object-fit: contain;">
                        <h5 class="fw-semibold wow">{{ $item->Nama_Barang }}</h5>
                        <p class="wow mb-1" style="font-size: 14px;">Jumlah: {{ $item->Quantity }}</p>
                        <p class="wow fw-bold mb-3" style="font-size: 16px;">
                            Rp{{ number_format($item->Harga, 0, ',', '.') }}/{{ $item->nama_satuan }}
                        </p>
                        <button class="btn btn-cart-custom js-cart-btn d-flex align-items-center justify-content-center gap-2"
                            data-bs-toggle="modal" data-bs-target="#cartModal-{{ $item->ID }}">
                            <i class="fas fa-shopping-cart"></i> <span>Cart</span>
                        </button>
                    </div>
                </div>

                <!-- MODAL -->
                <div class="modal fade te" id="cartModal-{{ $item->ID }}" tabindex="-1"
                    aria-labelledby="cartModalLabel-{{ $item->ID }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content shadow border-0 rounded-4">
                            <form action="{{ route('keranjang.store') }}" method="POST">
                                @csrf
                                <div class="modal-header border-0">
                                    <h5 class="modal-title" id="cartModalLabel-{{ $item->ID }}">Tambah ke Keranjang
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('document/' . $item->gambar) }}" class="img-fluid rounded mb-3"
                                        alt="{{ $item->Nama_Barang }}">
                                    <h6 class="mb-1">{{ $item->Nama_Barang }}</h6>
                                    <p class="text-muted mb-3">
                                        Harga: <strong>Rp
                                            {{ number_format($item->Harga, 0, ',', '.') }}/{{ $item->nama_satuan }}</strong>
                                    </p>

                                    <input type="hidden" name="nama" value="{{ $item->Nama_Barang }}">
                                    <input type="hidden" name="harga" value="{{ $item->Harga }}">
                                    <input type="hidden" name="barang_id" value="{{ $item->ID }}">

                                    <div class="form-group text-start mb-3">
                                        <label for="jumlah-{{ $item->ID }}" class="small fw-semibold">Jumlah</label>
                                        <input type="number" id="jumlah-{{ $item->ID }}" name="jumlah_barang"
                                            class="form-control rounded-pill text-center shadow-sm" value="1"
                                            min="1" max="{{ $item->Quantity }}" required>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-light rounded-pill w-45"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary rounded-pill w-45">Tambah</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cartBox = document.getElementById("cartBox");
            const openCart = document.getElementById("openCart");
            const closeCart = document.getElementById("closeCart");
            const statusSelect = document.getElementById("status_pembayaran");
            const metodeBox = document.getElementById("metodePembayaranBox");
            const jatuhtempo = document.getElementById("jatuhtempo");
              const namapemesan = document.getElementById("namapemesan");
        const no_hp = document.getElementById("no_hp");

            openCart?.addEventListener("click", e => {
                e.preventDefault();
                cartBox.classList.add("show");
            });

            closeCart?.addEventListener("click", () => {
                cartBox.classList.remove("show");
            });

            statusSelect?.addEventListener("change", function() {
                metodeBox.style.display = this.value === 'Lunas' ? 'block' : 'none';
                jatuhtempo.style.display = this.value === 'Kredit' ? 'block' : 'none';
                namapemesan.style.display = this.value === 'Kredit' ? 'block' : 'none';
                no_hp.style.display = this.value === 'Kredit' ? 'block' : 'none';
            });

            if (statusSelect) {
                statusSelect.dispatchEvent(new Event('change'));
            }
        });
        
        document.querySelectorAll('.produk-card').forEach(card => {
                const qty = parseInt(card.dataset.qty, 10);
                const min = parseInt(card.dataset.minim, 10);
                if (qty === 0) {
                    card.classList.add('bg-danger');
                } else if (qty <= min) {
                    card.classList.add('bg-warning');
                }
            });

            document.querySelectorAll('.produk-card').forEach(card => {
                const min = parseInt(card.dataset.minim, 10);
                const qty = parseInt(card.dataset.qty, 10);
                const btn = card.querySelector('.js-cart-btn');
                // Hapus dulu kelas lama, lalu tambahkan yang sesuai
                if (qty <= min) {
                    btn.classList.add('btn-danger');
                }
            });
    </script>
@endsection
