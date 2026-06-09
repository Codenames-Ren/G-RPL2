@extends('layouts.app')

@section('title', 'Edit Application - G-RPL2')
@section('page', 'application-edit')
@section('authRequired', 'true')
@section('roleRequired', 'applicant')

@section('content')
    <section class="app-shell" data-protected-shell hidden>

        {{-- Sidebar Applicant Blade --}}
        <x-applicant-sidebar />

        <div class="workspace application-edit-workspace">

            {{-- HERO --}}
            <div class="application-edit-hero">
                <div class="application-edit-hero-main">
                    <div>
                        <p class="eyebrow application-edit-eyebrow" data-application-status-badge>Status</p>

                        <h2 data-application-number>
                            Application Number
                        </h2>

                        <p class="application-edit-subtitle">
                            Perbarui data pengajuan RPL Anda, lengkapi mata kuliah A1, pengalaman pembelajaran A2,
                            serta dokumen pendukung sebelum pengajuan dikirim.
                        </p>
                    </div>

                    <div class="application-edit-hero-actions">
                        <span class="connection-pill application-edit-status-pill" data-api-status>
                            Connecting
                        </span>

                        <a href="/applications" class="application-edit-back-btn">
                            <span class="application-edit-back-icon">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.42-1.41L7.83 13H20v-2Z"/>
                                </svg>
                            </span>
                            <span>Kembali</span>
                        </a>
                    </div>
                </div>

                <div class="application-edit-stats">
                    <div class="application-edit-stat-card">
                        <span class="application-edit-stat-icon application-edit-stat-blue">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M4 4c0-1.1.9-2 2-2h9l5 5v13c0 1.1-.9 2-2 2H6c-1.1 0-2-.9-2-2V4Zm10 0v4h4l-4-4ZM8 12v2h8v-2H8Zm0 4v2h8v-2H8Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>A1 Courses</p>
                            <strong data-edit-a1-total>—</strong>
                        </div>
                    </div>

                    <div class="application-edit-stat-card">
                        <span class="application-edit-stat-icon application-edit-stat-green">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 2 1 7l11 5 9-4.09V17h2V7L12 2Zm0 12L5 10.82V15c0 2.21 3.13 4 7 4s7-1.79 7-4v-4.18L12 14Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>A2 Experiences</p>
                            <strong data-edit-a2-total>—</strong>
                        </div>
                    </div>

                    <div class="application-edit-stat-card">
                        <span class="application-edit-stat-icon application-edit-stat-yellow">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6Zm-1 7V3.5L18.5 9H13Zm-5 4h8v2H8v-2Zm0 4h8v2H8v-2Zm0-8h3v2H8V9Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Documents</p>
                            <strong data-edit-document-total>—</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div data-page-message></div>

            {{-- CONTROL PANEL --}}
            <div class="application-edit-control-card">
                <div class="application-edit-control-head">
                    <div>
                        <h3>Edit Data Pengajuan</h3>
                        <p>Pilih kategori data yang ingin diperbarui untuk melengkapi pengajuan RPL Anda.</p>
                    </div>

                    <div class="application-edit-control-actions">
                        <button class="application-edit-action-btn" type="button" data-add-a1-course data-rpl-section="a1">
                            <span class="application-edit-action-icon">+</span>
                            <span>Add A1 Course</span>
                        </button>

                        <button class="application-edit-action-btn application-edit-action-alt" type="button" data-add-a2-experience data-rpl-section="a2">
                            <span class="application-edit-action-icon">+</span>
                            <span>Add Learning Experience</span>
                        </button>
                    </div>
                </div>

                <div class="application-edit-tabs tabs" data-tabs>
                    <button class="application-edit-tab tab-button active" data-tab-button="a1-courses" data-rpl-section="a1">
                        <span class="application-edit-tab-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M18 2H7c-1.66 0-3 1.34-3 3v14c0 1.66 1.34 3 3 3h11c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2Zm0 16H7c-.55 0-1 .45-1 1s.45 1 1 1h11v-2Zm0-2H7c-.35 0-.69.06-1 .17V5c0-.55.45-1 1-1h11v12Z"/>
                            </svg>
                        </span>
                        <span>A1 Courses</span>
                    </button>

                    <button class="application-edit-tab tab-button" data-tab-button="a2-learning-experiences" data-rpl-section="a2">
                        <span class="application-edit-tab-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3 1 9l11 6 9-4.91V17h2V9L12 3Zm0 14L5 13.18V16c0 2 4.66 4 7 4s7-2 7-4v-2.82L12 17Z"/>
                            </svg>
                        </span>
                        <span>A2 Learning Experiences</span>
                    </button>

                    <button class="application-edit-tab tab-button" data-tab-button="documents">
                        <span class="application-edit-tab-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6Zm-1 7V3.5L18.5 9H13Z"/>
                            </svg>
                        </span>
                        <span>Documents</span>
                    </button>
                </div>
            </div>

            {{-- A1 --}}
            <div class="application-edit-tab-content tab-content active" data-tab-content="a1-courses" data-rpl-section="a1">
                <div class="application-edit-section-card">
                    <div class="application-edit-section-head">
                        <div>
                            <h3>Data A1 Courses</h3>
                            <p>Perbarui daftar mata kuliah formal yang ingin diajukan untuk proses rekognisi.</p>
                        </div>

                        <span class="application-edit-soft-badge">
                            A1 Course List
                        </span>
                    </div>

                    <div class="application-edit-table-scroll">
                        <table class="data-table application-edit-table">
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
                                <tr>
                                    <td colspan="6">
                                        <div class="application-edit-loading-state">
                                            <span class="application-edit-loader"></span>
                                            <strong>Memuat data A1...</strong>
                                            <p>Sedang mengambil data mata kuliah.</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- A2 --}}
            <div class="application-edit-tab-content tab-content" data-tab-content="a2-learning-experiences" data-rpl-section="a2">
                <div class="application-edit-section-card">
                    <div class="application-edit-section-head">
                        <div>
                            <h3>Data A2 Learning Experiences</h3>
                            <p>Perbarui pengalaman kerja, pelatihan, sertifikasi, proyek, atau pengalaman nonformal.</p>
                        </div>

                        <span class="application-edit-soft-badge">
                            A2 Experience List
                        </span>
                    </div>

                    <div class="application-edit-table-scroll">
                        <table class="data-table application-edit-table">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Tipe</th>
                                    <th>Organisasi</th>
                                    <th>Periode</th>
                                </tr>
                            </thead>

                            <tbody data-a2-experiences-body>
                                <tr>
                                    <td colspan="4">
                                        <div class="application-edit-loading-state">
                                            <span class="application-edit-loader"></span>
                                            <strong>Memuat data A2...</strong>
                                            <p>Sedang mengambil data pengalaman pembelajaran.</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- DOCUMENTS --}}
            <div class="application-edit-tab-content tab-content" data-tab-content="documents">
                <div class="application-edit-document-layout">
                    <div class="application-edit-upload-card">
                        <div class="application-edit-upload-info">
                            <p class="eyebrow application-edit-eyebrow">Document Upload</p>
                            <h3>Upload Dokumen Pendukung</h3>
                            <p>
                                Tambahkan dokumen seperti transkrip, sertifikat, portofolio, atau dokumen pendukung lain
                                sebelum pengajuan dikirim.
                            </p>
                        </div>

                        <form data-upload-form class="application-edit-upload-form">
                            <label>
                                <span>Jenis Dokumen</span>
                                <select name="document_type" required>
                                    <option value="">Pilih jenis</option>
                                    <option value="transcript">Transkrip Nilai</option>
                                    <option value="certificate">Sertifikat</option>
                                    <option value="portfolio">Portfolio</option>
                                    <option value="other">Lainnya</option>
                                </select>
                            </label>

                            <label>
                                <span>Nama Dokumen</span>
                                <input type="text" name="document_name" placeholder="Contoh: Transkrip Nilai" required>
                            </label>

                            <div class="application-edit-file-field">
                                <span>File</span>

                                <input
                                    id="application-edit-file-input"
                                    class="application-edit-native-file"
                                    type="file"
                                    name="file"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    required
                                >

                                <label for="application-edit-file-input" class="application-edit-file-trigger">
                                    <span class="application-edit-file-icon">
                                        <svg viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6Zm-1 7V3.5L18.5 9H13ZM8 13h8v2H8v-2Zm0 4h8v2H8v-2Z"/>
                                        </svg>
                                    </span>
                                    <span data-edit-file-name>Pilih file dokumen</span>
                                </label>
                            </div>

                            <div class="application-edit-form-message" data-form-message></div>

                            <button class="application-edit-submit-btn" type="button" data-upload-document>
                                Upload Document
                            </button>
                        </form>
                    </div>

                    <div class="application-edit-section-card">
                        <div class="application-edit-section-head">
                            <div>
                                <h3>Daftar Dokumen</h3>
                                <p>Dokumen pendukung yang sudah diunggah untuk pengajuan ini.</p>
                            </div>

                            <span class="application-edit-soft-badge">
                                Document List
                            </span>
                        </div>

                        <div class="application-edit-table-scroll">
                            <table class="data-table application-edit-table application-edit-document-table">
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
                                    <tr>
                                        <td colspan="5">
                                            <div class="application-edit-loading-state">
                                                <span class="application-edit-loader"></span>
                                                <strong>Memuat dokumen...</strong>
                                                <p>Sedang mengambil data dokumen.</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="application-edit-submit-section form-actions" data-submit-section hidden>
                <button class="application-edit-final-submit button button-primary" type="button" data-submit-application>
                    Submit Application
                </button>
            </div>
        </div>
    </section>

    {{-- Modal A1 Course --}}
    <div class="modal application-edit-modal" data-modal="a1-course" hidden>
        <div class="modal-content application-edit-modal-content">
            <div class="modal-header application-edit-modal-header">
                <div>
                    <p class="eyebrow application-edit-eyebrow">A1 Course</p>
                    <h3 data-a1-course-modal-title>Add A1 Course</h3>
                </div>

                <button type="button" class="modal-close application-edit-modal-close" data-close-modal="a1-course">
                    &times;
                </button>
            </div>

            <form data-a1-course-form class="application-edit-modal-form">
                <label>
                    <span>Kode Mata Kuliah</span>
                    <input type="text" name="course_code" placeholder="Contoh: IF101" required>
                </label>

                <label>
                    <span>Nama Mata Kuliah</span>
                    <input type="text" name="course_name" placeholder="Contoh: Algoritma dan Pemrograman" required>
                </label>

                <label>
                    <span>SKS</span>
                    <input type="number" name="credits" min="1" max="6" required>
                </label>

                <label>
                    <span>Nilai</span>
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

                <label class="application-edit-full-field">
                    <span>Nama Institusi</span>
                    <input type="text" name="institution_name" placeholder="Contoh: Universitas ABC" required>
                </label>

                <div data-form-message></div>

                <div class="modal-actions application-edit-modal-actions">
                    <button type="button" class="application-edit-muted-btn" data-close-modal="a1-course">
                        Cancel
                    </button>

                    <button type="button" class="application-edit-submit-btn" data-save-a1-course>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal A2 Learning Experience --}}
    <div class="modal application-edit-modal" data-modal="a2-experience" hidden>
        <div class="modal-content application-edit-modal-content">
            <div class="modal-header application-edit-modal-header">
                <div>
                    <p class="eyebrow application-edit-eyebrow">A2 Experience</p>
                    <h3>Add Learning Experience</h3>
                </div>

                <button type="button" class="modal-close application-edit-modal-close" data-close-modal="a2-experience">
                    &times;
                </button>
            </div>

            <form data-a2-experience-form class="application-edit-modal-form">
                <label>
                    <span>Judul</span>
                    <input type="text" name="title" placeholder="Contoh: Backend Developer" required>
                </label>

                <label>
                    <span>Tipe Pengalaman</span>
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
                    <span>Nama Organisasi</span>
                    <input type="text" name="organization_name" placeholder="Contoh: PT Teknologi Indonesia" required>
                </label>

                <label>
                    <span>Tanggal Mulai</span>
                    <input type="date" name="start_date">
                </label>

                <label>
                    <span>Tanggal Selesai</span>
                    <input type="date" name="end_date" data-end-date>
                </label>

                <label class="application-edit-checkbox-label">
                    <input type="checkbox" name="is_ongoing" value="1" data-is-ongoing>
                    <span>Masih Berlangsung</span>
                </label>

                <label class="application-edit-full-field">
                    <span>Deskripsi</span>
                    <textarea name="description" rows="4" placeholder="Jelaskan pengalaman Anda..." required></textarea>
                </label>

                <div data-form-message></div>

                <div class="modal-actions application-edit-modal-actions">
                    <button type="button" class="application-edit-muted-btn" data-close-modal="a2-experience">
                        Cancel
                    </button>

                    <button type="button" class="application-edit-submit-btn" data-save-a2-experience>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .application-edit-workspace,
        .application-edit-workspace * {
            box-sizing: border-box;
        }

        .application-edit-workspace {
            display: grid;
            gap: 18px;
            min-width: 0;
        }

        .application-edit-hero,
        .application-edit-control-card,
        .application-edit-section-card,
        .application-edit-upload-card {
            border: 1px solid rgba(203, 213, 225, 0.78);
            background: rgba(255, 255, 255, 0.94);
            box-shadow: 0 18px 55px rgba(15, 23, 42, 0.07);
        }

        .application-edit-hero {
            position: relative;
            overflow: hidden;
            padding: 24px;
            border-radius: 30px;
            background:
                radial-gradient(circle at 8% 0%, rgba(249, 168, 37, 0.15), transparent 28%),
                radial-gradient(circle at 92% 0%, rgba(21, 101, 192, 0.16), transparent 32%),
                linear-gradient(135deg, #ffffff 0%, #f8fafc 55%, #eef6ff 100%);
        }

        .application-edit-hero::before {
            content: "";
            position: absolute;
            inset: 0 0 auto;
            height: 5px;
            background: linear-gradient(90deg, #1565C0, #F9A825, #E53935);
        }

        .application-edit-hero-main {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 22px;
        }

        .application-edit-eyebrow {
            margin-bottom: 8px;
            color: #1565C0;
            font-weight: 950;
        }

        .application-edit-hero h2 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, sans-serif;
            font-size: clamp(1.8rem, 3vw, 2.6rem);
            line-height: 1.05;
            font-weight: 950;
            letter-spacing: -0.07em;
        }

        .application-edit-subtitle {
            max-width: 780px;
            margin: 12px 0 0;
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.7;
            font-weight: 650;
        }

        .application-edit-hero-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            flex-shrink: 0;
        }

        .application-edit-status-pill,
        .connection-pill {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 0 16px;
            border-radius: 999px;
            color: #1d4ed8;
            background: #dbeafe;
            border: 1px solid #93c5fd;
            font-size: 0.82rem;
            font-weight: 950;
            white-space: nowrap;
        }

        .application-edit-status-pill::before,
        .connection-pill::before {
            content: "";
            width: 9px;
            height: 9px;
            border-radius: 999px;
            background: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.14);
        }

        .connection-pill.is-connected {
            color: #14532d;
            background: #dcfce7;
            border-color: #86efac;
        }

        .connection-pill.is-connected::before {
            background: #16a34a;
        }

        .connection-pill.is-error,
        .connection-pill.is-disconnected {
            color: #991b1b;
            background: #fee2e2;
            border-color: #fca5a5;
        }

        .connection-pill.is-error::before,
        .connection-pill.is-disconnected::before {
            background: #dc2626;
        }

        .application-edit-back-btn,
        .application-edit-action-btn,
        .application-edit-submit-btn {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 0 16px;
            border: 0;
            border-radius: 999px;
            color: #ffffff;
            background: linear-gradient(135deg, #1565C0, #0f4fa3);
            box-shadow: 0 15px 26px rgba(21, 101, 192, 0.23);
            font-family: inherit;
            font-size: 0.86rem;
            line-height: 1;
            font-weight: 950;
            text-decoration: none;
            cursor: pointer;
            white-space: nowrap;
            transition: 0.2s ease;
        }

        .application-edit-back-btn:hover,
        .application-edit-action-btn:hover,
        .application-edit-submit-btn:hover {
            transform: translateY(-2px);
            filter: brightness(1.04);
            box-shadow: 0 18px 34px rgba(21, 101, 192, 0.28);
        }

        .application-edit-action-alt {
            color: #0f172a;
            background: linear-gradient(135deg, #F9A825, #ffd966);
            box-shadow: 0 15px 26px rgba(249, 168, 37, 0.2);
        }

        .application-edit-action-icon,
        .application-edit-back-icon {
            width: 22px;
            height: 22px;
            display: grid;
            place-items: center;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.2);
            font-weight: 950;
        }

        .application-edit-back-icon svg {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }

        .application-edit-stats {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-top: 22px;
        }

        .application-edit-stat-card {
            display: flex;
            align-items: center;
            gap: 13px;
            min-width: 0;
            padding: 16px;
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(226, 232, 240, 0.9);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.05);
        }

        .application-edit-stat-icon {
            width: 44px;
            height: 44px;
            flex: 0 0 44px;
            display: grid;
            place-items: center;
            border-radius: 16px;
        }

        .application-edit-stat-icon svg {
            width: 22px;
            height: 22px;
            fill: currentColor;
        }

        .application-edit-stat-blue {
            color: #1565C0;
            background: rgba(21, 101, 192, 0.1);
        }

        .application-edit-stat-green {
            color: #16a34a;
            background: rgba(22, 163, 74, 0.1);
        }

        .application-edit-stat-yellow {
            color: #b77905;
            background: rgba(249, 168, 37, 0.15);
        }

        .application-edit-stat-card p {
            margin: 0 0 5px;
            color: #64748b;
            font-size: 0.74rem;
            font-weight: 950;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .application-edit-stat-card strong {
            color: #0f172a;
            font-size: 1.28rem;
            font-weight: 950;
        }

        .application-edit-control-card {
            padding: 20px;
            border-radius: 28px;
        }

        .application-edit-control-head,
        .application-edit-section-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
        }

        .application-edit-control-head h3,
        .application-edit-section-head h3,
        .application-edit-upload-info h3 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, sans-serif;
            font-size: 1.15rem;
            line-height: 1.2;
            font-weight: 950;
            letter-spacing: -0.045em;
        }

        .application-edit-control-head p,
        .application-edit-section-head p,
        .application-edit-upload-info p {
            margin: 7px 0 0;
            color: #64748b;
            font-size: 0.88rem;
            line-height: 1.55;
            font-weight: 700;
        }

        .application-edit-control-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }

        .application-edit-tabs {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            margin-top: 18px;
            padding: 0;
            border: 0;
            background: transparent;
        }

        .application-edit-tab {
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 0 14px;
            border-radius: 17px;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
            box-shadow: 0 9px 22px rgba(15, 23, 42, 0.035);
            font-size: 0.88rem;
            font-weight: 950;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .application-edit-tab:hover {
            color: #1565C0;
            border-color: rgba(21, 101, 192, 0.35);
            transform: translateY(-1px);
            box-shadow: 0 13px 26px rgba(21, 101, 192, 0.08);
        }

        .application-edit-tab.active {
            color: #ffffff;
            background: linear-gradient(135deg, #1565C0, #0f4fa3);
            border-color: rgba(21, 101, 192, 0.25);
            box-shadow: 0 15px 26px rgba(21, 101, 192, 0.2);
        }

        .application-edit-tab-icon {
            width: 30px;
            height: 30px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            color: currentColor;
            background: rgba(21, 101, 192, 0.08);
        }

        .application-edit-tab.active .application-edit-tab-icon {
            background: rgba(255, 255, 255, 0.18);
        }

        .application-edit-tab-icon svg {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }

        .application-edit-tab-content {
            display: none;
        }

        .application-edit-tab-content.active {
            display: block;
        }

        .application-edit-section-card {
            overflow: hidden;
            border-radius: 28px;
        }

        .application-edit-section-head {
            padding: 20px;
            border-bottom: 1px solid rgba(226, 232, 240, 0.9);
            background: linear-gradient(135deg, #ffffff, #f8fafc);
        }

        .application-edit-soft-badge {
            min-height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 13px;
            border-radius: 999px;
            color: #1565C0;
            background: rgba(21, 101, 192, 0.08);
            border: 1px solid rgba(21, 101, 192, 0.12);
            font-size: 0.75rem;
            font-weight: 950;
            white-space: nowrap;
        }

        .application-edit-table-scroll {
            width: 100%;
            overflow-x: auto;
        }

        .application-edit-table-scroll::-webkit-scrollbar {
            height: 8px;
        }

        .application-edit-table-scroll::-webkit-scrollbar-track {
            background: #eef2f7;
            border-radius: 999px;
        }

        .application-edit-table-scroll::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 999px;
        }

        .application-edit-table-scroll::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }

        .application-edit-table {
            width: 100%;
            min-width: 760px;
            border-collapse: separate;
            border-spacing: 0;
        }

        .application-edit-document-table {
            min-width: 760px;
        }

        .application-edit-table thead th {
            padding: 15px 16px;
            color: #334155;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.72rem;
            font-weight: 950;
            letter-spacing: 0.08em;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .application-edit-table tbody td {
            padding: 17px 16px;
            color: #334155;
            background: #ffffff;
            border-bottom: 1px solid #edf2f7;
            font-size: 0.88rem;
            font-weight: 750;
            vertical-align: middle;
        }

        .application-edit-table tbody tr:hover td {
            background: #fbfdff;
        }

        .application-edit-table td[colspan] {
            padding: 38px 20px;
            text-align: center;
        }

        .application-edit-table td a,
        .application-edit-table td button,
        .application-edit-table [data-download-document],
        .applications-action-btn,
        .application-action-btn,
        .applications-detail-btn,
        .application-detail-btn {
            min-height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 13px;
            border-radius: 999px;
            color: #1565C0;
            background: rgba(21, 101, 192, 0.08);
            border: 1px solid rgba(21, 101, 192, 0.14);
            box-shadow: 0 8px 18px rgba(21, 101, 192, 0.06);
            font-family: inherit;
            font-size: 0.76rem;
            line-height: 1;
            font-weight: 950;
            text-decoration: none;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .application-edit-table td a:hover,
        .application-edit-table td button:hover,
        .application-edit-table [data-download-document]:hover,
        .applications-action-btn:hover,
        .application-action-btn:hover,
        .applications-detail-btn:hover,
        .application-detail-btn:hover {
            color: #ffffff;
            background: linear-gradient(135deg, #1565C0, #0f4fa3);
            border-color: rgba(21, 101, 192, 0.28);
            transform: translateY(-1px);
            box-shadow: 0 12px 24px rgba(21, 101, 192, 0.18);
        }

        .applications-edit-btn,
        .application-edit-btn,
        [data-edit-a1-course] {
            color: #0f172a !important;
            background: linear-gradient(135deg, #F9A825, #ffd966) !important;
            border-color: rgba(249, 168, 37, 0.28) !important;
            box-shadow: 0 10px 22px rgba(249, 168, 37, 0.14) !important;
        }

        .applications-edit-btn:hover,
        .application-edit-btn:hover,
        [data-edit-a1-course]:hover {
            color: #0f172a !important;
            transform: translateY(-1px);
            box-shadow: 0 14px 28px rgba(249, 168, 37, 0.22) !important;
        }

        .application-edit-loading-state {
            display: grid;
            place-items: center;
            gap: 8px;
            color: #64748b;
        }

        .application-edit-loading-state strong {
            color: #0f172a;
            font-size: 0.95rem;
            font-weight: 950;
        }

        .application-edit-loading-state p {
            margin: 0;
            color: #64748b;
            font-size: 0.84rem;
            font-weight: 700;
        }

        .application-edit-loader {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            border: 4px solid rgba(21, 101, 192, 0.12);
            border-top-color: #1565C0;
            animation: application-edit-spin 0.8s linear infinite;
        }

        @keyframes application-edit-spin {
            to {
                transform: rotate(360deg);
            }
        }

        .application-edit-document-layout {
            display: grid;
            gap: 18px;
        }

        .application-edit-upload-card {
            display: grid;
            grid-template-columns: minmax(240px, 0.75fr) minmax(0, 1.45fr);
            gap: 22px;
            align-items: center;
            padding: 20px;
            border-radius: 28px;
        }

        .application-edit-upload-info {
            min-width: 0;
        }

        .application-edit-upload-form,
        .application-edit-modal-form {
            display: grid;
            gap: 14px;
            align-items: end;
        }

        .application-edit-upload-form {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .application-edit-modal-form {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .application-edit-upload-form label,
        .application-edit-modal-form label,
        .application-edit-file-field {
            display: grid;
            gap: 8px;
            min-width: 0;
        }

        .application-edit-upload-form label span,
        .application-edit-modal-form label span,
        .application-edit-file-field > span {
            color: #475569;
            font-size: 0.72rem;
            font-weight: 950;
            letter-spacing: 0.07em;
            text-transform: uppercase;
        }

        .application-edit-upload-form input,
        .application-edit-upload-form select,
        .application-edit-upload-form textarea,
        .application-edit-modal-form input,
        .application-edit-modal-form select,
        .application-edit-modal-form textarea {
            width: 100%;
            min-height: 46px;
            padding: 0 14px;
            border: 1px solid #cbd5e1;
            border-radius: 16px;
            background: #ffffff;
            color: #0f172a;
            font: inherit;
            font-size: 0.9rem;
            font-weight: 750;
            outline: none;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.035);
            transition: 0.2s ease;
        }

        .application-edit-upload-form input:hover,
        .application-edit-upload-form select:hover,
        .application-edit-upload-form textarea:hover,
        .application-edit-modal-form input:hover,
        .application-edit-modal-form select:hover,
        .application-edit-modal-form textarea:hover {
            border-color: rgba(21, 101, 192, 0.45);
            box-shadow: 0 12px 28px rgba(21, 101, 192, 0.08);
        }

        .application-edit-upload-form input:focus,
        .application-edit-upload-form select:focus,
        .application-edit-upload-form textarea:focus,
        .application-edit-modal-form input:focus,
        .application-edit-modal-form select:focus,
        .application-edit-modal-form textarea:focus {
            border-color: rgba(21, 101, 192, 0.62);
            box-shadow: 0 0 0 4px rgba(21, 101, 192, 0.1);
        }

        .application-edit-file-field {
            position: relative;
        }

        .application-edit-native-file {
            position: absolute;
            width: 1px;
            height: 1px;
            opacity: 0;
            pointer-events: none;
        }

        .application-edit-file-trigger {
            min-height: 46px;
            display: flex !important;
            align-items: center;
            gap: 10px;
            padding: 0 14px;
            border: 1px solid #cbd5e1;
            border-radius: 16px;
            background: #ffffff;
            color: #0f172a;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.035);
            cursor: pointer;
            transition: 0.2s ease;
        }

        .application-edit-file-trigger:hover {
            border-color: rgba(21, 101, 192, 0.55);
            background: #f8fbff;
            transform: translateY(-1px);
            box-shadow: 0 14px 30px rgba(21, 101, 192, 0.12);
        }

        .application-edit-file-trigger span:last-child {
            min-width: 0;
            overflow: hidden;
            color: #334155;
            font-size: 0.86rem;
            font-weight: 850;
            letter-spacing: 0;
            text-overflow: ellipsis;
            text-transform: none;
            white-space: nowrap;
        }

        .application-edit-file-icon {
            width: 26px;
            height: 26px;
            flex: 0 0 26px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            color: #1565C0;
            background: rgba(21, 101, 192, 0.1);
        }

        .application-edit-file-icon svg {
            width: 15px;
            height: 15px;
            fill: currentColor;
        }

        .application-edit-form-message,
        .application-edit-modal-form > [data-form-message] {
            grid-column: 1 / -1;
            min-height: 0;
        }

        .application-edit-submit-btn {
            width: fit-content;
            min-width: 170px;
        }

        .application-edit-submit-section {
            display: flex;
            justify-content: flex-end;
        }

        .application-edit-final-submit {
            min-width: 190px;
        }

        .application-edit-modal,
        .modal.application-edit-modal {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: grid;
            place-items: center;
            padding: 22px;
            background: rgba(15, 23, 42, 0.62);
            backdrop-filter: blur(7px);
        }

        .application-edit-modal[hidden],
        .modal.application-edit-modal[hidden] {
            display: none !important;
        }

        .application-edit-modal-content,
        .modal-content.application-edit-modal-content {
            width: min(760px, calc(100vw - 44px));
            max-height: calc(100vh - 44px);
            overflow: auto;
            padding: 0;
            border-radius: 28px;
            border: 1px solid rgba(226, 232, 240, 0.96);
            background:
                radial-gradient(circle at 8% 0%, rgba(249, 168, 37, 0.13), transparent 30%),
                radial-gradient(circle at 92% 0%, rgba(21, 101, 192, 0.12), transparent 34%),
                #ffffff;
            box-shadow: 0 28px 90px rgba(15, 23, 42, 0.25);
        }

        .application-edit-modal-header {
            min-height: 96px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            padding: 24px 24px 18px;
            border-bottom: 1px solid #e2e8f0;
        }

        .application-edit-modal-header h3 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, sans-serif;
            font-size: 1.34rem;
            font-weight: 950;
            letter-spacing: -0.045em;
        }

        .application-edit-modal-close {
            width: 42px;
            height: 42px;
            flex: 0 0 42px;
            display: grid;
            place-items: center;
            border-radius: 15px;
            color: #334155;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            font-size: 1.7rem;
            line-height: 1;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .application-edit-modal-close:hover {
            color: #dc2626;
            background: #fff1f2;
            border-color: #fecdd3;
            transform: rotate(6deg) scale(1.03);
        }

        .application-edit-modal-form {
            padding: 22px 24px 24px;
        }

        .application-edit-full-field {
            grid-column: 1 / -1;
        }

        .application-edit-checkbox-label {
            min-height: 46px;
            display: flex !important;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 16px;
            background: #ffffff;
            color: #334155;
            font-size: 0.86rem;
            font-weight: 850;
        }

        .application-edit-checkbox-label input {
            width: 18px;
            min-height: 18px;
            height: 18px;
            box-shadow: none;
        }

        .application-edit-muted-btn {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 18px;
            border-radius: 999px;
            color: #334155;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            font-family: inherit;
            font-size: 0.9rem;
            font-weight: 950;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .application-edit-muted-btn:hover {
            border-color: rgba(21, 101, 192, 0.45);
            color: #1565C0;
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(15, 23, 42, 0.08);
        }

        .application-edit-modal-actions {
            grid-column: 1 / -1;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 8px;
            padding-top: 14px;
            border-top: 1px solid #edf2f7;
        }

        @media (max-width: 1200px) {
            .application-edit-hero-main,
            .application-edit-control-head,
            .application-edit-section-head,
            .application-edit-upload-card {
                grid-template-columns: 1fr;
                flex-direction: column;
            }

            .application-edit-upload-card {
                display: grid;
                align-items: stretch;
            }

            .application-edit-control-actions,
            .application-edit-hero-actions {
                width: 100%;
                justify-content: flex-start;
                flex-wrap: wrap;
            }

            .application-edit-upload-form {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 900px) {
            .application-edit-stats,
            .application-edit-tabs,
            .application-edit-upload-form,
            .application-edit-modal-form {
                grid-template-columns: 1fr;
            }

            .application-edit-action-btn,
            .application-edit-back-btn,
            .application-edit-status-pill,
            .application-edit-submit-btn {
                width: 100%;
            }

            .application-edit-control-actions,
            .application-edit-hero-actions {
                display: grid;
                grid-template-columns: 1fr;
            }

            .application-edit-modal-actions {
                display: grid;
                grid-template-columns: 1fr;
            }

            .application-edit-modal-actions .application-edit-muted-btn,
            .application-edit-modal-actions .application-edit-submit-btn {
                width: 100%;
            }
        }

        @media (max-width: 640px) {
            .application-edit-hero,
            .application-edit-control-card,
            .application-edit-section-card,
            .application-edit-upload-card {
                border-radius: 24px;
            }

            .application-edit-hero,
            .application-edit-control-card,
            .application-edit-upload-card {
                padding: 16px;
            }

            .application-edit-hero h2 {
                font-size: 1.55rem;
            }

            .application-edit-subtitle {
                font-size: 0.84rem;
                line-height: 1.62;
            }

            .application-edit-section-head {
                display: grid;
                padding: 16px;
            }

            .application-edit-soft-badge {
                width: fit-content;
            }

            .application-edit-table {
                min-width: 680px;
            }

            .application-edit-modal,
            .modal.application-edit-modal {
                padding: 12px;
            }

            .application-edit-modal-content,
            .modal-content.application-edit-modal-content {
                width: calc(100vw - 24px);
                max-height: calc(100vh - 24px);
                border-radius: 24px;
            }

            .application-edit-modal-header {
                min-height: auto;
                padding: 18px 18px 14px;
            }

            .application-edit-modal-form {
                padding: 18px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const a1Body = document.querySelector('[data-a1-courses-body]');
            const a2Body = document.querySelector('[data-a2-experiences-body]');
            const documentBody = document.querySelector('[data-documents-body]');
            const a1Target = document.querySelector('[data-edit-a1-total]');
            const a2Target = document.querySelector('[data-edit-a2-total]');
            const documentTarget = document.querySelector('[data-edit-document-total]');
            const apiStatus = document.querySelector('[data-api-status]');
            const fileInput = document.querySelector('#application-edit-file-input');
            const fileName = document.querySelector('[data-edit-file-name]');

            if (fileInput && fileName) {
                fileInput.addEventListener('change', function () {
                    fileName.textContent = this.files?.[0]?.name || 'Pilih file dokumen';
                });
            }

            function normalizeText(value) {
                return String(value || '').trim().toLowerCase();
            }

            function countRows(body) {
                if (!body) return 0;

                return Array.from(body.querySelectorAll('tr')).filter(function (row) {
                    return !row.querySelector('td[colspan]');
                }).length;
            }

            function refreshStats() {
                if (a1Target) a1Target.textContent = countRows(a1Body) || '—';
                if (a2Target) a2Target.textContent = countRows(a2Body) || '—';
                if (documentTarget) documentTarget.textContent = countRows(documentBody) || '—';
            }

            function observeTable(body) {
                if (!body) return;

                const observer = new MutationObserver(refreshStats);

                observer.observe(body, {
                    childList: true,
                    subtree: true,
                    characterData: true
                });
            }

            function refreshApiStatusClass() {
                if (!apiStatus) return;

                const text = normalizeText(apiStatus.textContent);

                apiStatus.classList.remove(
                    'is-connected',
                    'is-connecting',
                    'is-error',
                    'is-disconnected'
                );

                if (text.includes('connected') && !text.includes('disconnect')) {
                    apiStatus.classList.add('is-connected');
                    return;
                }

                if (text.includes('connecting') || text.includes('loading')) {
                    apiStatus.classList.add('is-connecting');
                    return;
                }

                if (
                    text.includes('error') ||
                    text.includes('failed') ||
                    text.includes('offline') ||
                    text.includes('disconnected')
                ) {
                    apiStatus.classList.add('is-error');
                    return;
                }

                apiStatus.classList.add('is-connecting');
            }

            observeTable(a1Body);
            observeTable(a2Body);
            observeTable(documentBody);
            refreshStats();

            if (apiStatus) {
                const statusObserver = new MutationObserver(refreshApiStatusClass);

                statusObserver.observe(apiStatus, {
                    childList: true,
                    subtree: true,
                    characterData: true
                });

                refreshApiStatusClass();
            }
        });
    </script>
@endsection