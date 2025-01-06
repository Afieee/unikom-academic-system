@if (session('success'))
    <div style="color: green; text-align: center; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div style="color: red; text-align: center; margin-bottom: 20px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<p>{{ $user->name }}</p>
<p>{{ $user->nim_atau_nip }}</p>
<p>{{ $user->role }}</p>

<!-- Tampilkan Foto Profil -->
<center>
    @if ($user->foto_profile)
        <img src="{{ asset('storage/profile_pictures/' . $user->foto_profile) }}" alt="Profile Picture"
            style="max-width: 150px; height: auto;">
    @else
        <p>Belum ada foto profil</p>
    @endif
</center>

<form action="{{ url('/profile/update-foto/' . $user->id_users) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="foto_profile">Upload Foto Profil:</label>
        <input type="file" name="foto_profile" id="foto_profile" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Update Foto</button>
</form>




<!-- Cek role pengguna dan tampilkan konten yang sesuai -->
@if (Auth::check() && Auth::user()->role == 'sekretariat')
    <center>
        <h2>Halaman Sekretariat</h2>

        <!-- Form untuk sinkronisasi -->
        <form action="/sinkronisasi-semester" method="POST">
            @csrf
            <button type="submit">Sinkronisasi Kenaikan Semester</button>
        </form>

        <!-- Form untuk tambah pengguna -->
        <form action="/register-berhasil" method="POST">
            @csrf
            <table>
                <tr>
                    <td>NIM/NIP</td>
                    <td>:</td>
                    <td><input type="text" name="nim_atau_nip"></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                    <td>No Handphone</td>
                    <td>:</td>
                    <td><input type="text" name="no_handphone"></td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>:</td>
                    <td>
                        <select name="role" id="role">
                            <option value="" disabled selected>Pilih Role Anda</option>
                            <option value="mahasiswa">Mahasiswa</option>
                            <option value="dosen">Dosen</option>
                            <option value="sekretariat">Sekretariat</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Semester</td>
                    <td>:</td>
                    <td><input type="text" name="semester" placeholder="Kosongkan Jika User Bukan Mahasiswa"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td>
                        Jurusan
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <select name="id_jurusan" id="id_jurusan">
                            <option value="" disabled selected>Pilih Jurusan Pengguna</option>
                            @foreach ($jurusan as $item_jurusan)
                                <option value="{{ $item_jurusan->id_jurusan }}">{{ $item_jurusan->id_jurusan }} -
                                    {{ $item_jurusan->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <center>
                            <button type="submit">Daftarkan Pengguna</button>
                        </center>
                    </td>
                </tr>
            </table>

        </form>

        <!-- Dropdown untuk dosen -->
        <select name="nim_atau_nip" id="nim_atau_nip">
            @foreach ($dosen as $d)
                <option value="{{ $d->nim_atau_nip }}">{{ $d->nim_atau_nip }} - {{ $d->name }}</option>
            @endforeach
        </select>
    </center>

    </center>
@elseif (Auth::user()->role == 'mahasiswa')
    <center>
        <h2>Selamat Datang, Mahasiswa!</h2>
        <!-- Konten khusus mahasiswa -->
    </center>
@elseif (Auth::user()->role == 'dosen')
    <center>
        <h2>Selamat Datang, Dosen!</h2>
        <!-- Konten khusus dosen -->
    </center>
@endif


<form action="/proses-logout" method="get">
    @csrf
    <button type="submit">Log-out</button>
</form>
