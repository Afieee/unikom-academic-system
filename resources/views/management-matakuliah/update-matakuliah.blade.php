<x-layout>
    <link rel="stylesheet" href="{{ asset('css/content.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">

    <style>
        .alert.success {
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 15px;
            font-weight: bold;
        }



        .page-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .semester-info {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            color: #555;
        }

        .cards {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin: 20px 0;
        }

        .card {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 15px;
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
        }

        .card i {
            font-size: 24px;
            color: #2c3e50;
        }

        .card-info span {
            display: block;
            font-size: 14px;
            font-weight: bold;
        }

        .alert {
            padding: 12px;
            background-color: #007bff;
            color: white;
            text-align: center;
            border-radius: 5px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 10px;
            font-size: 16px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .btn-submit {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background-color: #218838;
        }
    </style>

    <script src="{{ asset('js/time.js') }}"></script>

    <div class="content">
        @if (session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
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
                    <span class="date-range">Jumlah: {{ $jumlahMahasiswa }}</span>
                </div>
            </div>
            <div class="card">
                <i class="fas fa-chalkboard-teacher"></i>
                <div class="card-info">
                    <span>DOSEN</span>
                    <span class="date-range">Jumlah: {{ $jumlahDosen }}</span>
                </div>
            </div>
            <div class="card">
                <i class="fas fa-building"></i>
                <div class="card-info">
                    <span>SEKRETARIAT</span>
                    <span class="date-range">Jumlah: {{ $jumlahSekretariat }}</span>
                </div>
            </div>
        </div>

        <div class="alert">
            Bagian Manajemen Akademik
        </div>

        <div class="form-container">
            <form action="{{ route('updateMatakuliah', $matakuliah->id_matakuliah) }}" method="POST">
                @csrf
                @method('PUT')

                <table>
                    <tr>
                        <td>Matakuliah</td>
                        <td>:</td>
                        <td><strong>{{ $matakuliah->nama_matakuliah }}</strong></td>
                    </tr>
                    <tr>
                        <td>Semester</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="semester" value="{{ old('semester', $matakuliah->semester) }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Sks</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="sks" value="{{ old('sks', $matakuliah->sks) }}">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <button type="submit" class="btn-submit">Simpan Perubahan Matakuliah</button>
                        </td>
                    </tr>
                </table>

            </form>
        </div>
    </div>

</x-layout>
