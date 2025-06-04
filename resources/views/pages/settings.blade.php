@extends('layout.nav')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="container my-4">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs" id="settingTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ ($activeTab ?? 'user') == 'user' ? 'active' : '' }}"
                                    id="user-tab" data-bs-toggle="tab" data-bs-target="#user" type="button" role="tab"
                                    aria-controls="user"
                                    aria-selected="{{ ($activeTab ?? 'user') == 'user' ? 'true' : 'false' }}">
                                    User
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ ($activeTab ?? '') == 'barang' ? 'active' : '' }}"
                                    id="barang-tab" data-bs-toggle="tab" data-bs-target="#barang" type="button"
                                    role="tab" aria-controls="barang"
                                    aria-selected="{{ ($activeTab ?? '') == 'barang' ? 'true' : 'false' }}">
                                    Barang
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ ($activeTab ?? '') == 'satuan' ? 'active' : '' }}"
                                    id="satuan-tab" data-bs-toggle="tab" data-bs-target="#satuan" type="button"
                                    role="tab" aria-controls="satuan"
                                    aria-selected="{{ ($activeTab ?? '') == 'satuan' ? 'true' : 'false' }}">
                                    Satuan
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ ($activeTab ?? '') == 'supplier' ? 'active' : '' }}"
                                    id="supplier-tab" data-bs-toggle="tab" data-bs-target="#supplier" type="button"
                                    role="tab" aria-controls="supplier"
                                    aria-selected="{{ ($activeTab ?? '') == 'supplier' ? 'true' : 'false' }}">
                                    Supplier
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body tab-content">
                        {{-- Tab User --}}
                        <div class="tab-pane fade show {{ ($activeTab ?? 'user') == 'user' ? 'active' : '' }}"
                            id="user" role="tabpanel">
                            <h5>Data Pengguna</h5>
                            {{-- tambah data --}}

                            <div class="d-flex justify-content-end mb-3">
                                <button class="btn btn-primary wow" id="tambahDataButton" data-bs-toggle="modal"
                                    data-bs-target="#myModal">
                                    <span class="me-1">+</span> Tambah Data
                                </button>
                            </div>
                            {{-- modal tambah data --}}

                            <div class=" modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content card">

                                        <div class="modal-header">
                                            <h4 class="modal-title wow">Tambah User</h4>
                                            <button type="button"
                                                class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 32px; height: 32px; padding: 0;" data-bs-dismiss="modal"
                                                aria-label="Close">
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

                                            <form action="{{ route('user.post') }}" method="post">
                                                @csrf

                                                <div class="form-group wow">
                                                    <label for="name">Nama</label>
                                                    <input type="text" class="form-control" name="name" required>
                                                </div>

                                                <div class="form-group wow">
                                                    <label for="Username">Username</label>
                                                    <input type="text" class="form-control" name="Username" required>
                                                </div>


                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" name="password" required>
                                                </div>
                                                <br>
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-danger mx-4"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary mx-4">Simpan</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Akhir Modal --}}
                            <div class="table-responsive">
                                <form action="{{ route('settings') }}" method="GET" class="mb-3">
                                    <div class="input-group">
                                        <input type="hidden" name="activeTab" value="user">
                                        <input type="text" name="query" class="form-control"
                                            placeholder="Cari user..."
                                            value="{{ $activeTab == 'user' && isset($queryText) ? $queryText : '' }}">
                                        <button type="submit" class="btn btn-secondary">Search</button>
                                    </div>
                                </form>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="wow">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $index => $user)
                                            <tr class="wow">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $user->name }}</td>


                                                <td><button class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#editModal-{{ $user->id }}"
                                                        style="background-color: #f1e90b; border-color: #f1e90b; color: white;">
                                                        Edit
                                                    </button>
                                                    <button class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal-{{ $user->id }}"
                                                        style="background-color:#dc3545; border-color:#dc3545; color: white;">
                                                        🗑️ Hapus
                                                    </button>
                                                </td>

                                                {{-- modal edit user --}}

                                                <div class="modal" id="editModal-{{ $user->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content card">

                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit User</h4>
                                                                <button type="button"
                                                                    class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center"
                                                                    style="width: 32px; height: 32px; padding: 0;"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"
                                                                        class="text-white fs-5">×</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">

                                                                @if (session('success'))
                                                                    <div class="alert alert-success">
                                                                        {{ session('success') }}
                                                                    </div>
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

                                                                <form
                                                                    action="{{ route('user.update', ['id' => $user->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('put')

                                                                    <div class="form-group">
                                                                        <label for="name">Nama:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="name-{{ $user->id }}" name="name"
                                                                            required value="{{ $user->name }}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="username">Username</label>
                                                                        <input type="text" class="form-control"
                                                                            id="username-{{ $user->id }}"
                                                                            name="username" required
                                                                            value="{{ $user->username }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="role">Level:</label>
                                                                        <select name="role"
                                                                            id="role-{{ $user->id }}"
                                                                            class="form-control"
                                                                            onchange="toggleOperatorFieldUpdate({{ $user->id }})">
                                                                            <option value="admin"
                                                                                @if ($user->role == 'admin') selected @endif>
                                                                                Admin</option>
                                                                            <option value="operator"
                                                                                @if ($user->role == 'operator') selected @endif>
                                                                                Operator</option>
                                                                        </select>
                                                                    </div>

                                                                    {{-- Bagian ini mungkin tidak perlu ada di modal edit user kecuali Anda ingin mengubah departemen operator --}}
                                                                    {{-- <div class="form-group" id="baganOperator-{{ $user->id }}" style="display: none;">
                                                                    <label for="department">Departemen (Operator)</label>
                                                                    <input type="text" class="form-control" name="department" value="{{ $user->department ?? '' }}">
                                                                </div> --}}

                                                                    <div class="form-group">
                                                                        <label for="password">Password Baru
                                                                            (opsional)
                                                                            :</label>
                                                                        <input type="password" class="form-control"
                                                                            id="password-{{ $user->id }}"
                                                                            name="password"
                                                                            placeholder="Isi jika ingin mengganti password">
                                                                    </div>
                                                            </div>

                                                            <div class="modal-footer d-flex justify-content-center">
                                                                <button type="button" class="btn btn-danger mx-4"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary mx-4">Simpan</button>
                                                            </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>


                                                <script>
                                                    function toggleOperatorFieldUpdate(userId) {
                                                        const roleSelect = document.getElementById('role-' + userId);
                                                        const departmentField = document.getElementById('baganOperator-' +
                                                        userId); // Pastikan elemen ini ada jika ingin digunakan

                                                        if (roleSelect && departmentField) { // Tambahkan pengecekan apakah elemen ada
                                                            if (roleSelect.value === 'admin') {
                                                                departmentField.style.display = 'none';
                                                            } else {
                                                                departmentField.style.display = 'block';
                                                            }
                                                        }
                                                    }

                                                    // Jalankan fungsi di awal saat modal muncul
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        // Loop melalui setiap user untuk menginisialisasi toggleOperatorFieldUpdate
                                                        // Ini hanya akan dijalankan jika ada user yang ditampilkan di awal
                                                        @foreach ($users as $user)
                                                            if (document.getElementById('role-{{ $user->id }}')) {
                                                                toggleOperatorFieldUpdate({{ $user->id }});
                                                            }
                                                        @endforeach
                                                    });
                                                </script>

                                                {{-- akhir modal edit user --}}

                                                {{-- Modal Delete User --}}

                                                <div class="modal fade" id="deleteModal-{{ $user->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content card">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi
                                                                    Hapus</h5>
                                                                <button type="button"
                                                                    class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center"
                                                                    style="width: 32px; height: 32px; padding: 0;"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"
                                                                        class="text-white fs-5">×</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body text-center">
                                                                <p>Apakah Anda yakin ingin menghapus user
                                                                    <strong>{{ $user->name }}</strong>?
                                                                </p>
                                                                <svg width="100" height="100" viewBox="0 0 200 200"
                                                                    fill="none"
                                                                    xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)">
                                                                    <path
                                                                        d="M96.9689 18.25C98.3161 15.9167 101.684 15.9167 103.031 18.25L172.313 138.25C173.66 140.583 171.976 143.5 169.282 143.5H30.718C28.0237 143.5 26.3397 140.583 27.6869 138.25L96.9689 18.25Z"
                                                                        stroke="#9F1C1C" stroke-width="13"
                                                                        stroke-linejoin="round" />
                                                                    <path
                                                                        d="M103.664 81.875L102.773 105.383H96.75L95.8594 81.875H103.664ZM95.6484 112.672C95.6484 111.625 96.0234 110.742 96.7734 110.023C97.5234 109.305 98.5156 108.945 99.75 108.945C100.969 108.945 101.945 109.305 102.68 110.023C103.43 110.742 103.805 111.625 103.805 112.672C103.805 113.734 103.43 114.625 102.68 115.344C101.945 116.047 100.969 116.398 99.75 116.398C98.5156 116.398 97.5234 116.047 96.7734 115.344C96.0234 114.625 95.6484 113.734 95.6484 112.672Z"
                                                                        fill="#9F1C1C" />
                                                                </svg>
                                                            </div>

                                                            <div class="modal-footer d-flex justify-content-center">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <form
                                                                    action="{{ route('user.delete', ['id' => $user->id]) }}"
                                                                    method="POST" class="ml-2">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" class="btn"
                                                                        style="background-color:#dc3545; color: white;">Hapus</button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>


                                                {{-- Akhir Modal Delete User --}}

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- Tab Barang --}}
                        <div class="tab-pane fade {{ ($activeTab ?? '') == 'barang' ? 'active show' : '' }}"
                            id="barang" role="tabpanel">
                            <h5>Data Barang</h5>
                            {{-- tambah data --}}
                            <div class="d-flex justify-content-end mb-3">
                                <button class="btn btn-primary" id="tambahDataButton" data-bs-toggle="modal"
                                    data-bs-target="#myModal1">
                                    <span class="me-1">+</span> Tambah Data
                                </button>
                            </div>

                            {{-- modal tambah data --}}

                            <div class="modal" id="myModal1">
                                <div class="modal-dialog">
                                    <div class="modal-content card">

                                        <div class="modal-header">
                                            <h4 class="modal-title">Tambah Data Barang</h4>
                                            <button type="button"
                                                class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 32px; height: 32px; padding: 0;" data-bs-dismiss="modal"
                                                aria-label="Close">
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

                                            <form action="{{ route('barang.post') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group">
                                                    <label for="Nama_Barang">Nama Barang</label>
                                                    <input type="text" class="form-control" name="Nama_Barang"
                                                        required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="Harga">Harga Barang</label>
                                                    <input type="number" class="form-control" name="Harga" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="minimumbeli">Minimum Beli</label>
                                                    <input type="number" class="form-control" name="minimumbeli"
                                                        required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="maximumbeli">Maximum Beli</label>
                                                    <input type="number" class="form-control" name="maximumbeli"
                                                        required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="satuan">Satuan</label>
                                                    <select class="form-control" name="satuan">
                                                        @foreach ($satuans as $item)
                                                            <option value="{{ $item->ID }}">{{ $item->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="supplier">Supplier</label>
                                                    <select class="form-control" name="supplier">
                                                        @foreach ($suppliers as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->nama_supplier }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="file">Gambar (opsional)</label>
                                                    <input type="file" class="form-control" id="file"
                                                        name="file">
                                                    <small id="helpId" class="text-muted">Upload berkas jika
                                                        diperlukan.</small>
                                                </div>

                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-danger mx-4"
                                                        data-bs-dismiss="modal">Batal</button>

                                                    <button type="submit" class="btn btn-primary mx-4">Simpan</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Akhir Modal Tambah data --}}

                            <div class="table-responsive">
                                <form action="{{ route('settings') }}" method="GET" class="mb-3">
                                    <div class="input-group">
                                        <input type="hidden" name="activeTab" value="barang">
                                        <input type="text" name="query" class="form-control"
                                            placeholder="Cari Barang..."
                                            value="{{ $activeTab == 'barang' && isset($queryText) ? $queryText : '' }}">
                                        <button type="submit" class="btn btn-secondary">Search</button>
                                    </div>
                                </form>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="wow">
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Satuan</th>
                                            <th>Supplier</th>
                                            <th>Minimum Pembelian</th>
                                            <th>Maximum Pembelian</th>
                                            <th>Gambar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($barangs as $index => $barang)
                                            <tr class="wow">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $barang->Nama_Barang }}</td>
                                                <td>{{ $barang->Harga }}</td>
                                                <td>{{ $barang->nama_satuan }}</td>
                                                <td>{{ $barang->nama_supplier }}</td>
                                                <td>{{ $barang->minimumbeli }}</td>
                                                <td>{{ $barang->maximumbeli }}</td>



                                                <td style="width: 30%"><img src="document/{{ $barang->gambar }}"
                                                        alt="" style="width: 30%"></td>

                                                <td>


                                                    <button class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#editModalbarang-{{ $barang->ID }}"
                                                        style="background-color: #f1e90b; border-color: #f1e90b; color: white;">
                                                        Edit
                                                    </button>
                                                    <button class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModalbarang-{{ $barang->ID }}"
                                                        style="background-color:#dc3545; border-color:#dc3545; color: white;">
                                                        🗑️ Hapus
                                                    </button>
                                                </td>



                                                {{-- Modal edit data barang --}}

                                                <div class="modal fade" id="editModalbarang-{{ $barang->ID }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content card">

                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Data Barang</h4>
                                                                <button type="button"
                                                                    class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center"
                                                                    style="width: 32px; height: 32px; padding: 0;"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"
                                                                        class="text-white fs-5">×</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">

                                                                @if (session('success'))
                                                                    <div class="alert alert-success">
                                                                        {{ session('success') }}
                                                                    </div>
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

                                                                <form
                                                                    action="{{ route('barang.update', ['id' => $barang->ID]) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('put')

                                                                    <div class="form-group">
                                                                        <label for="Nama_Barang">Nama Barang:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="Nama_Barang-{{ $barang->ID }}"
                                                                            name="Nama_Barang" required
                                                                            value="{{ $barang->Nama_Barang }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="Harga">Harga Barang</label>
                                                                        <input type="number" class="form-control"
                                                                            id="Harga-{{ $barang->Harga }}"
                                                                            name="Harga" required
                                                                            value="{{ $barang->Harga }}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="minimumbeli">Minimum Beli</label>
                                                                        <input type="number" class="form-control"
                                                                            name="minimumbeli" required
                                                                            value="{{ $barang->minimumbeli }}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="maximumbeli">Maximum Beli</label>
                                                                        <input type="number" class="form-control"
                                                                            name="maximumbeli" required
                                                                            value="{{ $barang->maximumbeli }}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="nama_satuan">Satuan</label>
                                                                        <select class="form-control" name="satuan">
                                                                            @foreach ($satuans as $item)
                                                                                <option value="{{ $item->ID }}"
                                                                                    @if ($barang->satuan == $item->ID) selected @endif>
                                                                                    {{ $item->nama }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="nama_supplier">Supplier</label>
                                                                        <select class="form-control" name="supplier">
                                                                            {{-- Name should be 'supplier' not 'nama_supplier' --}}
                                                                            @foreach ($suppliers as $item)
                                                                                <option value="{{ $item->id }}"
                                                                                    @if ($barang->supplier == $item->id) selected @endif>
                                                                                    {{ $item->nama_supplier }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="file">Gambar</label>
                                                                        <input type="file" class="form-control"
                                                                            id="file" name="file">
                                                                        <small id="helpId" class="text-muted">Upload
                                                                            Berkas</small>
                                                                    </div>
                                                            </div>

                                                            <div class="modal-footer d-flex justify-content-center">
                                                                <button type="button" class="btn btn-danger mx-4"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary mx-4">Simpan</button>
                                                            </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Akhir Modal edit data barang --}}

                                                {{-- Awal Modal Delete Barang --}}

                                                <div class="modal fade" id="deleteModalbarang-{{ $barang->ID }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content card">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">
                                                                    Konfirmasi
                                                                    Hapus
                                                                </h5>
                                                                <button type="button"
                                                                    class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center"
                                                                    style="width: 32px; height: 32px; padding: 0;"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"
                                                                        class="text-white fs-5">×</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body text-center">
                                                                <p>Apakah Anda yakin ingin menghapus Barang
                                                                    <strong>{{ $barang->Nama_Barang }}</strong>?
                                                                </p>
                                                                <svg width="100" height="100" viewBox="0 0 200 200"
                                                                    fill="none"
                                                                    xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)">
                                                                    <path
                                                                        d="M96.9689 18.25C98.3161 15.9167 101.684 15.9167 103.031 18.25L172.313 138.25C173.66 140.583 171.976 143.5 169.282 143.5H30.718C28.0237 143.5 26.3397 140.583 27.6869 138.25L96.9689 18.25Z"
                                                                        stroke="#9F1C1C" stroke-width="13"
                                                                        stroke-linejoin="round" />
                                                                    <path
                                                                        d="M103.664 81.875L102.773 105.383H96.75L95.8594 81.875H103.664ZM95.6484 112.672C95.6484 111.625 96.0234 110.742 96.7734 110.023C97.5234 109.305 98.5156 108.945 99.75 108.945C100.969 108.945 101.945 109.305 102.68 110.023C103.43 110.742 103.805 111.625 103.805 112.672C103.805 113.734 103.43 114.625 102.68 115.344C101.945 116.047 100.969 116.398 99.75 116.398C98.5156 116.398 97.5234 116.047 96.7734 115.344C96.0234 114.625 95.6484 113.734 95.6484 112.672Z"
                                                                        fill="#9F1C1C" />
                                                                </svg>
                                                            </div>

                                                            <div class="modal-footer d-flex justify-content-center">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <form
                                                                    action="{{ route('barang.delete', ['id' => $barang->ID]) }}"
                                                                    method="POST" class="ml-2">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" class="btn"
                                                                        style="background-color:#dc3545; color: white;">Hapus</button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>


                                                {{-- Akhir Modal Delete Barang --}}

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Tab Satuan --}}
                        <div class="tab-pane fade {{ ($activeTab ?? '') == 'satuan' ? 'active show' : '' }}"
                            id="satuan" role="tabpanel">
                            <h5>Data Satuan</h5>
                            {{-- tambah data --}}

                            <div class="d-flex justify-content-end mb-3">
                                <button class="btn btn-primary" id="tambahDataButton" data-bs-toggle="modal"
                                    data-bs-target="#myModal3">
                                    <span class="me-1">+</span> Tambah Data
                                </button>
                            </div>
                            {{-- modal tambah data --}}

                            <div class="modal" id="myModal3">
                                <div class="modal-dialog">
                                    <div class="modal-content card">

                                        <div class="modal-header">
                                            <h4 class="modal-title">Tambah Data Satuan</h4>
                                            <button type="button"
                                                class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 32px; height: 32px; padding: 0;" data-bs-dismiss="modal"
                                                aria-label="Close">
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

                                            <form action="{{ route('satuan.post') }}" method="post">
                                                @csrf

                                                <div class="form-group">
                                                    <label for="nama">Nama Satuan:</label>
                                                    <input type="text" class="form-control" name="nama" required>
                                                </div>
                                                <br>
                                                <div class="d-flex justify-content-center">

                                                    <button type="button" class="btn btn-danger mx-4"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary mx-4">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Akhir Modal Tambah data --}}

                            <div class="table-responsive">
                                <form action="{{ route('settings') }}" method="GET" class="mb-3">
                                    <div class="input-group">
                                        <input type="hidden" name="activeTab" value="satuan">
                                        <input type="text" name="query" class="form-control"
                                            placeholder="Cari satuan..."
                                            value="{{ $activeTab == 'satuan' && isset($queryText) ? $queryText : '' }}">
                                        <button type="submit" class="btn btn-secondary">Search</button>
                                    </div>
                                </form>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="wow">
                                            <th>No</th>
                                            <th>Nama Satuan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($satuans as $index => $satuan)
                                            <tr class="wow">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $satuan->nama }}</td>
                                                <td>

                                                    <button class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#editModalsatuan-{{ $satuan->ID }}"
                                                        style="background-color: #f1e90b; border-color: #f1e90b; color: white;">
                                                        Edit
                                                    </button>
                                                    <button class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModalsatuan-{{ $satuan->ID }}"
                                                        style="background-color:#dc3545; border-color:#dc3545; color: white;">
                                                        🗑️ Hapus
                                                    </button>

                                                    {{-- Modal edit data Satuan --}}

                                                    <div class="modal" id="editModalsatuan-{{ $satuan->ID }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content card">

                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Edit Data Satuan</h4>
                                                                    <button type="button"
                                                                        class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center"
                                                                        style="width: 32px; height: 32px; padding: 0;"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true"
                                                                            class="text-white fs-5">×</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">

                                                                    @if (session('success'))
                                                                        <div class="alert alert-success">
                                                                            {{ session('success') }}
                                                                        </div>
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

                                                                    <form
                                                                        action="{{ route('satuan.update', ['id' => $satuan->ID]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('put')

                                                                        <div class="form-group">
                                                                            <label for="nama">Nama Satuan:</label>
                                                                            <input type="text" class="form-control"
                                                                                id="nama-{{ $satuan->ID }}"
                                                                                name="nama" required
                                                                                value="{{ $satuan->nama }}">
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer d-flex justify-content-center">
                                                                    <button type="button" class="btn btn-danger mx-4"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary mx-4">Simpan</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    {{-- Awal Modal Delete Satuan --}}

                                                    <div class="modal fade" id="deleteModalsatuan-{{ $satuan->ID }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content card">

                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel">
                                                                        Konfirmasi
                                                                        Hapus
                                                                    </h5>
                                                                    <button type="button"
                                                                        class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center"
                                                                        style="width: 32px; height: 32px; padding: 0;"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true"
                                                                            class="text-white fs-5">×</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body text-center">
                                                                    <p>Apakah Anda yakin ingin menghapus Satuan
                                                                        <strong>{{ $satuan->nama }}</strong>?
                                                                    </p>
                                                                    <svg width="100" height="100"
                                                                        viewBox="0 0 200 200" fill="none"
                                                                        xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)">
                                                                        <path
                                                                            d="M96.9689 18.25C98.3161 15.9167 101.684 15.9167 103.031 18.25L172.313 138.25C173.66 140.583 171.976 143.5 169.282 143.5H30.718C28.0237 143.5 26.3397 140.583 27.6869 138.25L96.9689 18.25Z"
                                                                            stroke="#9F1C1C" stroke-width="13"
                                                                            stroke-linejoin="round" />
                                                                        <path
                                                                            d="M103.664 81.875L102.773 105.383H96.75L95.8594 81.875H103.664ZM95.6484 112.672C95.6484 111.625 96.0234 110.742 96.7734 110.023C97.5234 109.305 98.5156 108.945 99.75 108.945C100.969 108.945 101.945 109.305 102.68 110.023C103.43 110.742 103.805 111.625 103.805 112.672C103.805 113.734 103.43 114.625 102.68 115.344C101.945 116.047 100.969 116.398 99.75 116.398C98.5156 116.398 97.5234 116.047 96.7734 115.344C96.0234 114.625 95.6484 113.734 95.6484 112.672Z"
                                                                            fill="#9F1C1C" />
                                                                    </svg>
                                                                </div>

                                                                <div class="modal-footer d-flex justify-content-center">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <form
                                                                        action="{{ route('satuan.delete', ['id' => $satuan->ID]) }}"
                                                                        method="POST" class="ml-2">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="btn"
                                                                            style="background-color:#dc3545; color: white;">Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Tab Supplier --}}
                        <div class="tab-pane fade {{ ($activeTab ?? '') == 'supplier' ? 'active show' : '' }}"
                            id="supplier" role="tabpanel">
                            <h5>Data Supplier</h5>
                            {{-- tambah data --}}

                            <div class="d-flex justify-content-end mb-3">
                                <button class="btn btn-primary" id="tambahDataButton" data-bs-toggle="modal"
                                    data-bs-target="#myModal4">
                                    <span class="me-1">+</span> Tambah Data
                                </button>
                            </div>
                            {{-- modal tambah data --}}

                            <div class="modal" id="myModal4">
                                <div class="modal-dialog">
                                    <div class="modal-content card">

                                        <div class="modal-header">
                                            <h4 class="modal-title">Tambah Data Supplier</h4>
                                            <button type="button"
                                                class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 32px; height: 32px; padding: 0;" data-bs-dismiss="modal"
                                                aria-label="Close">
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

                                            <form action="{{ route('supplier.post') }}" method="post">
                                                @csrf

                                                <div class="form-group">
                                                    <label for="nama_supplier">Nama Supplier:</label>
                                                    <input type="text" class="form-control" name="nama_supplier"
                                                        required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="kontak">Kontak:</label>
                                                    <input type="number" class="form-control" name="kontak" required>
                                                </div>
                                                <br>
                                                <div class="d-flex justify-content-center">

                                                    <button type="button" class="btn btn-danger mx-4"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary mx-4">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Akhir Modal Tambah data --}}

                            <div class="table-responsive">
                                <form action="{{ route('settings') }}" method="GET" class="mb-3">
                                    <div class="input-group">
                                        <input type="hidden" name="activeTab" value="supplier">
                                        <input type="text" name="query" class="form-control"
                                            placeholder="Cari supplier..."
                                            value="{{ $activeTab == 'supplier' && isset($queryText) ? $queryText : '' }}">
                                        <button type="submit" class="btn btn-secondary">Search</button>
                                    </div>
                                </form>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="wow">
                                            <th>No</th>
                                            <th>Nama Supplier</th>
                                            <th>Kontak</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suppliers as $index => $supplier)
                                            <tr class="wow">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $supplier->nama_supplier }}</td>
                                                <td>{{ $supplier->kontak }}</td>
                                                <td>

                                                    <button class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#editModalsupplier-{{ $supplier->id }}"
                                                        style="background-color: #f1e90b; border-color: #f1e90b; color: white;">
                                                        Edit
                                                    </button>
                                                    <button class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModalsupplier-{{ $supplier->id }}"
                                                        style="background-color:#dc3545; border-color:#dc3545; color: white;">
                                                        🗑️ Hapus
                                                    </button>

                                                    {{-- Modal edit data Supplier --}}

                                                    <div class="modal" id="editModalsupplier-{{ $supplier->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content card">

                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Edit Data Supplier</h4>
                                                                    <button type="button"
                                                                        class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center"
                                                                        style="width: 32px; height: 32px; padding: 0;"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true"
                                                                            class="text-white fs-5">×</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">

                                                                    @if (session('success'))
                                                                        <div class="alert alert-success">
                                                                            {{ session('success') }}
                                                                        </div>
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

                                                                    <form
                                                                        action="{{ route('supplier.update', ['id' => $supplier->id]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('put')

                                                                        <div class="form-group">
                                                                            <label for="nama_supplier">Nama
                                                                                Supplier:</label>
                                                                            <input type="text" class="form-control"
                                                                                id="nama_supplier-{{ $supplier->id }}"
                                                                                name="nama_supplier" required
                                                                                value="{{ $supplier->nama_supplier }}">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="kontak">Kontak:</label>
                                                                            <input type="text" class="form-control"
                                                                                id="kontak-{{ $supplier->id }}"
                                                                                name="kontak" required
                                                                                value="{{ $supplier->kontak }}">
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer d-flex justify-content-center">
                                                                    <button type="button" class="btn btn-danger mx-4"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary mx-4">Simpan</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    {{-- Awal Modal Delete Supplier --}}

                                                    <div class="modal fade" id="deleteModalsupplier-{{ $supplier->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content card">

                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel">
                                                                        Konfirmasi
                                                                        Hapus
                                                                    </h5>
                                                                    <button type="button"
                                                                        class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center"
                                                                        style="width: 32px; height: 32px; padding: 0;"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true"
                                                                            class="text-white fs-5">×</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body text-center">
                                                                    <p>Apakah Anda yakin ingin menghapus Supplier
                                                                        <strong>{{ $supplier->nama_supplier }}</strong>?
                                                                    </p>
                                                                    <svg width="100" height="100"
                                                                        viewBox="0 0 200 200" fill="none"
                                                                        xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)">
                                                                        <path
                                                                            d="M96.9689 18.25C98.3161 15.9167 101.684 15.9167 103.031 18.25L172.313 138.25C173.66 140.583 171.976 143.5 169.282 143.5H30.718C28.0237 143.5 26.3397 140.583 27.6869 138.25L96.9689 18.25Z"
                                                                            stroke="#9F1C1C" stroke-width="13"
                                                                            stroke-linejoin="round" />
                                                                        <path
                                                                            d="M103.664 81.875L102.773 105.383H96.75L95.8594 81.875H103.664ZM95.6484 112.672C95.6484 111.625 96.0234 110.742 96.7734 110.023C97.5234 109.305 98.5156 108.945 99.75 108.945C100.969 108.945 101.945 109.305 102.68 110.023C103.43 110.742 103.805 111.625 103.805 112.672C103.805 113.734 103.43 114.625 102.68 115.344C101.945 116.047 100.969 116.398 99.75 116.398C98.5156 116.398 97.5234 116.047 96.7734 115.344C96.0234 114.625 95.6484 113.734 95.6484 112.672Z"
                                                                            fill="#9F1C1C" />
                                                                    </svg>
                                                                </div>

                                                                <div class="modal-footer d-flex justify-content-center">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <form
                                                                        action="{{ route('supplier.delete', ['id' => $supplier->id]) }}"
                                                                        method="POST" class="ml-2">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="btn"
                                                                            style="background-color:#dc3545; color: white;">Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div> {{-- Tutup card-body tab-content --}}
                </div> {{-- Tutup card --}}
            </div> {{-- Tutup container --}}

            {{-- Script untuk mengaktifkan tab saat halaman dimuat dan toggle bagian operator --}}
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Script untuk mengaktifkan tab saat halaman dimuat
                    const urlParams = new URLSearchParams(window.location.search);
                    const activeTab = urlParams.get('activeTab');
                    if (activeTab) {
                        const triggerTab = document.querySelector(`#${activeTab}-tab`);
                        if (triggerTab) {
                            new bootstrap.Tab(triggerTab).show();
                        }
                    }

                    // Fungsi untuk menginisialisasi toggleOperatorFieldUpdate untuk setiap user
                    // Fungsi ini akan dipanggil setelah DOMContentLoaded
                    // dan hanya jika elemen 'role-userId' ada
                    @foreach ($users as $user)
                        if (document.getElementById('role-{{ $user->id }}')) {
                            toggleOperatorFieldUpdate({{ $user->id }});
                        }
                    @endforeach
                });

                // Fungsi toggleOperatorFieldUpdate (didefinisikan di luar DOMContentLoaded agar bisa diakses global)
                function toggleOperatorFieldUpdate(userId) {
                    const roleSelect = document.getElementById('role-' + userId);
                    const departmentField = document.getElementById('baganOperator-' + userId);

                    // Pastikan kedua elemen ada sebelum mencoba mengakses propertinya
                    if (roleSelect && departmentField) {
                        if (roleSelect.value === 'admin') {
                            departmentField.style.display = 'none';
                        } else {
                            departmentField.style.display = 'block';
                        }
                    }
                }
            </script>

            <script
                src="[https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js](https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js)"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>

        </section>
    </div>
@endsection
