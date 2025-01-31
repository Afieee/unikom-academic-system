<x-layout>
    <script src="{{ asset('js/time.js') }}"></script>

    @if (Auth::check() && Auth::user()->role == 'sekretariat')
        <link rel="stylesheet" href="{{ asset('css/content.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                        <h6>MAHASISWA</h6>
                        <span class="date-range">Jumlah: {{ $jumlahMahasiswa }}</span>
                    </div>
                </div>
                <div class="card">
                    <i class="fas fa-users"></i>
                    <div class="card-info">
                        <h6>DOSEN</h6>
                        <span class="date-range">Jumlah: {{ $jumlahDosen }}</span>
                    </div>
                </div>
                <div class="card">
                    <i class="fas fa-users"></i>
                    <div class="card-info">
                        <h6>SEKRETARIAT</h6>
                        <span class="date-range">Jumlah: {{ $jumlahSekretariat }}</span>
                    </div>
                </div>
            </div>
            <div class="alert">Bagian Manajemen Akademik</div>

            <div class="chart-container" style="display: flex; justify-content: center; gap: 20px;">
                <div style="width: 35%;">
                    <canvas id="pieChart"></canvas>
                </div>

            </div>
        </div>

        <script>
            const pieCtx = document.getElementById('pieChart').getContext('2d');
            new Chart(pieCtx, {
                type: 'pie',
                data: {
                    labels: ['Mahasiswa', 'Dosen', 'Sekretariat'],
                    datasets: [{
                        data: [{{ $jumlahMahasiswa }}, {{ $jumlahDosen }}, {{ $jumlahSekretariat }}],
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });
        </script>
    @elseif (Auth::user()->role == 'mahasiswa')
        <link rel="stylesheet" href="{{ asset('css/content.css') }}">

        <div class="content">
            <div class="page-title">
                <i class="fas fa-home">
                </i>
                <h1>
                    Halaman Utama
                </h1>
            </div>
            <div class="semester-info">
                <i class="fas fa-calendar-alt">
                </i>
                <span>
                    <span id="currentTime"></span>
                </span>
            </div>
            <div class="cards">
                <div class="card">
                    <i class="fas fa-check-square">
                    </i>
                    <div class="card-info">
                        <span>
                            SMART
                        </span>
                        <span class="date-range">
                            Lorem ipsum dolor sit amet
                        </span>
                    </div>
                </div>
                <div class="card">
                    <i class="fas fa-thumbs-up">
                    </i>
                    <div class="card-info">
                        <span>
                            INTEGERITY
                        </span>
                        <span class="date-range">
                            Lorem ipsum dolor sit amet
                        </span>
                    </div>
                </div>
                <div class="card">
                    <i class="fas fa-users">
                    </i>
                    <div class="card-info">
                        <span>
                            FUTURE
                        </span>
                        <span class="date-range">
                            Lorem ipsum dolor sit amet
                        </span>
                    </div>
                </div>
            </div>
            <div class="alert">
                Dashboard
            </div>
            <div class="welcome">
                <h2>
                    Selamat Datang
                </h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                    pariatur.
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim
                    id
                    est
                    laborum
                </p>
                <p>
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <p>
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat:
                </p>
                <ol>
                    <li>
                        ullamco laboris nisi.
                    </li>
                    <li>
                        laboris nisi ut aliquip ex ea commodo consequat.
                    </li>
                    <li>
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur.
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                        anim
                        id
                        est.
                    </li>
                </ol>
            </div>
        </div>

        </body>

        </html>
        </div>
    @elseif (Auth::user()->role == 'dosen')
        <link rel="stylesheet" href="{{ asset('css/content.css') }}">

        <div class="content">
            <div class="page-title">
                <i class="fas fa-home">
                </i>
                <h1>
                    Halaman Utama
                </h1>
            </div>
            <div class="semester-info">
                <i class="fas fa-calendar-alt">
                </i>
                <span>
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
                            @if ($countBelumDinilai && $countBelumDinilai->nilai_mahasiswa_yang_belum_dinilai)
                                Jumlah : {{ $countBelumDinilai->nilai_mahasiswa_yang_belum_dinilai }}
                            @else
                                0
                            @endif


                        </span>
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
                    <i class="fas fa-users">
                    </i>
                    <div class="card-info">
                        <span>
                            INTEGERITY
                        </span>
                        <span class="date-range">
                            SMART LEARNING
                        </span>
                    </div>
                </div>
            </div>
            <div class="alert">
                Dashboard
            </div>
            <div class="welcome">
                <h2>
                    Selamat Datang
                </h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                    pariatur.
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim
                    id
                    est
                    laborum
                </p>
                <p>
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <p>
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat:
                </p>
                <ol>
                    <li>
                        ullamco laboris nisi.
                    </li>
                    <li>
                        laboris nisi ut aliquip ex ea commodo consequat.
                    </li>
                    <li>
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur.
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                        anim
                        id
                        est.
                    </li>
                </ol>
            </div>
        </div>

        </body>

        </html>
        </div>
    @endif

</x-layout>
