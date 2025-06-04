<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Sumber Maju - Stok Barang</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #1e1e2f;
            color: #fff;
        }

        .content-header {
            background: linear-gradient(90deg, #4f46e5, #3b82f6);
            padding: 1.5rem;
            text-align: center;
            font-size: 1.6rem;
            font-weight: 600;
        }

        .container {
            padding: 2rem 1rem;
            max-width: 1200px;
            margin: auto;
        }

        .search-container {
            margin-bottom: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
        }

        .search-input {
            width: 100%;
            max-width: 400px;
            padding: 0.8rem 1.2rem;
            border-radius: 25px;
            border: none;
            outline: none;
            font-size: 1rem;
            background-color: #3b3b4d;
            color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .search-input::placeholder {
            color: #bbb;
        }

        .search-input:focus {
            background-color: #4a4a5e;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        .search-button {
            background-color: #4f46e5;
            color: white;
            border: none;
            border-radius: 25px;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .search-button:hover {
            background-color: #3b82f6;
            transform: translateY(-2px);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            justify-content: center;
        }

        .col {
            flex: 1 1 calc(25% - 1.5rem);
            max-width: calc(25% - 1.5rem);
        }

        @media (max-width: 992px) {
            .col {
                flex: 1 1 calc(33.333% - 1.5rem);
                max-width: calc(33.333% - 1.5rem);
            }
        }

        @media (max-width: 768px) {
            .col {
                flex: 1 1 calc(50% - 1.5rem);
                max-width: calc(50% - 1.5rem);
            }
        }

        @media (max-width: 480px) {
            .col {
                flex: 1 1 100%;
                max-width: 100%;
            }
        }

        .product-card {
            border-radius: 16px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            background: #fff;
            color: #000;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.4);
        }

        .product-card img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            margin-bottom: 1rem;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.3);
            background-color: #fff;
        }

        .product-card h5 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.2rem;
        }

        .product-card p {
            font-size: 0.9rem;
            margin: 0.3rem 0;
        }
    </style>
</head>

<body>

    <div class="content-header">
        Toko Sumber Maju
    </div>

    <div class="container">
        <form action="{{ route('pengguna') }}" method="GET" class="search-container">
            <input type="text" name="search" class="search-input" placeholder="Cari barang..."
                value="{{ request('search') }}">
            <button type="submit" class="search-button">Cari</button>
        </form>

        <div class="row">
            @foreach ($query as $item)
                <div class="col">
                    <div class="product-card" data-stok="{{ $item->Quantity }}">
                        <div>
                            <img src="document/{{ $item->gambar }}" alt="{{ $item->Nama_Barang }}">
                        </div>
                        <h5>{{ $item->Nama_Barang }}</h5>
                        <p>Jumlah: {{ $item->Quantity }}</p>
                        <p><strong>Rp{{ number_format($item->Harga, 0, ',', '.') }}/{{ $item->nama_satuan }}</strong>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.querySelectorAll('.product-card').forEach(card => {
            const stok = parseInt(card.dataset.stok);

            if (stok === 0) {
                card.style.backgroundColor = '#ff6b6b'; // Merah
                card.style.color = 'white';
            } else if (stok <= 10) {
                card.style.backgroundColor = '#feca57'; // Kuning
                card.style.color = '#000';
            } else {
                card.style.backgroundColor = '#1dd1a1'; // Hijau
                card.style.color = 'white';
            }
        });
    </script>


</body>

</html>
