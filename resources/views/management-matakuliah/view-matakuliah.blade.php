<x-layout>
    <link rel="stylesheet" href="{{ asset('css/content.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <style>
        .btn-update {
            background-color: #008CBA;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: 0.3s ease-in-out;
            text-decoration: none;
            display: inline-block;
        }

        .btn-update:hover {
            background-color: #005f73;
        }

        .btn-delete {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: 0.3s ease-in-out;
        }

        .btn-delete:hover {
            background-color: #cc0000;
        }

        /* Menjadikan tombol update & delete sejajar */
        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons form {
            margin: 0;
        }
    </style>


    <script src="{{ asset('js/time.js') }}"></script>

    <div class="content">
        @if (session('success'))
            <script>
                window.onload = function() {
                    alert("{{ session('success') }}");
                };
            </script>
        @endif
        <div class="page-title">
            <i class="fas fa-home"></i>
            <h1>Matakuliah</h1>
        </div>
        <div class="semester-info">
            <i class="fas fa-calendar-alt"></i>
            <span id="realTimeClock">
                <span id="currentTime"></span>
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
            <form action="/manajemen-view-matakuliah" method="GET" class="search-form">
                <input type="search" name="katakunci" value="{{ Request::get('katakunci') }}"
                    placeholder="Cari Matakuliah" class="search-input">
                <button type="submit" class="search-button">Search</button>
            </form>

            <h1><b>Data Matakuliah</b></h1>
            <a href="/manajemen-view-tambah-matakuliah" class="tambah-matakuliah">Tambah Matakuliah</a>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID Matakuliah</th>
                        <th>Nama Matakuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matakuliahs as $matakuliah)
                        <tr>
                            <td>{{ $matakuliah->id_matakuliah }}</td>
                            <td>{{ $matakuliah->nama_matakuliah }}</td>
                            <td>{{ $matakuliah->sks }}</td>
                            <td>{{ $matakuliah->semester }}</td>
                            <td>{{ $matakuliah->jurusan ? $matakuliah->jurusan->nama_jurusan : 'Jurusan tidak tersedia' }}
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('halamanUpdateMatakuliah', $matakuliah->id_matakuliah) }}"
                                        class="btn-update">
                                        Update
                                    </a>

                                    <form action="{{ url('/hapus-matakuliah/' . $matakuliah->id_matakuliah) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda Ingin Menghapus Matakuliah ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $matakuliahs->links() }}

        </div>
    </div>
    </div>
</x-layout>
