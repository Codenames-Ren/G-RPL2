<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Detail Hasil Asesmen RPL</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 10pt;
            line-height: 1.4;
            color: #000;
            margin: 15mm 12mm 12mm 12mm;
        }

        .title-wrap {
            text-align: center;
            margin-bottom: 14px;
        }
        .title-wrap div {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11pt;
        }

        .mk-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
            margin: 10px 0 20px;
        }
        .mk-table th,
        .mk-table td {
            border: 1px solid #000;
            padding: 3px 5px;
        }
        .mk-table th {
            text-align: center;
            font-weight: bold;
            vertical-align: middle;
        }
        .mk-table td.c { text-align: center; }

        .check-mark {
            display: inline-block;
            font-family: "DejaVu Sans", sans-serif;
            font-weight: bold;
            font-size: 10pt;
        }

        .empty-row { text-align: center; padding: 20px !important; font-style: italic; }

        .ttd-wrap { width: 100%; margin-top: 10px; }
        .ttd-block { float: right; text-align: left; width: 260px; font-size: 11pt; }
        .ttd-space { height: 65px; }
        .ttd-block .nama { font-weight: bold; text-decoration: underline; }
    </style>
</head>
<body>

{{-- JUDUL --}}
<div class="title-wrap">
    <div>REKAP DETAIL HASIL ASESMEN</div>
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
            <th rowspan="2" style="width:4%">No.</th>
            <th rowspan="2" style="width:18%">Nama Calon Mahasiswa</th>
            <th rowspan="2" style="width:10%">Kode</th>
            <th rowspan="2" style="width:28%">Mata Kuliah</th>
            <th rowspan="2" style="width:8%">Jumlah SKS</th>
            <th rowspan="2" style="width:8%">Nilai</th>
            <th colspan="2" style="width:14%">Asal CP</th>
        </tr>
        <tr>
            <th style="width:7%">Transfer</th>
            <th style="width:7%">Perolehan</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rows as $row)
            <tr>
                <td class="c">{{ $loop->iteration }}</td>
                <td>{{ $row['student_name'] }}</td>
                <td class="c">{{ $row['course_code'] }}</td>
                <td>{{ $row['course_name'] }}</td>
                <td class="c">{{ $row['sks'] }}</td>
                <td class="c">{{ $row['grade'] }}</td>
                <td class="c">
                    @if($row['is_transfer'])
                        <span class="check-mark">&#10003;</span>
                    @endif
                </td>
                <td class="c">
                    @if($row['is_perolehan'])
                        <span class="check-mark">&#10003;</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="empty-row">Tidak ada data mata kuliah pada filter ini.</td>
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