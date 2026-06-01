@extends('layouts.app')

@section('title', 'Edit Application - G-RPL2')
@section('page', 'application-edit')
@section('authRequired', 'true')
@section('roleRequired', 'applicant')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <aside class="sidebar">
            <p class="eyebrow">Applicant</p>
            <h1 data-application-title>Edit Application</h1>
            <a class="button button-small button-muted" href="/applications/{{ request()->route('id') }}">Back</a>
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
                <div class="form-grid">
                    <button class="button button-small" type="button" data-add-a1-course>
                        + Add A1 Course
                    </button>
                </div>
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Nilai</th>
                                <th>Institusi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody data-a1-courses-body>
                            <tr><td colspan="6">Memuat data...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-content" data-tab-content="a2-learning-experiences" data-rpl-section="a2">
                <div class="form-grid">
                    <button class="button button-small" type="button" data-add-a2-experience>
                        + Add Learning Experience
                    </button>
                </div>
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
                <div class="form-grid">
                    <form data-upload-form class="form-grid">
                        <label>
                            Jenis Dokumen
                            <select name="document_type" required>
                                <option value="">Pilih jenis</option>
                                <option value="transcript">Transkrip Nilai</option>
                                <option value="certificate">Sertifikat</option>
                                <option value="portfolio">Portfolio</option>
                                <option value="other">Lainnya</option>
                            </select>
                        </label>
                        <label>
                            Nama Dokumen
                            <input type="text" name="document_name" placeholder="Contoh: Transkrip Nilai" required>
                        </label>
                        <label>
                            File
                            <input type="file" name="file" accept=".pdf,.jpg,.jpeg,.png" required>
                        </label>
                        <div data-form-message></div>
                        <button class="button" type="button" data-upload-document>
                            Upload
                        </button>
                    </form>
                </div>
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

    <!-- Modal A1 Course -->
    <div class="modal" data-modal="a1-course" hidden>
        <div class="modal-content">
            <div class="modal-header">
                <h3 data-a1-course-modal-title>Add A1 Course</h3>
                <button type="button" class="modal-close" data-close-modal="a1-course">&times;</button>
            </div>
            <form data-a1-course-form class="form-grid">
                <label>
                    Kode Mata Kuliah
                    <input type="text" name="course_code" placeholder="Contoh: IF101" required>
                </label>
                <label>
                    Nama Mata Kuliah
                    <input type="text" name="course_name" placeholder="Contoh: Algoritma dan Pemrograman" required>
                </label>
                <label>
                    SKS
                    <input type="number" name="credits" min="1" max="6" required>
                </label>
                <label>
                    Nilai
                    <select name="grade" required>
                        <option value="">Pilih nilai</option>
                        <option value="A">A</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B">B</option>
                        <option value="B-">B-</option>
                        <option value="C+">C+</option>
                        <option value="C">C</option>
                    </select>
                </label>
                <label>
                    Nama Institusi
                    <input type="text" name="institution_name" placeholder="Contoh: Universitas ABC" required>
                </label>
                <div data-form-message></div>
                <div class="modal-actions">
                    <button type="button" class="button button-muted" data-close-modal="a1-course">Cancel</button>
                    <button type="button" class="button" data-save-a1-course>Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal A2 Learning Experience -->
    <div class="modal" data-modal="a2-experience" hidden>
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Learning Experience</h3>
                <button type="button" class="modal-close" data-close-modal="a2-experience">&times;</button>
            </div>
            <form data-a2-experience-form class="form-grid">
                <label>
                    Judul
                    <input type="text" name="title" placeholder="Contoh: Backend Developer" required>
                </label>
                <label>
                    Tipe Pengalaman
                    <select name="experience_type" required>
                        <option value="">Pilih tipe</option>
                        <option value="work">Pekerjaan</option>
                        <option value="training">Pelatihan</option>
                        <option value="certification">Sertifikasi</option>
                        <option value="project">Proyek</option>
                        <option value="volunteer">Volunteer</option>
                    </select>
                </label>
                <label>
                    Nama Organisasi
                    <input type="text" name="organization_name" placeholder="Contoh: PT Teknologi Indonesia" required>
                </label>
                <label>
                    Tanggal Mulai
                    <input type="date" name="start_date">
                </label>
                <label>
                    Tanggal Selesai
                    <input type="date" name="end_date" data-end-date>
                </label>
                <label>
                    <input type="checkbox" name="is_ongoing" value="1" data-is-ongoing>
                    Masih Berlangsung
                </label>
                <label>
                    Deskripsi
                    <textarea name="description" rows="4" placeholder="Jelaskan pengalaman Anda..." required></textarea>
                </label>
                <div data-form-message></div>
                <div class="modal-actions">
                    <button type="button" class="button button-muted" data-close-modal="a2-experience">Cancel</button>
                    <button type="button" class="button" data-save-a2-experience>Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
