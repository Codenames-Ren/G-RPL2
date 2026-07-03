<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Pendaftaran RPL Disetujui</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.5;
            color: #000;
            margin: 15mm 15mm 12mm 20mm;
        }

        /* ── HEADER ── */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }
        .header-table td { padding: 0; vertical-align: middle; }

        .td-logo { width: 65px; text-align: left; }
        .td-logo img { width: 58px; height: auto; }

        .td-center { text-align: center; }
        .td-center .line1 {
            font-size: 12pt;
            font-weight: bold;
            color: #1a3a6b;
            text-transform: uppercase;
        }
        .td-center .line2 {
            font-size: 14pt;
            font-weight: bold;
            color: #c0392b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .td-address {
            width: 155px;
            text-align: right;
            font-size: 7pt;
            line-height: 1.6;
            color: #333;
        }

        .header-border {
            border-top: 4px solid #1a3a6b;
            margin-top: 6px;
            margin-bottom: 3px;
        }

        .header-sk {
            text-align: center;
            font-size: 7pt;
            font-weight: bold;
            color: #333;
        }

        /* ── JUDUL ── */
        .title-wrap {
            text-align: center;
            margin: 14px 0 12px;
        }
        .title-wrap .t1 {
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
        }
        .title-wrap .t2 { font-size: 10pt; margin-top: 4px; font-weight: bold; }

        /* ── DIVIDER ── */
        .divider { border: none; border-top: 1px solid #bbb; margin: 10px 0; }

        /* ── TABEL DATA ── */
        .mk-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
            margin: 15px 0;
        }
        .mk-table th {
            background-color: #1a3a6b;
            color: #fff;
            padding: 6px 8px;
            text-align: center;
            border: 1px solid #1a3a6b;
        }
        .mk-table td {
            padding: 5px 8px;
            border: 1px solid #999;
            vertical-align: middle;
        }
        .mk-table td.c { text-align: center; }
        .mk-table tbody tr:nth-child(even) { background-color: #f4f7fb; }
        
        .empty-row { text-align: center; padding: 20px !important; font-style: italic; color: #555; }

        /* ── TANGGAL & TANDA TANGAN ── */
        .ttd-date {
            text-align: right;
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 10pt;
        }

        .ttd-outer {
            width: 100%;
            border-collapse: collapse;
        }
        .ttd-outer td {
            width: 50%;
            vertical-align: top;
            padding: 0;
        }

        .ttd-block { float: right; text-align: center; margin-bottom: 16px; width: 250px; }
        .ttd-block .jabatan { min-height: 32pt; font-size: 10pt; }
        .ttd-block .ttd-space { height: 60px; }
        .ttd-block .nama {
            font-weight: bold;
            text-decoration: underline;
            font-size: 10pt;
        }
        .ttd-block .nip { font-size: 9pt; }
    </style>
</head>
<body>

{{-- HEADER --}}
<table class="header-table">
    <tr>
        <td class="td-logo">
            <img src="{{ public_path('images/logo.png') }}" alt="Logo">
        </td>
        <td class="td-center">
            <div class="line1">Institut Teknologi &amp; Bisnis</div>
            <div class="line2">Bina Sarana Global</div>
        </td>
        <td class="td-address">
            Jl. Aria Santika No. 43A<br>
            Margasari, Karawaci<br>
            Kota Tangerang, 15113<br>
            Telp: 021-5522727
        </td>
    </tr>
</table>
<div class="header-border"></div>
<div class="header-sk">SK. KEMDIKBUD RI. NO. 23/E/O/2021</div>

{{-- JUDUL (Hanya ubah blok title-wrap ini saja) --}}
<div class="title-wrap">
    <div class="t1">REKAPITULASI PENDAFTARAN MAHASISWA RPL</div>
    <div class="t2">
        Periode: 
        @if($period)
            @php
                $parts = explode('-', $period);
                if (count($parts) === 2) {
                    echo \Carbon\Carbon::createFromFormat('Y-m', $period)->translatedFormat('F Y');
                } else {
                    echo 'Tahun ' . $period;
                }
            @endphp
        @else
            Semua Periode
        @endif
    </div>
    @if($search)
    <div style="font-size: 9pt; margin-top: 4px;">Pencarian: "{{ $search }}"</div>
    @endif
</div>

<hr class="divider">

{{-- TABEL DATA --}}
<table class="mk-table">
    <thead>
        <tr>
            <th style="width:4%">No</th>
            <th style="width:14%">Nomor Aplikasi</th>
            <th style="width:22%">Nama Mahasiswa</th>
            <th style="width:18%">Program Studi</th>
            <th style="width:10%">Jenis RPL</th>
            <th style="width:12%">Total SKS Diakui</th>
            <th style="width:12%">Tgl Disetujui</th>
            <th style="width:8%">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($applications as $app)
            <tr>
                <td class="c">{{ $loop->iteration }}</td>
                <td class="c">{{ $app->application_number }}</td>
                <td>{{ $app->applicant->user->name ?? '-' }}</td>
                <td>{{ $app->studyProgram->name ?? '-' }}</td>
                <td class="c">{{ strtoupper($app->rpl_type) }}</td>
                <td class="c"><strong>{{ $app->total_sks }}</strong> SKS</td>
                <td class="c">{{ $app->updated_at ? \Carbon\Carbon::parse($app->updated_at)->translatedFormat('d M Y') : '-' }}</td>
                <td class="c">Selesai</td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="empty-row">Tidak ada data pengajuan yang disetujui pada filter ini.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- TANGGAL & TANDA TANGAN (Hanya 1 di kanan bawah biasanya untuk rekap) --}}
<div class="ttd-date">
    Tangerang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
</div>

<div style="width: 100%; display: block; clear: both;">
    <div class="ttd-block">
        <div class="jabatan">Komite Penyelenggara RPL,</div>
        <div class="ttd-space"></div>
        <div class="nama">(............................................)</div>
        <div class="nip">NIP.</div>
    </div>
</div>

</body>
</html>