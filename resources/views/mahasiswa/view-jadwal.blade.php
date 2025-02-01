<x-layout>
    <link rel="stylesheet" href="{{ asset('css/content.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">


    <script src="{{ asset('js/time.js') }}"></script>

    <div class="content">
        <div class="page-title">
            <i class="fas fa-home"></i>
            <h1>Jadwal Kuliah</h1>
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
                    <span>SMART</span>
                    <span class="date-range"></span>
                </div>
            </div>
            <div class="card">
                <i class="fas fa-users"></i>
                <div class="card-info">
                    <span style="margin-left: 20px; font-size:15px">INTEGERITY</span>
                    <span class="date-range"></span>
                </div>
            </div>
            <div class="card">
                <i class="fas fa-users"></i>
                <div class="card-info">
                    <span>FUTURE</span>
                    <span class="date-range"></span>
                </div>
            </div>
        </div>
        <div class="alert">
            Bagian Mahasiswa
        </div>
        <div class="welcome">
            <h1><b> Jadwal Kuliah / Perwalian </b></h1>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID Matakuliah</th>
                        <th>Matakuliah</th>
                        <th>Dosen</th>
                        <th>Jadwal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal as $jadwal)
                        <tr>
                            <td>
                                {{ $jadwal->id_matakuliah }}
                            </td>
                            <td>
                                {{ $jadwal->nama_matakuliah }}
                            </td>
                            <td>
                                {{ $jadwal->name }}
                            </td>
                            <td>
                                {{ $jadwal->jadwal }}

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    </div>
</x-layout>
