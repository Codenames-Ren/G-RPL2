@extends('layouts.app')

@section('title', 'Courses - G-RPL')
@section('page', 'courses')
@section('authRequired', 'true')
@section('roleRequired', 'system_admin')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <x-admin-sidebar />

        <div class="workspace courses-workspace">
            <div class="courses-hero">
                <div class="courses-hero-content">
                    <div>
                        <p class="eyebrow courses-eyebrow">Course Management</p>
                        <h2>Daftar Mata Kuliah</h2>
                        <p class="courses-subtitle">
                            Kelola data mata kuliah, program studi, semester, SKS, tipe rekognisi,
                            dan status aktif mata kuliah dengan tampilan yang lebih rapi dan mudah dipantau.
                        </p>
                    </div>

                    <div class="courses-header-actions">
                        <span class="connection-pill courses-status-pill" data-api-status>Connecting</span>

                        <a href="/admin/courses/create" class="courses-create-btn">
                            <span class="courses-create-icon">+</span>
                            <span>Tambah Matakuliah</span>
                        </a>
                    </div>
                </div>

                <div class="courses-stats">
                    <div class="courses-stat-card">
                        <span class="courses-stat-icon courses-stat-blue">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M18 2H7c-1.66 0-3 1.34-3 3v14c0 1.66 1.34 3 3 3h11c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2Zm0 16H7c-.55 0-1 .45-1 1s.45 1 1 1h11v-2Zm0-2H7c-.35 0-.69.06-1 .17V5c0-.55.45-1 1-1h11v12Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Total Data</p>
                            <strong data-courses-total>—</strong>
                        </div>
                    </div>

                    <div class="courses-stat-card">
                        <span class="courses-stat-icon courses-stat-green">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M9 16.17 4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Active</p>
                            <strong data-courses-active>—</strong>
                        </div>
                    </div>

                    <div class="courses-stat-card">
                        <span class="courses-stat-icon courses-stat-yellow">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3 1 9l11 6 9-4.91V17h2V9L12 3Zm0 14L5 13.18V16c0 2 4.66 4 7 4s7-2 7-4v-2.82L12 17Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Program Studi</p>
                            <strong data-courses-programs>—</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="courses-panel">
                <div class="courses-panel-head">
                    <div>
                        <h3>Filter Mata Kuliah</h3>
                        <p>Gunakan filter untuk mencari data berdasarkan kode, nama, program studi, atau status.</p>
                    </div>
                </div>

                <form class="toolbar courses-toolbar" data-admin-filter="courses">
                    <label class="courses-filter-field courses-search-field">
                        <span>Cari Mata Kuliah</span>

                        <div class="courses-input-wrap">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M9.5 3a6.5 6.5 0 0 1 5.17 10.44l4.45 4.44-1.41 1.41-4.44-4.45A6.5 6.5 0 1 1 9.5 3Zm0 2a4.5 4.5 0 1 0 0 9 4.5 4.5 0 0 0 0-9Z"/>
                            </svg>

                            <input
                                type="search"
                                name="search"
                                placeholder="Cari kode atau nama mata kuliah"
                            >
                        </div>
                    </label>

                    <label class="courses-filter-field">
                        <span>Program Studi</span>
                        <select name="study_program_id" data-study-program-filter>
                            <option value="">Semua program studi</option>
                        </select>
                    </label>

                    <label class="courses-filter-field">
                        <span>Status</span>
                        <select name="is_active">
                            <option value="">Semua status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </label>

                    <button class="courses-filter-btn" type="submit">
                        <span>Filter</span>
                    </button>
                </form>

                <p class="form-message courses-message" data-page-message aria-live="polite"></p>
            </div>

            <div class="courses-table-section">
                <div class="courses-table-header">
                    <div>
                        <h3>Data Mata Kuliah</h3>
                        <p>Daftar seluruh mata kuliah yang tersedia di sistem G-RPL.</p>
                    </div>

                    <span class="courses-table-badge">List Matakuliah</span>
                </div>

                <div class="table-wrap courses-table-wrap">
                    <table class="data-table courses-table">
                        <thead>
                            <tr>
                                <th>Kode MK</th>
                                <th>Nama MK</th>
                                <th>Program Studi</th>
                                <th>Semester</th>
                                <th>SKS</th>
                                <th>Tipe</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody data-courses-body>
                            <tr>
                                <td colspan="8">
                                    <div class="courses-loading-state">
                                        <span class="courses-loader"></span>
                                        <strong>Memuat mata kuliah...</strong>
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
        | COURSES PAGE - PREMIUM ADMIN STYLE
        |--------------------------------------------------------------------------
        */

        .courses-workspace,
        .courses-workspace * {
            box-sizing: border-box;
        }

        .courses-workspace {
            position: relative;
            display: grid;
            gap: 18px;
            min-width: 0;
        }

        .courses-hero {
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

        .courses-hero::before {
            content: "";
            position: absolute;
            inset: 0 0 auto;
            height: 5px;
            background: linear-gradient(90deg, #1565C0, #F9A825, #E53935);
        }

        .courses-hero::after {
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

        .courses-hero-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 22px;
        }

        .courses-eyebrow {
            margin-bottom: 8px;
            color: #1565C0;
        }

        .courses-hero h2 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: clamp(1.65rem, 3vw, 2.45rem);
            line-height: 1.08;
            font-weight: 950;
            letter-spacing: -0.065em;
        }

        .courses-subtitle {
            max-width: 760px;
            margin: 10px 0 0;
            color: #64748b;
            font-size: 0.94rem;
            line-height: 1.72;
            font-weight: 650;
        }

        .courses-header-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            flex-shrink: 0;
        }

        /*
        |--------------------------------------------------------------------------
        | STATUS PILL - FIX CONNECTED BIAR JELAS
        |--------------------------------------------------------------------------
        */

        .connection-pill,
        .courses-status-pill {
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
        .courses-status-pill::before {
            content: "";
            width: 9px;
            height: 9px;
            flex: 0 0 9px;
            border-radius: 999px;
            background: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        .connection-pill.is-connected,
        .courses-status-pill.is-connected {
            color: #14532d;
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            border-color: #4ade80;
            box-shadow:
                0 12px 28px rgba(34, 197, 94, 0.16),
                inset 0 1px 0 rgba(255, 255, 255, 0.72);
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.45);
        }

        .connection-pill.is-connected::before,
        .courses-status-pill.is-connected::before {
            background: #16a34a;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.18);
        }

        .connection-pill.is-connecting,
        .courses-status-pill.is-connecting {
            color: #1d4ed8;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-color: #93c5fd;
        }

        .connection-pill.is-connecting::before,
        .courses-status-pill.is-connecting::before {
            background: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        .connection-pill.is-error,
        .courses-status-pill.is-error,
        .connection-pill.is-disconnected,
        .courses-status-pill.is-disconnected {
            color: #991b1b;
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border-color: #fca5a5;
            box-shadow:
                0 12px 28px rgba(239, 68, 68, 0.14),
                inset 0 1px 0 rgba(255, 255, 255, 0.65);
        }

        .connection-pill.is-error::before,
        .courses-status-pill.is-error::before,
        .connection-pill.is-disconnected::before,
        .courses-status-pill.is-disconnected::before {
            background: #dc2626;
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.16);
        }

        .courses-create-btn {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 0 16px;
            border-radius: 999px;
            color: #ffffff;
            background:
                linear-gradient(135deg, #1565C0 0%, #0f4fa3 100%);
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

        .courses-create-btn:hover {
            transform: translateY(-2px);
            filter: brightness(1.03);
            box-shadow:
                0 20px 36px rgba(21, 101, 192, 0.28),
                inset 0 1px 0 rgba(255, 255, 255, 0.28);
        }

        .courses-create-icon {
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

        .courses-stats {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 22px;
        }

        .courses-stat-card {
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

        .courses-stat-icon {
            width: 44px;
            height: 44px;
            flex: 0 0 44px;
            display: grid;
            place-items: center;
            border-radius: 17px;
        }

        .courses-stat-icon svg {
            width: 22px;
            height: 22px;
            fill: currentColor;
            display: block;
        }

        .courses-stat-blue {
            color: #1565C0;
            background: rgba(21, 101, 192, 0.10);
            border: 1px solid rgba(21, 101, 192, 0.12);
        }

        .courses-stat-green {
            color: #16a34a;
            background: rgba(22, 163, 74, 0.10);
            border: 1px solid rgba(22, 163, 74, 0.12);
        }

        .courses-stat-yellow {
            color: #b77905;
            background: rgba(249, 168, 37, 0.14);
            border: 1px solid rgba(249, 168, 37, 0.18);
        }

        .courses-stat-card p {
            margin: 0 0 4px;
            color: #64748b;
            font-size: 0.74rem;
            font-weight: 900;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .courses-stat-card strong {
            display: block;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 1.28rem;
            line-height: 1;
            font-weight: 950;
            letter-spacing: -0.045em;
        }

        .courses-panel,
        .courses-table-section {
            overflow: hidden;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(226, 232, 240, 0.95);
            box-shadow:
                0 18px 50px rgba(15, 23, 42, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        .courses-panel {
            padding: 20px;
        }

        .courses-panel-head,
        .courses-table-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .courses-panel-head h3,
        .courses-table-header h3 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 1.08rem;
            line-height: 1.2;
            font-weight: 950;
            letter-spacing: -0.04em;
        }

        .courses-panel-head p,
        .courses-table-header p {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 0.84rem;
            line-height: 1.55;
            font-weight: 650;
        }

        .courses-toolbar {
            display: grid;
            grid-template-columns: minmax(260px, 1.45fr) minmax(180px, 0.9fr) minmax(150px, 0.7fr) auto;
            align-items: end;
            gap: 12px;
            margin-top: 18px;
            padding: 0;
            background: transparent;
            border: 0;
        }

        .courses-filter-field {
            display: grid;
            gap: 8px;
            min-width: 0;
        }

        .courses-filter-field span {
            color: #475569;
            font-size: 0.72rem;
            line-height: 1;
            font-weight: 950;
            letter-spacing: 0.07em;
            text-transform: uppercase;
        }

        .courses-input-wrap {
            position: relative;
            min-width: 0;
        }

        .courses-input-wrap svg {
            position: absolute;
            top: 50%;
            left: 13px;
            width: 18px;
            height: 18px;
            fill: #94a3b8;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .courses-input-wrap input {
            padding-left: 42px !important;
        }

        .courses-filter-field input,
        .courses-filter-field select {
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

        .courses-filter-field input::placeholder {
            color: #94a3b8;
            font-weight: 650;
        }

        .courses-filter-field input:focus,
        .courses-filter-field select:focus {
            border-color: rgba(21, 101, 192, 0.55);
            box-shadow:
                0 0 0 4px rgba(21, 101, 192, 0.10),
                0 12px 28px rgba(15, 23, 42, 0.05);
        }

        .courses-filter-btn {
            min-height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 20px;
            border-radius: 16px;
            color: #0f172a;
            background:
                linear-gradient(135deg, #F9A825, #ffd966);
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

        .courses-filter-btn:hover {
            transform: translateY(-1px);
            filter: brightness(1.02);
            box-shadow:
                0 18px 34px rgba(249, 168, 37, 0.24),
                inset 0 1px 0 rgba(255, 255, 255, 0.48);
        }

        .courses-message {
            margin: 13px 0 0;
            font-weight: 800;
        }

        .courses-table-section {
            padding: 0;
        }

        .courses-table-header {
            padding: 20px 20px 16px;
            border-bottom: 1px solid rgba(226, 232, 240, 0.88);
            background:
                linear-gradient(135deg, rgba(248, 250, 252, 0.95), rgba(255, 255, 255, 0.95));
        }

        .courses-table-badge {
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

        .courses-table-wrap {
            margin-top: 0;
            border-radius: 0;
            border: 0;
            box-shadow: none;
            overflow-x: auto;
        }

        .courses-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 860px;
        }

        .courses-table thead th {
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

        .courses-table tbody td {
            padding: 15px 16px;
            color: #334155;
            border-bottom: 1px solid #edf2f7;
            background: #ffffff;
            font-size: 0.88rem;
            line-height: 1.45;
            font-weight: 700;
            vertical-align: middle;
        }

        .courses-table tbody tr:hover td {
            background: #fbfdff;
        }

        .courses-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .courses-table td[colspan="8"] {
            padding: 34px 22px;
            color: #64748b;
            text-align: center;
            font-weight: 800;
        }

        .courses-loading-state {
            display: grid;
            place-items: center;
            gap: 8px;
            padding: 10px;
        }

        .courses-loading-state strong {
            color: #0f172a;
            font-size: 0.95rem;
            font-weight: 950;
        }

        .courses-loading-state p {
            margin: 0;
            color: #64748b;
            font-size: 0.84rem;
            font-weight: 650;
        }

        .courses-loader {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            border: 4px solid rgba(21, 101, 192, 0.12);
            border-top-color: #1565C0;
            animation: courses-spin 0.8s linear infinite;
        }

        @keyframes courses-spin {
            to {
                transform: rotate(360deg);
            }
        }

        .courses-badge {
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

        .courses-badge-active {
            color: #15803d;
            background: rgba(34, 197, 94, 0.11);
            border: 1px solid rgba(34, 197, 94, 0.16);
        }

        .courses-badge-inactive {
            color: #b91c1c;
            background: rgba(239, 68, 68, 0.10);
            border: 1px solid rgba(239, 68, 68, 0.15);
        }

        .courses-badge-type {
            color: #1565C0;
            background: rgba(21, 101, 192, 0.08);
            border: 1px solid rgba(21, 101, 192, 0.12);
        }

        @media (max-width: 1100px) {
            .courses-hero,
            .courses-panel {
                padding: 20px;
            }

            .courses-hero-content {
                flex-direction: column;
            }

            .courses-header-actions {
                width: 100%;
                justify-content: flex-start;
                flex-wrap: wrap;
            }

            .courses-toolbar {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .courses-search-field {
                grid-column: 1 / -1;
            }

            .courses-filter-btn {
                width: 100%;
            }
        }

        @media (max-width: 900px) {
            .courses-stats {
                grid-template-columns: 1fr;
            }

            .courses-stat-card {
                padding: 14px;
            }

            .courses-create-btn {
                flex: 1;
            }

            .courses-status-pill {
                width: fit-content;
            }
        }

        @media (max-width: 640px) {
            .courses-workspace {
                gap: 14px;
            }

            .courses-hero,
            .courses-panel,
            .courses-table-section {
                border-radius: 24px;
            }

            .courses-hero,
            .courses-panel {
                padding: 16px;
            }

            .courses-hero h2 {
                font-size: 1.55rem;
                letter-spacing: -0.055em;
            }

            .courses-subtitle {
                font-size: 0.84rem;
                line-height: 1.62;
            }

            .courses-header-actions {
                display: grid;
                grid-template-columns: 1fr;
            }

            .courses-status-pill,
            .courses-create-btn {
                width: 100%;
            }

            .courses-stats {
                margin-top: 18px;
            }

            .courses-toolbar {
                grid-template-columns: 1fr;
                gap: 11px;
            }

            .courses-search-field {
                grid-column: auto;
            }

            .courses-panel-head,
            .courses-table-header {
                display: grid;
            }

            .courses-table-header {
                padding: 16px;
            }

            .courses-table-badge {
                width: fit-content;
            }

            .courses-filter-field span {
                font-size: 0.68rem;
            }

            .courses-filter-field input,
            .courses-filter-field select,
            .courses-filter-btn {
                min-height: 44px;
                border-radius: 15px;
            }
        }

        @media (max-width: 420px) {
            .courses-hero,
            .courses-panel {
                padding: 14px;
            }

            .courses-stat-card {
                align-items: flex-start;
            }

            .courses-stat-icon {
                width: 40px;
                height: 40px;
                flex-basis: 40px;
                border-radius: 15px;
            }

            .courses-stat-card strong {
                font-size: 1.12rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const body = document.querySelector('[data-courses-body]');
            const totalTarget = document.querySelector('[data-courses-total]');
            const activeTarget = document.querySelector('[data-courses-active]');
            const programsTarget = document.querySelector('[data-courses-programs]');
            const apiStatus = document.querySelector('[data-api-status]');

            function normalizeText(value) {
                return String(value || '').trim().toLowerCase();
            }

            function readCoursesFromTable() {
                if (!body) return [];

                const rows = Array.from(body.querySelectorAll('tr'));

                return rows
                    .filter(function (row) {
                        return !row.querySelector('td[colspan]');
                    })
                    .map(function (row) {
                        const cells = Array.from(row.querySelectorAll('td'));

                        return {
                            program: normalizeText(cells[2] ? cells[2].textContent : ''),
                            status: normalizeText(cells[6] ? cells[6].textContent : '')
                        };
                    });
            }

            function refreshCourseStats() {
                const courses = readCoursesFromTable();

                if (!courses.length) {
                    if (totalTarget) totalTarget.textContent = '—';
                    if (activeTarget) activeTarget.textContent = '—';
                    if (programsTarget) programsTarget.textContent = '—';
                    return;
                }

                const total = courses.length;
                const active = courses.filter(function (course) {
                    return course.status.includes('active') && !course.status.includes('inactive');
                }).length;

                const programs = new Set(
                    courses
                        .map(function (course) {
                            return course.program;
                        })
                        .filter(Boolean)
                ).size;

                if (totalTarget) totalTarget.textContent = total;
                if (activeTarget) activeTarget.textContent = active;
                if (programsTarget) programsTarget.textContent = programs;
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
                const observer = new MutationObserver(refreshCourseStats);

                observer.observe(body, {
                    childList: true,
                    subtree: true,
                    characterData: true
                });

                refreshCourseStats();
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