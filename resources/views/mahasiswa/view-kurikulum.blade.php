<x-layout>
    <link rel="stylesheet" href="{{ asset('css/content.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">


    <script src="{{ asset('js/time.js') }}"></script>

    <div class="content">
        <div class="page-title">
            <i class="fas fa-home"></i>
            <h1>Kurikulum</h1>
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
                    <span>SEKRETARIAT</span>
                    <span class="date-range"></span>
                </div>
            </div>
        </div>
        <div class="alert">
            Bagian Mahasiswa
        </div>
        <div class="welcome">
            <h1><b> Matakuliah </b></h1>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID Matakuliah</th>
                        <th>Nama Matakuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matakuliah as $mtk)
                        <tr>
                            <td>
                                {{ $mtk->id_matakuliah }}
                            </td>
                            <td>
                                {{ $mtk->nama_matakuliah }}
                            </td>
                            <td>
                                {{ $mtk->sks }}
                            </td>
                            <td>
                                {{ $mtk->semester }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    </div>
</x-layout>
