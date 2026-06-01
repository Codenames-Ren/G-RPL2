@extends('layouts.app')

@section('title', 'Create Application - G-RPL2')
@section('page', 'applications-create')
@section('authRequired', 'true')
@section('roleRequired', 'applicant')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <aside class="sidebar">
            <p class="eyebrow">Applicant</p>
            <h1>Create Application</h1>
            <a class="button button-small button-muted" href="/applications">Back</a>
        </aside>
        <div class="workspace">
            <div class="workspace-header">
                <div>
                    <p class="eyebrow">New Application</p>
                    <h2>Pilih tipe rekognisi</h2>
                </div>
                <span class="connection-pill" data-api-status>Connecting</span>
            </div>
            <div data-page-message></div>

            <div class="form-grid">
                <label>
                    Program Studi
                    <select name="study_program_id" data-study-program-select required>
                        <option value="">Pilih program studi</option>
                    </select>
                </label>

                <label>
                    Tipe Rekognisi
                    <select name="rpl_type" required>
                        <option value="">Pilih tipe</option>
                        <option value="a1">A1 - Pengakuan Terhadap Pencapaian Pembelajaran Formal</option>
                        <option value="a2">A2 - Pengakuan Terhadap Pencapaian Pembelajaran Informal dan Nonformal</option>
                        <option value="hybrid">Hybrid - Kombinasi A1 dan A2</option>
                    </select>
                </label>

                <div data-form-message></div>

                <button class="button" type="button" data-create-application>
                    Lanjutkan
                </button>
            </div>
        </div>
    </section>
@endsection
