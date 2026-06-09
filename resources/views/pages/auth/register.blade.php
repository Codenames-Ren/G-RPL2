{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Akun')
@section('page', 'register')

@section('content')

<x-navbar />

<section class="register-page">
    <div class="register-bg register-bg-blue"></div>
    <div class="register-bg register-bg-gold"></div>
    <div class="register-bg register-bg-red"></div>

    <div class="register-container">

        {{-- LEFT CONTENT - LAPTOP --}}
        <div class="register-side">
            <div class="register-side-badge">
                <span></span>
                Pendaftaran RPL Online
            </div>

            <h1>
                Daftar Akun
                <span>Calon Mahasiswa</span>
            </h1>

            <p>
                Buat akun resmi untuk memulai pengajuan Rekognisi Pembelajaran Lampau,
                melengkapi data diri, dan memantau proses pendaftaran secara digital.
            </p>

            <div class="register-side-actions">
                <a href="/" class="register-home-btn">
                    Kembali ke Beranda
                </a>

                <a href="/login" class="register-login-btn-side">
                    Sudah Punya Akun
                </a>
            </div>

            <div class="register-side-features">
                <div class="register-feature-card">
                    <div class="register-feature-icon">1</div>
                    <div>
                        <strong>Isi Data Diri</strong>
                        <p>Masukkan identitas sesuai KTP atau ijazah.</p>
                    </div>
                </div>

                <div class="register-feature-card">
                    <div class="register-feature-icon">2</div>
                    <div>
                        <strong>Buat Akun Portal</strong>
                        <p>Gunakan email aktif dan kata sandi yang aman.</p>
                    </div>
                </div>

                <div class="register-feature-card">
                    <div class="register-feature-icon">3</div>
                    <div>
                        <strong>Lanjutkan Pengajuan</strong>
                        <p>Login untuk melengkapi proses pendaftaran RPL.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- FORM CARD --}}
        <div class="register-card-wrap">
            <div class="register-card">
                <div class="register-card-line"></div>

                <div class="register-logo-area">
                    <div class="register-logo-box">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo G-RPL">
                    </div>
                </div>

                <div class="register-heading">
                    <span>Buat Akun Baru</span>
                    <h2>Pendaftaran Mahasiswa</h2>
                    <p>Lengkapi data berikut untuk memulai proses pengajuan RPL.</p>
                </div>

                <form data-auth-form="register" class="register-form">

                    {{-- NIK --}}
                    <div class="register-field">
                        <label for="nik">Nomor Induk Kependudukan (NIK)</label>

                        <div class="register-input-wrap">
                            <span class="register-input-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10 6h8M10 10h8M10 14h5M6 6h.01M6 10h.01M6 14h.01M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                                </svg>
                            </span>

                            <input
                                type="text"
                                name="nik"
                                id="nik"
                                maxlength="16"
                                inputmode="numeric"
                                placeholder="Contoh: 3171234567890001"
                            >
                        </div>
                    </div>

                    {{-- NAMA --}}
                    <div class="register-field">
                        <label for="name">Nama Lengkap</label>

                        <div class="register-input-wrap">
                            <span class="register-input-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5.121 17.804A9.003 9.003 0 0112 15c2.21 0 4.236.797 5.879 2.121M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </span>

                            <input
                                type="text"
                                name="name"
                                id="name"
                                required
                                placeholder="Nama sesuai KTP/Ijazah"
                            >
                        </div>
                    </div>

                    {{-- EMAIL --}}
                    <div class="register-field">
                        <label for="email">Alamat Email Aktif</label>

                        <div class="register-input-wrap">
                            <span class="register-input-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 12H8m8 0l-2.5-2.5M16 12l-2.5 2.5M4 6.5A2.5 2.5 0 016.5 4h11A2.5 2.5 0 0120 6.5v11a2.5 2.5 0 01-2.5 2.5h-11A2.5 2.5 0 014 17.5v-11z"/>
                                </svg>
                            </span>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                required
                                placeholder="nama@email.com"
                            >
                        </div>
                    </div>

                    {{-- PHONE --}}
                    <div class="register-field">
                        <label for="phone">Nomor HP Aktif</label>

                        <div class="register-input-wrap">
                            <span class="register-input-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.684l1.2 3.6a1 1 0 01-.27 1.05l-2 2a16 16 0 006.5 6.5l2-2a1 1 0 011.05-.27l3.6 1.2a1 1 0 01.69.95V19a2 2 0 01-2 2h-1C10.268 21 3 13.732 3 5z"/>
                                </svg>
                            </span>

                            <input
                                type="text"
                                name="phone"
                                id="phone"
                                inputmode="numeric"
                                placeholder="Contoh: 08123456789"
                            >
                        </div>
                    </div>

                    {{-- ADDRESS --}}
                    <div class="register-field register-field-full">
                        <label for="address">Alamat Lengkap</label>

                        <div class="register-textarea-wrap">
                            <textarea
                                name="address"
                                id="address"
                                rows="2"
                                placeholder="Masukkan alamat lengkap Anda"
                            ></textarea>
                        </div>
                    </div>

                    {{-- PASSWORD GRID --}}
                    <div class="register-password-grid">
                        <div class="register-field">
                            <label for="password">Kata Sandi</label>

                            <div class="register-input-wrap">
                                <span class="register-input-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4"/>
                                    </svg>
                                </span>

                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    minlength="8"
                                    required
                                    placeholder="Minimal 8 karakter"
                                >

                                <button type="button" class="register-password-toggle" data-toggle-password="password" aria-label="Tampilkan kata sandi">
                                    <svg class="eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>

                                    <svg class="eye-close hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.223-3.592m3.31-2.183A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.973 9.973 0 01-4.293 5.032M15 12a3 3 0 00-3-3m0 0a3 3 0 00-3 3m3-3l9 9M3 3l18 18"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="register-field">
                            <label for="password_confirmation">Konfirmasi Sandi</label>

                            <div class="register-input-wrap">
                                <span class="register-input-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </span>

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    minlength="8"
                                    required
                                    placeholder="Ulangi sandi"
                                >

                                <button type="button" class="register-password-toggle" data-toggle-password="password_confirmation" aria-label="Tampilkan konfirmasi sandi">
                                    <svg class="eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>

                                    <svg class="eye-close hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.223-3.592m3.31-2.183A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.973 9.973 0 01-4.293 5.032M15 12a3 3 0 00-3-3m0 0a3 3 0 00-3 3m3-3l9 9M3 3l18 18"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-message register-message" data-form-message aria-live="polite"></div>

                    <button type="submit" data-submit-button class="register-submit-btn">
                        <span>Daftar Sekarang</span>

                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </form>

                <div class="register-login-text">
                    Sudah memiliki akun?
                    <a href="/login">Masuk di sini</a>
                </div>
            </div>
        </div>

    </div>
</section>

<style>
    /*
    |--------------------------------------------------------------------------
    | REGISTER PAGE - LAPTOP / DESKTOP
    |--------------------------------------------------------------------------
    */

    .register-page {
        position: relative;
        min-height: calc(100vh - 71px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 44px 24px 60px;
        overflow: hidden;
        background:
            radial-gradient(circle at 11% 10%, rgba(249, 168, 37, 0.11), transparent 30%),
            radial-gradient(circle at 88% 16%, rgba(21, 101, 192, 0.15), transparent 34%),
            linear-gradient(180deg, #FFFFFF 0%, #F8FBFF 48%, #EEF5FF 100%);
    }

    .register-page::before {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        background-image:
            linear-gradient(rgba(21, 101, 192, 0.055) 1px, transparent 1px),
            linear-gradient(90deg, rgba(21, 101, 192, 0.055) 1px, transparent 1px);
        background-size: 54px 54px;
        mask-image: linear-gradient(to bottom, rgba(0,0,0,0.95), transparent 92%);
    }

    .register-bg {
        position: absolute;
        border-radius: 999px;
        filter: blur(24px);
        pointer-events: none;
    }

    .register-bg-blue {
        width: 430px;
        height: 430px;
        right: -140px;
        top: -130px;
        background: rgba(21, 101, 192, 0.13);
    }

    .register-bg-gold {
        width: 360px;
        height: 360px;
        left: -120px;
        bottom: -120px;
        background: rgba(249, 168, 37, 0.14);
    }

    .register-bg-red {
        width: 220px;
        height: 220px;
        right: 24%;
        bottom: 8%;
        background: rgba(229, 57, 53, 0.07);
    }

    .register-container {
        position: relative;
        z-index: 2;
        width: min(100%, 1180px);
        display: grid;
        grid-template-columns: 1fr 520px;
        gap: 64px;
        align-items: center;
    }

    .register-side {
        max-width: 570px;
    }

    .register-side-badge {
        width: fit-content;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        min-height: 36px;
        padding: 0 16px;
        margin-bottom: 22px;
        border-radius: 999px;
        color: #1565C0;
        background: rgba(255,255,255,0.86);
        border: 1px solid rgba(21, 101, 192, 0.12);
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.06);
        font-size: 12px;
        font-weight: 900;
        letter-spacing: 0.16em;
        text-transform: uppercase;
    }

    .register-side-badge span {
        width: 9px;
        height: 9px;
        border-radius: 999px;
        background: #1565C0;
        box-shadow: 0 0 0 5px rgba(21, 101, 192, 0.11);
    }

    .register-side h1 {
        margin: 0;
        font-family: 'Sora', sans-serif;
        font-size: clamp(44px, 5.2vw, 74px);
        line-height: 1.03;
        font-weight: 900;
        letter-spacing: -0.068em;
        color: #111827;
    }

    .register-side h1 span {
        display: block;
        color: #1565C0;
    }

    .register-side > p {
        max-width: 540px;
        margin: 22px 0 0;
        color: #64748B;
        font-size: 16px;
        line-height: 1.85;
        font-weight: 650;
    }

    .register-side-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 28px;
    }

    .register-home-btn,
    .register-login-btn-side {
        min-height: 44px;
        padding: 0 18px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 13px;
        font-weight: 900;
        transition: all 0.2s ease;
    }

    .register-home-btn {
        color: #FFFFFF;
        background: linear-gradient(135deg, #176BD8, #0D55B8);
        box-shadow: 0 16px 30px rgba(21, 101, 192, 0.22);
    }

    .register-home-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 20px 36px rgba(21, 101, 192, 0.28);
    }

    .register-login-btn-side {
        color: #1565C0;
        background: rgba(255,255,255,0.78);
        border: 1px solid rgba(21, 101, 192, 0.14);
    }

    .register-login-btn-side:hover {
        color: #0D47A1;
        background: #FFFFFF;
    }

    .register-side-features {
        display: grid;
        grid-template-columns: 1fr;
        gap: 14px;
        max-width: 520px;
        margin-top: 34px;
    }

    .register-feature-card {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 16px;
        border-radius: 24px;
        background: rgba(255,255,255,0.78);
        border: 1px solid rgba(21, 101, 192, 0.10);
        box-shadow: 0 16px 38px rgba(15, 23, 42, 0.06);
        backdrop-filter: blur(14px);
    }

    .register-feature-icon {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        display: grid;
        place-items: center;
        border-radius: 16px;
        color: #FFFFFF;
        background: linear-gradient(135deg, #1565C0, #0D47A1);
        font-size: 14px;
        font-weight: 900;
        box-shadow: 0 14px 26px rgba(21, 101, 192, 0.22);
    }

    .register-feature-card strong {
        display: block;
        color: #172033;
        font-size: 14px;
        font-weight: 900;
    }

    .register-feature-card p {
        margin: 4px 0 0;
        color: #64748B;
        font-size: 12px;
        line-height: 1.5;
        font-weight: 650;
    }

    .register-card-wrap {
        width: 100%;
    }

    .register-card {
        position: relative;
        overflow: hidden;
        width: 100%;
        padding: 28px 34px 26px;
        border-radius: 34px;
        background: rgba(255, 255, 255, 0.93);
        border: 1px solid rgba(21, 101, 192, 0.12);
        box-shadow:
            0 28px 80px rgba(15, 23, 42, 0.10),
            inset 0 1px 0 rgba(255,255,255,0.85);
        backdrop-filter: blur(20px);
    }

    .register-card::before {
        content: "";
        position: absolute;
        inset: auto -80px -90px auto;
        width: 210px;
        height: 210px;
        border-radius: 999px;
        background: rgba(21, 101, 192, 0.07);
        pointer-events: none;
    }

    .register-card-line {
        position: absolute;
        inset: 0 0 auto;
        height: 4px;
        background: linear-gradient(90deg, #1565C0, #F9A825, #E53935);
    }

    .register-logo-area {
        position: relative;
        display: flex;
        justify-content: center;
        margin-bottom: 18px;
    }

    .register-logo-box {
        width: 76px;
        height: 76px;
        display: grid;
        place-items: center;
        border-radius: 26px;
        background:
            radial-gradient(circle at 30% 20%, rgba(249, 168, 37, 0.16), transparent 35%),
            linear-gradient(135deg, #FFFFFF, #F8FAFC);
        border: 1px solid rgba(21, 101, 192, 0.12);
        box-shadow:
            0 18px 38px rgba(15, 23, 42, 0.10),
            inset 0 1px 0 rgba(255,255,255,0.90);
    }

    .register-logo-box img {
        width: 52px;
        height: 52px;
        object-fit: contain;
        display: block;
    }

    .register-heading {
        position: relative;
        text-align: center;
        margin-bottom: 22px;
    }

    .register-heading span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 28px;
        padding: 0 12px;
        margin-bottom: 12px;
        border-radius: 999px;
        color: #1565C0;
        background: rgba(21, 101, 192, 0.08);
        font-size: 11px;
        font-weight: 900;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }

    .register-heading h2 {
        margin: 0;
        font-family: 'Sora', sans-serif;
        color: #172033;
        font-size: 25px;
        line-height: 1.2;
        font-weight: 900;
        letter-spacing: -0.04em;
    }

    .register-heading p {
        margin: 9px 0 0;
        color: #64748B;
        font-size: 13px;
        line-height: 1.6;
        font-weight: 650;
    }

    .register-form {
        position: relative;
        margin: 0;
    }

    .register-field {
        margin-bottom: 13px;
    }

    .register-field label {
        display: block;
        margin-bottom: 7px;
        color: #172033;
        font-size: 12px;
        font-weight: 900;
    }

    .register-input-wrap,
    .register-textarea-wrap {
        position: relative;
    }

    .register-input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        width: 18px;
        height: 18px;
        transform: translateY(-50%);
        color: #8A94A6;
        pointer-events: none;
    }

    .register-input-icon svg {
        width: 18px;
        height: 18px;
    }

    .register-input-wrap input {
        width: 100%;
        min-height: 49px;
        padding: 0 46px 0 45px;
        border-radius: 17px;
        border: 1px solid rgba(21, 101, 192, 0.14);
        background: #FFFFFF;
        color: #172033;
        outline: none;
        font-size: 13px;
        font-weight: 650;
        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease,
            background 0.2s ease;
    }

    .register-textarea-wrap textarea {
        width: 100%;
        min-height: 72px;
        padding: 13px 15px;
        border-radius: 17px;
        border: 1px solid rgba(21, 101, 192, 0.14);
        background: #FFFFFF;
        color: #172033;
        outline: none;
        resize: none;
        font-size: 13px;
        font-weight: 650;
        line-height: 1.55;
        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease,
            background 0.2s ease;
    }

    .register-input-wrap input::placeholder,
    .register-textarea-wrap textarea::placeholder {
        color: #9AA3B2;
        font-weight: 500;
    }

    .register-input-wrap input:focus,
    .register-textarea-wrap textarea:focus {
        border-color: #1565C0;
        box-shadow: 0 0 0 5px rgba(21, 101, 192, 0.10);
        background: #FFFFFF;
    }

    .register-password-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .register-password-toggle {
        position: absolute;
        right: 11px;
        top: 50%;
        width: 32px;
        height: 32px;
        transform: translateY(-50%);
        display: grid;
        place-items: center;
        border: 0;
        border-radius: 12px;
        background: transparent;
        color: #8A94A6;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .register-password-toggle:hover {
        color: #1565C0;
        background: rgba(21, 101, 192, 0.08);
    }

    .register-password-toggle svg {
        width: 17px;
        height: 17px;
    }

    .hidden {
        display: none !important;
    }

    .register-message {
        min-height: 18px;
        margin-bottom: 10px;
        color: #D32F2F;
        font-size: 12px;
        font-weight: 700;
        line-height: 1.5;
    }

    .register-submit-btn {
        width: 100%;
        min-height: 50px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        border: 0;
        border-radius: 18px;
        background: linear-gradient(135deg, #176BD8 0%, #0D55B8 100%);
        color: #FFFFFF;
        cursor: pointer;
        font-size: 14px;
        font-weight: 900;
        box-shadow: 0 18px 34px rgba(21, 101, 192, 0.25);
        transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
    }

    .register-submit-btn svg {
        width: 18px;
        height: 18px;
    }

    .register-submit-btn:hover {
        transform: translateY(-1px);
        background: linear-gradient(135deg, #0D55B8 0%, #0A3F8F 100%);
        box-shadow: 0 22px 42px rgba(21, 101, 192, 0.31);
    }

    .register-submit-btn:disabled {
        cursor: not-allowed;
        opacity: 0.7;
        transform: none;
    }

    .register-login-text {
        position: relative;
        margin-top: 18px;
        text-align: center;
        color: #64748B;
        font-size: 13px;
        font-weight: 650;
        line-height: 1.6;
    }

    .register-login-text a {
        color: #1565C0;
        font-weight: 900;
        text-decoration: none;
    }

    .register-login-text a:hover {
        text-decoration: underline;
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER PAGE - TABLET
    |--------------------------------------------------------------------------
    */

    @media (max-width: 1050px) {
        .register-page {
            padding: 36px 20px 50px;
        }

        .register-container {
            grid-template-columns: 1fr;
            gap: 28px;
            max-width: 620px;
        }

        .register-side {
            text-align: center;
            max-width: none;
        }

        .register-side-badge,
        .register-side-actions {
            margin-left: auto;
            margin-right: auto;
            justify-content: center;
        }

        .register-side h1 {
            font-size: clamp(32px, 6vw, 48px);
        }

        .register-side > p {
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            font-size: 14px;
            line-height: 1.7;
        }

        .register-side-features {
            display: none;
        }

        .register-card {
            padding: 28px 30px 26px;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER PAGE - MOBILE / HP
    |--------------------------------------------------------------------------
    */

    @media (max-width: 640px) {
        .register-page {
            min-height: calc(100vh - 71px);
            padding: 18px 14px 26px;
            align-items: flex-start;
            background:
                radial-gradient(circle at 12% 5%, rgba(249, 168, 37, 0.10), transparent 35%),
                radial-gradient(circle at 90% 8%, rgba(21, 101, 192, 0.13), transparent 40%),
                linear-gradient(180deg, #FFFFFF 0%, #F7FAFF 100%);
        }

        .register-page::before {
            background-size: 36px 36px;
            opacity: 0.8;
        }

        .register-bg-blue {
            width: 260px;
            height: 260px;
            right: -120px;
            top: -80px;
        }

        .register-bg-gold {
            width: 230px;
            height: 230px;
            left: -120px;
            bottom: -90px;
        }

        .register-bg-red {
            display: none;
        }

        .register-container {
            width: 100%;
            max-width: 390px;
            display: block;
        }

        .register-side {
            display: none;
        }

        .register-card {
            width: 100%;
            padding: 16px 18px 18px;
            border-radius: 24px;
            box-shadow:
                0 18px 44px rgba(15, 23, 42, 0.09),
                inset 0 1px 0 rgba(255,255,255,0.9);
        }

        .register-card::before {
            display: none;
        }

        .register-card-line {
            height: 3px;
        }

        .register-logo-area {
            margin-bottom: 12px;
        }

        .register-logo-box {
            width: 58px;
            height: 58px;
            border-radius: 19px;
            box-shadow:
                0 12px 26px rgba(15, 23, 42, 0.08),
                inset 0 1px 0 rgba(255,255,255,0.9);
        }

        .register-logo-box img {
            width: 39px;
            height: 39px;
        }

        .register-heading {
            margin-bottom: 15px;
        }

        .register-heading span {
            min-height: 23px;
            padding: 0 10px;
            margin-bottom: 8px;
            font-size: 9px;
            letter-spacing: 0.11em;
        }

        .register-heading h2 {
            font-size: 20px;
            letter-spacing: -0.045em;
        }

        .register-heading p {
            max-width: 270px;
            margin: 7px auto 0;
            font-size: 11.5px;
            line-height: 1.5;
        }

        .register-field {
            margin-bottom: 10px;
        }

        .register-field label {
            margin-bottom: 5px;
            font-size: 10.5px;
        }

        .register-input-icon {
            left: 12px;
            width: 16px;
            height: 16px;
        }

        .register-input-icon svg {
            width: 16px;
            height: 16px;
        }

        .register-input-wrap input {
            min-height: 42px;
            padding: 0 40px 0 37px;
            border-radius: 14px;
            font-size: 12px;
        }

        .register-textarea-wrap textarea {
            min-height: 58px;
            padding: 10px 12px;
            border-radius: 14px;
            font-size: 12px;
            line-height: 1.45;
        }

        .register-password-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .register-password-toggle {
            right: 8px;
            width: 30px;
            height: 30px;
            border-radius: 10px;
        }

        .register-password-toggle svg {
            width: 16px;
            height: 16px;
        }

        .register-message {
            min-height: 16px;
            margin-bottom: 8px;
            font-size: 11px;
        }

        .register-submit-btn {
            min-height: 44px;
            border-radius: 14px;
            font-size: 13px;
            box-shadow: 0 14px 26px rgba(21, 101, 192, 0.22);
        }

        .register-submit-btn svg {
            width: 16px;
            height: 16px;
        }

        .register-login-text {
            margin-top: 13px;
            font-size: 12px;
        }
    }

    @media (max-width: 420px) {
        .register-page {
            padding-left: 12px;
            padding-right: 12px;
        }

        .register-container {
            max-width: 360px;
        }

        .register-card {
            padding: 15px;
            border-radius: 22px;
        }

        .register-logo-box {
            width: 54px;
            height: 54px;
            border-radius: 18px;
        }

        .register-logo-box img {
            width: 36px;
            height: 36px;
        }

        .register-heading h2 {
            font-size: 19px;
        }

        .register-heading p {
            display: none;
        }

        .register-input-wrap input {
            min-height: 40px;
            border-radius: 13px;
        }

        .register-textarea-wrap textarea {
            min-height: 52px;
            border-radius: 13px;
        }

        .register-submit-btn {
            min-height: 42px;
            border-radius: 13px;
        }
    }

    @media (max-width: 360px) {
        .register-card {
            padding: 13px;
        }

        .register-heading {
            margin-bottom: 12px;
        }

        .register-field {
            margin-bottom: 9px;
        }

        .register-login-text {
            font-size: 11px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButtons = document.querySelectorAll('[data-toggle-password]');

        toggleButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const targetId = button.getAttribute('data-toggle-password');
                const input = document.getElementById(targetId);

                if (!input) return;

                const eyeOpen = button.querySelector('.eye-open');
                const eyeClose = button.querySelector('.eye-close');
                const isPassword = input.getAttribute('type') === 'password';

                input.setAttribute('type', isPassword ? 'text' : 'password');

                if (eyeOpen && eyeClose) {
                    eyeOpen.classList.toggle('hidden', isPassword);
                    eyeClose.classList.toggle('hidden', !isPassword);
                }

                button.setAttribute(
                    'aria-label',
                    isPassword ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'
                );
            });
        });
    });
</script>

@endsection