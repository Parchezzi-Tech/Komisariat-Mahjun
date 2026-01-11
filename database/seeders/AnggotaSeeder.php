<?php

namespace Database\Seeders;

use App\Models\Anggota;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        $anggotas = [
            [
                'nim' => '123456789',
                'nama' => 'Ahmad Fauzan',
                'email' => 'ahmad.fauzan@example.com',
                'no_hp' => '081234567890',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jl. Mahbub No. 123, Surabaya',
                'fakultas' => 'Fakultas Teknik',
                'prodi' => 'Teknik Informatika',
                'angkatan' => '2021',
                'status' => 'Aktif',
                'tanggal_masuk' => '2021-08-01',
                'keterangan' => 'Ketua Komisariat',
            ],
            [
                'nim' => '123456790',
                'nama' => 'Siti Aisyah',
                'email' => 'siti.aisyah@example.com',
                'no_hp' => '081234567891',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jl. Masjid No. 45, Surabaya',
                'fakultas' => 'Fakultas Ekonomi',
                'prodi' => 'Ekonomi Syariah',
                'angkatan' => '2022',
                'status' => 'Aktif',
                'tanggal_masuk' => '2022-08-01',
                'keterangan' => 'Bendahara',
            ],
            [
                'nim' => '123456791',
                'nama' => 'Muhammad Rizki',
                'email' => 'rizki.muhammad@example.com',
                'no_hp' => '081234567892',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jl. Kampus No. 78, Surabaya',
                'fakultas' => 'Fakultas Hukum',
                'prodi' => 'Ilmu Hukum',
                'angkatan' => '2023',
                'status' => 'Aktif',
                'tanggal_masuk' => '2023-08-01',
                'keterangan' => 'Sekretaris',
            ],
            [
                'nim' => '123456792',
                'nama' => 'Fatimah Zahra',
                'email' => 'fatimah.zahra@example.com',
                'no_hp' => '081234567893',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jl. Pesantren No. 90, Surabaya',
                'fakultas' => 'Fakultas Dakwah',
                'prodi' => 'Komunikasi Penyiaran Islam',
                'angkatan' => '2022',
                'status' => 'Aktif',
                'tanggal_masuk' => '2022-08-01',
            ],
            [
                'nim' => '123456793',
                'nama' => 'Abdul Rahman',
                'email' => 'abdul.rahman@example.com',
                'no_hp' => '081234567894',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jl. Islamic Center No. 12, Surabaya',
                'fakultas' => 'Fakultas Ushuluddin',
                'prodi' => 'Aqidah Filsafat',
                'angkatan' => '2021',
                'status' => 'Alumni',
                'tanggal_masuk' => '2021-08-01',
                'keterangan' => 'Sudah lulus',
            ],
            [
                'nim' => '123456794',
                'nama' => 'Khadijah Nur',
                'email' => 'khadijah.nur@example.com',
                'no_hp' => '081234567895',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jl. Pondok No. 56, Surabaya',
                'fakultas' => 'Fakultas Tarbiyah',
                'prodi' => 'Pendidikan Agama Islam',
                'angkatan' => '2023',
                'status' => 'Aktif',
                'tanggal_masuk' => '2023-08-01',
            ],
            [
                'nim' => '123456795',
                'nama' => 'Umar Faruq',
                'email' => 'umar.faruq@example.com',
                'no_hp' => '081234567896',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jl. Pemuda No. 34, Surabaya',
                'fakultas' => 'Fakultas Syariah',
                'prodi' => 'Hukum Ekonomi Syariah',
                'angkatan' => '2024',
                'status' => 'Aktif',
                'tanggal_masuk' => '2024-08-01',
            ],
            [
                'nim' => '123456796',
                'nama' => 'Aisha Ramadhani',
                'email' => 'aisha.ramadhani@example.com',
                'no_hp' => '081234567897',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jl. Madinah No. 67, Surabaya',
                'fakultas' => 'Fakultas Adab',
                'prodi' => 'Bahasa dan Sastra Arab',
                'angkatan' => '2024',
                'status' => 'Aktif',
                'tanggal_masuk' => '2024-08-01',
            ],
        ];

        foreach ($anggotas as $anggota) {
            Anggota::create($anggota);
        }
    }
}
