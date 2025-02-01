<x-layout>

    <head>
        <link rel="stylesheet" href="{{ asset('css/tambah-matakuliah.css') }}">

        <link rel="stylesheet" href="{{ asset('css/content.css') }}">
        <link rel="stylesheet" href="{{ asset('css/table.css') }}">
        <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    </head>
    <style>

    </style>
    <div class="content">
        <form action="/proses-tambah-matakuliah" method="POST" class="form-container">
            @csrf

            <div class="fg">
                <label for="nama_matakuliah">Nama Matakuliah</label>
                <input type="text" id="nama_matakuliah" name="nama_matakuliah" class="form-input">
            </div>

            <div class="fg">
                <label for="sks">Jumlah SKS :</label>
                <input type="text" id="sks" name="sks" class="form-input">
            </div>

            <div class="fg">
                <label for="semester">Semester :</label>
                <input type="text" id="semester" name="semester" class="form-input">
            </div>

            <div class="fg">
                <label for="jurusan">Nama Jurusan :</label>
                <select id="jurusan" name="id_jurusan" class="fs">
                    @foreach ($jurusan as $item)
                        <option value="{{ $item->id_jurusan }}">{{ $item->nama_jurusan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="fg">
                <button type="submit" class="form-button">Tambah Matakuliah</button>
            </div>
        </form>
    </div>
</x-layout>
