<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\StudyProgram;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Isi array $faculties sesuai fakultas yang ada di kampus lo.
     * Isi array $mapping sesuai kolom `code` di tabel study_programs lo
     * (cek data existing dulu: SELECT code, name FROM study_programs;)
     */
    public function run(): void
    {
        // 1. Buat data fakultas
        $faculties = [
            ['code' => 'FTIK', 'name' => 'Fakultas Teknik dan Ilmu Komputer'],
            // tambah fakultas lain kalau ada, contoh:
            // ['code' => 'FEB', 'name' => 'Fakultas Ekonomi dan Bisnis'],
        ];

        foreach ($faculties as $faculty) {
            Faculty::updateOrCreate(
                ['code' => $faculty['code']],
                ['name' => $faculty['name']]
            );
        }

        // 2. Mapping: code study_program => code faculty
        // Sesuaikan key (code prodi) dengan data yang udah ada di database lo
        $mapping = [
            'SI' => 'FTIK',  // contoh: Sistem Informasi -> FTIK
            'TI' => 'FTIK',  // contoh: Teknik Informatika -> FTIK
            // tambah baris lain sesuai code prodi lo
        ];

        foreach ($mapping as $studyProgramCode => $facultyCode) {
            $faculty = Faculty::where('code', $facultyCode)->first();

            if (!$faculty) {
                continue;
            }

            StudyProgram::where('code', $studyProgramCode)
                ->update(['faculty_id' => $faculty->id]);
        }
    }
}