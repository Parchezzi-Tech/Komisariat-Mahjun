<?php

namespace App\Imports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AnggotaImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Anggota([
            'nim' => $row['nim'],
            'nama' => $row['nama'],
            'email' => $row['email'] ?? null,
            'no_hp' => $row['no_hp'] ?? null,
            'jenis_kelamin' => $row['jenis_kelamin'],
            'alamat' => $row['alamat'] ?? null,
            'fakultas' => $row['fakultas'] ?? null,
            'prodi' => $row['prodi'] ?? null,
            'angkatan' => $row['angkatan'] ?? null,
            'status' => $row['status'] ?? 'Aktif',
            'tanggal_masuk' => !empty($row['tanggal_masuk']) ? \Carbon\Carbon::parse($row['tanggal_masuk']) : null,
            'keterangan' => $row['keterangan'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'nim' => 'required|unique:anggotas,nim',
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status' => 'in:Aktif,Non-Aktif,Alumni',
        ];
    }
}
