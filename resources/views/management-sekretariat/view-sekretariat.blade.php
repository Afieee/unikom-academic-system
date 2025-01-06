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
            <h1><b>Data Pegawai Sekretariat</b></h1>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Email</th>
                        <th>No Handphone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sekretariats as $sekretariat)
                        <tr>
                            <td>{{ $sekretariat->nim_atau_nip }}</td>
                            <td>{{ $sekretariat->name }}</td>
                            <td>{{ $sekretariat->email }}</td>
                            <td>{{ $sekretariat->no_handphone }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
</x-layout>
