<x-layout>
    <link rel="stylesheet" href="{{ asset('css/content.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Menambahkan Chart.js -->

    <script src="{{ asset('js/time.js') }}"></script>

    <div class="content">
        <div class="page-title">
            <i class="fas fa-home"></i>
            <h1>Riwayat Nilai</h1>
        </div>
        <div class="semester-info">
            <i class="fas fa-calendar-alt"></i>
            <span id="realTimeClock">
                <span id="currentTime"></span>
            </span>
        </div>

        <div class="alert">
            Bagian Mahasiswa
        </div>
        <div class="welcome">
            <h1><b> Matakuliah </b></h1>
            <div class="export-btn-container">
                <a href="{{ url('/export-nilai/' . Auth::user()->nim_atau_nip . '/' . urlencode(Auth::user()->name)) }}"
                    class="excel">
                    <i class="fas fa-download"></i> Export ke Excel
                </a>
            </div>

            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Nama Matakuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Nilai Akhir</th>
                        <th>Indeks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilai as $nilai)
                        <tr>
                            <td>{{ $nilai->matakuliah->nama_matakuliah }}</td>
                            <td>{{ $nilai->matakuliah->sks }}</td>
                            <td>{{ $nilai->matakuliah->semester }}</td>
                            <td>{{ $nilai->na }}</td>
                            <td>{{ $nilai->index }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h1>Statistik Nilai</h1>

            <!-- Chart Container -->
            <div class="chart-container"
                style="display: flex; justify-content: space-between; width: 80%; margin: auto;">
                <!-- Pie Chart -->
                <div style="width: 45%;">
                    <canvas id="indexPieChart"></canvas>
                </div>

                <!-- Bar Chart -->
                <div style="width: 85%;">
                    <canvas id="indexBarChart"></canvas>
                </div>
            </div>

            <!-- Combined Legend -->
            <div id="chartLegend" style="display: flex; justify-content: center; margin-top: 20px;  margin-bottom:20%">
                <div style="margin-right: 20px;">
                    <span style="display: inline-block; width: 20px; height: 20px; background-color: #4CAF50;"></span> A
                </div>
                <div style="margin-right: 20px;">
                    <span style="display: inline-block; width: 20px; height: 20px; background-color: #FFC107;"></span> B
                </div>
                <div style="margin-right: 20px;">
                    <span style="display: inline-block; width: 20px; height: 20px; background-color: #2196F3;"></span> C
                </div>
                <div style="margin-right: 20px;">
                    <span style="display: inline-block; width: 20px; height: 20px; background-color: #FF5722;"></span> D
                </div>
                <div style="margin-right: 20px;">
                    <span style="display: inline-block; width: 20px; height: 20px; background-color: #9E9E9E;"></span> E
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data dari controller
        const indexCounts = @json($indexCounts);

        // Pie Chart
        var ctxPie = document.getElementById('indexPieChart').getContext('2d');
        var indexPieChart = new Chart(ctxPie, {
            type: 'pie', // Pie chart
            data: {
                labels: ['A', 'B', 'C', 'D', 'E'], // Legend
                datasets: [{
                    label: 'Jumlah Indeks',
                    data: [indexCounts.A, indexCounts.B, indexCounts.C, indexCounts.D, indexCounts
                        .E
                    ], // Data
                    backgroundColor: ['#4CAF50', '#FFC107', '#2196F3', '#FF5722', '#9E9E9E'], // Warna
                    borderColor: ['#388E3C', '#FF9800', '#1976D2', '#F44336', '#616161'], // Border warna
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false // Menyembunyikan legend di pie chart
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });

        // Bar Chart
        var ctxBar = document.getElementById('indexBarChart').getContext('2d');
        var indexBarChart = new Chart(ctxBar, {
            type: 'bar', // Bar chart
            data: {
                labels: ['A', 'B', 'C', 'D', 'E'],
                datasets: [{
                    label: 'Jumlah Indeks',
                    data: [indexCounts.A, indexCounts.B, indexCounts.C, indexCounts.D, indexCounts.E],
                    backgroundColor: ['#4CAF50', '#FFC107', '#2196F3', '#FF5722', '#9E9E9E'],
                    borderColor: ['#388E3C', '#FF9800', '#1976D2', '#F44336', '#616161'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false // Menyembunyikan legend di bar chart
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-layout>
