<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Pendaftaran RPL Disetujui</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #000;
            margin: 15mm 15mm 12mm 15mm;
        }

        /* ── JUDUL ── */
        .title-wrap {
            text-align: center;
            margin-bottom: 14px;
        }
        .title-wrap div {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11pt;
        }

        /* ── TABEL DATA ── */
        .mk-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
            margin: 10px 0 20px;
        }
        .mk-table th,
        .mk-table td {
            border: 1px solid #000;
            padding: 4px 6px;
        }
        .mk-table th {
            text-align: center;
            font-weight: bold;
            vertical-align: middle;
        }
        .mk-table td.c { text-align: center; }

        .empty-row { text-align: center; padding: 20px !important; font-style: italic; }

        /* ── TANGGAL & TANDA TANGAN ── */
        .ttd-wrap {
            width: 100%;
            margin-top: 10px;
        }
        .ttd-block {
            float: right;
            text-align: left;
            width: 260px;
            font-size: 11pt;
        }
        .ttd-space { height: 65px; }
        .ttd-block .nama {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body>

{{-- JUDUL --}}
<div class="title-wrap">
    <div>DAFTAR PELAMAR YANG LOLOS</div>
    <div>PROGRAM REKOGNISI PEMBELAJARAN LAMPAU</div>
    <div>
        @if($year)
            @php
                $label = 'TAHUN AKADEMIK ' . $year . '/' . ((int) $year + 1);

                if ($monthFrom || $monthTo) {
                    $fromMonth = (int) ($monthFrom ?: $monthTo);
                    $toMonth = (int) ($monthTo ?: $monthFrom);
                    $endYear = $toMonth < $fromMonth ? ((int) $year) + 1 : (int) $year;

                    $fromLabel = \Carbon\Carbon::create((int) $year, $fromMonth, 1)->translatedFormat('F Y');
                    $toLabel = \Carbon\Carbon::create($endYear, $toMonth, 1)->translatedFormat('F Y');

                    $label = $fromMonth === $toMonth && $endYear === (int) $year
                        ? strtoupper($fromLabel)
                        : strtoupper($fromLabel) . ' – ' . strtoupper($toLabel);
                }

                echo $label;
            @endphp
        @else
            SEMUA PERIODE
        @endif
    </div>
    <div>INSTITUT TEKNOLOGI DAN BISNIS BINA SARANA GLOBAL</div>
    @if($search)
    <div style="font-weight: normal; text-transform: none; margin-top: 4px;">Pencarian: "{{ $search }}"</div>
    @endif
</div>

{{-- TABEL DATA --}}
<table class="mk-table">
    <thead>
        <tr>
            <th rowspan="2" style="width:5%">No.</th>
            <th rowspan="2" style="width:27%">Nama Pelamar</th>
            <th rowspan="2" style="width:22%">Program Studi</th>
            <th rowspan="2" style="width:12%">Fakultas</th>
            <th colspan="3" style="width:34%">Hasil RPL (SKS)</th>
        </tr>
        <tr>
            <th style="width:11%">Transfer</th>
            <th style="width:12%">Perolehan</th>
            <th style="width:11%">Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($applications as $app)
            <tr>
                <td class="c">{{ $loop->iteration }}</td>
                <td>{{ $app->applicant->user->name ?? '-' }}</td>
                <td>{{ $app->studyProgram->name ?? '-' }}</td>
                <td class="c">{{ $app->studyProgram->faculty->code ?? '-' }}</td>
                <td class="c">{{ $app->transfer_sks }}</td>
                <td class="c">{{ $app->perolehan_sks }}</td>
                <td class="c">{{ $app->total_sks }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="empty-row">Tidak ada data pengajuan yang disetujui pada filter ini.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- TANGGAL & TANDA TANGAN --}}
<div class="ttd-wrap">
    <div class="ttd-block">
        <div>Ditetapkan di Tangerang :</div>
        <div>Pada Tanggal : {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
        <div>Rektor,</div>
        <div class="ttd-space"></div>
        <div class="nama">Dr. H. Dedi Royadi, M.Si</div>
        <div>NIP. 01-0291-001</div>
    </div>
</div>

</body>
</html>