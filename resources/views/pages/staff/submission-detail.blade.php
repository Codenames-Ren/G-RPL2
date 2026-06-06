@extends('layouts.app')

@section('title', 'Submission Detail - G-RPL2')
@section('page', 'submission-detail')
@section('authRequired', 'true')
@section('roleRequired', 'staff_rpl')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <aside class="sidebar">
            <p class="eyebrow">Staff</p>
            <h1 data-submission-title>Submission Detail</h1>
            <div class="sidebar-actions">
                <a class="button button-small button-muted" href="/submissions">Back</a>
                <button class="button button-small button-muted" type="button" data-review-application>Review</button>
                <button class="button button-small button-muted" type="button" data-return-application hidden>Kembalikan</button>
                <button class="button button-small button-muted" type="button" data-assign-assessor hidden>Tugaskan Assessor</button>
            </div>
        </aside>
        <div class="workspace">
            <div class="workspace-header">
                <div>
                    <p class="eyebrow" data-submission-status-badge>Status</p>
                    <h2 data-submission-number>Submission Number</h2>
                </div>
                <span class="connection-pill" data-api-status>Connecting</span>
            </div>
            <div data-page-message></div>

            <div class="detail-grid" data-submission-info>
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
                    <span class="detail-label">Diajukan</span>
                    <span class="detail-value" data-detail-submitted-at>-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Revisi</span>
                    <span class="detail-value" data-detail-revision-count>-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Review Notes</span>
                    <span class="detail-value" data-detail-review-notes>-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Assessor Ditugaskan</span>
                    <span class="detail-value" data-detail-assessor>-</span>
                </div>
            </div>

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
        </div>
    </section>

    <div class="modal" data-modal="return-submission" hidden>
        <div class="modal-content">
            <div class="modal-header">
                <h3>Kembalikan Aplikasi</h3>
                <button class="modal-close" type="button" data-close-modal="return-submission">&times;</button>
            </div>
            <div class="form-grid" style="padding:24px;">
                <form data-return-form class="form-grid" style="border:0;background:transparent;box-shadow:none;padding:0;">
                    <div class="form-grid-full">
                        <label>
                            Catatan Review
                            <textarea name="review_notes" rows="4" placeholder="Tuliskan alasan pengembalian..."></textarea>
                        </label>
                    </div>
                    <div data-form-message></div>
                    <div class="modal-actions">
                        <button class="button button-muted" type="button" data-close-modal="return-submission">Batal</button>
                        <button class="button" type="button" data-submit-return>Kembalikan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" data-modal="assign-assessor" hidden>
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tugaskan Assessor</h3>
                <button class="modal-close" type="button" data-close-modal="assign-assessor">&times;</button>
            </div>
            <div class="form-grid" style="padding:24px;">
                <form data-assign-form class="form-grid" style="border:0;background:transparent;box-shadow:none;padding:0;">
                    <div class="form-grid-full">
                        <label>
                            Pilih Assessor
                            <select name="assessor_id" data-assessor-select>
                                <option value="">Memuat assessor...</option>
                            </select>
                        </label>
                    </div>
                    <div data-form-message></div>
                    <div class="modal-actions">
                        <button class="button button-muted" type="button" data-close-modal="assign-assessor">Batal</button>
                        <button class="button" type="button" data-submit-assign>Tugaskan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
