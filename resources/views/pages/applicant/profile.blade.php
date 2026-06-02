@extends('layouts.app')

@section('title', 'Profil Saya - G-RPL2')
@section('page', 'profile')
@section('authRequired', 'true')
@section('roleRequired', 'applicant')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <aside class="sidebar">
            <p class="eyebrow">Applicant</p>
            <h1>Profil Saya</h1>
            <div class="sidebar-actions">
                <a class="button button-small button-muted" href="/dashboard">Dashboard</a>
                <a class="button button-small" href="/profile/edit">Edit Profil</a>
            </div>
        </aside>
        <div class="workspace">
            <div class="workspace-header">
                <div>
                    <p class="eyebrow">Personal Information</p>
                    <h2>Data Profil</h2>
                </div>
                <span class="connection-pill" data-api-status>Connecting</span>
            </div>
            <div data-page-message></div>

            <div class="profile-view" data-profile-card>
                <div class="profile-summary">
                    <div class="profile-avatar" aria-hidden="true">AP</div>
                    <div class="profile-summary-main">
                        <p class="eyebrow">Applicant Profile</p>
                        <h3 data-user-name>Applicant</h3>
                        <div class="profile-summary-meta">
                            <span data-profile-nik>-</span>
                            <span data-profile-phone>-</span>
                        </div>
                    </div>
                    <div class="profile-status-panel">
                        <span class="profile-status-badge" data-profile-completeness-badge>-</span>
                        <p data-profile-completeness-note>
                            Pastikan data profil lengkap sebelum membuat pengajuan RPL.
                        </p>
                    </div>
                </div>

                <div class="profile-section">
                    <div class="profile-section-header">
                        <span class="profile-section-marker"></span>
                        <div>
                            <p class="eyebrow">Data Identitas</p>
                            <h3>Kontak dan alamat</h3>
                        </div>
                    </div>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">NIK</span>
                            <span class="detail-value" data-profile-nik>-</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Nomor Telepon</span>
                            <span class="detail-value" data-profile-phone>-</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Alamat</span>
                            <span class="detail-value" data-profile-address>-</span>
                        </div>
                    </div>
                </div>

                <div class="profile-section">
                    <div class="profile-section-header">
                        <span class="profile-section-marker"></span>
                        <div>
                            <p class="eyebrow">Data Pribadi</p>
                            <h3>Informasi personal</h3>
                        </div>
                    </div>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Tempat Lahir <span class="required">*</span></span>
                            <span class="detail-value" data-profile-birth-place>-</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Tanggal Lahir <span class="required">*</span></span>
                            <span class="detail-value" data-profile-birth-date>-</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Jenis Kelamin <span class="required">*</span></span>
                            <span class="detail-value" data-profile-gender>-</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Status Perkawinan <span class="required">*</span></span>
                            <span class="detail-value" data-profile-marital-status>-</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Kewarganegaraan <span class="required">*</span></span>
                            <span class="detail-value" data-profile-nationality>-</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Kode Pos</span>
                            <span class="detail-value" data-profile-postal-code>-</span>
                        </div>
                    </div>
                </div>

                <div class="profile-section">
                    <div class="profile-section-header">
                        <span class="profile-section-marker"></span>
                        <div>
                            <p class="eyebrow">Riwayat Pendidikan</p>
                            <h3>Pendidikan terakhir</h3>
                        </div>
                    </div>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Pendidikan Terakhir <span class="required">*</span></span>
                            <span class="detail-value" data-profile-last-education>-</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Nama Institusi <span class="required">*</span></span>
                            <span class="detail-value" data-profile-institution-name>-</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Program Studi</span>
                            <span class="detail-value" data-profile-study-program>-</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Tahun Lulus <span class="required">*</span></span>
                            <span class="detail-value" data-profile-graduation-year>-</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
