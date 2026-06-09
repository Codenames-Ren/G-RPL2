{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('title', 'Masuk')
@section('page', 'login')

@section('content')

<x-navbar />

<section class="login-page">
    <div class="login-bg login-bg-blue"></div>
    <div class="login-bg login-bg-gold"></div>
    <div class="login-bg login-bg-red"></div>

    <div class="login-container">

        {{-- LEFT CONTENT - LAPTOP --}}
        <div class="login-side">
            <div class="login-side-badge">
                <span></span>
                Portal Resmi G-RPL
            </div>

            <h1>
                Masuk ke Portal
                <span>Pengajuan RPL</span>
            </h1>

            <p>
                Lanjutkan proses pendaftaran, pantau status pengajuan, dan kelola
                kebutuhan Rekognisi Pembelajaran Lampau dalam satu portal digital.
            </p>

            <div class="login-side-actions">
                <a href="/" class="login-home-btn">
                    Kembali ke Beranda
                </a>

                <a href="/register" class="login-register-btn-side">
                    Buat Akun
                </a>
            </div>

            <div class="login-side-features">
                <div class="login-feature-card">
                    <div class="login-feature-icon">1</div>
                    <div>
                        <strong>Akses Akun</strong>
                        <p>Masuk menggunakan email yang telah terdaftar.</p>
                    </div>
                </div>

                <div class="login-feature-card">
                    <div class="login-feature-icon">2</div>
                    <div>
                        <strong>Pantau Proses</strong>
                        <p>Lihat perkembangan pengajuan RPL secara online.</p>
                    </div>
                </div>

                <div class="login-feature-card">
                    <div class="login-feature-icon">3</div>
                    <div>
                        <strong>Portal Terintegrasi</strong>
                        <p>Data pendaftaran dan proses tersimpan dalam satu sistem.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- FORM CARD --}}
        <div class="login-card-wrap">
            <div class="login-card">
                <div class="login-card-line"></div>

                <div class="login-logo-area">
                    <div class="login-logo-box">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo G-RPL">
                    </div>
                </div>

                <div class="login-heading">
                    <span>Selamat Datang</span>
                    <h2>Masuk ke Sistem</h2>
                    <p>Gunakan akun Anda untuk melanjutkan proses RPL.</p>
                </div>

                <form data-auth-form="login" class="login-form">

                    {{-- EMAIL --}}
                    <div class="login-field">
                        <label for="email">Alamat Email</label>

                        <div class="login-input-wrap">
                            <span class="login-input-icon">
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
                                autofocus
                                placeholder="contoh@email.com"
                            >
                        </div>
                    </div>

                    {{-- PASSWORD --}}
                    <div class="login-field">
                        <label for="password">Kata Sandi</label>

                        <div class="login-input-wrap">
                            <span class="login-input-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4"/>
                                </svg>
                            </span>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                required
                                placeholder="Masukkan kata sandi"
                            >

                            <button type="button" class="login-password-toggle" id="togglePassword" aria-label="Tampilkan kata sandi">
                                <svg id="eyeOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>

                                <svg id="eyeClose" class="hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.223-3.592m3.31-2.183A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.973 9.973 0 01-4.293 5.032M15 12a3 3 0 00-3-3m0 0a3 3 0 00-3 3m3-3l9 9M3 3l18 18"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="login-options">
                        <label class="login-remember">
                            <input type="checkbox" name="remember">
                            <span>Ingat saya</span>
                        </label>

                        <a href="#">Lupa sandi?</a>
                    </div>

                    <div class="form-message login-message" data-form-message aria-live="polite"></div>

                    <button type="submit" data-submit-button class="login-submit-btn">
                        <span>Masuk ke Sistem</span>

                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </form>

                <div class="login-register-text">
                    Belum punya akun?
                    <a href="/register">Daftar di sini</a>
                </div>

                <div class="login-info-box">
                    <div class="login-info-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z"/>
                        </svg>
                    </div>

                    <p>
                        Asesor dan Pengelola dapat masuk menggunakan kredensial dari Admin Sistem.
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>

<style>
    /*
    |--------------------------------------------------------------------------
    | LOGIN PAGE - LAPTOP / DESKTOP
    |--------------------------------------------------------------------------
    */

    .login-page {
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

    .login-page::before {
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

    .login-bg {
        position: absolute;
        border-radius: 999px;
        filter: blur(24px);
        pointer-events: none;
    }

    .login-bg-blue {
        width: 430px;
        height: 430px;
        right: -140px;
        top: -130px;
        background: rgba(21, 101, 192, 0.13);
    }

    .login-bg-gold {
        width: 360px;
        height: 360px;
        left: -120px;
        bottom: -120px;
        background: rgba(249, 168, 37, 0.14);
    }

    .login-bg-red {
        width: 220px;
        height: 220px;
        right: 24%;
        bottom: 8%;
        background: rgba(229, 57, 53, 0.07);
    }

    .login-container {
        position: relative;
        z-index: 2;
        width: min(100%, 1140px);
        display: grid;
        grid-template-columns: 1fr 458px;
        gap: 64px;
        align-items: center;
    }

    .login-side {
        max-width: 570px;
    }

    .login-side-badge {
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

    .login-side-badge span {
        width: 9px;
        height: 9px;
        border-radius: 999px;
        background: #1565C0;
        box-shadow: 0 0 0 5px rgba(21, 101, 192, 0.11);
    }

    .login-side h1 {
        margin: 0;
        font-family: 'Sora', sans-serif;
        font-size: clamp(44px, 5.2vw, 74px);
        line-height: 1.03;
        font-weight: 900;
        letter-spacing: -0.068em;
        color: #111827;
    }

    .login-side h1 span {
        display: block;
        color: #1565C0;
    }

    .login-side > p {
        max-width: 540px;
        margin: 22px 0 0;
        color: #64748B;
        font-size: 16px;
        line-height: 1.85;
        font-weight: 650;
    }

    .login-side-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 28px;
    }

    .login-home-btn,
    .login-register-btn-side {
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

    .login-home-btn {
        color: #FFFFFF;
        background: linear-gradient(135deg, #176BD8, #0D55B8);
        box-shadow: 0 16px 30px rgba(21, 101, 192, 0.22);
    }

    .login-home-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 20px 36px rgba(21, 101, 192, 0.28);
    }

    .login-register-btn-side {
        color: #1565C0;
        background: rgba(255,255,255,0.78);
        border: 1px solid rgba(21, 101, 192, 0.14);
    }

    .login-register-btn-side:hover {
        color: #0D47A1;
        background: #FFFFFF;
    }

    .login-side-features {
        display: grid;
        grid-template-columns: 1fr;
        gap: 14px;
        max-width: 520px;
        margin-top: 34px;
    }

    .login-feature-card {
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

    .login-feature-icon {
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

    .login-feature-card strong {
        display: block;
        color: #172033;
        font-size: 14px;
        font-weight: 900;
    }

    .login-feature-card p {
        margin: 4px 0 0;
        color: #64748B;
        font-size: 12px;
        line-height: 1.5;
        font-weight: 650;
    }

    .login-card-wrap {
        width: 100%;
    }

    .login-card {
        position: relative;
        overflow: hidden;
        width: 100%;
        padding: 30px 34px 28px;
        border-radius: 34px;
        background: rgba(255, 255, 255, 0.93);
        border: 1px solid rgba(21, 101, 192, 0.12);
        box-shadow:
            0 28px 80px rgba(15, 23, 42, 0.10),
            inset 0 1px 0 rgba(255,255,255,0.85);
        backdrop-filter: blur(20px);
    }

    .login-card::before {
        content: "";
        position: absolute;
        inset: auto -80px -90px auto;
        width: 210px;
        height: 210px;
        border-radius: 999px;
        background: rgba(21, 101, 192, 0.07);
        pointer-events: none;
    }

    .login-card-line {
        position: absolute;
        inset: 0 0 auto;
        height: 4px;
        background: linear-gradient(90deg, #1565C0, #F9A825, #E53935);
    }

    .login-logo-area {
        position: relative;
        display: flex;
        justify-content: center;
        margin-bottom: 22px;
    }

    .login-logo-box {
        width: 82px;
        height: 82px;
        display: grid;
        place-items: center;
        border-radius: 28px;
        background:
            radial-gradient(circle at 30% 20%, rgba(249, 168, 37, 0.16), transparent 35%),
            linear-gradient(135deg, #FFFFFF, #F8FAFC);
        border: 1px solid rgba(21, 101, 192, 0.12);
        box-shadow:
            0 18px 38px rgba(15, 23, 42, 0.10),
            inset 0 1px 0 rgba(255,255,255,0.90);
    }

    .login-logo-box img {
        width: 56px;
        height: 56px;
        object-fit: contain;
        display: block;
    }

    .login-heading {
        position: relative;
        text-align: center;
        margin-bottom: 24px;
    }

    .login-heading span {
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

    .login-heading h2 {
        margin: 0;
        font-family: 'Sora', sans-serif;
        color: #172033;
        font-size: 26px;
        line-height: 1.2;
        font-weight: 900;
        letter-spacing: -0.04em;
    }

    .login-heading p {
        margin: 10px 0 0;
        color: #64748B;
        font-size: 14px;
        line-height: 1.6;
        font-weight: 650;
    }

    .login-form {
        position: relative;
        margin: 0;
    }

    .login-field {
        margin-bottom: 15px;
    }

    .login-field label {
        display: block;
        margin-bottom: 8px;
        color: #172033;
        font-size: 12px;
        font-weight: 900;
    }

    .login-input-wrap {
        position: relative;
    }

    .login-input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        width: 19px;
        height: 19px;
        transform: translateY(-50%);
        color: #8A94A6;
        pointer-events: none;
    }

    .login-input-icon svg {
        width: 19px;
        height: 19px;
    }

    .login-input-wrap input {
        width: 100%;
        min-height: 52px;
        padding: 0 48px 0 46px;
        border-radius: 18px;
        border: 1px solid rgba(21, 101, 192, 0.14);
        background: #FFFFFF;
        color: #172033;
        outline: none;
        font-size: 14px;
        font-weight: 650;
        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease,
            background 0.2s ease;
    }

    .login-input-wrap input::placeholder {
        color: #9AA3B2;
        font-weight: 500;
    }

    .login-input-wrap input:focus {
        border-color: #1565C0;
        box-shadow: 0 0 0 5px rgba(21, 101, 192, 0.10);
        background: #FFFFFF;
    }

    .login-password-toggle {
        position: absolute;
        right: 13px;
        top: 50%;
        width: 34px;
        height: 34px;
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

    .login-password-toggle:hover {
        color: #1565C0;
        background: rgba(21, 101, 192, 0.08);
    }

    .login-password-toggle svg {
        width: 19px;
        height: 19px;
    }

    .hidden {
        display: none !important;
    }

    .login-options {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin: 4px 0 18px;
    }

    .login-remember {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        color: #64748B;
        font-size: 13px;
        font-weight: 750;
        cursor: pointer;
        user-select: none;
    }

    .login-remember input {
        width: 16px;
        height: 16px;
        accent-color: #1565C0;
    }

    .login-options a {
        color: #1565C0;
        font-size: 13px;
        font-weight: 900;
        text-decoration: none;
    }

    .login-options a:hover {
        text-decoration: underline;
    }

    .login-message {
        min-height: 20px;
        margin-bottom: 12px;
        color: #D32F2F;
        font-size: 12px;
        font-weight: 700;
        line-height: 1.5;
    }

    .login-submit-btn {
        width: 100%;
        min-height: 52px;
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

    .login-submit-btn svg {
        width: 18px;
        height: 18px;
    }

    .login-submit-btn:hover {
        transform: translateY(-1px);
        background: linear-gradient(135deg, #0D55B8 0%, #0A3F8F 100%);
        box-shadow: 0 22px 42px rgba(21, 101, 192, 0.31);
    }

    .login-submit-btn:disabled {
        cursor: not-allowed;
        opacity: 0.7;
        transform: none;
    }

    .login-register-text {
        position: relative;
        margin-top: 22px;
        text-align: center;
        color: #64748B;
        font-size: 13px;
        font-weight: 650;
        line-height: 1.6;
    }

    .login-register-text a {
        color: #1565C0;
        font-weight: 900;
        text-decoration: none;
    }

    .login-register-text a:hover {
        text-decoration: underline;
    }

    .login-info-box {
        position: relative;
        display: flex;
        gap: 12px;
        margin-top: 20px;
        padding: 16px;
        border-radius: 22px;
        background: linear-gradient(135deg, rgba(21, 101, 192, 0.08), rgba(249, 168, 37, 0.06));
        border: 1px solid rgba(21, 101, 192, 0.10);
    }

    .login-info-icon {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        display: grid;
        place-items: center;
        border-radius: 13px;
        color: #1565C0;
        background: #FFFFFF;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.06);
    }

    .login-info-icon svg {
        width: 19px;
        height: 19px;
    }

    .login-info-box p {
        margin: 0;
        color: #64748B;
        font-size: 12px;
        line-height: 1.65;
        font-weight: 650;
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN PAGE - TABLET
    |--------------------------------------------------------------------------
    */

    @media (max-width: 1050px) {
        .login-page {
            padding: 36px 20px 50px;
        }

        .login-container {
            grid-template-columns: 1fr;
            gap: 28px;
            max-width: 590px;
        }

        .login-side {
            text-align: center;
            max-width: none;
        }

        .login-side-badge,
        .login-side-actions {
            margin-left: auto;
            margin-right: auto;
            justify-content: center;
        }

        .login-side h1 {
            font-size: clamp(32px, 6vw, 48px);
        }

        .login-side > p {
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            font-size: 14px;
            line-height: 1.7;
        }

        .login-side-features {
            display: none;
        }

        .login-card {
            padding: 28px 30px 26px;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN PAGE - MOBILE / HP
    |--------------------------------------------------------------------------
    | Ini dipisah supaya tampilan HP tidak ikut ukuran laptop.
    */

    @media (max-width: 640px) {
        .login-page {
            min-height: calc(100vh - 71px);
            padding: 18px 14px 26px;
            align-items: flex-start;
            background:
                radial-gradient(circle at 12% 5%, rgba(249, 168, 37, 0.10), transparent 35%),
                radial-gradient(circle at 90% 8%, rgba(21, 101, 192, 0.13), transparent 40%),
                linear-gradient(180deg, #FFFFFF 0%, #F7FAFF 100%);
        }

        .login-page::before {
            background-size: 36px 36px;
            opacity: 0.8;
        }

        .login-bg-blue {
            width: 260px;
            height: 260px;
            right: -120px;
            top: -80px;
        }

        .login-bg-gold {
            width: 230px;
            height: 230px;
            left: -120px;
            bottom: -90px;
        }

        .login-bg-red {
            display: none;
        }

        .login-container {
            width: 100%;
            max-width: 390px;
            display: block;
        }

        .login-side {
            display: none;
        }

        .login-card-wrap {
            width: 100%;
        }

        .login-card {
            width: 100%;
            padding: 18px 18px 18px;
            border-radius: 24px;
            box-shadow:
                0 18px 44px rgba(15, 23, 42, 0.09),
                inset 0 1px 0 rgba(255,255,255,0.9);
        }

        .login-card::before {
            display: none;
        }

        .login-card-line {
            height: 3px;
        }

        .login-logo-area {
            margin-bottom: 14px;
        }

        .login-logo-box {
            width: 62px;
            height: 62px;
            border-radius: 20px;
            box-shadow:
                0 12px 26px rgba(15, 23, 42, 0.08),
                inset 0 1px 0 rgba(255,255,255,0.9);
        }

        .login-logo-box img {
            width: 42px;
            height: 42px;
        }

        .login-heading {
            margin-bottom: 18px;
        }

        .login-heading span {
            min-height: 24px;
            padding: 0 10px;
            margin-bottom: 9px;
            font-size: 9px;
            letter-spacing: 0.11em;
        }

        .login-heading h2 {
            font-size: 22px;
            letter-spacing: -0.045em;
        }

        .login-heading p {
            max-width: 250px;
            margin: 8px auto 0;
            font-size: 12px;
            line-height: 1.55;
        }

        .login-field {
            margin-bottom: 12px;
        }

        .login-field label {
            margin-bottom: 6px;
            font-size: 11px;
        }

        .login-input-icon {
            left: 13px;
            width: 17px;
            height: 17px;
        }

        .login-input-icon svg {
            width: 17px;
            height: 17px;
        }

        .login-input-wrap input {
            min-height: 46px;
            padding: 0 43px 0 40px;
            border-radius: 15px;
            font-size: 13px;
        }

        .login-password-toggle {
            right: 9px;
            width: 32px;
            height: 32px;
            border-radius: 11px;
        }

        .login-password-toggle svg {
            width: 17px;
            height: 17px;
        }

        .login-options {
            margin: 2px 0 12px;
            gap: 8px;
        }

        .login-remember {
            gap: 8px;
            font-size: 12px;
        }

        .login-remember input {
            width: 15px;
            height: 15px;
        }

        .login-options a {
            font-size: 12px;
        }

        .login-message {
            min-height: 16px;
            margin-bottom: 8px;
            font-size: 11px;
        }

        .login-submit-btn {
            min-height: 46px;
            border-radius: 15px;
            font-size: 13px;
            box-shadow: 0 14px 26px rgba(21, 101, 192, 0.22);
        }

        .login-submit-btn svg {
            width: 16px;
            height: 16px;
        }

        .login-register-text {
            margin-top: 14px;
            font-size: 12px;
        }

        .login-info-box {
            margin-top: 14px;
            padding: 12px;
            gap: 10px;
            border-radius: 18px;
        }

        .login-info-icon {
            width: 30px;
            height: 30px;
            border-radius: 11px;
        }

        .login-info-icon svg {
            width: 16px;
            height: 16px;
        }

        .login-info-box p {
            font-size: 10.5px;
            line-height: 1.55;
        }
    }

    @media (max-width: 420px) {
        .login-page {
            padding-left: 12px;
            padding-right: 12px;
        }

        .login-container {
            max-width: 360px;
        }

        .login-card {
            padding: 16px;
            border-radius: 22px;
        }

        .login-logo-box {
            width: 58px;
            height: 58px;
            border-radius: 18px;
        }

        .login-logo-box img {
            width: 39px;
            height: 39px;
        }

        .login-heading h2 {
            font-size: 20px;
        }

        .login-heading p {
            font-size: 11.5px;
        }

        .login-input-wrap input {
            min-height: 44px;
            border-radius: 14px;
        }

        .login-submit-btn {
            min-height: 44px;
            border-radius: 14px;
        }

        .login-info-box {
            display: none;
        }
    }

    @media (max-width: 360px) {
        .login-card {
            padding: 14px;
        }

        .login-heading {
            margin-bottom: 14px;
        }

        .login-heading h2 {
            font-size: 19px;
        }

        .login-heading p {
            display: none;
        }

        .login-field {
            margin-bottom: 10px;
        }

        .login-options {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClose = document.getElementById('eyeClose');

        if (togglePassword && passwordInput && eyeOpen && eyeClose) {
            togglePassword.addEventListener('click', function () {
                const isPassword = passwordInput.getAttribute('type') === 'password';

                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');

                eyeOpen.classList.toggle('hidden', isPassword);
                eyeClose.classList.toggle('hidden', !isPassword);

                togglePassword.setAttribute(
                    'aria-label',
                    isPassword ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'
                );
            });
        }
    });
</script>

@endsection