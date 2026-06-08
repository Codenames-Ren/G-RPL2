<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - RPL IBSG</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            background-color: #f0f4f8;
            color: #333;
        }

        .wrapper {
            width: 100%;
            padding: 40px 16px;
            background-color: #f0f4f8;
        }

        .container {
            max-width: 560px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        /* ── HEADER ── */
        .email-header {
            background-color: #1a3a6b;
            padding: 28px 32px;
            text-align: center;
        }

        .email-header .logo-row {
            display: inline-block;
            text-align: center;
        }

        .email-header img {
            width: 52px;
            height: auto;
            display: block;
            margin: 0 auto 10px;
        }

        .email-header .kampus-name {
            font-size: 13px;
            font-weight: bold;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            line-height: 1.3;
        }

        .email-header .kampus-sub {
            font-size: 16px;
            font-weight: bold;
            color: #e8b84b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header-divider {
            border: none;
            border-top: 2px solid #e8b84b;
            margin: 14px 0 0;
        }

        /* ── BODY ── */
        .email-body {
            padding: 32px 36px;
        }

        .email-body .greeting {
            font-size: 16px;
            font-weight: bold;
            color: #1a3a6b;
            margin-bottom: 12px;
        }

        .email-body p {
            margin-bottom: 12px;
            color: #444;
            font-size: 14px;
        }

        /* ── BUTTON ── */
        .btn-wrap {
            text-align: center;
            margin: 28px 0;
        }

        .btn-verify {
            display: inline-block;
            background-color: #1a3a6b;
            color: #ffffff !important;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            padding: 12px 36px;
            border-radius: 5px;
            letter-spacing: 0.5px;
        }

        /* ── URL FALLBACK ── */
        .url-fallback {
            background-color: #f4f7fb;
            border: 1px solid #d0daea;
            border-radius: 4px;
            padding: 10px 14px;
            margin: 16px 0;
            font-size: 11px;
            color: #555;
            word-break: break-all;
        }

        .url-fallback span {
            display: block;
            font-weight: bold;
            color: #1a3a6b;
            margin-bottom: 4px;
            font-size: 11px;
        }

        /* ── DIVIDER ── */
        .divider {
            border: none;
            border-top: 1px solid #e8edf3;
            margin: 20px 0;
        }

        .note {
            font-size: 12px;
            color: #888;
        }

        /* ── FOOTER ── */
        .email-footer {
            background-color: #f4f7fb;
            border-top: 3px solid #1a3a6b;
            padding: 18px 36px;
            text-align: center;
        }

        .email-footer p {
            font-size: 11px;
            color: #888;
            margin-bottom: 4px;
        }

        .email-footer .footer-kampus {
            font-size: 11px;
            font-weight: bold;
            color: #1a3a6b;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container">

        {{-- HEADER --}}
        <div class="email-header">
            <div class="logo-row">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Global">                <div class="kampus-name">Institut Teknologi &amp; Bisnis</div>
                <div class="kampus-sub">Bina Sarana Global</div>
            </div>
            <hr class="header-divider">
        </div>

        {{-- BODY --}}
        <div class="email-body">
            <div class="greeting">Halo, {{ $notifiable->name }}!</div>

            <p>Terima kasih telah mendaftar di sistem <strong>Rekognisi Pembelajaran Lampau (RPL)</strong> Institut Teknologi &amp; Bisnis Bina Sarana Global.</p>

            <p>Silakan klik tombol di bawah ini untuk memverifikasi alamat email Anda dan mengaktifkan akun.</p>

            <div class="btn-wrap">
                <a href="{{ $verificationUrl }}" class="btn-verify">Verifikasi Email Sekarang</a>
            </div>

            <hr class="divider">

            <p class="note">Apabila tombol di atas tidak berfungsi, salin dan tempel tautan berikut ke browser Anda:</p>
            <div class="url-fallback">
                <span>Tautan Verifikasi:</span>
                {{ $verificationUrl }}
            </div>

            <hr class="divider">

            <p class="note">Tautan ini akan kedaluwarsa dalam <strong>60 menit</strong>. Apabila Anda tidak merasa melakukan pendaftaran, abaikan email ini.</p>
        </div>

        {{-- FOOTER --}}
        <div class="email-footer">
            <p class="footer-kampus">Institut Teknologi &amp; Bisnis Bina Sarana Global</p>
            <p>Jl. Aria Santika No. 43A, Margasari, Karawaci, Kota Tangerang, 15113</p>
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
        </div>

    </div>
</div>
</body>
</html>