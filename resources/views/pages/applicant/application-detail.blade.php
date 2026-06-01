@extends('layouts.app')

@section('title', 'Application Detail - G-RPL2')
@section('page', 'application-detail')
@section('authRequired', 'true')
@section('roleRequired', 'applicant')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <aside class="sidebar">
            <p class="eyebrow">Applicant</p>
            <h1 data-application-title>Application Detail</h1>
            <div class="sidebar-actions">
                <a class="button button-small button-muted" href="/applications">Back</a>
                <a class="button button-small" href="/applications/{{ request()->route('id') }}/edit">Edit</a>
            </div>
        </aside>
        <div class="workspace">
            <div class="workspace-header">
                <div>
                    <p class="eyebrow" data-application-status-badge>Status</p>
                    <h2 data-application-number>Application Number</h2>
                </div>
                <span class="connection-pill" data-api-status>Connecting</span>
            </div>
            <div data-page-message></div>

            <div class="tabs" data-tabs>
                <button class="tab-button active" data-tab-button="a1-courses" data-rpl-section="a1">A1 Courses</button>
                <button class="tab-button" data-tab-button="a2-learning-experiences" data-rpl-section="a2">A2 Learning Experiences</button>
                <button class="tab-button" data-tab-button="documents">Documents</button>
            </div>

            <div class="tab-content active" data-tab-content="a1-courses" data-rpl-section="a1">
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Nilai</th>
                                <th>Institusi</th>
                            </tr>
                        </thead>
                        <tbody data-a1-courses-body>
                            <tr><td colspan="5">Memuat data...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-content" data-tab-content="a2-learning-experiences" data-rpl-section="a2">
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Tipe</th>
                                <th>Organisasi</th>
                                <th>Periode</th>
                            </tr>
                        </thead>
                        <tbody data-a2-experiences-body>
                            <tr><td colspan="4">Memuat data...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-content" data-tab-content="documents">
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nama Dokumen</th>
                                <th>Jenis</th>
                                <th>Ukuran</th>
                                <th>Diunggah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody data-documents-body>
                            <tr><td colspan="5">Memuat data...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="form-actions" data-submit-section hidden>
                <button class="button button-primary" type="button" data-submit-application>
                    Submit Application
                </button>
            </div>
        </div>
    </section>
@endsection
