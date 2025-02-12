<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use App\Models\Jurusan;
use App\Models\Akademisi;
use App\Models\Perwalian;
use App\Models\Matakuliah;
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


    public function halamanTambahMatakuliah()
    {
        $dataJurusan = Jurusan::all();
        return view('management-matakuliah.tambah-matakuliah', ['jurusan' => $dataJurusan]);
    }


    public function simpanMatakuliah(Request $request)
    {
        $request->validate([
            'nama_matakuliah' => 'required|string|max:255',
            'sks' => 'required|integer',
            'semester' => 'required|integer',
            'id_jurusan' => 'required|integer',
        ]);

        $data = [
            'nama_matakuliah' => $request->nama_matakuliah,
            'sks' => $request->sks,
            'semester' => $request->semester,
            'id_jurusan' => $request->id_jurusan,
        ];

        Matakuliah::create($data);

        return redirect()->route('sekre.view.matkul')->with('success', 'Data Matakuliah berhasil disimpan!');
    }









    public function hapusMatakuliah($id_matakuliah)
    {
        Matakuliah::where('id_matakuliah', $id_matakuliah)->delete();

        return redirect()->back()->with('success', 'Matakuliah berhasil dihapus.');
    }

    public function halamanUpdateMatakuliah($id_matakuliah)
    {
        $jumlahDosen = Akademisi::where('role', 'dosen')->count();
        $jumlahMahasiswa = Akademisi::where('role', 'mahasiswa')->count();
        $jumlahSekretariat = Akademisi::where('role', 'sekretariat')->count();
        $matakuliah = Matakuliah::findOrFail($id_matakuliah);

        return view('management-matakuliah.update-matakuliah', [
            'matakuliah' => $matakuliah,
            'jumlahDosen' => $jumlahDosen,
            'jumlahMahasiswa' => $jumlahMahasiswa,
            'jumlahSekretariat' => $jumlahSekretariat,
        ]);
    }

    public function updateMatakuliah(Request $request, $id_matakuliah)
    {
        $request->validate([
            'sks' => 'required',
            'semester' => 'required',
        ]);

        $matakuliah = Matakuliah::findOrFail($id_matakuliah);


        $matakuliah->update([
            'sks' => $request->sks,
            'semester' => $request->semester,
        ]);

        return redirect()->to('/manajemen-view-matakuliah')->with('success', 'Data Berhasil Diubah');
    }
}
