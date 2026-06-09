<footer class="grpl-footer">
    <div class="grpl-footer-glow grpl-footer-glow-one"></div>
    <div class="grpl-footer-glow grpl-footer-glow-two"></div>

    <div class="grpl-footer-container">

        <div class="grpl-footer-main">

            {{-- BRAND --}}
            <div class="grpl-footer-brand">
                <a href="/" class="grpl-footer-logo-box">
                    <span class="grpl-footer-logo-wrap">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo G-RPL">
                    </span>

                    <span>
                        <strong>G-RPL</strong>
                        <small>Portal Resmi</small>
                    </span>
                </a>

                <p>
                    Mewujudkan pengakuan akademik atas pengalaman nyata melalui
                    sistem digital RPL yang modern, mudah, dan terintegrasi.
                </p>

                <div class="grpl-footer-badges">
                    <span>Portal Digital</span>
                    <span>RPL Online</span>
                    <span>TI24PSE3</span>
                </div>
            </div>

            {{-- LINK --}}
            <div class="grpl-footer-links">
                <div class="grpl-footer-col">
                    <h4>Navigasi</h4>
                    <a href="/#beranda">Beranda</a>
                    <a href="/#tentang">Tentang RPL</a>
                    <a href="/#keunggulan">Keunggulan</a>
                    <a href="/#alur">Alur Pendaftaran</a>
                </div>

                <div class="grpl-footer-col">
                    <h4>Informasi</h4>
                    <a href="/#pengumuman">Pengumuman</a>
                    <a href="/#persyaratan">Persyaratan</a>
                    <a href="/#faq">FAQ</a>
                    <a href="/register">Daftar Akun</a>
                </div>

                <div class="grpl-footer-col grpl-footer-contact">
                    <h4>Bantuan</h4>

                    <div class="grpl-footer-contact-card">
                        <span class="grpl-footer-contact-icon">?</span>

                        <div>
                            <strong>Butuh bantuan?</strong>
                            <p>Hubungi admin untuk informasi pendaftaran dan proses RPL.</p>
                        </div>
                    </div>

                    <a href="/login" class="grpl-footer-login-link">
                        Masuk ke Portal
                    </a>
                </div>
            </div>
        </div>

        <div class="grpl-footer-divider"></div>

        <div class="grpl-footer-bottom">
            <p>
                © {{ date('Y') }} G-RPL Global Institute. Project by Bayu Sukma, Muhammad Raffi Arosyid, Dias Mayri (Project 2 - TI24PSE3).
            </p>

            <div class="grpl-footer-bottom-links">
                <a href="/#persyaratan">Persyaratan</a>
                <span></span>
                <a href="/#faq">Bantuan</a>
            </div>
        </div>

    </div>
</footer>

<style>
    .grpl-footer {
        position: relative;
        overflow: hidden;
        padding: 72px 28px 30px;
        background:
            radial-gradient(circle at 10% 8%, rgba(21, 101, 192, 0.26), transparent 34%),
            radial-gradient(circle at 88% 12%, rgba(249, 168, 37, 0.13), transparent 30%),
            linear-gradient(135deg, #101728 0%, #151A2E 48%, #0E1324 100%);
        color: #FFFFFF;
    }

    .grpl-footer::before {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        background-image:
            linear-gradient(rgba(255,255,255,0.035) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.035) 1px, transparent 1px);
        background-size: 48px 48px;
        mask-image: linear-gradient(to bottom, rgba(0,0,0,0.88), transparent 95%);
    }

    .grpl-footer::after {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        height: 4px;
        background: linear-gradient(90deg, #1565C0, #F9A825, #E53935);
    }

    .grpl-footer-glow {
        position: absolute;
        border-radius: 999px;
        filter: blur(24px);
        pointer-events: none;
        opacity: 0.48;
    }

    .grpl-footer-glow-one {
        width: 230px;
        height: 230px;
        left: -100px;
        top: -90px;
        background: rgba(21, 101, 192, 0.28);
    }

    .grpl-footer-glow-two {
        width: 190px;
        height: 190px;
        right: -80px;
        bottom: 10px;
        background: rgba(249, 168, 37, 0.12);
    }

    .grpl-footer-container {
        position: relative;
        z-index: 2;
        width: min(100%, 1180px);
        margin: 0 auto;
    }

    .grpl-footer-main {
        display: grid;
        grid-template-columns: 0.95fr 1.45fr;
        gap: 70px;
        align-items: start;
    }

    .grpl-footer-brand {
        max-width: 410px;
    }

    .grpl-footer-logo-box {
        display: inline-flex;
        align-items: center;
        gap: 14px;
        color: #FFFFFF;
        text-decoration: none;
        margin-bottom: 20px;
    }

    .grpl-footer-logo-wrap {
        width: 54px;
        height: 54px;
        border-radius: 18px;
        display: grid;
        place-items: center;
        background:
            radial-gradient(circle at 30% 20%, rgba(249, 168, 37, 0.16), transparent 35%),
            linear-gradient(135deg, #FFFFFF, #F5F8FC);
        border: 1px solid rgba(255,255,255,0.18);
        box-shadow: 0 18px 36px rgba(0,0,0,0.22);
    }

    .grpl-footer-logo-wrap img {
        width: 37px;
        height: 37px;
        object-fit: contain;
        display: block;
    }

    .grpl-footer-logo-box strong {
        display: block;
        font-family: 'Sora', sans-serif;
        font-size: 25px;
        line-height: 1;
        font-weight: 800;
        letter-spacing: -0.04em;
        color: #FFFFFF;
    }

    .grpl-footer-logo-box small {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-top: 7px;
        font-size: 10px;
        line-height: 1;
        font-weight: 800;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.58);
    }

    .grpl-footer-logo-box small::before {
        content: "";
        width: 7px;
        height: 7px;
        border-radius: 999px;
        background: #F9A825;
        box-shadow: 0 0 0 4px rgba(249, 168, 37, 0.14);
    }

    .grpl-footer-brand p {
        margin: 0;
        color: rgba(255,255,255,0.60);
        font-size: 14px;
        line-height: 1.8;
    }

    .grpl-footer-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 9px;
        margin-top: 22px;
    }

    .grpl-footer-badges span {
        display: inline-flex;
        align-items: center;
        min-height: 32px;
        padding: 0 12px;
        border-radius: 999px;
        color: rgba(255,255,255,0.82);
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.09);
        font-size: 11px;
        font-weight: 800;
    }

    .grpl-footer-links {
        display: grid;
        grid-template-columns: 1fr 1fr 1.25fr;
        gap: 34px;
        align-items: start;
    }

    .grpl-footer-col h4 {
        margin: 0 0 18px;
        color: #FFFFFF;
        font-size: 14px;
        font-weight: 800;
        letter-spacing: 0.02em;
    }

    .grpl-footer-col a {
        width: fit-content;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        color: rgba(255,255,255,0.56);
        font-size: 13px;
        font-weight: 650;
        text-decoration: none;
        transition: color 0.2s ease, transform 0.2s ease;
    }

    .grpl-footer-col a::before {
        content: "";
        width: 5px;
        height: 5px;
        border-radius: 999px;
        background: rgba(249, 168, 37, 0.78);
        opacity: 0;
        transform: scale(0.4);
        transition: opacity 0.2s ease, transform 0.2s ease;
    }

    .grpl-footer-col a:hover {
        color: #FFFFFF;
        transform: translateX(3px);
    }

    .grpl-footer-col a:hover::before {
        opacity: 1;
        transform: scale(1);
    }

    .grpl-footer-contact-card {
        display: flex;
        gap: 12px;
        padding: 17px;
        border-radius: 22px;
        background:
            linear-gradient(135deg, rgba(255,255,255,0.085), rgba(255,255,255,0.045));
        border: 1px solid rgba(255,255,255,0.10);
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);
    }

    .grpl-footer-contact-icon {
        width: 36px;
        height: 36px;
        flex-shrink: 0;
        display: grid;
        place-items: center;
        border-radius: 13px;
        color: #FFFFFF;
        background: linear-gradient(135deg, #1565C0, #0D47A1);
        font-size: 14px;
        font-weight: 900;
        box-shadow: 0 14px 26px rgba(21, 101, 192, 0.22);
    }

    .grpl-footer-contact-card strong {
        display: block;
        margin-bottom: 5px;
        color: #FFFFFF;
        font-size: 13px;
        font-weight: 850;
    }

    .grpl-footer-contact-card p {
        margin: 0;
        color: rgba(255,255,255,0.54);
        font-size: 12px;
        line-height: 1.6;
    }

    .grpl-footer-login-link {
        margin-top: 15px;
        margin-bottom: 0 !important;
        color: #FFFFFF !important;
        font-weight: 800 !important;
    }

    .grpl-footer-divider {
        width: 100%;
        height: 1px;
        margin: 44px 0 22px;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(255,255,255,0.12),
            transparent
        );
    }

    .grpl-footer-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
    }

    .grpl-footer-bottom p {
        margin: 0;
        color: rgba(255,255,255,0.34);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        line-height: 1.8;
    }

    .grpl-footer-bottom-links {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }

    .grpl-footer-bottom-links a {
        color: rgba(255,255,255,0.48);
        font-size: 12px;
        font-weight: 800;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .grpl-footer-bottom-links a:hover {
        color: #FFFFFF;
    }

    .grpl-footer-bottom-links span {
        width: 4px;
        height: 4px;
        border-radius: 999px;
        background: rgba(255,255,255,0.25);
    }

    @media (max-width: 1100px) {
        .grpl-footer-main {
            grid-template-columns: 1fr;
            gap: 42px;
        }

        .grpl-footer-brand {
            max-width: 660px;
        }

        .grpl-footer-links {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 26px;
        }
    }

    @media (max-width: 820px) {
        .grpl-footer {
            padding: 62px 22px 26px;
        }

        .grpl-footer-links {
            grid-template-columns: 1fr 1fr;
            gap: 28px;
        }

        .grpl-footer-contact {
            grid-column: 1 / -1;
        }

        .grpl-footer-contact-card {
            max-width: 460px;
        }
    }

    @media (max-width: 620px) {
        .grpl-footer {
            padding: 54px 18px 24px;
        }

        .grpl-footer-main {
            gap: 34px;
        }

        .grpl-footer-links {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .grpl-footer-col {
            padding: 22px 0;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .grpl-footer-col:first-child {
            padding-top: 0;
        }

        .grpl-footer-col:last-child {
            padding-bottom: 0;
            border-bottom: 0;
        }

        .grpl-footer-bottom {
            flex-direction: column;
            align-items: flex-start;
        }

        .grpl-footer-bottom-links {
            flex-wrap: wrap;
        }
    }

    @media (max-width: 420px) {
        .grpl-footer-logo-wrap {
            width: 48px;
            height: 48px;
            border-radius: 16px;
        }

        .grpl-footer-logo-wrap img {
            width: 33px;
            height: 33px;
        }

        .grpl-footer-logo-box strong {
            font-size: 22px;
        }

        .grpl-footer-brand p {
            font-size: 13px;
        }

        .grpl-footer-bottom p {
            font-size: 10px;
            letter-spacing: 0.06em;
        }
    }
</style>