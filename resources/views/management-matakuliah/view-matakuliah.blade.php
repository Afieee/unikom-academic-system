<x-layout>
    <link rel="stylesheet" href="{{ asset('css/content.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">


    <script src="{{ asset('js/time.js') }}"></script>

    <div class="content">
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
                        {{-- <th>Nama Jurusan</th> --}}
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

                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $matakuliahs->links() }}

        </div>
    </div>
    </div>
</x-layout>
