@extends('layouts.app')

@section('title', 'Edit User - G-RPL')
@section('page', 'users-edit')
@section('authRequired', 'true')
@section('roleRequired', 'system_admin')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <x-admin-sidebar />

        <div class="workspace user-edit-workspace">
            <div class="user-edit-hero">
                <div class="user-edit-hero-content">
                    <div>
                        <p class="eyebrow user-edit-eyebrow">User Management</p>
                        <h2>Ubah Data User</h2>
                        <p class="user-edit-subtitle">
                            Perbarui data akun internal sistem G-RPL. Ubah identitas, kontak,
                            NIP, alamat, atau password user jika memang diperlukan.
                        </p>
                    </div>

                    <div class="user-edit-actions">
                        <span class="connection-pill user-edit-status-pill" data-api-status>Connecting</span>

                        <a href="/admin/users" class="user-edit-back-btn">
                            <span class="user-edit-back-icon">←</span>
                            <span>Back to Users</span>
                        </a>
                    </div>
                </div>

                <div class="user-edit-info-grid">
                    <div class="user-edit-info-card">
                        <span class="user-edit-info-icon user-edit-info-blue">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4Zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Form Type</p>
                            <strong>Edit User</strong>
                        </div>
                    </div>

                    <div class="user-edit-info-card">
                        <span class="user-edit-info-icon user-edit-info-yellow">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 1 3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4Zm0 2.18 7 3.11V11c0 4.52-2.98 8.69-7 9.93C7.98 19.69 5 15.52 5 11V6.29l7-3.11Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Security</p>
                            <strong>Password Optional</strong>
                        </div>
                    </div>

                    <div class="user-edit-info-card">
                        <span class="user-edit-info-icon user-edit-info-green">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M9 16.17 4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Status</p>
                            <strong>Ready to Update</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="user-edit-panel">
                <div class="user-edit-panel-head">
                    <div>
                        <h3>Informasi User</h3>
                        <p>Ubah data berikut untuk memperbarui akun user internal.</p>
                    </div>

                    <span class="user-edit-panel-badge">Update User</span>
                </div>

                <form class="form-grid user-edit-form" data-admin-user-form="edit">
                    <label class="user-edit-field">
                        <span>Name</span>

                        <div class="user-edit-input-wrap">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4Zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4Z"/>
                            </svg>

                            <input
                                type="text"
                                name="name"
                                required
                                maxlength="100"
                                placeholder="Masukkan nama user"
                            >
                        </div>
                    </label>

                    <label class="user-edit-field">
                        <span>Email</span>

                        <div class="user-edit-input-wrap">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2Zm0 4-8 5-8-5V6l8 5 8-5v2Z"/>
                            </svg>

                            <input
                                type="email"
                                name="email"
                                required
                                maxlength="50"
                                placeholder="contoh@email.com"
                            >
                        </div>
                    </label>

                    <div class="user-edit-section-title user-edit-full">
                        <div>
                            <h4>Keamanan Akun</h4>
                            <p>Kosongkan password jika tidak ingin mengubah password user.</p>
                        </div>
                    </div>

                    <label class="user-edit-field">
                        <span>Password</span>

                        <div class="user-edit-input-wrap">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2ZM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6Zm4 11.73V20h-2v-2.27c-.6-.35-1-1-1-1.73 0-1.1.9-2 2-2s2 .9 2 2c0 .73-.4 1.38-1 1.73Z"/>
                            </svg>

                            <input
                                type="password"
                                name="password"
                                minlength="8"
                                placeholder="Kosongkan jika tidak diubah"
                            >
                        </div>
                    </label>

                    <label class="user-edit-field">
                        <span>Confirm Password</span>

                        <div class="user-edit-input-wrap">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 1 3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4Zm-1 15.59-4-4L8.41 11.17 11 13.76l5.59-5.59L18 9.59l-7 7Z"/>
                            </svg>

                            <input
                                type="password"
                                name="password_confirmation"
                                minlength="8"
                                placeholder="Ulangi password baru"
                            >
                        </div>
                    </label>

                    <div class="user-edit-section-title user-edit-full">
                        <div>
                            <h4>Data Kepegawaian</h4>
                            <p>Perbarui identitas pegawai dan informasi kontak user.</p>
                        </div>
                    </div>

                    <label class="user-edit-field">
                        <span>NIP</span>

                        <div class="user-edit-input-wrap">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M20 6h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2Zm-6 0h-4V4h4v2Z"/>
                            </svg>

                            <input
                                type="text"
                                name="nip"
                                required
                                maxlength="30"
                                placeholder="Masukkan NIP"
                            >
                        </div>
                    </label>

                    <label class="user-edit-field">
                        <span>Phone</span>

                        <div class="user-edit-input-wrap">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.15 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1C10.61 21 3 13.39 3 4c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.24.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2Z"/>
                            </svg>

                            <input
                                type="text"
                                name="phone"
                                maxlength="20"
                                placeholder="Contoh: 081234567890"
                            >
                        </div>
                    </label>

                    <label class="user-edit-field user-edit-full">
                        <span>Address</span>

                        <div class="user-edit-textarea-wrap">
                            <textarea
                                name="address"
                                rows="3"
                                placeholder="Masukkan alamat lengkap user"
                            ></textarea>
                        </div>
                    </label>

                    <p class="form-message user-edit-message user-edit-full" data-form-message aria-live="polite"></p>

                    <div class="user-edit-submit-row user-edit-full">
                        <a href="/admin/users" class="user-edit-cancel-btn">
                            Cancel
                        </a>

                        <button class="user-edit-submit-btn" type="submit" data-submit-button>
                            <span>Update User</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <style>
        .user-edit-workspace,
        .user-edit-workspace * {
            box-sizing: border-box;
        }

        .user-edit-workspace {
            position: relative;
            display: grid;
            gap: 18px;
            min-width: 0;
        }

        .user-edit-hero {
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

        .user-edit-hero::before {
            content: "";
            position: absolute;
            inset: 0 0 auto;
            height: 5px;
            background: linear-gradient(90deg, #1565C0, #F9A825, #E53935);
        }

        .user-edit-hero::after {
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

        .user-edit-hero-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 22px;
        }

        .user-edit-eyebrow {
            margin-bottom: 8px;
            color: #1565C0;
        }

        .user-edit-hero h2 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: clamp(1.65rem, 3vw, 2.45rem);
            line-height: 1.08;
            font-weight: 950;
            letter-spacing: -0.065em;
        }

        .user-edit-subtitle {
            max-width: 760px;
            margin: 10px 0 0;
            color: #64748b;
            font-size: 0.94rem;
            line-height: 1.72;
            font-weight: 650;
        }

        .user-edit-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            flex-shrink: 0;
        }

        .connection-pill,
        .user-edit-status-pill {
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
        .user-edit-status-pill::before {
            content: "";
            width: 9px;
            height: 9px;
            flex: 0 0 9px;
            border-radius: 999px;
            background: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        .connection-pill.is-connected,
        .user-edit-status-pill.is-connected {
            color: #14532d;
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            border-color: #4ade80;
            box-shadow:
                0 12px 28px rgba(34, 197, 94, 0.16),
                inset 0 1px 0 rgba(255, 255, 255, 0.72);
        }

        .connection-pill.is-connected::before,
        .user-edit-status-pill.is-connected::before {
            background: #16a34a;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.18);
        }

        .connection-pill.is-connecting,
        .user-edit-status-pill.is-connecting {
            color: #1d4ed8;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-color: #93c5fd;
        }

        .connection-pill.is-connecting::before,
        .user-edit-status-pill.is-connecting::before {
            background: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        .connection-pill.is-error,
        .user-edit-status-pill.is-error,
        .connection-pill.is-disconnected,
        .user-edit-status-pill.is-disconnected {
            color: #991b1b;
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border-color: #fca5a5;
        }

        .connection-pill.is-error::before,
        .user-edit-status-pill.is-error::before,
        .connection-pill.is-disconnected::before,
        .user-edit-status-pill.is-disconnected::before {
            background: #dc2626;
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.16);
        }

        .user-edit-back-btn {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 0 16px;
            border-radius: 999px;
            color: #0f172a;
            background: rgba(255, 255, 255, 0.82);
            border: 1px solid rgba(203, 213, 225, 0.95);
            box-shadow:
                0 14px 28px rgba(15, 23, 42, 0.07),
                inset 0 1px 0 rgba(255, 255, 255, 0.92);
            font-size: 0.86rem;
            line-height: 1;
            font-weight: 950;
            text-decoration: none;
            white-space: nowrap;
            transition:
                transform 0.22s ease,
                box-shadow 0.22s ease,
                border-color 0.22s ease;
        }

        .user-edit-back-btn:hover {
            transform: translateY(-2px);
            border-color: rgba(21, 101, 192, 0.35);
            box-shadow:
                0 18px 34px rgba(15, 23, 42, 0.10),
                inset 0 1px 0 rgba(255, 255, 255, 0.94);
        }

        .user-edit-back-icon {
            width: 22px;
            height: 22px;
            display: grid;
            place-items: center;
            border-radius: 999px;
            color: #1565C0;
            background: rgba(21, 101, 192, 0.09);
            font-size: 1rem;
            line-height: 1;
            font-weight: 950;
        }

        .user-edit-info-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 22px;
        }

        .user-edit-info-card {
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

        .user-edit-info-icon {
            width: 44px;
            height: 44px;
            flex: 0 0 44px;
            display: grid;
            place-items: center;
            border-radius: 17px;
        }

        .user-edit-info-icon svg {
            width: 22px;
            height: 22px;
            fill: currentColor;
            display: block;
        }

        .user-edit-info-blue {
            color: #1565C0;
            background: rgba(21, 101, 192, 0.10);
            border: 1px solid rgba(21, 101, 192, 0.12);
        }

        .user-edit-info-yellow {
            color: #b77905;
            background: rgba(249, 168, 37, 0.14);
            border: 1px solid rgba(249, 168, 37, 0.18);
        }

        .user-edit-info-green {
            color: #16a34a;
            background: rgba(22, 163, 74, 0.10);
            border: 1px solid rgba(22, 163, 74, 0.12);
        }

        .user-edit-info-card p {
            margin: 0 0 4px;
            color: #64748b;
            font-size: 0.74rem;
            font-weight: 900;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .user-edit-info-card strong {
            display: block;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 1.04rem;
            line-height: 1.2;
            font-weight: 950;
            letter-spacing: -0.04em;
        }

        .user-edit-panel {
            overflow: hidden;
            padding: 22px;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(226, 232, 240, 0.95);
            box-shadow:
                0 18px 50px rgba(15, 23, 42, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        .user-edit-panel-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            padding-bottom: 18px;
            border-bottom: 1px solid rgba(226, 232, 240, 0.85);
        }

        .user-edit-panel-head h3 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 1.08rem;
            line-height: 1.2;
            font-weight: 950;
            letter-spacing: -0.04em;
        }

        .user-edit-panel-head p {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 0.84rem;
            line-height: 1.55;
            font-weight: 650;
        }

        .user-edit-panel-badge {
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

        .user-edit-form {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            margin-top: 20px;
            padding: 0;
            background: transparent;
            border: 0;
        }

        .user-edit-full {
            grid-column: 1 / -1;
        }

        .user-edit-section-title {
            padding: 15px;
            border-radius: 20px;
            background:
                radial-gradient(circle at 100% 0%, rgba(249, 168, 37, 0.11), transparent 34%),
                linear-gradient(135deg, #f8fafc, #ffffff);
            border: 1px solid rgba(226, 232, 240, 0.92);
        }

        .user-edit-section-title h4 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 0.98rem;
            font-weight: 950;
            letter-spacing: -0.035em;
        }

        .user-edit-section-title p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 0.8rem;
            line-height: 1.5;
            font-weight: 650;
        }

        .user-edit-field {
            display: grid;
            gap: 8px;
            min-width: 0;
            color: inherit;
            font-size: initial;
            font-weight: initial;
        }

        .user-edit-field > span {
            color: #475569;
            font-size: 0.72rem;
            line-height: 1;
            font-weight: 950;
            letter-spacing: 0.07em;
            text-transform: uppercase;
        }

        .user-edit-input-wrap,
        .user-edit-textarea-wrap {
            position: relative;
            min-width: 0;
        }

        .user-edit-input-wrap svg {
            position: absolute;
            top: 50%;
            left: 13px;
            width: 18px;
            height: 18px;
            fill: #94a3b8;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .user-edit-input-wrap input {
            padding-left: 42px !important;
        }

        .user-edit-field input,
        .user-edit-field textarea {
            width: 100%;
            border-radius: 16px;
            border: 1px solid #dbe3ee;
            background: #ffffff;
            color: #0f172a;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.035);
            font-size: 0.92rem;
            font-weight: 750;
            outline: none;
            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .user-edit-field input {
            min-height: 48px;
        }

        .user-edit-field textarea {
            min-height: 105px;
            padding: 13px 14px;
            resize: vertical;
            line-height: 1.55;
        }

        .user-edit-field input::placeholder,
        .user-edit-field textarea::placeholder {
            color: #94a3b8;
            font-weight: 650;
        }

        .user-edit-field input:focus,
        .user-edit-field textarea:focus {
            border-color: rgba(21, 101, 192, 0.55);
            box-shadow:
                0 0 0 4px rgba(21, 101, 192, 0.10),
                0 12px 28px rgba(15, 23, 42, 0.05);
        }

        .user-edit-message {
            margin: 0;
            font-weight: 850;
        }

        .user-edit-submit-row {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            margin-top: 4px;
            padding-top: 16px;
            border-top: 1px solid rgba(226, 232, 240, 0.85);
        }

        .user-edit-cancel-btn,
        .user-edit-submit-btn {
            min-height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 20px;
            border-radius: 16px;
            font-family: inherit;
            font-size: 0.88rem;
            line-height: 1;
            font-weight: 950;
            text-decoration: none;
            cursor: pointer;
            transition:
                transform 0.22s ease,
                box-shadow 0.22s ease,
                filter 0.22s ease,
                border-color 0.22s ease;
        }

        .user-edit-cancel-btn {
            color: #475569;
            background: #ffffff;
            border: 1px solid #dbe3ee;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.035);
        }

        .user-edit-cancel-btn:hover {
            color: #0f172a;
            border-color: #cbd5e1;
            transform: translateY(-1px);
        }

        .user-edit-submit-btn {
            color: #ffffff;
            background: linear-gradient(135deg, #1565C0 0%, #0f4fa3 100%);
            border: 1px solid rgba(21, 101, 192, 0.22);
            box-shadow:
                0 16px 30px rgba(21, 101, 192, 0.22),
                inset 0 1px 0 rgba(255, 255, 255, 0.24);
        }

        .user-edit-submit-btn:hover {
            transform: translateY(-1px);
            filter: brightness(1.03);
            box-shadow:
                0 20px 36px rgba(21, 101, 192, 0.28),
                inset 0 1px 0 rgba(255, 255, 255, 0.28);
        }

        .user-edit-submit-btn:disabled {
            cursor: not-allowed;
            opacity: 0.65;
            transform: none;
            box-shadow: none;
        }

        @media (max-width: 1100px) {
            .user-edit-hero,
            .user-edit-panel {
                padding: 20px;
            }

            .user-edit-hero-content {
                flex-direction: column;
            }

            .user-edit-actions {
                width: 100%;
                justify-content: flex-start;
                flex-wrap: wrap;
            }
        }

        @media (max-width: 900px) {
            .user-edit-info-grid {
                grid-template-columns: 1fr;
            }

            .user-edit-info-card {
                padding: 14px;
            }

            .user-edit-back-btn {
                flex: 1;
            }

            .user-edit-status-pill {
                width: fit-content;
            }
        }

        @media (max-width: 640px) {
            .user-edit-workspace {
                gap: 14px;
            }

            .user-edit-hero,
            .user-edit-panel {
                border-radius: 24px;
                padding: 16px;
            }

            .user-edit-hero h2 {
                font-size: 1.55rem;
                letter-spacing: -0.055em;
            }

            .user-edit-subtitle {
                font-size: 0.84rem;
                line-height: 1.62;
            }

            .user-edit-actions {
                display: grid;
                grid-template-columns: 1fr;
            }

            .user-edit-status-pill,
            .user-edit-back-btn {
                width: 100%;
            }

            .user-edit-info-grid {
                margin-top: 18px;
            }

            .user-edit-panel-head {
                display: grid;
            }

            .user-edit-panel-badge {
                width: fit-content;
            }

            .user-edit-form {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .user-edit-full {
                grid-column: auto;
            }

            .user-edit-field > span {
                font-size: 0.68rem;
            }

            .user-edit-field input,
            .user-edit-cancel-btn,
            .user-edit-submit-btn {
                min-height: 44px;
                border-radius: 15px;
            }

            .user-edit-submit-row {
                display: grid;
                grid-template-columns: 1fr;
            }

            .user-edit-cancel-btn,
            .user-edit-submit-btn {
                width: 100%;
            }
        }

        @media (max-width: 420px) {
            .user-edit-hero,
            .user-edit-panel {
                padding: 14px;
            }

            .user-edit-info-card {
                align-items: flex-start;
            }

            .user-edit-info-icon {
                width: 40px;
                height: 40px;
                flex-basis: 40px;
                border-radius: 15px;
            }

            .user-edit-info-card strong {
                font-size: 0.98rem;
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