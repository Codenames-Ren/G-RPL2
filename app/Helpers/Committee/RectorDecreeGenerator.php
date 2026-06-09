<?php

namespace App\Helpers\Committee;

use Barryvdh\DomPDF\Facade\Pdf;

class RectorDecreeGenerator
{
    /**
     * Generate SK Rektor PDF
     *
     * @param array $data  // Data sudah siap cetak
     *      [
     *          'nomor_sk' => string,
     *          'nama_mahasiswa' => string,
     *          'program_studi' => string,
     *          'rpl_type' => string,
     *          'total_sks_diakui' => int,
     *          'mata_kuliah_diakui' => [
     *               ['nama_mata_kuliah' => string, 'sks' => int]
     *          ],
     *          'tanggal_cetak' => string,
     *      ]
     *
     * @return \Barryvdh\DomPDF\PDF
     */
    public static function generate(array $data)
    {
        return Pdf::loadView('pdf.committee.rector-decree', $data);
    }
}