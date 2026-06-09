@extends('layouts.app')

@section('title', 'Applications - G-RPL2')
@section('page', 'applications')
@section('authRequired', 'true')
@section('roleRequired', 'applicant')

@section('content')
    <section class="app-shell" data-protected-shell hidden>

        {{-- Sidebar Applicant Blade --}}
        <x-applicant-sidebar />

        <div class="workspace applications-workspace">
            <div class="applications-hero">
                <div class="applications-hero-content">
                    <div>
                        <p class="eyebrow applications-eyebrow">Application Management</p>
                        <h2>Pengajuan RPL</h2>
                        <p class="applications-subtitle">
                            Pantau seluruh pengajuan Rekognisi Pembelajaran Lampau Anda, lihat status,
                            buka detail pengajuan, dan lanjutkan proses edit jika data masih perlu dilengkapi.
                        </p>
                    </div>

                    <div class="applications-header-actions">
                        <span class="connection-pill applications-status-pill" data-api-status>Connecting</span>

                        <a href="/applications/create" class="applications-create-btn">
                            <span class="applications-create-icon">+</span>
                            <span>Create Application</span>
                        </a>
                    </div>
                </div>

                <div class="applications-stats">
                    <div class="applications-stat-card">
                        <span class="applications-stat-icon applications-stat-blue">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M4 4c0-1.1.9-2 2-2h9l5 5v13c0 1.1-.9 2-2 2H6c-1.1 0-2-.9-2-2V4Zm10 0v4h4l-4-4ZM8 12v2h8v-2H8Zm0 4v2h8v-2H8Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Total Pengajuan</p>
                            <strong data-applications-total>—</strong>
                        </div>
                    </div>

                    <div class="applications-stat-card">
                        <span class="applications-stat-icon applications-stat-green">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M9 16.17 4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Submitted</p>
                            <strong data-applications-submitted>—</strong>
                        </div>
                    </div>

                    <div class="applications-stat-card">
                        <span class="applications-stat-icon applications-stat-yellow">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3 1 9l11 6 9-4.91V17h2V9L12 3Zm0 14L5 13.18V16c0 2 4.66 4 7 4s7-2 7-4v-2.82L12 17Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Draft / Process</p>
                            <strong data-applications-draft>—</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="applications-panel">
                <div class="applications-panel-head">
                    <div>
                        <h3>Daftar Pengajuan</h3>
                        <p>
                            Semua pengajuan RPL Anda akan tampil di tabel ini. Gunakan tombol Detail atau Edit
                            pada kolom aksi untuk melanjutkan pengelolaan data.
                        </p>
                    </div>

                    <span class="applications-panel-badge">Applicant Area</span>
                </div>

                <p class="form-message applications-message" data-page-message aria-live="polite"></p>
            </div>

            <div class="applications-table-section">
                <div class="applications-table-header">
                    <div>
                        <h3>Data Applications</h3>
                        <p>Daftar seluruh pengajuan RPL yang terhubung dengan akun applicant Anda.</p>
                    </div>

                    <span class="applications-table-badge">Application List</span>
                </div>

                <div class="table-wrap applications-table-wrap">
                    <table class="data-table applications-table">
                        <thead>
                            <tr>
                                <th>Nomor Aplikasi</th>
                                <th>Program Studi</th>
                                <th>Tipe</th>
                                <th>Status</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody data-applications-body>
                            <tr>
                                <td colspan="6">
                                    <div class="applications-loading-state">
                                        <span class="applications-loader"></span>
                                        <strong>Memuat pengajuan...</strong>
                                        <p>Sedang mengambil data applications dari server.</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <style>
        /*
        |--------------------------------------------------------------------------
        | APPLICATIONS PAGE - PREMIUM APPLICANT STYLE
        |--------------------------------------------------------------------------
        */

        .applications-workspace,
        .applications-workspace * {
            box-sizing: border-box;
        }

        .applications-workspace {
            position: relative;
            display: grid;
            gap: 18px;
            min-width: 0;
        }

        .applications-hero {
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

        .applications-hero::before {
            content: "";
            position: absolute;
            inset: 0 0 auto;
            height: 5px;
            background: linear-gradient(90deg, #1565C0, #F9A825, #E53935);
        }

        .applications-hero::after {
            content: "";
            position: absolute;
            width: 170px;
            height: 170px;
            right: -76px;
            bottom: -86px;
            border-radius: 999px;
            background: rgba(21, 101, 192, 0.08);
            pointer-events: none;
        }

        .applications-hero-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 22px;
        }

        .applications-eyebrow {
            margin-bottom: 8px;
            color: #1565C0;
        }

        .applications-hero h2 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: clamp(1.65rem, 3vw, 2.45rem);
            line-height: 1.08;
            font-weight: 950;
            letter-spacing: -0.065em;
        }

        .applications-subtitle {
            max-width: 760px;
            margin: 10px 0 0;
            color: #64748b;
            font-size: 0.94rem;
            line-height: 1.72;
            font-weight: 650;
        }

        .applications-header-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            flex-shrink: 0;
        }

        .connection-pill,
        .applications-status-pill {
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
            white-space: nowrap;
        }

        .connection-pill::before,
        .applications-status-pill::before {
            content: "";
            width: 9px;
            height: 9px;
            flex: 0 0 9px;
            border-radius: 999px;
            background: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        .connection-pill.is-connected,
        .applications-status-pill.is-connected {
            color: #14532d;
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            border-color: #4ade80;
            box-shadow:
                0 12px 28px rgba(34, 197, 94, 0.16),
                inset 0 1px 0 rgba(255, 255, 255, 0.72);
        }

        .connection-pill.is-connected::before,
        .applications-status-pill.is-connected::before {
            background: #16a34a;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.18);
        }

        .connection-pill.is-connecting,
        .applications-status-pill.is-connecting {
            color: #1d4ed8;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-color: #93c5fd;
        }

        .connection-pill.is-error,
        .applications-status-pill.is-error,
        .connection-pill.is-disconnected,
        .applications-status-pill.is-disconnected {
            color: #991b1b;
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border-color: #fca5a5;
            box-shadow:
                0 12px 28px rgba(239, 68, 68, 0.14),
                inset 0 1px 0 rgba(255, 255, 255, 0.65);
        }

        .connection-pill.is-error::before,
        .applications-status-pill.is-error::before,
        .connection-pill.is-disconnected::before,
        .applications-status-pill.is-disconnected::before {
            background: #dc2626;
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.16);
        }

        .applications-create-btn {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 0 16px;
            border-radius: 999px;
            color: #ffffff;
            background: linear-gradient(135deg, #1565C0 0%, #0f4fa3 100%);
            border: 1px solid rgba(21, 101, 192, 0.20);
            box-shadow:
                0 16px 30px rgba(21, 101, 192, 0.22),
                inset 0 1px 0 rgba(255, 255, 255, 0.24);
            font-size: 0.86rem;
            line-height: 1;
            font-weight: 950;
            text-decoration: none;
            white-space: nowrap;
            transition:
                transform 0.22s ease,
                box-shadow 0.22s ease,
                filter 0.22s ease;
        }

        .applications-create-btn:hover {
            transform: translateY(-2px);
            filter: brightness(1.03);
            box-shadow:
                0 20px 36px rgba(21, 101, 192, 0.28),
                inset 0 1px 0 rgba(255, 255, 255, 0.28);
        }

        .applications-create-icon {
            width: 22px;
            height: 22px;
            display: grid;
            place-items: center;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.18);
            font-size: 1.1rem;
            line-height: 1;
            font-weight: 950;
        }

        .applications-stats {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 22px;
        }

        .applications-stat-card {
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

        .applications-stat-icon {
            width: 44px;
            height: 44px;
            flex: 0 0 44px;
            display: grid;
            place-items: center;
            border-radius: 17px;
        }

        .applications-stat-icon svg {
            width: 22px;
            height: 22px;
            fill: currentColor;
            display: block;
        }

        .applications-stat-blue {
            color: #1565C0;
            background: rgba(21, 101, 192, 0.10);
            border: 1px solid rgba(21, 101, 192, 0.12);
        }

        .applications-stat-green {
            color: #16a34a;
            background: rgba(22, 163, 74, 0.10);
            border: 1px solid rgba(22, 163, 74, 0.12);
        }

        .applications-stat-yellow {
            color: #b77905;
            background: rgba(249, 168, 37, 0.14);
            border: 1px solid rgba(249, 168, 37, 0.18);
        }

        .applications-stat-card p {
            margin: 0 0 4px;
            color: #64748b;
            font-size: 0.74rem;
            font-weight: 900;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .applications-stat-card strong {
            display: block;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 1.28rem;
            line-height: 1;
            font-weight: 950;
            letter-spacing: -0.045em;
        }

        .applications-panel,
        .applications-table-section {
            overflow: hidden;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(226, 232, 240, 0.95);
            box-shadow:
                0 18px 50px rgba(15, 23, 42, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        .applications-panel {
            padding: 20px;
        }

        .applications-panel-head,
        .applications-table-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .applications-panel-head h3,
        .applications-table-header h3 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 1.08rem;
            line-height: 1.2;
            font-weight: 950;
            letter-spacing: -0.04em;
        }

        .applications-panel-head p,
        .applications-table-header p {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 0.84rem;
            line-height: 1.55;
            font-weight: 650;
        }

        .applications-panel-badge,
        .applications-table-badge {
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

        .applications-message {
            margin: 13px 0 0;
            font-weight: 800;
        }

        .applications-table-section {
            padding: 0;
        }

        .applications-table-header {
            padding: 20px 20px 16px;
            border-bottom: 1px solid rgba(226, 232, 240, 0.88);
            background:
                linear-gradient(135deg, rgba(248, 250, 252, 0.95), rgba(255, 255, 255, 0.95));
        }

        .applications-table-wrap {
            margin-top: 0;
            border-radius: 0;
            border: 0;
            box-shadow: none;
            overflow-x: auto;
        }

        .applications-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 860px;
        }

        .applications-table thead th {
            position: sticky;
            top: 0;
            z-index: 2;
            padding: 15px 16px;
            color: #475569;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.72rem;
            line-height: 1;
            font-weight: 950;
            letter-spacing: 0.08em;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .applications-table tbody td {
            padding: 15px 16px;
            color: #334155;
            border-bottom: 1px solid #edf2f7;
            background: #ffffff;
            font-size: 0.88rem;
            line-height: 1.45;
            font-weight: 700;
            vertical-align: middle;
        }

        .applications-table tbody tr:hover td {
            background: #fbfdff;
        }

        .applications-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .applications-table td[colspan="6"] {
            padding: 34px 22px;
            color: #64748b;
            text-align: center;
            font-weight: 800;
        }

        .applications-loading-state {
            display: grid;
            place-items: center;
            gap: 8px;
            padding: 10px;
        }

        .applications-loading-state strong {
            color: #0f172a;
            font-size: 0.95rem;
            font-weight: 950;
        }

        .applications-loading-state p {
            margin: 0;
            color: #64748b;
            font-size: 0.84rem;
            font-weight: 650;
        }

        .applications-loader {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            border: 4px solid rgba(21, 101, 192, 0.12);
            border-top-color: #1565C0;
            animation: applications-spin 0.8s linear infinite;
        }

        @keyframes applications-spin {
            to {
                transform: rotate(360deg);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | BADGE DAN AKSI YANG BIASANYA DIBIKIN OLEH JS
        |--------------------------------------------------------------------------
        */

        .applications-status-badge,
        .application-status-badge,
        .status-badge {
            min-height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 10px;
            border-radius: 999px;
            font-size: 0.72rem;
            line-height: 1;
            font-weight: 950;
            white-space: nowrap;
        }

        .applications-status-draft,
        .status-draft {
            color: #92400e;
            background: rgba(249, 168, 37, 0.14);
            border: 1px solid rgba(249, 168, 37, 0.20);
        }

        .applications-status-submitted,
        .status-submitted {
            color: #1565C0;
            background: rgba(21, 101, 192, 0.08);
            border: 1px solid rgba(21, 101, 192, 0.12);
        }

        .applications-status-approved,
        .status-approved {
            color: #15803d;
            background: rgba(34, 197, 94, 0.11);
            border: 1px solid rgba(34, 197, 94, 0.16);
        }

        .applications-status-rejected,
        .status-rejected {
            color: #b91c1c;
            background: rgba(239, 68, 68, 0.10);
            border: 1px solid rgba(239, 68, 68, 0.15);
        }

        .applications-actions,
        .application-actions {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .applications-action-btn,
        .application-action-btn {
            min-height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 11px;
            border-radius: 999px;
            font-size: 0.76rem;
            line-height: 1;
            font-weight: 950;
            text-decoration: none;
            white-space: nowrap;
            border: 1px solid transparent;
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                filter 0.2s ease;
        }

        .applications-action-btn:hover,
        .application-action-btn:hover {
            transform: translateY(-1px);
            filter: brightness(1.02);
        }

        .applications-detail-btn,
        .application-detail-btn {
            color: #1565C0;
            background: rgba(21, 101, 192, 0.08);
            border-color: rgba(21, 101, 192, 0.12);
        }

        .applications-edit-btn,
        .application-edit-btn {
            color: #0f172a;
            background: linear-gradient(135deg, #F9A825, #ffd966);
            border-color: rgba(249, 168, 37, 0.28);
            box-shadow: 0 10px 22px rgba(249, 168, 37, 0.16);
        }

        @media (max-width: 1100px) {
            .applications-hero,
            .applications-panel {
                padding: 20px;
            }

            .applications-hero-content {
                flex-direction: column;
            }

            .applications-header-actions {
                width: 100%;
                justify-content: flex-start;
                flex-wrap: wrap;
            }
        }

        @media (max-width: 900px) {
            .applications-stats {
                grid-template-columns: 1fr;
            }

            .applications-stat-card {
                padding: 14px;
            }

            .applications-create-btn {
                flex: 1;
            }

            .applications-status-pill {
                width: fit-content;
            }
        }

        @media (max-width: 640px) {
            .applications-workspace {
                gap: 14px;
            }

            .applications-hero,
            .applications-panel,
            .applications-table-section {
                border-radius: 24px;
            }

            .applications-hero,
            .applications-panel {
                padding: 16px;
            }

            .applications-hero h2 {
                font-size: 1.55rem;
                letter-spacing: -0.055em;
            }

            .applications-subtitle {
                font-size: 0.84rem;
                line-height: 1.62;
            }

            .applications-header-actions {
                display: grid;
                grid-template-columns: 1fr;
            }

            .applications-status-pill,
            .applications-create-btn {
                width: 100%;
            }

            .applications-stats {
                margin-top: 18px;
            }

            .applications-panel-head,
            .applications-table-header {
                display: grid;
            }

            .applications-table-header {
                padding: 16px;
            }

            .applications-panel-badge,
            .applications-table-badge {
                width: fit-content;
            }
        }

        @media (max-width: 420px) {
            .applications-hero,
            .applications-panel {
                padding: 14px;
            }

            .applications-stat-card {
                align-items: flex-start;
            }

            .applications-stat-icon {
                width: 40px;
                height: 40px;
                flex-basis: 40px;
                border-radius: 15px;
            }

            .applications-stat-card strong {
                font-size: 1.12rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const body = document.querySelector('[data-applications-body]');
            const totalTarget = document.querySelector('[data-applications-total]');
            const submittedTarget = document.querySelector('[data-applications-submitted]');
            const draftTarget = document.querySelector('[data-applications-draft]');
            const apiStatus = document.querySelector('[data-api-status]');

            function normalizeText(value) {
                return String(value || '').trim().toLowerCase();
            }

            function readApplicationsFromTable() {
                if (!body) return [];

                const rows = Array.from(body.querySelectorAll('tr'));

                return rows
                    .filter(function (row) {
                        return !row.querySelector('td[colspan]');
                    })
                    .map(function (row) {
                        const cells = Array.from(row.querySelectorAll('td'));

                        return {
                            status: normalizeText(cells[3] ? cells[3].textContent : '')
                        };
                    });
            }

            function refreshApplicationStats() {
                const applications = readApplicationsFromTable();

                if (!applications.length) {
                    if (totalTarget) totalTarget.textContent = '—';
                    if (submittedTarget) submittedTarget.textContent = '—';
                    if (draftTarget) draftTarget.textContent = '—';
                    return;
                }

                const total = applications.length;

                const submitted = applications.filter(function (item) {
                    return (
                        item.status.includes('submit') ||
                        item.status.includes('submitted') ||
                        item.status.includes('review') ||
                        item.status.includes('approved') ||
                        item.status.includes('rejected')
                    );
                }).length;

                const draft = applications.filter(function (item) {
                    return (
                        item.status.includes('draft') ||
                        item.status.includes('process') ||
                        item.status.includes('pending')
                    );
                }).length;

                if (totalTarget) totalTarget.textContent = total;
                if (submittedTarget) submittedTarget.textContent = submitted;
                if (draftTarget) draftTarget.textContent = draft;
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

            if (body) {
                const observer = new MutationObserver(refreshApplicationStats);

                observer.observe(body, {
                    childList: true,
                    subtree: true,
                    characterData: true
                });

                refreshApplicationStats();
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