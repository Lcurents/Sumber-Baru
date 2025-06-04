<!DOCTYPE html>
<html>

<head>
    <!--   ***** Link To Custom Stylesheet *****   -->
    <link rel="stylesheet" type="text/css" href="/origalih/style.css" />

    <!-- ✅ Pakai hanya satu versi Font Awesome (6.1.1) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

    <!-- ✅ Tambahan lain yang kamu gunakan -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Dashboard</title>
</head>

<body class="{{ $themeClass }}">
    <style>
        .top-bar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            /* tinggi navbar */
            background-color: #ffffff;
            /* warna latar */
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 1rem;
            /* jarak kiri-kanan */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 50;
            /* pastikan di atas konten lain */
        }

        /* Styling dasar hamburger */
        /* .hamburger-btn span {
            display: block;
            width: 25px;
            height: 3px;
            margin: 4px 0;
            background-color: #333;
            transition: all .3s;
        } */

        /* Kalau perlu: beri padding-top pada body agar konten tidak tertutup navbar */
        /* body {
            padding-top: 60px;
        } */
    </style>
    <!--   *** Page Wrapper Starts ***   -->
    <div class="page-wrapper">
        <!--   *** Top Bar Starts ***   -->
        <div class="top-bar print-hidden">
            <div class="top-bar-left">
                <!-- Hamburger selalu terlihat -->
                <div class="hamburger-btn" style="display:flex; cursor:pointer;">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

            </div>

            <div class="top-bar-right">
                <div class="mode-switch">
                    <i class="fa-solid fa-moon"></i>
                </div>
                <div class="notifications">
                    <i class="fa-solid fa-bell"></i>
                </div>

            </div>
        </div>
        <!--   *** Top Bar Ends ***   -->

        <!--   === Side Bar Starts ===   -->
        <aside class="side-bar print-hidden" style="width:240px; transition: width 0.3s;">
            <span class="menu-label">MENU</span>
            <ul class="navbar-links">

                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <span class="nav-icon"><i class="fa-solid fa-house"></i></span>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                <li class="{{ Request::is('pembukuan*') ? 'active' : '' }}">
                    <a href="{{ route('Penjualan') }}">
                        <span class="nav-icon"><i class="fa-solid fa-cash-register"></i></span>
                        <span class="nav-text">Penjualan</span>
                    </a>
                </li>

                <li class="{{ Request::is('pembelian*') ? 'active' : '' }}">
                    <a href="{{ route('Pembelian') }}">
                        <span class="nav-icon"><i class="fa-solid fa-cart-shopping"></i></span>
                        <span class="nav-text">Pembelian</span>
                    </a>
                </li>

                <li class="{{ Request::is('utangpiutang*') ? 'active' : '' }}">
                    <a href="{{ route('utangpiutang') }}">
                        <span class="nav-icon"><i class="fa-solid fa-file-invoice-dollar"></i></span>
                        <span class="nav-text">Utang</span>
                    </a>
                </li>

                <li class="{{ Request::is('Piutang*') ? 'active' : '' }}">
                    <a href="{{ route('Piutang') }}">
                        <span class="nav-icon"><i class="fa-solid fa-hand-holding-dollar"></i></span>
                        <span class="nav-text">Piutang</span>
                    </a>
                </li>

                <li class="{{ Request::is('storage*') ? 'active' : '' }}">
                    <a href="{{ route('storage') }}">
                        <span class="nav-icon"><i class="fa-solid fa-boxes-stacked"></i></span>
                        <span class="nav-text">Storage</span>
                    </a>
                </li>

                <!-- Dropdown Laporan -->
                <li class="dropdown laporan-dropdown">
                    <a href="javascript:void(0);" onclick="toggleDropdown(this)">
                        <span class="nav-icon"><i class="fa-solid fa-chart-line"></i></span>
                        <span class="nav-text">Laporan</span>
                        <i class="fa-solid "></i>
                    </a>
                    <ul class="side-dropdown d-none">
                        <li><a href="{{ route('LaporanLabaRugi') }}"><i class="fa-solid fa-wallet me-2"></i> Laporan
                                Laba Rugi</a></li>
                        <li><a href="{{ route('LaporanPenjualan') }}"><i class="fa-solid fa-chart-simple me-2"></i>
                                Laporan Penjualan</a></li>
                        <li><a href="{{ route('LaporanPembelian') }}"><i class="fa-solid fa-cart-flatbed me-2"></i>
                                Laporan Pembelian</a></li>
                        <li><a href="{{ route('LaporanMinimum') }}"><i class="fa-solid fa-box-open me-2"></i> Laporan
                                Minimum Stok</a></li>
                        <li><a href="{{ route('LaporanYangDibeli') }}"><i
                                    class="fa-solid fa-truck-arrow-right me-2"></i> Laporan Yang Akan Dibeli</a></li>
                        <li><a href="{{ route('LaporanBbn') }}"><i class="fa-solid fa-coins me-2"></i> Laporan Beban
                                Operasional</a></li>
                    </ul>
                </li>

                <li class="{{ Request::is('settings*') ? 'active' : '' }}">
                    <a href="{{ route('settings') }}">
                        <span class="nav-icon"><i class="fa-solid fa-gear"></i></span>
                        <span class="nav-text">Settings</span>
                    </a>
                </li>
            </ul>

            <!-- Logout -->
            <div class="sidebar-footer">
                <div class="logoutBtn">
                    <form method="POST" action="{{ route('logout') }}" class="d-flex align-items-center">
                        @csrf
                        <input type="submit" id="logoutSubmit" style="display: none;" />
                        <label for="logoutSubmit" class="d-flex align-items-center" style="cursor: pointer;">
                            <span class="logout-icon"><i class="fa-solid fa-right-from-bracket"></i></span>
                            <span class="text ms-1">Logout</span>
                        </label>
                    </form>
                </div>
            </div>
        </aside>


        <!--   === Side Bar Ends ===   -->
        <style>
            .side-dropdown {
                padding-left: 1.5rem;
            }

            .side-dropdown li a {
                font-size: 14px;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                padding: 6px 10px;
                color: #ccc;
                transition: 0.3s;
                border-radius: 6px;
            }

            .side-dropdown li a:hover {
                background-color: rgba(255, 255, 255, 0.1);
                color: white;
            }

            .side-bar.close .side-dropdown {
                display: none !important;
            }

            .side-bar.close .dropdown-toggle .nav-text,
            .side-bar.close .dropdown-toggle .fa-angle-down {
                display: none !important;
            }
        </style>

        <script>
            function toggleDropdown(element) {
                const dropdown = element.closest('.dropdown');
                dropdown.querySelector('.side-dropdown').classList.toggle('d-none');
            }
        </script>

        <!--   === Contents Section Starts ===   -->
        <div class="contents-wrapper" style="padding-left:240px; transition: padding-left 0.3s;">
            @yield('content')
        </div>
        <!--   === Contents Section Ends ===   -->
    </div>
    <!--   *** Page Wrapper Ends ***   -->

    <!--   *** Link To Custom Script File ***   -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="origalih/script.js"></script>
    <!-- inline toggle untuk desktop dan mobile -->
    <script>
        const hamburger = document.querySelector('.hamburger-btn');
        const sidebar = document.querySelector('.side-bar');
        const contents = document.querySelector('.contents-wrapper');
        hamburger.addEventListener('click', () => {
            const isClosed = sidebar.classList.toggle('close');
            if (isClosed) {
                sidebar.style.width = '70px';
                contents.style.paddingLeft = '70px';
            } else {
                sidebar.style.width = '240px';
                contents.style.paddingLeft = '240px';
            }
        });
    </script>
</body>

</html>
