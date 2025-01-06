<x-layout>

    <link rel="stylesheet" href="{{ asset('css/penilaian.css') }}">
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
            <h1><b>Beri Nilai Mahasiswa</b></h1>
            <form action="{{ route('updateNilai', $penilaian->id_perwalian) }}" method="POST" class="form-container">
                @csrf
                @method('PUT')

                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>UTS</th>
                            <th>UAS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $penilaian->nim }}</td>
                            <td>
                                <input type="number" name="uts" value="{{ $penilaian->uts }}" class="form-input"
                                    placeholder="Nilai UTS">
                            </td>
                            <td>
                                <input type="number" name="uas" value="{{ $penilaian->uas }}" class="form-input"
                                    placeholder="Nilai UAS">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="form-actions">
                    <button type="submit" class="btn-give-score">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
