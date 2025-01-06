<x-layout>
    <link rel="stylesheet" href="{{ asset('css/content.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">

    <script src="{{ asset('js/time.js') }}"></script>

    <div class="content">
        <div class="page-title">
            <i class="fas fa-home"></i>
            <h1>Halaman Utama</h1>
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
            <form action="/manajemen-view-mahasiswa" method="GET" class="search-form">
                <input type="search" name="katakunci" value="{{ Request::get('katakunci') }}"
                    placeholder="Cari Mahasiswa" class="search-input">
                <button type="submit" class="search-button">Search</button>
            </form>

            <h1><b>Data Mahasiswa</b></h1>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Email</th>
                        <th>No Handphone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $mhs)
                        <tr>
                            <td>
                                <center>{{ $loop->iteration }}</center>
                            </td>
                            <td>{{ $mhs->nim_atau_nip }}</td>
                            <td>{{ $mhs->name }}</td>
                            <td>{{ $mhs->email }}</td>
                            <td>{{ $mhs->no_handphone }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}

        </div>
    </div>
    </div>
</x-layout>
