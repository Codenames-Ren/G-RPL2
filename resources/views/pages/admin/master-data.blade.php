@extends('layouts.app')

@section('title', 'Master Data - G-RPL')
@section('page', 'master-data')
@section('authRequired', 'true')
@section('roleRequired', 'system_admin')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <x-admin-sidebar />

        <div class="workspace master-data-workspace">
            <div class="master-data-hero">
                <div class="master-data-hero-content">
                    <div>
                        <p class="eyebrow master-data-eyebrow">Reference Data</p>
                        <h2>Master Data G-RPL</h2>
                        <p class="master-data-subtitle">
                            Kelola data referensi utama seperti program studi dan mata kuliah.
                            Data ini menjadi dasar untuk proses rekognisi pembelajaran lampau di sistem G-RPL.
                        </p>
                    </div>

                    <div class="master-data-actions">
                        <span class="connection-pill master-data-status-pill" data-api-status>Connecting</span>
                    </div>
                </div>

                <div class="master-data-stats">
                    <div class="master-data-stat-card">
                        <span class="master-data-stat-icon master-data-stat-blue">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3 1 9l11 6 9-4.91V17h2V9L12 3Zm0 14L5 13.18V16c0 2 4.66 4 7 4s7-2 7-4v-2.82L12 17Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Reference</p>
                            <strong>Study Programs</strong>
                        </div>
                    </div>

                    <div class="master-data-stat-card">
                        <span class="master-data-stat-icon master-data-stat-yellow">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M18 2H7c-1.66 0-3 1.34-3 3v14c0 1.66 1.34 3 3 3h11c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2Zm0 16H7c-.55 0-1 .45-1 1s.45 1 1 1h11v-2Zm0-2H7c-.35 0-.69.06-1 .17V5c0-.55.45-1 1-1h11v12Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Reference</p>
                            <strong>Courses</strong>
                        </div>
                    </div>

                    <div class="master-data-stat-card">
                        <span class="master-data-stat-icon master-data-stat-green">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M9 16.17 4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Status</p>
                            <strong>Ready to Manage</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="master-data-panel">
                <div class="master-data-panel-head">
                    <div>
                        <h3>Pilih Data yang Ingin Dikelola</h3>
                        <p>
                            Masuk ke salah satu modul untuk mengatur data program studi atau mata kuliah.
                        </p>
                    </div>

                    <span class="master-data-panel-badge">Master Modules</span>
                </div>

                <div class="master-data-grid">
                    <a class="master-data-card master-data-card-programs" href="/admin/study-programs">
                        <span class="master-data-card-glow"></span>

                        <div class="master-data-card-top">
                            <span class="master-data-card-icon">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M12 3 1 9l11 6 9-4.91V17h2V9L12 3Zm0 14L5 13.18V16c0 2 4.66 4 7 4s7-2 7-4v-2.82L12 17Z"/>
                                </svg>
                            </span>

                            <span class="master-data-card-label">Program</span>
                        </div>

                        <div class="master-data-card-body">
                            <strong>Study Programs</strong>
                            <span>
                                Kelola program studi, total SKS, jenjang pendidikan, dan skema RPL
                                yang didukung oleh sistem.
                            </span>
                        </div>

                        <div class="master-data-card-footer">
                            <span>Manage Study Programs</span>
                            <span class="master-data-arrow">→</span>
                        </div>
                    </a>

                    <a class="master-data-card master-data-card-courses" href="/admin/courses">
                        <span class="master-data-card-glow"></span>

                        <div class="master-data-card-top">
                            <span class="master-data-card-icon">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M18 2H7c-1.66 0-3 1.34-3 3v14c0 1.66 1.34 3 3 3h11c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2Zm0 16H7c-.55 0-1 .45-1 1s.45 1 1 1h11v-2Zm0-2H7c-.35 0-.69.06-1 .17V5c0-.55.45-1 1-1h11v12Z"/>
                                </svg>
                            </span>

                            <span class="master-data-card-label">Course</span>
                        </div>

                        <div class="master-data-card-body">
                            <strong>Courses</strong>
                            <span>
                                Kelola mata kuliah, kode, semester, SKS, tipe rekognisi,
                                dan status aktif mata kuliah.
                            </span>
                        </div>

                        <div class="master-data-card-footer">
                            <span>Manage Courses</span>
                            <span class="master-data-arrow">→</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style>
        /*
        |--------------------------------------------------------------------------
        | MASTER DATA PAGE - PREMIUM ADMIN STYLE
        |--------------------------------------------------------------------------
        */

        .master-data-workspace,
        .master-data-workspace * {
            box-sizing: border-box;
        }

        .master-data-workspace {
            position: relative;
            display: grid;
            gap: 18px;
            min-width: 0;
        }

        .master-data-hero {
            position: relative;
            overflow: hidden;
            padding: 24px;
            border-radius: 30px;
            background:
                radial-gradient(circle at 8% 0%, rgba(249, 168, 37, 0.18), transparent 28%),
                radial-gradient(circle at 92% 0%, rgba(21, 101, 192, 0.18), transparent 32%),
                linear-gradient(135deg, #ffffff 0%, #f8fafc 54%, #eef6ff 100%);
            border: 1px solid rgba(226, 232, 240, 0.92);
            box-shadow:
                0 22px 60px rgba(15, 23, 42, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.85);
        }

        .master-data-hero::before {
            content: "";
            position: absolute;
            inset: 0 0 auto;
            height: 5px;
            background: linear-gradient(90deg, #1565C0, #F9A825, #E53935);
        }

        .master-data-hero::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            right: -78px;
            bottom: -90px;
            border-radius: 999px;
            background: rgba(21, 101, 192, 0.08);
            pointer-events: none;
        }

        .master-data-hero-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 22px;
        }

        .master-data-eyebrow {
            margin-bottom: 8px;
            color: #1565C0;
        }

        .master-data-hero h2 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: clamp(1.65rem, 3vw, 2.45rem);
            line-height: 1.08;
            font-weight: 950;
            letter-spacing: -0.065em;
        }

        .master-data-subtitle {
            max-width: 760px;
            margin: 10px 0 0;
            color: #64748b;
            font-size: 0.94rem;
            line-height: 1.72;
            font-weight: 650;
        }

        .master-data-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            flex-shrink: 0;
        }

        /*
        |--------------------------------------------------------------------------
        | STATUS PILL
        |--------------------------------------------------------------------------
        */

        .connection-pill,
        .master-data-status-pill {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 0 17px;
            border-radius: 999px;
            border: 1px solid #93c5fd;
            color: #1d4ed8;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            box-shadow:
                0 12px 28px rgba(15, 23, 42, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.65);
            font-size: 0.82rem;
            line-height: 1;
            font-weight: 950;
            letter-spacing: 0.01em;
            white-space: nowrap;
        }

        .connection-pill::before,
        .master-data-status-pill::before {
            content: "";
            width: 9px;
            height: 9px;
            flex: 0 0 9px;
            border-radius: 999px;
            background: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        .connection-pill.is-connected,
        .master-data-status-pill.is-connected {
            color: #14532d;
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            border-color: #4ade80;
            box-shadow:
                0 12px 28px rgba(34, 197, 94, 0.16),
                inset 0 1px 0 rgba(255, 255, 255, 0.72);
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.45);
        }

        .connection-pill.is-connected::before,
        .master-data-status-pill.is-connected::before {
            background: #16a34a;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.18);
        }

        .connection-pill.is-connecting,
        .master-data-status-pill.is-connecting {
            color: #1d4ed8;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-color: #93c5fd;
        }

        .connection-pill.is-connecting::before,
        .master-data-status-pill.is-connecting::before {
            background: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        .connection-pill.is-error,
        .master-data-status-pill.is-error,
        .connection-pill.is-disconnected,
        .master-data-status-pill.is-disconnected {
            color: #991b1b;
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border-color: #fca5a5;
            box-shadow:
                0 12px 28px rgba(239, 68, 68, 0.14),
                inset 0 1px 0 rgba(255, 255, 255, 0.65);
        }

        .connection-pill.is-error::before,
        .master-data-status-pill.is-error::before,
        .connection-pill.is-disconnected::before,
        .master-data-status-pill.is-disconnected::before {
            background: #dc2626;
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.16);
        }

        /*
        |--------------------------------------------------------------------------
        | STATS
        |--------------------------------------------------------------------------
        */

        .master-data-stats {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 22px;
        }

        .master-data-stat-card {
            min-width: 0;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 15px;
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.78);
            border: 1px solid rgba(226, 232, 240, 0.92);
            box-shadow: 0 14px 34px rgba(15, 23, 42, 0.06);
            backdrop-filter: blur(10px);
        }

        .master-data-stat-icon {
            width: 44px;
            height: 44px;
            flex: 0 0 44px;
            display: grid;
            place-items: center;
            border-radius: 17px;
        }

        .master-data-stat-icon svg {
            width: 22px;
            height: 22px;
            fill: currentColor;
            display: block;
        }

        .master-data-stat-blue {
            color: #1565C0;
            background: rgba(21, 101, 192, 0.10);
            border: 1px solid rgba(21, 101, 192, 0.12);
        }

        .master-data-stat-yellow {
            color: #b77905;
            background: rgba(249, 168, 37, 0.14);
            border: 1px solid rgba(249, 168, 37, 0.18);
        }

        .master-data-stat-green {
            color: #16a34a;
            background: rgba(22, 163, 74, 0.10);
            border: 1px solid rgba(22, 163, 74, 0.12);
        }

        .master-data-stat-card p {
            margin: 0 0 4px;
            color: #64748b;
            font-size: 0.74rem;
            font-weight: 900;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .master-data-stat-card strong {
            display: block;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 1.04rem;
            line-height: 1.2;
            font-weight: 950;
            letter-spacing: -0.04em;
        }

        /*
        |--------------------------------------------------------------------------
        | PANEL
        |--------------------------------------------------------------------------
        */

        .master-data-panel {
            overflow: hidden;
            padding: 22px;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(226, 232, 240, 0.95);
            box-shadow:
                0 18px 50px rgba(15, 23, 42, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        .master-data-panel-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            padding-bottom: 18px;
            border-bottom: 1px solid rgba(226, 232, 240, 0.85);
        }

        .master-data-panel-head h3 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 1.08rem;
            line-height: 1.2;
            font-weight: 950;
            letter-spacing: -0.04em;
        }

        .master-data-panel-head p {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 0.84rem;
            line-height: 1.55;
            font-weight: 650;
        }

        .master-data-panel-badge {
            min-height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 12px;
            border-radius: 999px;
            color: #1565C0;
            background: rgba(21, 101, 192, 0.08);
            border: 1px solid rgba(21, 101, 192, 0.10);
            font-size: 0.74rem;
            font-weight: 950;
            white-space: nowrap;
        }

        /*
        |--------------------------------------------------------------------------
        | MODULE CARDS
        |--------------------------------------------------------------------------
        */

        .master-data-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            margin-top: 20px;
        }

        .master-data-card {
            position: relative;
            min-height: 230px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 18px;
            overflow: hidden;
            padding: 20px;
            border-radius: 26px;
            color: #0f172a;
            text-decoration: none;
            background:
                radial-gradient(circle at 100% 0%, rgba(21, 101, 192, 0.10), transparent 34%),
                linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid rgba(226, 232, 240, 0.95);
            box-shadow:
                0 16px 42px rgba(15, 23, 42, 0.07),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            transition:
                transform 0.24s ease,
                box-shadow 0.24s ease,
                border-color 0.24s ease;
        }

        .master-data-card:hover {
            transform: translateY(-4px);
            border-color: rgba(21, 101, 192, 0.24);
            box-shadow:
                0 24px 54px rgba(15, 23, 42, 0.11),
                inset 0 1px 0 rgba(255, 255, 255, 0.92);
        }

        .master-data-card-glow {
            position: absolute;
            width: 150px;
            height: 150px;
            right: -70px;
            bottom: -76px;
            border-radius: 999px;
            background: rgba(21, 101, 192, 0.08);
            pointer-events: none;
        }

        .master-data-card-programs .master-data-card-glow {
            background: rgba(21, 101, 192, 0.10);
        }

        .master-data-card-courses .master-data-card-glow {
            background: rgba(249, 168, 37, 0.14);
        }

        .master-data-card-top {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        .master-data-card-icon {
            width: 54px;
            height: 54px;
            flex: 0 0 54px;
            display: grid;
            place-items: center;
            border-radius: 20px;
            color: #1565C0;
            background: rgba(21, 101, 192, 0.09);
            border: 1px solid rgba(21, 101, 192, 0.12);
        }

        .master-data-card-courses .master-data-card-icon {
            color: #b77905;
            background: rgba(249, 168, 37, 0.14);
            border-color: rgba(249, 168, 37, 0.18);
        }

        .master-data-card-icon svg {
            width: 27px;
            height: 27px;
            fill: currentColor;
            display: block;
        }

        .master-data-card-label {
            min-height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 12px;
            border-radius: 999px;
            color: #475569;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            font-size: 0.72rem;
            line-height: 1;
            font-weight: 950;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .master-data-card-body {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 10px;
        }

        .master-data-card-body strong {
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 1.35rem;
            line-height: 1.1;
            font-weight: 950;
            letter-spacing: -0.055em;
        }

        .master-data-card-body span {
            max-width: 520px;
            color: #64748b;
            font-size: 0.9rem;
            line-height: 1.65;
            font-weight: 650;
        }

        .master-data-card-footer {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding-top: 16px;
            border-top: 1px solid rgba(226, 232, 240, 0.88);
            color: #1565C0;
            font-size: 0.86rem;
            line-height: 1;
            font-weight: 950;
        }

        .master-data-card-courses .master-data-card-footer {
            color: #b77905;
        }

        .master-data-arrow {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            display: grid;
            place-items: center;
            border-radius: 999px;
            background: rgba(21, 101, 192, 0.08);
            transition: transform 0.24s ease;
        }

        .master-data-card-courses .master-data-arrow {
            background: rgba(249, 168, 37, 0.14);
        }

        .master-data-card:hover .master-data-arrow {
            transform: translateX(3px);
        }

        /*
        |--------------------------------------------------------------------------
        | TABLET
        |--------------------------------------------------------------------------
        */

        @media (max-width: 1100px) {
            .master-data-hero,
            .master-data-panel {
                padding: 20px;
            }

            .master-data-hero-content {
                flex-direction: column;
            }

            .master-data-actions {
                width: 100%;
                justify-content: flex-start;
                flex-wrap: wrap;
            }
        }

        @media (max-width: 900px) {
            .master-data-stats {
                grid-template-columns: 1fr;
            }

            .master-data-stat-card {
                padding: 14px;
            }

            .master-data-status-pill {
                width: fit-content;
            }

            .master-data-grid {
                grid-template-columns: 1fr;
            }

            .master-data-card {
                min-height: 210px;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | MOBILE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 640px) {
            .master-data-workspace {
                gap: 14px;
            }

            .master-data-hero,
            .master-data-panel {
                border-radius: 24px;
                padding: 16px;
            }

            .master-data-hero h2 {
                font-size: 1.55rem;
                letter-spacing: -0.055em;
            }

            .master-data-subtitle {
                font-size: 0.84rem;
                line-height: 1.62;
            }

            .master-data-actions {
                display: grid;
                grid-template-columns: 1fr;
            }

            .master-data-status-pill {
                width: 100%;
            }

            .master-data-stats {
                margin-top: 18px;
            }

            .master-data-panel-head {
                display: grid;
            }

            .master-data-panel-badge {
                width: fit-content;
            }

            .master-data-grid {
                gap: 14px;
            }

            .master-data-card {
                min-height: 220px;
                padding: 16px;
                border-radius: 22px;
            }

            .master-data-card-body strong {
                font-size: 1.18rem;
            }

            .master-data-card-body span {
                font-size: 0.84rem;
                line-height: 1.58;
            }

            .master-data-card-icon {
                width: 48px;
                height: 48px;
                flex-basis: 48px;
                border-radius: 18px;
            }

            .master-data-card-icon svg {
                width: 24px;
                height: 24px;
            }
        }

        @media (max-width: 420px) {
            .master-data-hero,
            .master-data-panel {
                padding: 14px;
            }

            .master-data-stat-card {
                align-items: flex-start;
            }

            .master-data-stat-icon {
                width: 40px;
                height: 40px;
                flex-basis: 40px;
                border-radius: 15px;
            }

            .master-data-stat-card strong {
                font-size: 0.98rem;
            }

            .master-data-card-top {
                align-items: flex-start;
            }

            .master-data-card-label {
                font-size: 0.66rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const apiStatus = document.querySelector('[data-api-status]');

            function normalizeText(value) {
                return String(value || '').trim().toLowerCase();
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