<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Surat extends Model
{
    protected $fillable = [
        'nomor_surat',
        'jenis_surat',
        'perihal',
        'kepada',
        'isi_surat',
        'tanggal_surat',
        'penandatangan',
        'jabatan_penandatangan',
        'signature_path',
        'status',
        'created_by',
        'pdf_path',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function generateNomorSurat(): string
    {
        $lastSurat = static::whereYear('created_at', date('Y'))->latest('id')->first();
        $nextNumber = $lastSurat ? ((int) explode('/', $lastSurat->nomor_surat)[0]) + 1 : 1;
        
        return sprintf('%03d/PMII-MAHBUB/%s/%s', $nextNumber, strtoupper($this->getJenisSuratCode()), date('Y'));
    }
    
    private function getJenisSuratCode(): string
    {
        return match($this->jenis_surat) {
            'Surat Tugas' => 'ST',
            'Surat Keterangan' => 'SK',
            'Surat Undangan' => 'SU',
            'Surat Rekomendasi' => 'SR',
            'Surat Pengantar' => 'SP',
            default => 'SRT',
        };
    }
}
