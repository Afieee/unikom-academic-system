<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Akademisi;
use App\Models\Jurusan;
use App\Models\Perwalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{


    // public function halamanTambahAkademisi()
    // {


    // }


    public function tambahPenggunaAkademisi(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nim_atau_nip' => 'required|unique:users,nim_atau_nip',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:akademisi,email',
            'no_handphone' => 'required|string|max:15',
            'role' => 'required|string',
            'password' => 'required|string|min:6',
            'id_jurusan' => 'required',
            'semester' => 'nullable|integer',
        ]);




        // Simpan data ke tabel 'akademisi' terlebih dahulu
        $akademisi = new Akademisi();
        $akademisi->nim_atau_nip = $request->nim_atau_nip;
        $akademisi->name = $request->name;
        $akademisi->email = $request->email;
        $akademisi->no_handphone = $request->no_handphone;
        $akademisi->role = $request->role;
        $akademisi->semester = $request->semester;
        $akademisi->id_jurusan = $request->id_jurusan;
        // if($akademisi->role == 'mahasiswa'){
        //     $perwalian = new Perwalian();
        //     $perwalian->nim = $request->nim_atau_nip;
        //     $perwalian->save();


        // }
        $akademisi->save();

        // Setelah data akademisi tersimpan, simpan data ke tabel 'users'
        $user = new User();
        $user->nim_atau_nip = $request->nim_atau_nip; // nim_atau_nip harus sama dengan yang di tabel akademisi
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        // $user->password = $request->password;
        $user->role = $request->role;
        $user->save();

        // Redirect atau tampilkan pesan sukses
        return redirect('/manajemen-akademisi')->with('success', 'Pengguna berhasil didaftarkan.');
    }
}
