<?php

namespace App\Exports;

use App\Models\Perwalian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NilaiExport implements FromCollection, WithHeadings
{
    protected $nim;

    public function __construct($nim)
    {
        $this->nim = $nim;
    }

    public function collection()
    {
        return Perwalian::with('matakuliah')
            ->where('perwalian.nim', $this->nim)
            ->where('perwalian.index', '!=', 'T')
            ->join('matakuliah', 'perwalian.id_matakuliah', '=', 'matakuliah.id_matakuliah')
            ->get([
                'perwalian.id_matakuliah',
                'matakuliah.nama_matakuliah',
                'matakuliah.sks',
                'matakuliah.semester',
                'perwalian.index',

            ]);
    }

    public function headings(): array
    {
        return [
            'ID Matakuliah',
            'Nama Matakuliah',
            'SKS',
            'Semester',
            'Indeks',
        ];
    }
}
