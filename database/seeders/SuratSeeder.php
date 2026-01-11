<?php

namespace Database\Seeders;

use App\Models\Surat;
use App\Models\User;
use Illuminate\Database\Seeder;

class SuratSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@pmii.org')->first();
        
        if (!$admin) {
            return;
        }

        $surats = [
            [
                'nomor_surat' => '001/PMII-MAHBUB/ST/2026',
                'jenis_surat' => 'Surat Tugas',
                'perihal' => 'Penugasan Koordinator Kegiatan Ramadhan 2026',
                'kepada' => "Yth.\nSaudara/i Ahmad Fauzan\nKoordinator Bidang Kerohanian\nDi tempat",
                'isi_surat' => '<p>Berdasarkan rapat pengurus harian yang telah dilaksanakan pada tanggal 5 Januari 2026, dengan ini kami menugaskan:</p><ul><li>Nama: Ahmad Fauzan</li><li>Jabatan: Koordinator Bidang Kerohanian</li></ul><p>Untuk melaksanakan tugas sebagai Koordinator Kegiatan Ramadhan 2026 yang akan dilaksanakan pada bulan Maret 2026.</p><p>Demikian surat tugas ini dibuat untuk dapat dilaksanakan dengan penuh tanggung jawab.</p>',
                'tanggal_surat' => '2026-01-10',
                'penandatangan' => 'Dr. H. Abdullah Syafi\'i, M.Pd.I',
                'jabatan_penandatangan' => 'Ketua Komisariat',
                'status' => 'Final',
                'created_by' => $admin->id,
            ],
            [
                'nomor_surat' => '002/PMII-MAHBUB/SK/2026',
                'jenis_surat' => 'Surat Keterangan',
                'perihal' => 'Surat Keterangan Aktif Berorganisasi',
                'kepada' => "Yth.\nPimpinan Perusahaan/Instansi\nDi tempat",
                'isi_surat' => '<p>Yang bertanda tangan di bawah ini, Ketua Komisariat PMII Mahbub Djunaidi, menerangkan bahwa:</p><ul><li>Nama: Siti Aisyah</li><li>NIM: 123456790</li><li>Fakultas: Ekonomi</li><li>Prodi: Ekonomi Syariah</li></ul><p>Adalah benar anggota aktif Komisariat PMII Mahbub Djunaidi sejak tahun 2022 hingga sekarang.</p><p>Surat keterangan ini dibuat untuk keperluan melamar pekerjaan.</p>',
                'tanggal_surat' => '2026-01-11',
                'penandatangan' => 'Dr. H. Abdullah Syafi\'i, M.Pd.I',
                'jabatan_penandatangan' => 'Ketua Komisariat',
                'status' => 'Final',
                'created_by' => $admin->id,
            ],
            [
                'nomor_surat' => '003/PMII-MAHBUB/SU/2026',
                'jenis_surat' => 'Surat Undangan',
                'perihal' => 'Undangan Rapat Kerja Tahunan 2026',
                'kepada' => "Yth.\nSeluruh Pengurus Komisariat PMII Mahbub Djunaidi\nDi tempat",
                'isi_surat' => '<p>Dengan hormat, kami mengundang Saudara/i untuk menghadiri Rapat Kerja Tahunan 2026 yang akan dilaksanakan pada:</p><ul><li>Hari/Tanggal: Sabtu, 20 Januari 2026</li><li>Waktu: 08.00 WIB - Selesai</li><li>Tempat: Sekretariat PMII Mahbub Djunaidi</li><li>Acara: Evaluasi Program 2025 dan Penyusunan Program Kerja 2026</li></ul><p>Mengingat pentingnya agenda ini, kehadiran Saudara/i sangat kami harapkan.</p>',
                'tanggal_surat' => '2026-01-11',
                'penandatangan' => 'Muhammad Rizki',
                'jabatan_penandatangan' => 'Sekretaris Umum',
                'status' => 'Draft',
                'created_by' => $admin->id,
            ],
        ];

        foreach ($surats as $surat) {
            Surat::create($surat);
        }
    }
}
