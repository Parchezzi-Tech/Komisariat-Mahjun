<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratPdfController extends Controller
{
    public function generate(Surat $surat)
    {
        $pdf = Pdf::loadView('pdf.surat', ['surat' => $surat])
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Surat-' . $surat->nomor_surat . '.pdf');
    }
}
