<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $surat->jenis_surat }} - {{ $surat->nomor_surat }}</title>
    <style>
        @page {
            margin: 2cm 2cm 2cm 2cm;
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #000;
        }
        
        .header {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        
        .header h1 {
            font-size: 18pt;
            font-weight: bold;
            margin: 0;
            padding: 0;
        }
        
        .header h2 {
            font-size: 16pt;
            font-weight: bold;
            margin: 5px 0;
            padding: 0;
        }
        
        .header p {
            font-size: 11pt;
            margin: 2px 0;
            padding: 0;
        }
        
        .nomor-tanggal {
            margin: 20px 0;
        }
        
        .nomor-tanggal table {
            width: 100%;
        }
        
        .nomor-tanggal td {
            padding: 2px 0;
        }
        
        .kepada {
            margin: 20px 0;
        }
        
        .isi-surat {
            text-align: justify;
            margin: 20px 0;
        }
        
        .isi-surat p {
            margin: 10px 0;
        }
        
        .isi-surat ul, .isi-surat ol {
            margin: 10px 0;
            padding-left: 30px;
        }
        
        .ttd-container {
            margin-top: 40px;
        }
        
        .ttd {
            float: right;
            width: 300px;
            text-align: center;
        }
        
        .ttd-tanggal {
            margin-bottom: 10px;
        }
        
        .ttd-jabatan {
            margin-bottom: 60px;
        }
        
        .ttd-nama {
            font-weight: bold;
            border-bottom: 1px solid #000;
            display: inline-block;
            padding: 0 30px;
        }
        
        .signature-image {
            margin: 10px 0;
            max-height: 80px;
        }
        
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>
    <!-- Header / Kop Surat -->
    <div class="header">
        <h1>PERGERAKAN MAHASISWA ISLAM INDONESIA</h1>
        <h2>KOMISARIAT MAHBUB DJUNAIDI</h2>
        <p>Sekretariat: Jl. Masjid Al-Mahbub, Surabaya | Email: pmii.mahbub@gmail.com</p>
    </div>

    <!-- Nomor Surat & Tanggal -->
    <div class="nomor-tanggal">
        <table>
            <tr>
                <td width="20%">Nomor</td>
                <td width="2%">:</td>
                <td>{{ $surat->nomor_surat }}</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>:</td>
                <td><strong>{{ $surat->perihal }}</strong></td>
            </tr>
        </table>
    </div>

    <!-- Kepada -->
    <div class="kepada">
        {!! nl2br(e($surat->kepada)) !!}
    </div>

    <!-- Salam Pembuka -->
    <div class="isi-surat">
        <p><em>Assalamu'alaikum Warahmatullahi Wabarakatuh</em></p>
        <p>Dengan hormat,</p>
    </div>

    <!-- Isi Surat -->
    <div class="isi-surat">
        {!! $surat->isi_surat !!}
    </div>

    <!-- Penutup -->
    <div class="isi-surat">
        <p>Demikian surat ini kami sampaikan. Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.</p>
        <p><em>Wassalamu'alaikum Warahmatullahi Wabarakatuh</em></p>
    </div>

    <!-- Tanda Tangan -->
    <div class="ttd-container clearfix">
        <div class="ttd">
            <div class="ttd-tanggal">
                Surabaya, {{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}
            </div>
            <div class="ttd-jabatan">
                {{ $surat->jabatan_penandatangan }}
            </div>
            
            @if($surat->signature_path)
                <div>
                    <img src="{{ public_path('storage/' . $surat->signature_path) }}" 
                         alt="Tanda Tangan" 
                         class="signature-image">
                </div>
            @endif
            
            <div class="ttd-nama">
                {{ $surat->penandatangan }}
            </div>
        </div>
    </div>
</body>
</html>
