<?php

namespace App\Exports;

use App\Models\Perwalian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NilaiExport implements FromCollection, WithHeadings
{
    protected $nim;
    protected $nama;


    public function __construct($nim, $nama)
    {
        $this->nama = $nama;
        $this->nim = $nim;
    }

    public function collection()
    {
        $nilai = Perwalian::with('matakuliah')
            ->where('perwalian.nim', $this->nim)
            ->where('perwalian.index', '!=', 'T')
            ->join('matakuliah', 'perwalian.id_matakuliah', '=', 'matakuliah.id_matakuliah')
            ->orderBy('matakuliah.semester', 'asc')
            ->get([
                'perwalian.id_matakuliah',
                'matakuliah.nama_matakuliah',
                'matakuliah.sks',
                'matakuliah.semester',
                'perwalian.na',
                'perwalian.index',

            ]);

        return $nilai;
    }


    public function headings(): array
    {
        return [
            ['Nama:', $this->nama], // Baris 1, kolom 1 dan 2
            ['NIM:', $this->nim],   // Baris 2, kolom 1 dan 2
            [],                      // Baris kosong sebelum tabel
            ['ID Matakuliah', 'Nama Matakuliah', 'SKS', 'Semester', 'NA', 'Indeks']
        ];
    }

    public function startCell(): string
    {
        return 'A1';
    }

    public function map($row): array
    {
        return [
            $row->id_matakuliah,
            $row->nama_matakuliah,
            $row->sks,
            $row->semester,
            $row->na,
            $row->index,
        ];
    }
}
