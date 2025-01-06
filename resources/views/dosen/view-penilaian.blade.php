<x-layout>
    <link rel="stylesheet" href="{{ asset('css/content.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tabel-penilaian.css') }}">
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
                <i class="fas fa-check-square">
                </i>
                <div class="card-info">
                    <span>
                        Menunggu Penilaian
                    </span>
                    <span class="date-range">
                        Jumlah : {{ $countBelumDinilai->nilai_mahasiswa_yang_belum_dinilai }} </span>
                </div>
            </div>
            <div class="card">
                <i class="fas fa-thumbs-up">
                </i>
                <div class="card-info">
                    <span>
                        Mahasiswa Yang Diampu (Sesuai Perwalian) :
                    </span>
                    <span class="date-range">
                        Jumlah : {{ $jumlahMahasiswaYangDiampu }}
                    </span>
                </div>
            </div>
            <div class="card">
                <i class="fas fa-users"></i>
                <div class="card-info">
                    <span>SEKRETARIAT</span>
                    <span class="date-range"></span>
                </div>
            </div>
        </div>
        <div class="alert">
            Bagian Manajemen Akademik
        </div>
        <div class="welcome">
            {{-- <form action="/manajemen-view-dosen" method="GET" class="search-form">
                <input type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari Dosen"
                    class="search-input">
                <button type="submit" class="search-button">Search</button>
            </form> --}}
            <h1><b>Bagian Penilaian Mahasiswa</b></h1>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID Matakuliah</th>
                        <th>Matakuliah</th>
                        <th>NIM</th>
                        <th>UTS</th>
                        <th>UAS</th>
                        <th>Beri Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penilaian as $item)
                        <tr>
                            <td>{{ $item->id_matakuliah }}</td>
                            <td>{{ $item->matakuliah->nama_matakuliah }}</td>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->uts }}</td>
                            <td>{{ $item->uas }}</td>
                            <td>
                                <x-nav-link href="{{ route('halamanUpdateNilai', $item->id_perwalian) }}">
                                    <button class="btn-give-score">Beri Nilai</button>
                                </x-nav-link>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>


</x-layout>
