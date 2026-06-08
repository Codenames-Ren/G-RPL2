<?php

namespace App\Helpers\Committee;

use Barryvdh\DomPDF\Facade\Pdf;

class AssessmentSummaryGenerator
{
    /**
     * Generate ringkasan hasil assessment PDF
     *
     * @param array $data  // Data sudah siap cetak, formal dan bahasa Indonesia
     *      [
     *          'nama_mahasiswa' => string,
     *          'nim' => string,
     *          'program_studi' => string,
     *          'total_sks_diakui' => int,
     *          'tanggal_assessment' => string,
     *          'nama_assessor' => string,
     *          'mata_kuliah_diakui' => [
     *               ['mata_kuliah_asal' => string, 'mata_kuliah_tujuan' => string, 'sks' => int]
     *          ],
     *          'bukti_pendukung' => [
     *               'Transkrip', 'Sertifikat', ...
     *          ]
     *      ]
     *
     * @return \Barryvdh\DomPDF\PDF
     */
    public static function generate(array $data)
    {
        return Pdf::loadView('pdf.committee.assessment-summary', $data);
    }
}