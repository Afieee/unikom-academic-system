<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use App\Models\Jurusan;
use App\Models\Akademisi;
use App\Models\Perwalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function landingPageSiakad()
    {
        return view('index');
    }
    public function halamanLogin()
    {
        return view('auth.login');
    }
    public function halamanSetelahLogout()
    {
        return view('auth.login');
    }



    public function prosesLogin(Request $request)
    {
        $credentials = $request->validate([
            'nim_atau_nip' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $request->session()->put('user', $user);

            return redirect()->route('halaman-dashboard');
        }

        return back()->withErrors([
            'loginError' => 'NIM/NIP atau Password Anda Salah'
        ]);
    }


    public function dashboard(Request $request)
    {
        $user = $request->session()->get('user');
        $jumlahDosen = Akademisi::where('role', 'dosen')->count();
        $jumlahMahasiswa = Akademisi::where('role', 'mahasiswa')->count();
        $jumlahSekretariat = Akademisi::where('role', 'sekretariat')->count();


        $jurusan = Jurusan::all();
        $tahunSekarangDB = Tahun::select('tahun_sekarang')->distinct()->get();
        $tahunAjaranDB = Tahun::select('tahun_ajaran')->distinct()->get();

        $nip = Auth::user()->nim_atau_nip;
        $countBelumDinilai = Perwalian::selectRaw('COUNT(perwalian.id_perwalian) as nilai_mahasiswa_yang_belum_dinilai, perwalian.nip, perwalian.index')
            ->where('perwalian.nip', $nip)
            ->where('perwalian.index', 'T')
            ->groupBy('perwalian.nip', 'perwalian.index')
            ->first();

        $jumlahMahasiswaYangDiampu = Perwalian::where('nip', $nip)
            ->count();

        $nim = Auth::user()->nim_atau_nip;

        $matakuliah = DB::table('users')
            ->join('akademisi', 'users.nim_atau_nip', '=', 'akademisi.nim_atau_nip')
            ->join('jurusan', 'akademisi.id_jurusan', '=', 'jurusan.id_jurusan')
            ->join('matakuliah', 'jurusan.id_jurusan', '=', 'matakuliah.id_jurusan')
            ->where('akademisi.nim_atau_nip', '=', $nim)
            ->select('users.id', 'akademisi.name', 'matakuliah.nama_matakuliah')
            ->get();

        return view('user.dashboard', [
            'user' => $user,
            'jumlahDosen' => $jumlahDosen,
            'jumlahMahasiswa' => $jumlahMahasiswa,
            'jumlahSekretariat' => $jumlahSekretariat,
            'tahunSekarangDB' => $tahunSekarangDB,
            'tahunAjaranDB' => $tahunAjaranDB,
            'matakuliah' => $matakuliah,
            'countBelumDinilai' => $countBelumDinilai,
            'jumlahMahasiswaYangDiampu' => $jumlahMahasiswaYangDiampu,
        ]);
    }




    public function prosesLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/logout-berhasil')->with('success', 'Anda Berhasil Logout');
    }
}
