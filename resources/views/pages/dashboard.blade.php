@extends('layouts.app')

@section('title', 'Dashboard - G-RPL')
@section('page', 'dashboard')
@section('authRequired', 'true')
@section('roleRequired', 'system_admin')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <x-admin-sidebar />

        <div class="workspace dashboard-workspace">
            <div class="workspace-header dashboard-header">
                <div>
                    <p class="eyebrow">Dashboard</p>
                    <h2>Ringkasan Pekerjaan</h2>
                    <p class="dashboard-subtitle">
                        Pantau akses utama sistem RPL, mulai dari manajemen user,
                        master data, program studi, sampai daftar mata kuliah.
                    </p>
                </div>

                <span class="connection-pill dashboard-status-pill" data-api-status>Connecting</span>
            </div>

            <div class="dashboard-hero">
                <div>
                    <span class="dashboard-hero-badge">Admin Overview</span>
                    <h3>Selamat datang di panel pengelolaan G-RPL</h3>
                    <p>
                        Gunakan dashboard ini untuk mengakses modul utama yang dibutuhkan
                        dalam proses administrasi sistem Rekognisi Pembelajaran Lampau.
                    </p>
                </div>

                <div class="dashboard-hero-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 13h6V4H4v9zm10 7h6V4h-6v16zM4 20h6v-5H4v5z"/>
                    </svg>
                </div>
            </div>

            <div class="dashboard-grid admin-dashboard-grid">
                <a class="module-card admin-dashboard-card" href="/admin/users" data-role-card="system_admin" hidden>
                    <div class="admin-dashboard-card-top">
                        <div class="admin-dashboard-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m8-6a3 3 0 11-6 0 3 3 0 016 0zM9 8a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>

                        <span>User</span>
                    </div>

                    <strong>User Management</strong>
                    <p>Pengelolaan akun, role, status user, dan akses sistem.</p>
                    <small>Buka user management →</small>
                </a>

                <a class="module-card admin-dashboard-card" href="/admin/master-data" data-role-card="system_admin" hidden>
                    <div class="admin-dashboard-card-top">
                        <div class="admin-dashboard-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 7c0 1.657 3.582 3 8 3s8-1.343 8-3-3.582-3-8-3-8 1.343-8 3zm0 0v5c0 1.657 3.582 3 8 3s8-1.343 8-3V7M4 12v5c0 1.657 3.582 3 8 3s8-1.343 8-3v-5"/>
                            </svg>
                        </div>

                        <span>Reference</span>
                    </div>

                    <strong>Master Data</strong>
                    <p>Data referensi program studi dan mata kuliah yang digunakan sistem.</p>
                    <small>Buka master data →</small>
                </a>

                <a class="module-card admin-dashboard-card" href="/admin/study-programs" data-role-card="system_admin" hidden>
                    <div class="admin-dashboard-card-top">
                        <div class="admin-dashboard-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m-6-3.5V11m12 5.5V11"/>
                            </svg>
                        </div>

                        <span>Program</span>
                    </div>

                    <strong>Study Programs</strong>
                    <p>Pengelolaan program studi, total SKS, dan konfigurasi RPL.</p>
                    <small>Buka study programs →</small>
                </a>

                <a class="module-card admin-dashboard-card" href="/admin/courses" data-role-card="system_admin" hidden>
                    <div class="admin-dashboard-card-top">
                        <div class="admin-dashboard-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6.253v13M12 6.253C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253M12 6.253C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>

                        <span>Courses</span>
                    </div>

                    <strong>Courses</strong>
                    <p>Pengelolaan mata kuliah, semester, SKS, dan tipe rekognisi.</p>
                    <small>Buka courses →</small>
                </a>

                <a class="module-card admin-dashboard-card" href="/applications" data-role-card="applicant" hidden>
                    <strong>Applications</strong>
                    <p>Daftar dan pengajuan RPL applicant.</p>
                    <small>Buka applications →</small>
                </a>

                <a class="module-card admin-dashboard-card" href="/assessments" data-role-card="assessor" hidden>
                    <strong>Assessments</strong>
                    <p>Penilaian berkas dan evidensi applicant.</p>
                    <small>Buka assessments →</small>
                </a>

                <a class="module-card admin-dashboard-card" href="/approvals" data-role-card="committee" hidden>
                    <strong>Approvals</strong>
                    <p>Keputusan dan persetujuan komite.</p>
                    <small>Buka approvals →</small>
                </a>

                <a class="module-card admin-dashboard-card" href="/submissions" data-role-card="staff_rpl" hidden>
                    <strong>Submissions</strong>
                    <p>Review administrasi dan kelengkapan.</p>
                    <small>Buka submissions →</small>
                </a>
            </div>
        </div>
    </section>

    <style>
        /*
        |--------------------------------------------------------------------------
        | DASHBOARD PAGE - INLINE STYLE
        |--------------------------------------------------------------------------
        */

        .dashboard-workspace {
            position: relative;
        }

        .dashboard-header {
            align-items: flex-start;
        }

        .dashboard-subtitle {
            max-width: 700px;
            margin: 8px 0 0;
            color: #64748b;
            font-size: 0.92rem;
            line-height: 1.65;
            font-weight: 650;
        }

        /*
        |--------------------------------------------------------------------------
        | CONNECTED PILL - SAMA KAYA USERS
        |--------------------------------------------------------------------------
        */

        .dashboard-status-pill,
        .connection-pill.dashboard-status-pill {
            min-height: 42px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 9px !important;
            padding: 0 17px !important;
            border-radius: 999px !important;
            border: 1px solid #93c5fd !important;
            color: #1d4ed8 !important;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%) !important;
            box-shadow:
                0 12px 28px rgba(15, 23, 42, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.65) !important;
            font-size: 0.82rem !important;
            line-height: 1 !important;
            font-weight: 950 !important;
            letter-spacing: 0.01em;
            white-space: nowrap;
            opacity: 1 !important;
            visibility: visible !important;
            text-transform: none !important;
        }

        .dashboard-status-pill::before,
        .connection-pill.dashboard-status-pill::before {
            content: "";
            width: 9px;
            height: 9px;
            flex: 0 0 9px;
            border-radius: 999px;
            background: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        .dashboard-status-pill[data-status="connected"],
        .connection-pill.dashboard-status-pill[data-status="connected"],
        .dashboard-status-pill.is-connected,
        .connection-pill.dashboard-status-pill.is-connected {
            color: #14532d !important;
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%) !important;
            border-color: #4ade80 !important;
            box-shadow:
                0 12px 28px rgba(34, 197, 94, 0.16),
                inset 0 1px 0 rgba(255, 255, 255, 0.72) !important;
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.45);
        }

        .dashboard-status-pill[data-status="connected"]::before,
        .connection-pill.dashboard-status-pill[data-status="connected"]::before,
        .dashboard-status-pill.is-connected::before,
        .connection-pill.dashboard-status-pill.is-connected::before {
            background: #16a34a;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.18);
        }

        .dashboard-status-pill.is-error,
        .dashboard-status-pill[data-status="error"],
        .dashboard-status-pill[data-status="disconnected"],
        .connection-pill.dashboard-status-pill.is-error,
        .connection-pill.dashboard-status-pill[data-status="error"],
        .connection-pill.dashboard-status-pill[data-status="disconnected"] {
            color: #991b1b !important;
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%) !important;
            border-color: #fca5a5 !important;
            box-shadow:
                0 12px 28px rgba(239, 68, 68, 0.14),
                inset 0 1px 0 rgba(255, 255, 255, 0.65) !important;
        }

        .dashboard-status-pill.is-error::before,
        .dashboard-status-pill[data-status="error"]::before,
        .dashboard-status-pill[data-status="disconnected"]::before,
        .connection-pill.dashboard-status-pill.is-error::before,
        .connection-pill.dashboard-status-pill[data-status="error"]::before,
        .connection-pill.dashboard-status-pill[data-status="disconnected"]::before {
            background: #dc2626;
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.16);
        }

        .dashboard-hero {
            position: relative;
            display: grid;
            grid-template-columns: minmax(0, 1fr) 150px;
            gap: 20px;
            align-items: center;
            margin-top: 16px;
            padding: 24px;
            border-radius: 26px;
            border: 1px solid rgba(21, 101, 192, 0.10);
            background:
                radial-gradient(circle at 95% 0%, rgba(249, 168, 37, 0.14), transparent 32%),
                radial-gradient(circle at 0% 100%, rgba(21, 101, 192, 0.08), transparent 34%),
                linear-gradient(135deg, rgba(255, 255, 255, 0.98), rgba(248, 250, 252, 0.92));
            box-shadow: 0 18px 48px rgba(15, 23, 42, 0.06);
            overflow: hidden;
        }

        .dashboard-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #1565c0;
            font-size: 0.72rem;
            font-weight: 900;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .dashboard-hero-badge::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 999px;
            background: #1565c0;
            box-shadow: 0 0 0 4px rgba(21, 101, 192, 0.10);
        }

        .dashboard-hero h3 {
            margin: 10px 0 8px;
            color: #111827;
            font-family: 'Sora', var(--font-sans);
            font-size: 1.5rem;
            line-height: 1.2;
            font-weight: 900;
            letter-spacing: -0.05em;
        }

        .dashboard-hero p {
            max-width: 720px;
            margin: 0;
            color: #64748b;
            font-size: 0.92rem;
            line-height: 1.7;
            font-weight: 650;
        }

        .dashboard-hero-icon {
            width: 86px;
            height: 86px;
            justify-self: center;
            display: grid;
            place-items: center;
            border-radius: 28px;
            color: #ffffff;
            background: linear-gradient(135deg, #176bd8, #0d55b8);
            box-shadow: 0 20px 42px rgba(21, 101, 192, 0.24);
        }

        .dashboard-hero-icon svg {
            width: 42px;
            height: 42px;
        }

        .admin-dashboard-grid {
            margin-top: 18px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .admin-dashboard-card {
            min-height: 230px;
            padding: 22px;
            border-radius: 26px;
            background:
                radial-gradient(circle at 100% 0%, rgba(21, 101, 192, 0.08), transparent 34%),
                linear-gradient(135deg, #ffffff, #f8fafc);
            border: 1px solid rgba(21, 101, 192, 0.11);
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                border-color 0.2s ease;
        }

        .admin-dashboard-card::before {
            height: 4px;
            background: linear-gradient(90deg, #1565c0, #f9a825, #e53935);
        }

        .admin-dashboard-card:hover {
            transform: translateY(-3px);
            border-color: rgba(21, 101, 192, 0.25);
            box-shadow: 0 24px 58px rgba(15, 23, 42, 0.09);
        }

        .admin-dashboard-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .admin-dashboard-icon {
            width: 54px;
            height: 54px;
            display: grid;
            place-items: center;
            border-radius: 18px;
            color: #ffffff;
            background: linear-gradient(135deg, #176bd8, #0d55b8);
            box-shadow: 0 16px 30px rgba(21, 101, 192, 0.22);
        }

        .admin-dashboard-icon svg {
            width: 25px;
            height: 25px;
        }

        .admin-dashboard-card-top span {
            min-height: 28px;
            display: inline-flex;
            align-items: center;
            padding: 0 10px;
            border-radius: 999px;
            color: #1565c0;
            background: rgba(21, 101, 192, 0.08);
            border: 1px solid rgba(21, 101, 192, 0.12);
            font-size: 0.72rem;
            font-weight: 900;
        }

        .admin-dashboard-card strong {
            margin-top: 6px;
            color: #172033;
            font-family: 'Sora', var(--font-sans);
            font-size: 1.16rem;
            font-weight: 900;
            letter-spacing: -0.04em;
        }

        .admin-dashboard-card p {
            margin: 0;
            color: #64748b;
            font-size: 0.9rem;
            line-height: 1.65;
            font-weight: 650;
        }

        .admin-dashboard-card small {
            margin-top: auto;
            color: #1565c0;
            font-size: 0.82rem;
            font-weight: 900;
        }

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD PAGE - TABLET
        |--------------------------------------------------------------------------
        */

        @media (max-width: 900px) {
            .dashboard-header {
                flex-direction: column;
            }

            .dashboard-status-pill {
                width: fit-content;
            }

            .dashboard-hero {
                grid-template-columns: 1fr;
            }

            .dashboard-hero-icon {
                display: none;
            }

            .admin-dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD PAGE - MOBILE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 560px) {
            .dashboard-subtitle {
                font-size: 0.84rem;
            }

            .dashboard-status-pill {
                min-height: 38px !important;
                padding: 0 14px !important;
                font-size: 0.78rem !important;
            }

            .dashboard-hero {
                padding: 18px;
                border-radius: 22px;
            }

            .dashboard-hero h3 {
                font-size: 1.25rem;
            }

            .dashboard-hero p {
                font-size: 0.84rem;
            }

            .admin-dashboard-card {
                min-height: 205px;
                padding: 18px;
                border-radius: 22px;
            }

            .admin-dashboard-icon {
                width: 48px;
                height: 48px;
                border-radius: 16px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function syncDashboardStatusPill() {
                document.querySelectorAll('.dashboard-status-pill').forEach(function (pill) {
                    const text = (pill.textContent || '').trim().toLowerCase();
                    const status = (pill.dataset.status || '').trim().toLowerCase();

                    pill.classList.remove('is-connected', 'is-error', 'is-connecting');

                    if (status === 'connected' || text === 'connected') {
                        pill.classList.add('is-connected');
                        return;
                    }

                    if (
                        status === 'error' ||
                        status === 'disconnected' ||
                        text === 'error' ||
                        text === 'disconnected'
                    ) {
                        pill.classList.add('is-error');
                        return;
                    }

                    pill.classList.add('is-connecting');
                });
            }

            syncDashboardStatusPill();

            const observer = new MutationObserver(syncDashboardStatusPill);

            document.querySelectorAll('.dashboard-status-pill').forEach(function (pill) {
                observer.observe(pill, {
                    childList: true,
                    characterData: true,
                    subtree: true,
                    attributes: true,
                    attributeFilter: ['data-status']
                });
            });
        });
    </script>
@endsection