@extends('layouts.app')

@section('title', 'Study Programs - G-RPL')
@section('page', 'study-programs')
@section('authRequired', 'true')
@section('roleRequired', 'system_admin')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <x-admin-sidebar />

        <div class="workspace study-workspace">
            <div class="study-hero">
                <div class="study-hero-content">
                    <div>
                        <p class="eyebrow study-eyebrow">Study Program Management</p>

                        <h2>Daftar Program Studi</h2>

                        <p class="study-subtitle">
                            Kelola data program studi, kode program, total SKS, dukungan RPL,
                            dan status aktif program studi dengan tampilan yang lebih rapi dan mudah dipantau.
                        </p>
                    </div>

                    <div class="study-header-actions">
                        <span class="connection-pill study-status-pill" data-api-status>Connecting</span>

                        <a href="/admin/study-programs/create" class="study-create-btn">
                            <span class="study-create-icon">+</span>
                            <span>Tambah Prodi</span>
                        </a>
                    </div>
                </div>

                <div class="study-stats">
                    <div class="study-stat-card">
                        <span class="study-stat-icon study-stat-blue">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3 1 9l11 6 9-4.91V17h2V9L12 3Zm0 14L5 13.18V16c0 2 4.66 4 7 4s7-2 7-4v-2.82L12 17Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Total Prodi</p>
                            <strong data-study-total>—</strong>
                        </div>
                    </div>

                    <div class="study-stat-card">
                        <span class="study-stat-icon study-stat-green">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M9 16.17 4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Active</p>
                            <strong data-study-active>—</strong>
                        </div>
                    </div>

                    <div class="study-stat-card">
                        <span class="study-stat-icon study-stat-yellow">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 1 3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4Zm0 2.18 7 3.11V11c0 4.52-2.98 8.69-7 9.93C7.98 19.69 5 15.52 5 11V6.29l7-3.11Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>RPL Support</p>
                            <strong data-study-rpl>—</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="study-panel">
                <div class="study-panel-head">
                    <div>
                        <h3>Filter Program Studi</h3>
                        <p>Gunakan filter untuk mencari data berdasarkan kode, nama, dukungan RPL, atau status.</p>
                    </div>
                </div>

                <form class="toolbar study-toolbar" data-admin-filter="study-programs">
                    <label class="study-filter-field study-search-field">
                        <span>Cari Program Studi</span>

                        <div class="study-input-wrap">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M9.5 3a6.5 6.5 0 0 1 5.17 10.44l4.45 4.44-1.41 1.41-4.44-4.45A6.5 6.5 0 1 1 9.5 3Zm0 2a4.5 4.5 0 1 0 0 9 4.5 4.5 0 0 0 0-9Z"/>
                            </svg>

                            <input
                                type="search"
                                name="search"
                                placeholder="Cari kode atau nama program studi"
                            >
                        </div>
                    </label>

                    <label class="study-filter-field">
                        <span>RPL</span>
                        <select name="supports_rpl">
                            <option value="">Semua RPL</option>
                            <option value="1">Mendukung RPL</option>
                            <option value="0">Tidak RPL</option>
                        </select>
                    </label>

                    <label class="study-filter-field">
                        <span>Status</span>
                        <select name="is_active">
                            <option value="">Semua status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </label>

                    <button class="study-filter-btn" type="submit">
                        <span>Filter</span>
                    </button>
                </form>

                <p class="form-message study-message" data-page-message aria-live="polite"></p>
            </div>

            <div class="study-table-section">
                <div class="study-table-header">
                    <div>
                        <h3>Data Program Studi</h3>
                        <p>Daftar seluruh program studi yang tersedia di sistem G-RPL.</p>
                    </div>

                    <span class="study-table-badge">List Prodi</span>
                </div>

                <div class="table-wrap study-table-wrap">
                    <table class="data-table study-table">
                        <thead>
                            <tr>
                                <th>Kode Prodi</th>
                                <th>Nama</th>
                                <th>SKS</th>
                                <th>RPL</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody data-study-programs-body>
                            <tr>
                                <td colspan="6">
                                    <div class="study-loading-state">
                                        <span class="study-loader"></span>
                                        <strong>Memuat program studi...</strong>
                                        <p>Sedang mengambil data dari server.</p>
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
        | STUDY PROGRAMS PAGE - SAME STYLE AS COURSES
        |--------------------------------------------------------------------------
        */

        .study-workspace,
        .study-workspace * {
            box-sizing: border-box;
        }

        .study-workspace {
            position: relative;
            display: grid;
            gap: 18px;
            min-width: 0;
        }

        .study-hero {
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

        .study-hero::before {
            content: "";
            position: absolute;
            inset: 0 0 auto;
            height: 5px;
            background: linear-gradient(90deg, #1565C0, #F9A825, #E53935);
        }

        .study-hero::after {
            content: "";
            position: absolute;
            width: 160px;
            height: 160px;
            right: -70px;
            bottom: -80px;
            border-radius: 999px;
            background: rgba(21, 101, 192, 0.08);
            pointer-events: none;
        }

        .study-hero-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 22px;
        }

        .study-eyebrow {
            margin-bottom: 8px;
            color: #1565C0;
        }

        .study-hero h2 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: clamp(1.65rem, 3vw, 2.45rem);
            line-height: 1.08;
            font-weight: 950;
            letter-spacing: -0.065em;
        }

        .study-subtitle {
            max-width: 760px;
            margin: 10px 0 0;
            color: #64748b;
            font-size: 0.94rem;
            line-height: 1.72;
            font-weight: 650;
        }

        .study-header-actions {
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
        .study-status-pill {
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
        .study-status-pill::before {
            content: "";
            width: 9px;
            height: 9px;
            flex: 0 0 9px;
            border-radius: 999px;
            background: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        .connection-pill.is-connected,
        .study-status-pill.is-connected {
            color: #14532d;
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            border-color: #4ade80;
            box-shadow:
                0 12px 28px rgba(34, 197, 94, 0.16),
                inset 0 1px 0 rgba(255, 255, 255, 0.72);
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.45);
        }

        .connection-pill.is-connected::before,
        .study-status-pill.is-connected::before {
            background: #16a34a;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.18);
        }

        .connection-pill.is-connecting,
        .study-status-pill.is-connecting {
            color: #1d4ed8;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-color: #93c5fd;
        }

        .connection-pill.is-connecting::before,
        .study-status-pill.is-connecting::before {
            background: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        .connection-pill.is-error,
        .study-status-pill.is-error,
        .connection-pill.is-disconnected,
        .study-status-pill.is-disconnected {
            color: #991b1b;
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border-color: #fca5a5;
            box-shadow:
                0 12px 28px rgba(239, 68, 68, 0.14),
                inset 0 1px 0 rgba(255, 255, 255, 0.65);
        }

        .connection-pill.is-error::before,
        .study-status-pill.is-error::before,
        .connection-pill.is-disconnected::before,
        .study-status-pill.is-disconnected::before {
            background: #dc2626;
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.16);
        }

        .study-create-btn {
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

        .study-create-btn:hover {
            transform: translateY(-2px);
            filter: brightness(1.03);
            box-shadow:
                0 20px 36px rgba(21, 101, 192, 0.28),
                inset 0 1px 0 rgba(255, 255, 255, 0.28);
        }

        .study-create-icon {
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

        /*
        |--------------------------------------------------------------------------
        | STATS
        |--------------------------------------------------------------------------
        */

        .study-stats {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 22px;
        }

        .study-stat-card {
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

        .study-stat-icon {
            width: 44px;
            height: 44px;
            flex: 0 0 44px;
            display: grid;
            place-items: center;
            border-radius: 17px;
        }

        .study-stat-icon svg {
            width: 22px;
            height: 22px;
            fill: currentColor;
            display: block;
        }

        .study-stat-blue {
            color: #1565C0;
            background: rgba(21, 101, 192, 0.10);
            border: 1px solid rgba(21, 101, 192, 0.12);
        }

        .study-stat-green {
            color: #16a34a;
            background: rgba(22, 163, 74, 0.10);
            border: 1px solid rgba(22, 163, 74, 0.12);
        }

        .study-stat-yellow {
            color: #b77905;
            background: rgba(249, 168, 37, 0.14);
            border: 1px solid rgba(249, 168, 37, 0.18);
        }

        .study-stat-card p {
            margin: 0 0 4px;
            color: #64748b;
            font-size: 0.74rem;
            font-weight: 900;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .study-stat-card strong {
            display: block;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 1.28rem;
            line-height: 1;
            font-weight: 950;
            letter-spacing: -0.045em;
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER PANEL
        |--------------------------------------------------------------------------
        */

        .study-panel {
            overflow: hidden;
            padding: 20px;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(226, 232, 240, 0.95);
            box-shadow:
                0 18px 50px rgba(15, 23, 42, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        .study-panel-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .study-panel-head h3 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 1.08rem;
            line-height: 1.2;
            font-weight: 950;
            letter-spacing: -0.04em;
        }

        .study-panel-head p {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 0.84rem;
            line-height: 1.55;
            font-weight: 650;
        }

        .study-toolbar {
            display: grid;
            grid-template-columns: minmax(260px, 1.45fr) minmax(180px, 0.9fr) minmax(150px, 0.7fr) auto;
            align-items: end;
            gap: 12px;
            margin-top: 18px;
            padding: 0;
            background: transparent;
            border: 0;
        }

        .study-filter-field {
            display: grid;
            gap: 8px;
            min-width: 0;
        }

        .study-filter-field span {
            color: #475569;
            font-size: 0.72rem;
            line-height: 1;
            font-weight: 950;
            letter-spacing: 0.07em;
            text-transform: uppercase;
        }

        .study-input-wrap {
            position: relative;
            min-width: 0;
        }

        .study-input-wrap svg {
            position: absolute;
            top: 50%;
            left: 13px;
            width: 18px;
            height: 18px;
            fill: #94a3b8;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .study-input-wrap input {
            padding-left: 42px !important;
        }

        .study-filter-field input,
        .study-filter-field select {
            width: 100%;
            min-height: 46px;
            border-radius: 16px;
            border: 1px solid #dbe3ee;
            background: #ffffff;
            color: #0f172a;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.035);
            font-size: 0.9rem;
            font-weight: 750;
            outline: none;
            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .study-filter-field input::placeholder {
            color: #94a3b8;
            font-weight: 650;
        }

        .study-filter-field input:focus,
        .study-filter-field select:focus {
            border-color: rgba(21, 101, 192, 0.55);
            box-shadow:
                0 0 0 4px rgba(21, 101, 192, 0.10),
                0 12px 28px rgba(15, 23, 42, 0.05);
        }

        .study-filter-btn {
            min-height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 20px;
            border-radius: 16px;
            color: #0f172a;
            background: linear-gradient(135deg, #F9A825, #ffd966);
            border: 1px solid rgba(249, 168, 37, 0.35);
            box-shadow:
                0 14px 28px rgba(249, 168, 37, 0.20),
                inset 0 1px 0 rgba(255, 255, 255, 0.45);
            font-family: inherit;
            font-size: 0.88rem;
            line-height: 1;
            font-weight: 950;
            cursor: pointer;
            transition:
                transform 0.22s ease,
                box-shadow 0.22s ease,
                filter 0.22s ease;
        }

        .study-filter-btn:hover {
            transform: translateY(-1px);
            filter: brightness(1.02);
            box-shadow:
                0 18px 34px rgba(249, 168, 37, 0.24),
                inset 0 1px 0 rgba(255, 255, 255, 0.48);
        }

        .study-message {
            margin: 13px 0 0;
            font-weight: 800;
        }

        /*
        |--------------------------------------------------------------------------
        | TABLE
        |--------------------------------------------------------------------------
        */

        .study-table-section {
            overflow: hidden;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(226, 232, 240, 0.95);
            box-shadow:
                0 18px 50px rgba(15, 23, 42, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        .study-table-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            padding: 20px 20px 16px;
            border-bottom: 1px solid rgba(226, 232, 240, 0.88);
            background:
                linear-gradient(135deg, rgba(248, 250, 252, 0.95), rgba(255, 255, 255, 0.95));
        }

        .study-table-header h3 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 1.08rem;
            line-height: 1.2;
            font-weight: 950;
            letter-spacing: -0.04em;
        }

        .study-table-header p {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 0.84rem;
            line-height: 1.55;
            font-weight: 650;
        }

        .study-table-badge {
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

        .study-table-wrap {
            margin-top: 0;
            border-radius: 0;
            border: 0;
            box-shadow: none;
            overflow-x: auto;
        }

        .study-table {
            width: 100%;
            min-width: 760px;
            border-collapse: separate;
            border-spacing: 0;
        }

        .study-table thead th {
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

        .study-table tbody td {
            padding: 15px 16px;
            color: #334155;
            border-bottom: 1px solid #edf2f7;
            background: #ffffff;
            font-size: 0.88rem;
            line-height: 1.45;
            font-weight: 700;
            vertical-align: middle;
            white-space: nowrap;
        }

        .study-table tbody tr:hover td {
            background: #fbfdff;
        }

        .study-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .study-table td:nth-child(2) {
            min-width: 220px;
            white-space: normal;
        }

        .study-table td[colspan="6"] {
            padding: 34px 22px;
            color: #64748b;
            text-align: center;
            font-weight: 800;
        }

        .study-loading-state {
            display: grid;
            place-items: center;
            gap: 8px;
            padding: 10px;
        }

        .study-loading-state strong {
            color: #0f172a;
            font-size: 0.95rem;
            font-weight: 950;
        }

        .study-loading-state p {
            margin: 0;
            color: #64748b;
            font-size: 0.84rem;
            font-weight: 650;
        }

        .study-loader {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            border: 4px solid rgba(21, 101, 192, 0.12);
            border-top-color: #1565C0;
            animation: study-spin 0.8s linear infinite;
        }

        @keyframes study-spin {
            to {
                transform: rotate(360deg);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | OPTIONAL BADGES
        |--------------------------------------------------------------------------
        */

        .study-badge {
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

        .study-badge-active,
        .study-badge-rpl {
            color: #15803d;
            background: rgba(34, 197, 94, 0.11);
            border: 1px solid rgba(34, 197, 94, 0.16);
        }

        .study-badge-inactive,
        .study-badge-no-rpl {
            color: #b91c1c;
            background: rgba(239, 68, 68, 0.10);
            border: 1px solid rgba(239, 68, 68, 0.15);
        }

        /*
        |--------------------------------------------------------------------------
        | TABLET
        |--------------------------------------------------------------------------
        */

        @media (max-width: 1100px) {
            .study-hero,
            .study-panel {
                padding: 20px;
            }

            .study-hero-content {
                flex-direction: column;
            }

            .study-header-actions {
                width: 100%;
                justify-content: flex-start;
                flex-wrap: wrap;
            }

            .study-toolbar {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .study-search-field {
                grid-column: 1 / -1;
            }

            .study-filter-btn {
                width: 100%;
            }
        }

        @media (max-width: 900px) {
            .study-stats {
                grid-template-columns: 1fr;
            }

            .study-stat-card {
                padding: 14px;
            }

            .study-create-btn {
                flex: 1;
            }

            .study-status-pill {
                width: fit-content;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | MOBILE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 640px) {
            .study-workspace {
                gap: 14px;
            }

            .study-hero,
            .study-panel,
            .study-table-section {
                border-radius: 24px;
            }

            .study-hero,
            .study-panel {
                padding: 16px;
            }

            .study-hero h2 {
                font-size: 1.55rem;
                letter-spacing: -0.055em;
            }

            .study-subtitle {
                font-size: 0.84rem;
                line-height: 1.62;
            }

            .study-header-actions {
                display: grid;
                grid-template-columns: 1fr;
            }

            .study-status-pill,
            .study-create-btn {
                width: 100%;
            }

            .study-stats {
                margin-top: 18px;
            }

            .study-toolbar {
                grid-template-columns: 1fr;
                gap: 11px;
            }

            .study-search-field {
                grid-column: auto;
            }

            .study-panel-head,
            .study-table-header {
                display: grid;
            }

            .study-table-header {
                padding: 16px;
            }

            .study-table-badge {
                width: fit-content;
            }

            .study-filter-field span {
                font-size: 0.68rem;
            }

            .study-filter-field input,
            .study-filter-field select,
            .study-filter-btn {
                min-height: 44px;
                border-radius: 15px;
            }

            .study-table th,
            .study-table td {
                padding: 12px 13px;
                font-size: 0.78rem;
            }
        }

        @media (max-width: 420px) {
            .study-hero,
            .study-panel {
                padding: 14px;
            }

            .study-stat-card {
                align-items: flex-start;
            }

            .study-stat-icon {
                width: 40px;
                height: 40px;
                flex-basis: 40px;
                border-radius: 15px;
            }

            .study-stat-card strong {
                font-size: 1.12rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const body = document.querySelector('[data-study-programs-body]');
            const totalTarget = document.querySelector('[data-study-total]');
            const activeTarget = document.querySelector('[data-study-active]');
            const rplTarget = document.querySelector('[data-study-rpl]');
            const apiStatus = document.querySelector('[data-api-status]');

            function normalizeText(value) {
                return String(value || '').trim().toLowerCase();
            }

            function readProgramsFromTable() {
                if (!body) return [];

                const rows = Array.from(body.querySelectorAll('tr'));

                return rows
                    .filter(function (row) {
                        return !row.querySelector('td[colspan]');
                    })
                    .map(function (row) {
                        const cells = Array.from(row.querySelectorAll('td'));

                        return {
                            rpl: normalizeText(cells[3] ? cells[3].textContent : ''),
                            status: normalizeText(cells[4] ? cells[4].textContent : '')
                        };
                    });
            }

            function refreshStudyStats() {
                const programs = readProgramsFromTable();

                if (!programs.length) {
                    if (totalTarget) totalTarget.textContent = '—';
                    if (activeTarget) activeTarget.textContent = '—';
                    if (rplTarget) rplTarget.textContent = '—';
                    return;
                }

                const total = programs.length;

                const active = programs.filter(function (program) {
                    return program.status.includes('active') && !program.status.includes('inactive');
                }).length;

                const rpl = programs.filter(function (program) {
                    return (
                        program.rpl.includes('yes') ||
                        program.rpl.includes('supported') ||
                        program.rpl.includes('aktif') ||
                        program.rpl.includes('active') ||
                        program.rpl.includes('true') ||
                        program.rpl.includes('iya')
                    );
                }).length;

                if (totalTarget) totalTarget.textContent = total;
                if (activeTarget) activeTarget.textContent = active;
                if (rplTarget) rplTarget.textContent = rpl;
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
                const observer = new MutationObserver(refreshStudyStats);

                observer.observe(body, {
                    childList: true,
                    subtree: true,
                    characterData: true
                });

                refreshStudyStats();
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