<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use App\Models\Perwalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MatakuliahController extends Controller
{

    public function mahasiswaTampilMatakuliah(Request $request)
    {
        $user = $request->session()->get('user');

        $nim = Auth::user()->nim_atau_nip;
        $matakuliah = DB::table('users')
            ->join('akademisi', 'users.nim_atau_nip', '=', 'akademisi.nim_atau_nip')
            ->join('jurusan', 'akademisi.id_jurusan', '=', 'jurusan.id_jurusan')
            ->join('matakuliah', 'jurusan.id_jurusan', '=', 'matakuliah.id_jurusan')
            ->where('akademisi.nim_atau_nip', '=', $nim)
            ->select('users.id', 'akademisi.name', 'matakuliah.id_matakuliah', 'matakuliah.nama_matakuliah', 'matakuliah.sks', 'matakuliah.semester')
            ->orderBy('matakuliah.semester', 'asc')
            ->get();


        return view('mahasiswa.view-kurikulum', [
            'matakuliah' => $matakuliah,
        ]);
    }

    public function tampilJadwalMahasiswa()
    {
        // Mengambil data perwalian berdasarkan nim_atau_nip dan tahun_ajaran
        $nim = Auth::user()->nim_atau_nip;  // Atau bisa dari request session atau parameter

        $jadwalMahasiswa = Perwalian::join('akademisi', 'akademisi.nim_atau_nip', '=', 'perwalian.nip')
            ->join('tahun', 'perwalian.id_tahun', '=', 'tahun.id_tahun')
            ->join('matakuliah', 'perwalian.id_matakuliah', '=', 'matakuliah.id_matakuliah')
            ->where('perwalian.nim', '=', $nim)
            ->whereColumn('perwalian.tahun_ajaran', '=', 'tahun.tahun_ajaran')
            ->whereColumn('perwalian.tahun', '=', 'tahun.tahun_sekarang')
            ->where('akademisi.nim_atau_nip', '=', DB::raw('perwalian.nip'))
            ->select(
                'perwalian.nim',
                'perwalian.nip',
                'akademisi.name',
                'matakuliah.id_matakuliah',
                'matakuliah.nama_matakuliah',
                'perwalian.jadwal',
            )
            ->get();


        return view('mahasiswa.view-jadwal', [
            'jadwal' => $jadwalMahasiswa,
        ]);
    }
}
