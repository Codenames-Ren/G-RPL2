@extends('layouts.app')

@section('title', 'Edit Profil - G-RPL2')
@section('page', 'profile-edit')
@section('authRequired', 'true')
@section('roleRequired', 'applicant')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <aside class="sidebar">
            <p class="eyebrow">Applicant</p>
            <h1>Edit Profil</h1>
            <div class="sidebar-actions">
                <a class="button button-small button-muted" href="/profile">Batal</a>
            </div>
        </aside>
        <div class="workspace">
            <div class="workspace-header">
                <div>
                    <p class="eyebrow">Personal Information</p>
                    <h2>Lengkapi Data Profil</h2>
                </div>
                <span class="connection-pill" data-api-status>Connecting</span>
            </div>
            <div data-page-message></div>

            <form class="profile-form" data-profile-form>
                <div class="profile-form-intro">
                    <div>
                        <p class="eyebrow">Applicant Profile</p>
                        <h3>Data utama applicant</h3>
                    </div>
                    <span class="profile-form-pill">Field bertanda * wajib</span>
                </div>

                <div class="profile-form-grid">
                    <div class="profile-form-section">
                        <div class="profile-section-header">
                            <span class="profile-section-marker"></span>
                            <div>
                                <p class="eyebrow">Data Identitas</p>
                                <h3>Kontak dan alamat</h3>
                            </div>
                        </div>
                        <div class="form-grid">
                            <label>
                                Nomor Telepon
                                <input type="tel" name="phone" data-profile-phone placeholder="Contoh: 081234567890">
                            </label>
                            <label>
                                Alamat
                                <textarea name="address" data-profile-address rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                            </label>
                        </div>
                    </div>

                    <div class="profile-form-section">
                        <div class="profile-section-header">
                            <span class="profile-section-marker"></span>
                            <div>
                                <p class="eyebrow">Data Pribadi</p>
                                <h3>Informasi personal</h3>
                            </div>
                        </div>
                        <div class="form-grid">
                            <label>
                                Tempat Lahir <span class="required">*</span>
                                <input type="text" name="birth_place" data-profile-birth-place placeholder="Contoh: Jakarta" required>
                            </label>
                            <label>
                                Tanggal Lahir <span class="required">*</span>
                                <input type="date" name="birth_date" data-profile-birth-date required>
                            </label>
                            <label>
                                Jenis Kelamin <span class="required">*</span>
                                <select name="gender" data-profile-gender required>
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="male">Laki-laki</option>
                                    <option value="female">Perempuan</option>
                                </select>
                            </label>
                            <label>
                                Status Perkawinan <span class="required">*</span>
                                <select name="marital_status" data-profile-marital-status required>
                                    <option value="">Pilih status</option>
                                    <option value="single">Belum Kawin</option>
                                    <option value="married">Kawin</option>
                                    <option value="divorced">Cerai</option>
                                </select>
                            </label>
                            <label>
                                Kewarganegaraan <span class="required">*</span>
                                <input type="text" name="nationality" data-profile-nationality placeholder="Contoh: Indonesia" required>
                            </label>
                            <label>
                                Kode Pos
                                <input type="text" name="postal_code" data-profile-postal-code placeholder="Contoh: 15117">
                            </label>
                        </div>
                    </div>

                    <div class="profile-form-section">
                        <div class="profile-section-header">
                            <span class="profile-section-marker"></span>
                            <div>
                                <p class="eyebrow">Riwayat Pendidikan</p>
                                <h3>Pendidikan terakhir</h3>
                            </div>
                        </div>
                        <div class="form-grid">
                            <label>
                                Pendidikan Terakhir <span class="required">*</span>
                                <select name="last_education" data-profile-last-education required>
                                    <option value="">Pilih pendidikan terakhir</option>
                                    <option value="SMA">SMA / SMK / Sederajat</option>
                                    <option value="D3">Diploma 3 (D3)</option>
                                    <option value="D4">Diploma 4 (D4) / Sarjana Terapan</option>
                                    <option value="S1">Sarjana (S1)</option>
                                    <option value="S2">Magister (S2)</option>
                                    <option value="S3">Doktor (S3)</option>
                                </select>
                            </label>
                            <label>
                                Nama Institusi <span class="required">*</span>
                                <input type="text" name="institution_name" data-profile-institution-name placeholder="Contoh: SMAN 1 Tangerang" required>
                            </label>
                            <label>
                                Program Studi
                                <input type="text" name="study_program" data-profile-study-program placeholder="Contoh: Teknik Informatika">
                            </label>
                            <label>
                                Tahun Lulus <span class="required">*</span>
                                <input type="number" name="graduation_year" data-profile-graduation-year min="1950" max="{{ date('Y') }}" placeholder="Contoh: 2018" required>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="profile-form-actions">
                    <div data-form-message></div>
                    <button class="button" type="submit" data-save-profile>
                        Simpan Profil
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
