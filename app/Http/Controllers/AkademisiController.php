<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tahun;
use App\Models\Jurusan;

use App\Models\Akademisi;
use App\Models\Perwalian;
use App\Models\Matakuliah;
use App\Exports\NilaiExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AkademisiController extends Controller
{










    public function sinkronisasiSemester(Request $request)
    {
        $akademisi = Akademisi::whereNotNull('semester')->get();


        foreach ($akademisi as $item) {
            $item->semester += 1;
            $item->update();
        }

        session()->flash('success', 'Sinkronisasi Kenaikan Semester Berhasil');

        return redirect('/manajemen-akademisi');
    }










    public function halamanViewMahasiswa(Request $request)
    {
        $jumlahDosen = Akademisi::where('role', 'dosen')->count();
        $jumlahMahasiswa = Akademisi::where('role', 'mahasiswa')->count();
        $jumlahSekretariat = Akademisi::where('role', 'sekretariat')->count();

        $katakunci = $request->katakunci;

        // Build the query for mahasiswa with filtering and ordering
        $query = Akademisi::where('role', 'mahasiswa')->orderBy('nim_atau_nip', 'asc');

        if (!empty($katakunci)) {
            $query->where(function ($q) use ($katakunci) {
                $q->where('nim_atau_nip', 'like', "%{$katakunci}%")
                    ->orWhere('name', 'like', "%{$katakunci}%")
                    ->orWhere('email', 'like', "%{$katakunci}%")
                    ->orWhere('no_handphone', 'like', "%{$katakunci}%");
            });
        }


        // Mengambil data dengan relasi ke tabel users
        $data = $query->with('user')->paginate(10); // Mengambil relasi 'user' bersama data mahasiswa

        return view('management-mahasiswa.view-mahasiswa', [
            'jumlahDosen' => $jumlahDosen,
            'jumlahMahasiswa' => $jumlahMahasiswa,
            'jumlahSekretariat' => $jumlahSekretariat,
            'data' => $data,
        ]);
    }

    public function halamanViewDosen(Request $request)
    {
        $jumlahDosen = Akademisi::where('role', 'dosen')->count();
        $jumlahMahasiswa = Akademisi::where('role', 'mahasiswa')->count();
        $jumlahSekretariat = Akademisi::where('role', 'sekretariat')->count();

        $katakunci = $request->katakunci;
        $query = Akademisi::where('role', 'dosen')->orderBy('nim_atau_nip', 'asc');
        if (!empty($katakunci)) {
            $query->where(function ($q) use ($katakunci) {
                $q->where('nim_atau_nip', 'like', "%{$katakunci}%")
                    ->orWhere('name', 'like', "%{$katakunci}%")
                    ->orWhere('email', 'like', "%{$katakunci}%")
                    ->orWhere('no_handphone', 'like', "%{$katakunci}%");
            });
        }
        $data = $query->paginate(10);

        return view('management-dosen.view-dosen', [
            'jumlahDosen' => $jumlahDosen,
            'jumlahMahasiswa' => $jumlahMahasiswa,
            'jumlahSekretariat' => $jumlahSekretariat,
            'data' => $data,
        ]);
    }


    public function halamanViewSekretariat(Request $request)
    {
        $jumlahDosen = Akademisi::where('role', 'dosen')->count();
        $jumlahMahasiswa = Akademisi::where('role', 'mahasiswa')->count();
        $jumlahSekretariat = Akademisi::where('role', 'sekretariat')->count();

        $sekretariat = Akademisi::where('role', 'sekretariat')->orderBy('nim_atau_nip', 'asc')->get();
        $katakunci = $request->katakunci;


        return view('management-sekretariat.view-sekretariat', [
            'jumlahDosen' => $jumlahDosen,
            'jumlahMahasiswa' => $jumlahMahasiswa,
            'jumlahSekretariat' => $jumlahSekretariat,
            'sekretariats' => $sekretariat
        ]);
    }



    public function halamanViewMatakuliah(Request $request)
    {
        // Hitung jumlah dosen, mahasiswa, dan sekretariat
        $jumlahDosen = Akademisi::where('role', 'dosen')->count();
        $jumlahMahasiswa = Akademisi::where('role', 'mahasiswa')->count();
        $jumlahSekretariat = Akademisi::where('role', 'sekretariat')->count();

        // Ambil kata kunci dari request
        $katakunci = $request->katakunci;

        // Mulai query untuk mengambil data matakuliah dengan relasi jurusan
        $query = Matakuliah::with('jurusan');

        // Jika ada kata kunci pencarian, tambahkan filter pada query
        if (!empty($katakunci)) {
            $query->where(function ($q) use ($katakunci) {
                $q->where('id_matakuliah', 'like', "%{$katakunci}%")
                    ->orWhere('nama_matakuliah', 'like', "%{$katakunci}%")
                    ->orWhereHas('jurusan', function ($q) use ($katakunci) {
                        $q->where('nama_jurusan', 'like', "%{$katakunci}%");
                    });
            });
        }

        // Ambil data matakuliah dengan pagination
        $matakuliah = $query->orderBy('semester', 'asc')->paginate(10);

        // Kembalikan ke view dengan data yang diperlukan
        return view('management-matakuliah.view-matakuliah', [
            'jumlahDosen' => $jumlahDosen,
            'jumlahMahasiswa' => $jumlahMahasiswa,
            'jumlahSekretariat' => $jumlahSekretariat,
            'matakuliahs' => $matakuliah,
        ]);
    }

    public function halamanViewAkademisi()
    {
        $jumlahDosen = Akademisi::where('role', 'dosen')->count();
        $jumlahMahasiswa = Akademisi::where('role', 'mahasiswa')->count();
        $jumlahSekretariat = Akademisi::where('role', 'sekretariat')->count();




        $jurusan = Jurusan::all();
        $tahunSekarangDB = Tahun::select('tahun_sekarang')->distinct()->get();
        $tahunAjaranDB = Tahun::select('tahun_ajaran')->distinct()->get();



        return view('akademisi.tambah-akademisi', [
            'jumlahDosen' => $jumlahDosen,
            'jumlahMahasiswa' => $jumlahMahasiswa,
            'jumlahSekretariat' => $jumlahSekretariat,
            'jurusan' => $jurusan,
            'tahunSekarangDB' => $tahunSekarangDB,
            'tahunAjaranDB' => $tahunAjaranDB,
        ]);
    }

    public function ubahGenapGanjil(Request $request)
    {
        // Ambil data tahun terbaru
        $tahun = Tahun::orderBy('tahun_sekarang', 'desc')->first();

        if ($tahun) {
            // Toggle nilai tahun_ajaran antara 'ganjil' dan 'genap'
            $tahun->tahun_ajaran = $tahun->tahun_ajaran === 'ganjil' ? 'genap' : 'ganjil';
            $tahun->save(); // Simpan perubahan ke database
        }

        // Redirect kembali ke halaman semula atau berikan pesan sukses
        return redirect()->back()->with('success', 'Semester berhasil diubah menjadi ' . $tahun->tahun_ajaran);
    }






    public function naikTahun(Request $request)
    {
        $tahun = Tahun::orderBy('tahun_sekarang', 'desc')->first();

        if ($tahun) {
            $tahun->tahun_sekarang = $tahun->tahun_sekarang + 1;
            $tahun->save();

            return redirect()->back()->with('success', 'Tahun Akademik berhasil dinaikkan ke ' . $tahun->tahun_sekarang);
        }
        return redirect()->back()->with('error', 'Tidak ada data tahun akademik yang ditemukan.');
    }










    public function viewPenilaian()
    {
        $nip = Auth::user()->nim_atau_nip;
        $countBelumDinilai = Perwalian::selectRaw('COUNT(perwalian.id_perwalian) as nilai_mahasiswa_yang_belum_dinilai, perwalian.nip, perwalian.index')
            ->where('perwalian.nip', $nip)
            ->where('perwalian.index', 'T')
            ->groupBy('perwalian.nip', 'perwalian.index')
            ->first();

        $jumlahMahasiswaYangDiampu = Perwalian::where('nip', $nip)
            ->count();
        $penilaian = Perwalian::with(['matakuliah', 'akademisi'])
            ->where('perwalian.nip', $nip)
            ->where('perwalian.index', 'T') // Menambahkan kondisi untuk index = 'T'
            ->get([
                'perwalian.id_perwalian',
                'perwalian.id_matakuliah',
                'perwalian.nim',
                'perwalian.nip',
                'perwalian.uts',
                'perwalian.uas',
                'perwalian.na',
            ]);
        return view('dosen.view-penilaian', [
            'penilaian' => $penilaian,
            'countBelumDinilai' => $countBelumDinilai,
            'jumlahMahasiswaYangDiampu' => $jumlahMahasiswaYangDiampu,
        ]);
    }



    public function halamanUpdateNilai($id_perwalian)
    {
        $nip = Auth::user()->nim_atau_nip;
        $countBelumDinilai = Perwalian::selectRaw('COUNT(perwalian.id_perwalian) as nilai_mahasiswa_yang_belum_dinilai, perwalian.nip, perwalian.index')
            ->where('perwalian.nip', $nip)
            ->where('perwalian.index', 'T')
            ->groupBy('perwalian.nip', 'perwalian.index')
            ->first();

        $jumlahMahasiswaYangDiampu = Perwalian::where('nip', $nip)
            ->count();

        $penilaian = Perwalian::findOrFail($id_perwalian);
        $dosen = Akademisi::where('role', 'dosen')->get();

        return view('dosen.penilaian', [
            'penilaian' => $penilaian,
            'dosen' => $dosen,
            'countBelumDinilai' => $countBelumDinilai,
            'jumlahMahasiswaYangDiampu' => $jumlahMahasiswaYangDiampu,

        ]);
    }




    public function updateNilai(Request $request, $id_perwalian)
    {
        $request->validate([
            'uts' => 'required|numeric',
            'uas' => 'required|numeric',
        ]);

        $penilaian = Perwalian::findOrFail($id_perwalian);

        $penilaian->update([
            'uts' => $request->uts,
            'uas' => $request->uas,
        ]);

        return redirect()->route('halamanUpdateNilai', ['id_perwalian' => $id_perwalian]);
    }



    public function historyNilaiMahasiswa()
    {
        $nim = Auth::user()->nim_atau_nip;

        $nilai = Perwalian::with('matakuliah')
            ->where('perwalian.nim', $nim)
            ->where('perwalian.index', '!=', 'T')
            ->join('matakuliah', 'perwalian.id_matakuliah', '=', 'matakuliah.id_matakuliah')
            ->orderBy('matakuliah.semester', 'asc')
            ->get([
                'perwalian.id_matakuliah',
                'perwalian.index',
                'matakuliah.nama_matakuliah',
                'matakuliah.semester',
            ]);

        return view('mahasiswa.view-nilai', [
            'nilai' => $nilai,
        ]);
    }

    public function exportNilai($nim)
    {
        return Excel::download(new NilaiExport($nim), 'nilai-mahasiswa.xlsx');
    }
}
