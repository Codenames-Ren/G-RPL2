@extends('layouts.app')

@section('title', 'Users - G-RPL')
@section('page', 'users')
@section('authRequired', 'true')
@section('roleRequired', 'system_admin')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <x-admin-sidebar />

        <div class="workspace users-workspace">
            <div class="users-hero">
                <div class="users-hero-content">
                    <div>
                        <p class="eyebrow users-eyebrow">User Management</p>
                        <h2>Manajemen Data Pengguna Internal</h2>
                        <p class="users-subtitle">
                            Kelola akun internal sistem G-RPL, mulai dari assessor, staff RPL,
                            committee, status akun, dan data identitas pengguna.
                        </p>
                    </div>

                    <div class="users-header-actions">
                        <span class="connection-pill users-status-pill" data-api-status>Connecting</span>

                        <a href="/admin/users/create" class="users-create-btn">
                            <span class="users-create-icon">+</span>
                            <span>Create User</span>
                        </a>
                    </div>
                </div>

                <div class="users-stats">
                    <div class="users-stat-card">
                        <span class="users-stat-icon users-stat-blue">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M16 11c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3ZM8 11c1.66 0 3-1.34 3-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3Zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 10.33 13 8 13Zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Total User</p>
                            <strong data-users-total>—</strong>
                        </div>
                    </div>

                    <div class="users-stat-card">
                        <span class="users-stat-icon users-stat-green">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M9 16.17 4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Active</p>
                            <strong data-users-active>—</strong>
                        </div>
                    </div>

                    <div class="users-stat-card">
                        <span class="users-stat-icon users-stat-yellow">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 1 3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4Zm0 2.18 7 3.11V11c0 4.52-2.98 8.69-7 9.93C7.98 19.69 5 15.52 5 11V6.29l7-3.11Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Role Type</p>
                            <strong data-users-roles>—</strong>
                        </div>
                    </div>
                </div>
            </div>


            <div class="users-panel">
                <div class="users-panel-head">
                    <div>
                        <h3>Filter User</h3>
                        <p>Cari user berdasarkan nama, email, role, atau status akun.</p>
                    </div>
                </div>

                <form class="toolbar users-toolbar" data-admin-filter="users">
                    <label class="users-filter-field users-search-field">
                        <span>Cari User</span>

                        <div class="users-input-wrap">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M9.5 3a6.5 6.5 0 0 1 5.17 10.44l4.45 4.44-1.41 1.41-4.44-4.45A6.5 6.5 0 1 1 9.5 3Zm0 2a4.5 4.5 0 1 0 0 9 4.5 4.5 0 0 0 0-9Z"/>
                            </svg>

                            <input
                                type="search"
                                name="search"
                                placeholder="Cari nama atau email"
                            >
                        </div>
                    </label>

                    <label class="users-filter-field">
                        <span>Role</span>
                        <select name="role">
                            <option value="">Semua role</option>
                            <option value="assessor">Assessor</option>
                            <option value="staff_rpl">Staff RPL</option>
                            <option value="committee">Committee</option>
                        </select>
                    </label>

                    <label class="users-filter-field">
                        <span>Status</span>
                        <select name="is_active">
                            <option value="">Semua status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </label>

                    <button class="users-filter-btn" type="submit">
                        <span>Filter</span>
                    </button>
                </form>

                <p class="form-message users-message" data-page-message aria-live="polite"></p>
            </div>

            <div class="users-table-section">
                <div class="users-table-header">
                    <div>
                        <h3>Data User Internal</h3>
                        <p>Daftar seluruh user internal yang terdaftar di sistem G-RPL.</p>
                    </div>

                    <span class="users-table-badge">User List</span>
                </div>

                <div class="table-wrap users-table-wrap">
                    <table class="data-table users-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>NIP</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody data-users-body>
                            <tr>
                                <td colspan="6">
                                    <div class="users-loading-state">
                                        <span class="users-loader"></span>
                                        <strong>Memuat user...</strong>
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
        | USERS PAGE - PREMIUM ADMIN STYLE
        |--------------------------------------------------------------------------
        */

        .users-workspace,
        .users-workspace * {
            box-sizing: border-box;
        }

        .users-workspace {
            position: relative;
            display: grid;
            gap: 18px;
            min-width: 0;
        }

        .users-hero {
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

        .users-hero::before {
            content: "";
            position: absolute;
            inset: 0 0 auto;
            height: 5px;
            background: linear-gradient(90deg, #1565C0, #F9A825, #E53935);
        }

        .users-hero::after {
            content: "";
            position: absolute;
            width: 170px;
            height: 170px;
            right: -72px;
            bottom: -84px;
            border-radius: 999px;
            background: rgba(21, 101, 192, 0.08);
            pointer-events: none;
        }

        .users-hero-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 22px;
        }

        .users-eyebrow {
            margin-bottom: 8px;
            color: #1565C0;
        }

        .users-hero h2 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: clamp(1.65rem, 3vw, 2.45rem);
            line-height: 1.08;
            font-weight: 950;
            letter-spacing: -0.065em;
        }

        .users-subtitle {
            max-width: 760px;
            margin: 10px 0 0;
            color: #64748b;
            font-size: 0.94rem;
            line-height: 1.72;
            font-weight: 650;
        }

        .users-header-actions {
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
        .users-status-pill {
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
        .users-status-pill::before {
            content: "";
            width: 9px;
            height: 9px;
            flex: 0 0 9px;
            border-radius: 999px;
            background: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        .connection-pill.is-connected,
        .users-status-pill.is-connected {
            color: #14532d;
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            border-color: #4ade80;
            box-shadow:
                0 12px 28px rgba(34, 197, 94, 0.16),
                inset 0 1px 0 rgba(255, 255, 255, 0.72);
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.45);
        }

        .connection-pill.is-connected::before,
        .users-status-pill.is-connected::before {
            background: #16a34a;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.18);
        }

        .connection-pill.is-connecting,
        .users-status-pill.is-connecting {
            color: #1d4ed8;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-color: #93c5fd;
        }

        .connection-pill.is-connecting::before,
        .users-status-pill.is-connecting::before {
            background: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        .connection-pill.is-error,
        .users-status-pill.is-error,
        .connection-pill.is-disconnected,
        .users-status-pill.is-disconnected {
            color: #991b1b;
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border-color: #fca5a5;
            box-shadow:
                0 12px 28px rgba(239, 68, 68, 0.14),
                inset 0 1px 0 rgba(255, 255, 255, 0.65);
        }

        .connection-pill.is-error::before,
        .users-status-pill.is-error::before,
        .connection-pill.is-disconnected::before,
        .users-status-pill.is-disconnected::before {
            background: #dc2626;
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.16);
        }

        .users-create-btn {
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

        .users-create-btn:hover {
            transform: translateY(-2px);
            filter: brightness(1.03);
            box-shadow:
                0 20px 36px rgba(21, 101, 192, 0.28),
                inset 0 1px 0 rgba(255, 255, 255, 0.28);
        }

        .users-create-icon {
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

        .users-stats {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 22px;
        }

        .users-stat-card {
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

        .users-stat-icon {
            width: 44px;
            height: 44px;
            flex: 0 0 44px;
            display: grid;
            place-items: center;
            border-radius: 17px;
        }

        .users-stat-icon svg {
            width: 22px;
            height: 22px;
            fill: currentColor;
            display: block;
        }

        .users-stat-blue {
            color: #1565C0;
            background: rgba(21, 101, 192, 0.10);
            border: 1px solid rgba(21, 101, 192, 0.12);
        }

        .users-stat-green {
            color: #16a34a;
            background: rgba(22, 163, 74, 0.10);
            border: 1px solid rgba(22, 163, 74, 0.12);
        }

        .users-stat-yellow {
            color: #b77905;
            background: rgba(249, 168, 37, 0.14);
            border: 1px solid rgba(249, 168, 37, 0.18);
        }

        .users-stat-card p {
            margin: 0 0 4px;
            color: #64748b;
            font-size: 0.74rem;
            font-weight: 900;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .users-stat-card strong {
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
        | INFO CARD
        |--------------------------------------------------------------------------
        */

        .users-info-card {
            position: relative;
            display: grid;
            grid-template-columns: minmax(0, 1fr) 130px;
            gap: 20px;
            align-items: center;
            padding: 24px;
            border-radius: 28px;
            border: 1px solid rgba(226, 232, 240, 0.95);
            background:
                radial-gradient(circle at 95% 0%, rgba(249, 168, 37, 0.14), transparent 32%),
                radial-gradient(circle at 0% 100%, rgba(21, 101, 192, 0.08), transparent 34%),
                linear-gradient(135deg, rgba(255, 255, 255, 0.98), rgba(248, 250, 252, 0.94));
            box-shadow:
                0 18px 50px rgba(15, 23, 42, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            overflow: hidden;
        }

        .users-info-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #1565C0;
            font-size: 0.72rem;
            font-weight: 950;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .users-info-badge::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 999px;
            background: #1565C0;
            box-shadow: 0 0 0 4px rgba(21, 101, 192, 0.10);
        }

        .users-info-card h3 {
            margin: 10px 0 8px;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 1.45rem;
            line-height: 1.2;
            font-weight: 950;
            letter-spacing: -0.05em;
        }

        .users-info-card p {
            max-width: 720px;
            margin: 0;
            color: #64748b;
            font-size: 0.92rem;
            line-height: 1.7;
            font-weight: 650;
        }

        .users-info-icon {
            width: 82px;
            height: 82px;
            justify-self: center;
            display: grid;
            place-items: center;
            border-radius: 28px;
            color: #ffffff;
            background: linear-gradient(135deg, #176bd8, #0d55b8);
            box-shadow: 0 20px 42px rgba(21, 101, 192, 0.24);
        }

        .users-info-icon svg {
            width: 40px;
            height: 40px;
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER PANEL
        |--------------------------------------------------------------------------
        */

        .users-panel {
            overflow: hidden;
            padding: 20px;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(226, 232, 240, 0.95);
            box-shadow:
                0 18px 50px rgba(15, 23, 42, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        .users-panel-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .users-panel-head h3 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 1.08rem;
            line-height: 1.2;
            font-weight: 950;
            letter-spacing: -0.04em;
        }

        .users-panel-head p {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 0.84rem;
            line-height: 1.55;
            font-weight: 650;
        }

        .users-toolbar {
            display: grid;
            grid-template-columns: minmax(260px, 1.45fr) minmax(170px, 0.8fr) minmax(150px, 0.7fr) auto;
            align-items: end;
            gap: 12px;
            margin-top: 18px;
            padding: 0;
            background: transparent;
            border: 0;
        }

        .users-filter-field {
            display: grid;
            gap: 8px;
            min-width: 0;
        }

        .users-filter-field span {
            color: #475569;
            font-size: 0.72rem;
            line-height: 1;
            font-weight: 950;
            letter-spacing: 0.07em;
            text-transform: uppercase;
        }

        .users-input-wrap {
            position: relative;
            min-width: 0;
        }

        .users-input-wrap svg {
            position: absolute;
            top: 50%;
            left: 13px;
            width: 18px;
            height: 18px;
            fill: #94a3b8;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .users-input-wrap input {
            padding-left: 42px !important;
        }

        .users-filter-field input,
        .users-filter-field select {
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

        .users-filter-field input::placeholder {
            color: #94a3b8;
            font-weight: 650;
        }

        .users-filter-field input:focus,
        .users-filter-field select:focus {
            border-color: rgba(21, 101, 192, 0.55);
            box-shadow:
                0 0 0 4px rgba(21, 101, 192, 0.10),
                0 12px 28px rgba(15, 23, 42, 0.05);
        }

        .users-filter-btn {
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

        .users-filter-btn:hover {
            transform: translateY(-1px);
            filter: brightness(1.02);
            box-shadow:
                0 18px 34px rgba(249, 168, 37, 0.24),
                inset 0 1px 0 rgba(255, 255, 255, 0.48);
        }

        .users-message {
            margin: 13px 0 0;
            font-weight: 800;
        }

        /*
        |--------------------------------------------------------------------------
        | TABLE
        |--------------------------------------------------------------------------
        */

        .users-table-section {
            overflow: hidden;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(226, 232, 240, 0.95);
            box-shadow:
                0 18px 50px rgba(15, 23, 42, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        .users-table-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            padding: 20px 20px 16px;
            border-bottom: 1px solid rgba(226, 232, 240, 0.88);
            background:
                linear-gradient(135deg, rgba(248, 250, 252, 0.95), rgba(255, 255, 255, 0.95));
        }

        .users-table-header h3 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 1.08rem;
            line-height: 1.2;
            font-weight: 950;
            letter-spacing: -0.04em;
        }

        .users-table-header p {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 0.84rem;
            line-height: 1.55;
            font-weight: 650;
        }

        .users-table-badge {
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

        .users-table-wrap {
            margin-top: 0;
            border-radius: 0;
            border: 0;
            box-shadow: none;
            overflow-x: auto;
        }

        .users-table {
            width: 100%;
            min-width: 820px;
            border-collapse: separate;
            border-spacing: 0;
        }

        .users-table thead th {
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

        .users-table tbody td {
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

        .users-table tbody tr:hover td {
            background: #fbfdff;
        }

        .users-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .users-table td:nth-child(1),
        .users-table td:nth-child(2) {
            min-width: 200px;
            white-space: normal;
        }

        .users-table td[colspan="6"] {
            padding: 34px 22px;
            color: #64748b;
            text-align: center;
            font-weight: 800;
        }

        .users-loading-state {
            display: grid;
            place-items: center;
            gap: 8px;
            padding: 10px;
        }

        .users-loading-state strong {
            color: #0f172a;
            font-size: 0.95rem;
            font-weight: 950;
        }

        .users-loading-state p {
            margin: 0;
            color: #64748b;
            font-size: 0.84rem;
            font-weight: 650;
        }

        .users-loader {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            border: 4px solid rgba(21, 101, 192, 0.12);
            border-top-color: #1565C0;
            animation: users-spin 0.8s linear infinite;
        }

        @keyframes users-spin {
            to {
                transform: rotate(360deg);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | OPTIONAL BADGES
        |--------------------------------------------------------------------------
        */

        .users-badge {
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

        .users-badge-active {
            color: #15803d;
            background: rgba(34, 197, 94, 0.11);
            border: 1px solid rgba(34, 197, 94, 0.16);
        }

        .users-badge-inactive {
            color: #b91c1c;
            background: rgba(239, 68, 68, 0.10);
            border: 1px solid rgba(239, 68, 68, 0.15);
        }

        .users-badge-role {
            color: #1565C0;
            background: rgba(21, 101, 192, 0.08);
            border: 1px solid rgba(21, 101, 192, 0.12);
        }

        /*
        |--------------------------------------------------------------------------
        | TABLET
        |--------------------------------------------------------------------------
        */

        @media (max-width: 1100px) {
            .users-hero,
            .users-info-card,
            .users-panel {
                padding: 20px;
            }

            .users-hero-content {
                flex-direction: column;
            }

            .users-header-actions {
                width: 100%;
                justify-content: flex-start;
                flex-wrap: wrap;
            }

            .users-toolbar {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .users-search-field {
                grid-column: 1 / -1;
            }

            .users-filter-btn {
                width: 100%;
            }
        }

        @media (max-width: 900px) {
            .users-stats {
                grid-template-columns: 1fr;
            }

            .users-stat-card {
                padding: 14px;
            }

            .users-create-btn {
                flex: 1;
            }

            .users-status-pill {
                width: fit-content;
            }

            .users-info-card {
                grid-template-columns: 1fr;
            }

            .users-info-icon {
                display: none;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | MOBILE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 640px) {
            .users-workspace {
                gap: 14px;
            }

            .users-hero,
            .users-info-card,
            .users-panel,
            .users-table-section {
                border-radius: 24px;
            }

            .users-hero,
            .users-info-card,
            .users-panel {
                padding: 16px;
            }

            .users-hero h2 {
                font-size: 1.55rem;
                letter-spacing: -0.055em;
            }

            .users-subtitle,
            .users-info-card p {
                font-size: 0.84rem;
                line-height: 1.62;
            }

            .users-header-actions {
                display: grid;
                grid-template-columns: 1fr;
            }

            .users-status-pill,
            .users-create-btn {
                width: 100%;
            }

            .users-stats {
                margin-top: 18px;
            }

            .users-info-card h3 {
                font-size: 1.25rem;
            }

            .users-toolbar {
                grid-template-columns: 1fr;
                gap: 11px;
            }

            .users-search-field {
                grid-column: auto;
            }

            .users-panel-head,
            .users-table-header {
                display: grid;
            }

            .users-table-header {
                padding: 16px;
            }

            .users-table-badge {
                width: fit-content;
            }

            .users-filter-field span {
                font-size: 0.68rem;
            }

            .users-filter-field input,
            .users-filter-field select,
            .users-filter-btn {
                min-height: 44px;
                border-radius: 15px;
            }

            .users-table th,
            .users-table td {
                padding: 12px 13px;
                font-size: 0.78rem;
            }
        }

        @media (max-width: 420px) {
            .users-hero,
            .users-info-card,
            .users-panel {
                padding: 14px;
            }

            .users-stat-card {
                align-items: flex-start;
            }

            .users-stat-icon {
                width: 40px;
                height: 40px;
                flex-basis: 40px;
                border-radius: 15px;
            }

            .users-stat-card strong {
                font-size: 1.12rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const body = document.querySelector('[data-users-body]');
            const totalTarget = document.querySelector('[data-users-total]');
            const activeTarget = document.querySelector('[data-users-active]');
            const rolesTarget = document.querySelector('[data-users-roles]');
            const apiStatus = document.querySelector('[data-api-status]');

            function normalizeText(value) {
                return String(value || '').trim().toLowerCase();
            }

            function readUsersFromTable() {
                if (!body) return [];

                const rows = Array.from(body.querySelectorAll('tr'));

                return rows
                    .filter(function (row) {
                        return !row.querySelector('td[colspan]');
                    })
                    .map(function (row) {
                        const cells = Array.from(row.querySelectorAll('td'));

                        return {
                            role: normalizeText(cells[2] ? cells[2].textContent : ''),
                            status: normalizeText(cells[4] ? cells[4].textContent : '')
                        };
                    });
            }

            function refreshUserStats() {
                const users = readUsersFromTable();

                if (!users.length) {
                    if (totalTarget) totalTarget.textContent = '—';
                    if (activeTarget) activeTarget.textContent = '—';
                    if (rolesTarget) rolesTarget.textContent = '—';
                    return;
                }

                const total = users.length;

                const active = users.filter(function (user) {
                    return user.status.includes('active') && !user.status.includes('inactive');
                }).length;

                const roles = new Set(
                    users
                        .map(function (user) {
                            return user.role;
                        })
                        .filter(Boolean)
                ).size;

                if (totalTarget) totalTarget.textContent = total;
                if (activeTarget) activeTarget.textContent = active;
                if (rolesTarget) rolesTarget.textContent = roles;
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
                const observer = new MutationObserver(refreshUserStats);

                observer.observe(body, {
                    childList: true,
                    subtree: true,
                    characterData: true
                });

                refreshUserStats();
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