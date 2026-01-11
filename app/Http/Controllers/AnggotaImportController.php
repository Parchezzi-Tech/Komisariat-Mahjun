<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\AnggotaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class AnggotaImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            Excel::import(new AnggotaImport, $request->file('file'));
            
            return redirect()->route('filament.admin.resources.anggotas.index')
                ->with('success', 'Data anggota berhasil diimport!');
        } catch (\Exception $e) {
            return redirect()->route('filament.admin.resources.anggotas.index')
                ->with('error', 'Import gagal: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $headers = [
            'nim',
            'nama',
            'email',
            'no_hp',
            'jenis_kelamin',
            'alamat',
            'fakultas',
            'prodi',
            'angkatan',
            'status',
            'tanggal_masuk',
            'keterangan'
        ];

        $exampleData = [
            [
                '12345678',
                'John Doe',
                'john@example.com',
                '081234567890',
                'Laki-laki',
                'Jl. Contoh No. 123',
                'Teknik',
                'Informatika',
                '2024',
                'Aktif',
                '2024-01-01',
                'Contoh keterangan'
            ]
        ];

        $data = array_merge([$headers], $exampleData);
        
        return Excel::download(new class($data) implements \Maatwebsite\Excel\Concerns\FromArray {
            protected $data;
            
            public function __construct($data) {
                $this->data = $data;
            }
            
            public function array(): array {
                return $this->data;
            }
        }, 'template-anggota.xlsx');
    }
}
