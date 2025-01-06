<x-layout>

    @if (session('success'))
        <div id="successModal" class="modal" style="display: block;">
            <div class="modal-content">
                <span class="close" onclick="closeModal('successModal')">&times;</span>
                <h2 style="color: green; text-align: center;">{{ session('success') }}</h2>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div id="errorModal" class="modal" style="display: block;">
            <div class="modal-content">
                <span class="close" onclick="closeModal('errorModal')">&times;</span>
                <h2 style="color: red; text-align: center;">GAGAL MENAMBAHKAN DATA:</h2>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <link rel="stylesheet" href="{{ asset('css/content.css') }}">
    <link rel="stylesheet" href="{{ asset('css/add-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sync.css') }}">


    <script src="{{ asset('js/time.js') }}"></script>
    <!-- Di bagian head -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!-- Di bagian footer, sebelum tag </body> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <div class="content" style="margin-left:-40px">
        <div class="content">
            <div class="page-title">
                <i class="fas fa-home"></i>
                <h1>Halaman Utama</h1>
            </div>
            <div class="semester-info">
                <i class="fas fa-calendar-alt"></i>
                <span id="realTimeClock">
                    <span id="currentTime"></span>
                    | Akademik :
                    @foreach ($tahunSekarangDB as $tahun)
                        {{ $tahun->tahun_sekarang }}
                    @endforeach
                    /
                    @foreach ($tahunAjaranDB as $semester)
                        {{ $semester->tahun_ajaran === 'ganjil' ? 'Ganjil' : 'Genap' }}
                    @endforeach


                </span>
            </div>
            <div class="cards">
                <div class="card">
                    <i class="fas fa-users"></i>
                    <div class="card-info">
                        <span>MAHASISWA</span>
                        <span class="date-range">Jumlah : {{ $jumlahMahasiswa }}</span>
                    </div>
                </div>
                <div class="card">
                    <i class="fas fa-users"></i>
                    <div class="card-info">
                        <span style="margin-left: 20px; font-size:15px">DOSEN</span>
                        <span class="date-range">Jumlah : {{ $jumlahDosen }}</span>
                    </div>
                </div>
                <div class="card">
                    <i class="fas fa-users"></i>
                    <div class="card-info">
                        <span>SEKRETARIAT</span>
                        <span class="date-range">Jumlah : {{ $jumlahSekretariat }}</span>
                    </div>
                </div>
            </div>
            <div class="alert">
                Bagian Manajemen Akademik
            </div>
            <div class="welcome">
                <h1><b>Tambah Akademisi</b></h1>
                <form action="/sinkronisasi-semester" method="POST" id="syncForm">
                    @csrf
                    <button type="submit" class="sync-btn" id="syncButton">
                        <i class="fas fa-sync-alt sync-icon"></i> Sinkronisasi Kenaikan Semester
                    </button>
                </form>

                <form action="/ganjil-genap" method="POST" id="syncForm">
                    @csrf
                    <button type="submit" class="sync-btn" id="syncButton">
                        <i class="fas fa-sync-alt sync-icon"></i> Ubah Semester (Ganjil/Genap)
                    </button>
                </form>

                <form action="/naik-tahun" method="POST" id="syncForm">
                    @csrf
                    <button type="submit" class="sync-btn" id="syncButton" style="margin-bottom: 45px">
                        <i class="fas fa-sync-alt sync-icon"></i> Naik Tahun Akademik
                    </button>
                </form>


                <!-- Modal Konfirmasi -->
                <div id="confirmationModal" class="modal">
                    <div class="modal-content">
                        {{-- <span class="close">&times;</span> --}}
                        <h3>Konfirmasi Sinkronisasi</h3>
                        <p>Apakah Anda yakin ingin melakukan sinkronisasi kenaikan semester?</p>
                        <div class="modal-buttons">
                            <center>
                                <div style="display: flex; justify-content:center; align-item:center;">
                                    <button id="confirmBtn" class="sync-btn confirm-btn">Ya</button>
                                    <button id="cancelBtn" class="sync-btn cancel-btn">Tidak</button>
                                </div>

                            </center>
                        </div>
                    </div>
                </div>

                <link rel="stylesheet" href="{{ asset('css/register.css') }}">

                <div class="register-container">

                    <form action="/register-berhasil" method="POST" class="register-form">
                        @csrf
                        <div class="form-group">
                            <label for="nim_atau_nip">NIM/NIP</label>
                            <input type="text" name="nim_atau_nip" id="nim_atau_nip" required>
                        </div>

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" required>
                        </div>

                        <div class="form-group">
                            <label for="no_handphone">No Handphone</label>
                            <input type="text" name="no_handphone" id="no_handphone" required>
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role" required>
                                <option value="" disabled selected>Pilih Role Akademisi</option>
                                <option value="mahasiswa">Mahasiswa</option>
                                <option value="dosen">Dosen</option>
                                <option value="sekretariat">Sekretariat</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <input type="text" name="semester" id="semester"
                                placeholder="Kosongkan Jika User Bukan Mahasiswa">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" required>
                        </div>

                        <div class="form-group">
                            <label for="id_jurusan">Jurusan</label>
                            <select name="id_jurusan" id="id_jurusan" required>
                                <option value="" disabled selected>Pilih Jurusan Pengguna</option>
                                @foreach ($jurusan as $item_jurusan)
                                    <option value="{{ $item_jurusan->id_jurusan }}">
                                        {{ $item_jurusan->id_jurusan }} - {{ $item_jurusan->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="submit-btn">Daftarkan Pengguna</button>
                        </div>
                    </form>
                </div>
                </center>
                </link>
            </div>
        </div>
    </div>


    <script>
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // If success or error modal exists, display it
        @if (session('success'))
            setTimeout(function() {
                closeModal('successModal');
            }, 1000);
        @elseif ($errors->any())
            setTimeout(function() {
                closeModal('errorModal');
            }, 1000);
        @endif
    </script>


    <style>
        /* Modal Style */
        .modal {
            display: none;
            /* Sembunyikan modal secara default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            /* Latar belakang transparan */
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            text-align: center;
            border-radius: 10px;
        }

        .modal-content h2 {
            margin-bottom: 20px;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 0;
            right: 10px;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .sync-btn {
            background-color: #3498db;
            color: white;
            padding: 12px 24px;
            border: none;
            font-size: 16px;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .sync-btn:hover {
            background-color: #b96329;
        }

        /* Tombol pada modal */
        #confirmBtn,
        #cancelBtn {
            margin: 10px;
        }
    </style>

    <!-- JavaScript untuk Modal Konfirmasi -->
    <script>
        // Ambil elemen modal dan tombol konfirmasi
        var modal = document.getElementById("confirmationModal");
        var btn = document.getElementById("syncButton");
        var closeBtn = document.getElementsByClassName("close")[0];
        var confirmBtn = document.getElementById("confirmBtn");
        var cancelBtn = document.getElementById("cancelBtn");

        // Ketika tombol sinkronisasi ditekan, tampilkan modal
        btn.onclick = function(event) {
            event.preventDefault(); // Mencegah form dikirim langsung
            modal.style.display = "block"; // Tampilkan modal konfirmasi
        }

        // Ketika tombol "Ya" diklik, kirimkan form
        confirmBtn.onclick = function() {
            document.getElementById("syncForm").submit();
        }

        // Ketika tombol "Tidak" diklik, tutup modal
        cancelBtn.onclick = function() {
            modal.style.display = "none";
        }

        // Ketika klik di luar modal, tutup modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Ketika tombol close diklik, tutup modal
        closeBtn.onclick = function() {
            modal.style.display = "none";
        }
    </script>

</x-layout>
