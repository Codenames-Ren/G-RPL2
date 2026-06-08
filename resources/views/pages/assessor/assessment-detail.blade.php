@extends('layouts.app')

@section('title', 'Assessment Detail - G-RPL2')
@section('page', 'assessment-detail')
@section('authRequired', 'true')
@section('roleRequired', 'assessor')

@section('content')
    <section class="app-shell" data-protected-shell hidden data-assessment-id="">
        <aside class="sidebar">
            <p class="eyebrow">Assessor</p>
            <h1 data-assessment-title>Assessment Detail</h1>
            <div class="sidebar-actions">
                <a class="button button-small button-muted" href="/assessments">Back</a>
                <button class="button button-small button-muted" type="button" data-create-assessment hidden>Mulai Penilaian</button>
                <button class="button button-small button-muted" type="button" data-submit-assessment hidden>Submit Penilaian</button>
            </div>
        </aside>
        <div class="workspace">
            <div class="workspace-header">
                <div>
                    <p class="eyebrow" data-assessment-status-badge>Status</p>
                    <h2 data-assessment-number>Application Number</h2>
                </div>
                <span class="connection-pill" data-api-status>Connecting</span>
            </div>
            <div data-page-message></div>

            <div class="detail-grid" data-assessment-info>
                <div class="detail-item">
                    <span class="detail-label">Pemohon</span>
                    <span class="detail-value" data-detail-applicant-name>-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Email</span>
                    <span class="detail-value" data-detail-applicant-email>-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Program Studi</span>
                    <span class="detail-value" data-detail-study-program>-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Tipe RPL</span>
                    <span class="detail-value" data-detail-rpl-type>-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Total SKS Dikonversi</span>
                    <span class="detail-value" data-detail-total-sks>-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Rekomendasi</span>
                    <span class="detail-value" data-detail-recommendation>-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Catatan</span>
                    <span class="detail-value" data-detail-notes>-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Diajukan</span>
                    <span class="detail-value" data-detail-submitted-at>-</span>
                </div>
            </div>

            <div class="tabs" data-tabs>
                <button class="tab-button active" data-tab-button="a1-courses" data-rpl-section="a1">A1 Courses</button>
                <button class="tab-button" data-tab-button="a2-experiences" data-rpl-section="a2">A2 Learning Experiences</button>
                <button class="tab-button" data-tab-button="course-mappings">Course Mappings</button>
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

            <div class="tab-content" data-tab-content="a2-experiences" data-rpl-section="a2">
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Tipe</th>
                                <th>Organisasi</th>
                                <th>Periode</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody data-a2-experiences-body>
                            <tr><td colspan="5">Memuat data...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-content" data-tab-content="course-mappings">
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Sumber</th>
                                <th>Tipe Sumber</th>
                                <th>Mata Kuliah Tujuan</th>
                                <th>SKS</th>
                                <th>Diakui</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody data-assessment-mappings-body>
                            <tr><td colspan="6">Memuat data...</td></tr>
                        </tbody>
                    </table>
                </div>
                <div style="margin-top:16px;display:flex;gap:8px;flex-wrap:wrap;" data-mapping-actions>
                    <button class="button button-small button-muted" type="button" data-add-a1-mapping hidden>Tambah Mapping A1</button>
                    <button class="button button-small button-muted" type="button" data-add-a2-mapping hidden>Tambah Mapping A2</button>
                </div>
            </div>

            <div class="tab-content" data-tab-content="documents">
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nama Dokumen</th>
                                <th>Jenis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody data-documents-body>
                            <tr><td colspan="3">Memuat data...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <div class="modal" data-modal="create-mapping" hidden>
        <div class="modal-content">
            <div class="modal-header">
                <h3 data-mapping-modal-title>Tambah Mapping</h3>
                <button class="modal-close" type="button" data-close-modal="create-mapping">&times;</button>
            </div>
            <div class="form-grid" style="padding:24px;">
                <form data-mapping-form class="form-grid" style="border:0;background:transparent;box-shadow:none;padding:0;">
                    <input type="hidden" name="source_type" data-source-type>
                    <div class="form-grid-full">
                        <label>
                            Sumber
                            <select name="source_id" required>
                                <option value="">Memuat...</option>
                            </select>
                        </label>
                    </div>
                    <div class="form-grid-full">
                        <label>
                            Mata Kuliah Tujuan
                            <select name="course_id" data-course-select>
                                <option value="">Memuat course...</option>
                            </select>
                        </label>
                    </div>
                    <div class="form-grid-full">
                        <label>
                            <input type="checkbox" name="is_recognized" value="1" checked data-recognized-checkbox>
                            Diakui (recognized)
                        </label>
                    </div>
                    <div class="form-grid-full">
                        <label>
                            Catatan
                            <textarea name="notes" rows="3" placeholder="Catatan mapping..."></textarea>
                        </label>
                    </div>
                    <div data-form-message></div>
                    <div class="modal-actions">
                        <button class="button button-muted" type="button" data-close-modal="create-mapping">Batal</button>
                        <button class="button" type="button" data-submit-mapping>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
