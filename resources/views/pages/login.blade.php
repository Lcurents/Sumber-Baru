<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Login | Sumber Baru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        :root {
            --primary: #ff6f00;
            --bg: #e0e0e0;
            --card-bg: rgba(255, 255, 255, 0.2);
            --text-dark: #333;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(145deg, #f5f5f5, #cfcfcf);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-attachment: fixed;
        }

        .login-card {
            width: 90%;
            max-width: 1000px;
            background: var(--card-bg);
            backdrop-filter: blur(25px);
            border-radius: 30px;
            box-shadow: 20px 20px 60px #bebebe, -20px -20px 60px #ffffff;
            overflow: hidden;
            display: flex;
        }

        .login-left {
            background: var(--primary);
            color: white;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            text-align: center;
        }

        .login-left h2 {
            font-size: 2.2rem;
            font-weight: 700;
        }

        .login-left p {
            margin-top: 1rem;
            font-size: 1rem;
        }

        #weather-status {
            font-size: 0.9rem;
            margin-top: 1rem;
            font-weight: 500;
        }

        #sapaan-berganti {
            margin-top: 1.5rem;
            font-size: 0.95rem;
            font-style: italic;
            min-height: 50px;
        }

        .login-left img {
            width: 180px;
            margin-top: 2rem;
            filter: drop-shadow(0 0 10px rgba(0, 0, 0, 0.3));
        }

        .login-right {
            flex: 1;
            background: #fff;
            padding: 3rem;
            color: var(--text-dark);
        }

        .login-right h4 {
            text-align: center;
            font-weight: 600;
            margin-bottom: 2rem;
        }

        .form-control {
            border-radius: 14px;
            height: 48px;
            border: none;
            box-shadow: inset 3px 3px 6px #d1d1d1, inset -3px -3px 6px #ffffff;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(255, 111, 0, 0.2);
            border: none;
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            font-size: 1.2rem;
            color: var(--primary);
            cursor: pointer;
        }

        .form-text {
            font-size: 0.85rem;
        }

        .btn-login {
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 14px;
            height: 45px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-login:hover {
            background-color: #e85f00;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
            }

            .login-left,
            .login-right {
                padding: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="login-left">
            <h2>Selamat Datang</h2>
            <img src="dist/img/logo.png" alt="Logo Toko" />
        </div>

        <div class="login-right">
            <h4>Masuk ke Akun</h4>
            <form id="loginForm" method="POST" action="{{ route('login.post') }}">
                @csrf

                <div class="mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required />
                </div>

                <div class="mb-3 password-wrapper">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                        required />
                    <i class="bi bi-eye-slash toggle-password" id="togglePassword"></i>
                </div>

                <!-- Kuis Acak -->
                {{-- <div class="mb-3">
                    <label for="kuisInput" class="form-label">
                        Berapa hasil dari <span id="angka1"></span>
                        <span id="operator"></span>
                        <span id="angka2"></span>?
                    </label>
                    <input type="number" id="kuisInput" class="form-control" placeholder="Jawaban kuis" required />
                    <div class="form-text text-danger d-none" id="kuisError">Jawaban salah. Coba lagi.</div>
                </div> --}}

                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="rememberMe" required />
                    <label class="form-check-label" for="rememberMe">Ingat saya</label>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-login">Masuk</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cuaca -->
    {{-- <script>
        function interpretCuaca(code) {
            const mapping = {
                0: "Cerah",
                1: "Sebagian berawan",
                2: "Berawan",
                3: "Mendung",
                45: "Berkabut",
                48: "Kabut tebal",
                51: "Gerimis ringan",
                53: "Gerimis sedang",
                55: "Gerimis lebat",
                61: "Hujan ringan",
                63: "Hujan sedang",
                65: "Hujan lebat",
                80: "Hujan lokal",
                81: "Hujan deras",
                82: "Hujan ekstrem"
            };
            return mapping[code] || "Cuaca tidak diketahui";
        }

        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(pos => {
                const lat = pos.coords.latitude;
                const lon = pos.coords.longitude;

                fetch(
                        `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true`)
                    .then(res => res.json())
                    .then(data => {
                        const suhu = data.current_weather.temperature;
                        const kode = data.current_weather.weathercode;
                        const deskripsi = interpretCuaca(kode);
                        document.getElementById("weather-status").innerText = `${deskripsi}, ${suhu}°C`;
                    })
                    .catch(() => {
                        document.getElementById("weather-status").innerText = "Gagal memuat cuaca.";
                    });
            }, () => {
                document.getElementById("weather-status").innerText = "Izin lokasi ditolak.";
            });
        } else {
            document.getElementById("weather-status").innerText = "Geolokasi tidak didukung.";
        }
    </script> --}}

    <!-- Password Toggle -->
    <script>
        const toggle = document.getElementById("togglePassword");
        const password = document.getElementById("password");

        toggle.addEventListener("click", function() {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            this.classList.toggle("bi-eye");
            this.classList.toggle("bi-eye-slash");
        });
    </script>

    <!-- Sapaan Acak -->
    {{-- <script>
        const sapaans = [
            "Selamat datang di Sumber Baru. Sukses dimulai dari login yang jujur.",
            "Datang ke toko tak sekadar mampir, login dulu biar stok tak kabur.",
            "Baut, semen, pipa dan kaca. Login dulu, baru kerja terasa lega.",
            "Stok rapi, pelanggan happy. Ayo login dulu, boss!",
            "Login bukan sekadar formalitas, tapi awal dari sistem yang berkualitas.",
            "Toko lancar karena data benar. Login sekarang, jangan nanti-nanti!",
            "Yang rapi bukan hanya barang, tapi juga data di belakang layar.",
            "Bangun rumah dimulai dari pondasi. Bangun usaha dimulai dari login ini.",
            "Selamat bekerja! Data kuat, kerja cepat.",
            "Sukses itu milik yang konsisten. Mulai dari login tiap hari.",
            "Toko modern bukan soal cat, tapi sistem yang hebat.",
            "Pantun singkat untuk semangat: login cepat, semangat naik.",
            "Data hari ini untuk keputusan esok. Ayo login.",
            "Barang banyak bukan berarti kacau, login dulu biar tahu.",
            "Login sekarang, transaksi aman.",
            "Login dulu, kerja lancar. Nanti sore bisa santai sebentar.",
            "Login itu ibarat buka pintu toko. Kalau gak login, ngapain kerja?",
            "Login bukan beban, tapi jalan aman.",
            "Masuk aplikasi, bukan ke hati. Tapi setidaknya datamu pasti.",
            "Tak perlu kuatir, sistem ini rapi. Login yuk, biar makin happy.",
            "Cek stok, catat transaksi, semua dimulai dari login pasti.",
            "Jangan tunda login, nanti lupa dan bingung sendiri.",
            "Toko jalan, tim senang. Login dulu, biar semuanya tenang.",
            "Daripada bingung, mending login.",
            "Kalau niat kerja bener, pasti login dulu bener.",
            "Login hari ini, laporan tenang nanti sore.",
            "Setiap klik punya arti. Klik login, mulai hari ini.",
            "Login itu ringan. Yang berat itu nunda-nunda.",
            "Toko bisa maju, karena datanya dijaga. Login sekarang.",
            "Stok kosong itu biasa. Yang penting kamu login dulu.",
            "Bangun bisnis? Login tiap pagi, disiplin jadi bukti.",
            "Kerja cerdas dimulai dari data yang jelas. Ayo login.",
            "Login bukan cuma akses, tapi komitmen kerja beres.",
            "Toko bukan sulap. Login biar tidak gelap.",
            "Mulai hari dengan satu klik: login.",
            "Pantun sore: login terus, rejeki terus.",
            "Data bagus bikin bahagia. Jangan lupa login ya!",
            "Login dulu, baru kamu bisa lihat apa yang penting hari ini.",
            "Toko besar dimulai dari login kecil tiap hari.",
            "Aplikasi ini bukan sekadar alat. Login dan buat dampak nyata!"
        ];
        let i = 0;
        const target = document.getElementById('sapaan-berganti');

        function putarSapaan() {
            target.innerHTML = sapaans[i];
            i = (i + 1) % sapaans.length;
        }
        putarSapaan();
        setInterval(putarSapaan, 6000);
    </script> --}}

    <!-- Kuis Acak -->
    {{-- <script>
        const angka1 = Math.floor(Math.random() * 10) + 1;
        const angka2 = Math.floor(Math.random() * 10) + 1;
        const ops = ["+", "-", "×"];
        const operator = ops[Math.floor(Math.random() * ops.length)];
        let hasil;

        if (operator === "+") hasil = angka1 + angka2;
        else if (operator === "-") hasil = angka1 - angka2;
        else hasil = angka1 * angka2;

        document.getElementById("angka1").textContent = angka1;
        document.getElementById("angka2").textContent = angka2;
        document.getElementById("operator").textContent = operator;

        document.getElementById("loginForm").addEventListener("submit", function(e) {
            const jawaban = parseInt(document.getElementById("kuisInput").value);
            const errorDiv = document.getElementById("kuisError");
            if (jawaban !== hasil) {
                e.preventDefault();
                errorDiv.classList.remove("d-none");
            } else {
                errorDiv.classList.add("d-none");
            }
        });
    </script> --}}
</body>

</html>
