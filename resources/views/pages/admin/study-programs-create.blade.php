@extends('layouts.app')

@section('title', 'Create Study Program - G-RPL')
@section('page', 'study-programs-create')
@section('authRequired', 'true')
@section('roleRequired', 'system_admin')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <x-admin-sidebar />

        <div class="workspace study-create-workspace">
            <div class="study-create-hero">
                <div class="study-create-hero-content">
                    <div>
                        <p class="eyebrow study-create-eyebrow">Master Data</p>
                        <h2>Tambah Program Studi</h2>
                        <p class="study-create-subtitle">
                            Buat data program studi baru untuk sistem G-RPL. Pastikan kode,
                            nama program, total SKS, batas konversi SKS, dan dukungan RPL sudah sesuai.
                        </p>
                    </div>

                    <div class="study-create-actions">
                        <span class="connection-pill study-create-status-pill" data-api-status>Connecting</span>

                        <a href="/admin/study-programs" class="study-create-back-btn">
                            <span class="study-create-back-icon">←</span>
                            <span>Back to Programs</span>
                        </a>
                    </div>
                </div>

                <div class="study-create-info-grid">
                    <div class="study-create-info-card">
                        <span class="study-create-info-icon study-create-info-blue">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3 1 9l11 6 9-4.91V17h2V9L12 3Zm0 14L5 13.18V16c0 2 4.66 4 7 4s7-2 7-4v-2.82L12 17Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Form Type</p>
                            <strong>Study Program</strong>
                        </div>
                    </div>

                    <div class="study-create-info-card">
                        <span class="study-create-info-icon study-create-info-yellow">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M18 2H7c-1.66 0-3 1.34-3 3v14c0 1.66 1.34 3 3 3h11c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2Zm0 16H7c-.55 0-1 .45-1 1s.45 1 1 1h11v-2Zm0-2H7c-.35 0-.69.06-1 .17V5c0-.55.45-1 1-1h11v12Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Data Scope</p>
                            <strong>RPL Configuration</strong>
                        </div>
                    </div>

                    <div class="study-create-info-card">
                        <span class="study-create-info-icon study-create-info-green">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M9 16.17 4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17Z"/>
                            </svg>
                        </span>

                        <div>
                            <p>Status</p>
                            <strong>Ready to Create</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="study-create-panel">
                <div class="study-create-panel-head">
                    <div>
                        <h3>Informasi Program Studi</h3>
                        <p>Lengkapi form berikut untuk menambahkan program studi baru ke sistem G-RPL.</p>
                    </div>

                    <span class="study-create-panel-badge">New Program</span>
                </div>

                <form class="form-grid study-create-form" data-study-program-form="create">
                    <label class="study-create-field">
                        <span>Code</span>

                        <div class="study-create-input-wrap">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M3 5c0-1.1.9-2 2-2h6v7H3V5Zm0 9h8v7H5c-1.1 0-2-.9-2-2v-5Zm10 7v-7h8v5c0 1.1-.9 2-2 2h-6Zm8-11h-8V3h6c1.1 0 2 .9 2 2v5Z"/>
                            </svg>

                            <input
                                type="text"
                                name="code"
                                required
                                maxlength="20"
                                placeholder="Contoh: TI"
                            >
                        </div>
                    </label>

                    <label class="study-create-field">
                        <span>Name</span>

                        <div class="study-create-input-wrap">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M4 4h16v2H4V4Zm0 4h10v2H4V8Zm0 4h16v2H4v-2Zm0 4h10v2H4v-2Z"/>
                            </svg>

                            <input
                                type="text"
                                name="name"
                                required
                                maxlength="255"
                                placeholder="Contoh: Teknik Informatika"
                            >
                        </div>
                    </label>

                    <label class="study-create-field">
                        <span>Total SKS</span>

                        <div class="study-create-input-wrap">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 2 3 7v10l9 5 9-5V7l-9-5Zm0 2.3L18.5 8 12 11.7 5.5 8 12 4.3ZM5 9.73l6 3.39v6.61l-6-3.34V9.73Zm8 10v-6.61l6-3.39v6.66l-6 3.34Z"/>
                            </svg>

                            <input
                                type="number"
                                name="total_sks"
                                required
                                min="1"
                                placeholder="144"
                            >
                        </div>
                    </label>

                    <label class="study-create-field">
                        <span>Max Convertible SKS</span>

                        <div class="study-create-input-wrap">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2Zm-7 14H7v-2h5v2Zm5-4H7v-2h10v2Zm0-4H7V7h10v2Z"/>
                            </svg>

                            <input
                                type="number"
                                name="max_convertible_sks"
                                required
                                min="1"
                                placeholder="90"
                            >
                        </div>
                    </label>

                    <div class="study-create-section-title study-create-full">
                        <div>
                            <h4>Konfigurasi RPL</h4>
                            <p>Atur dukungan skema RPL untuk program studi ini.</p>
                        </div>
                    </div>

                    <label class="study-create-field">
                        <span>Supports A1</span>

                        <div class="study-create-select-wrap">
                            <select name="supports_a1" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </label>

                    <label class="study-create-field">
                        <span>Supports A2</span>

                        <div class="study-create-select-wrap">
                            <select name="supports_a2" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </label>

                    <label class="study-create-field">
                        <span>Hybrid Allowed</span>

                        <div class="study-create-select-wrap">
                            <select name="is_hybrid_allowed" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </label>

                    <label class="study-create-field">
                        <span>Status</span>

                        <div class="study-create-select-wrap">
                            <select name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </label>

                    <p class="form-message study-create-message study-create-full" data-form-message aria-live="polite"></p>

                    <div class="study-create-submit-row study-create-full">
                        <a href="/admin/study-programs" class="study-create-cancel-btn">
                            Cancel
                        </a>

                        <button class="study-create-submit-btn" type="submit" data-submit-button>
                            <span>Create Study Program</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <style>
        .study-create-workspace,
        .study-create-workspace * {
            box-sizing: border-box;
        }

        .study-create-workspace {
            position: relative;
            display: grid;
            gap: 18px;
            min-width: 0;
        }

        .study-create-hero {
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

        .study-create-hero::before {
            content: "";
            position: absolute;
            inset: 0 0 auto;
            height: 5px;
            background: linear-gradient(90deg, #1565C0, #F9A825, #E53935);
        }

        .study-create-hero::after {
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

        .study-create-hero-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 22px;
        }

        .study-create-eyebrow {
            margin-bottom: 8px;
            color: #1565C0;
        }

        .study-create-hero h2 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: clamp(1.65rem, 3vw, 2.45rem);
            line-height: 1.08;
            font-weight: 950;
            letter-spacing: -0.065em;
        }

        .study-create-subtitle {
            max-width: 760px;
            margin: 10px 0 0;
            color: #64748b;
            font-size: 0.94rem;
            line-height: 1.72;
            font-weight: 650;
        }

        .study-create-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            flex-shrink: 0;
        }

        .connection-pill,
        .study-create-status-pill {
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
        .study-create-status-pill::before {
            content: "";
            width: 9px;
            height: 9px;
            flex: 0 0 9px;
            border-radius: 999px;
            background: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        .connection-pill.is-connected,
        .study-create-status-pill.is-connected {
            color: #14532d;
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            border-color: #4ade80;
            box-shadow:
                0 12px 28px rgba(34, 197, 94, 0.16),
                inset 0 1px 0 rgba(255, 255, 255, 0.72);
        }

        .connection-pill.is-connected::before,
        .study-create-status-pill.is-connected::before {
            background: #16a34a;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.18);
        }

        .connection-pill.is-error,
        .study-create-status-pill.is-error,
        .connection-pill.is-disconnected,
        .study-create-status-pill.is-disconnected {
            color: #991b1b;
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border-color: #fca5a5;
        }

        .connection-pill.is-error::before,
        .study-create-status-pill.is-error::before,
        .connection-pill.is-disconnected::before,
        .study-create-status-pill.is-disconnected::before {
            background: #dc2626;
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.16);
        }

        .study-create-back-btn {
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

        .study-create-back-btn:hover {
            transform: translateY(-2px);
            border-color: rgba(21, 101, 192, 0.35);
            box-shadow:
                0 18px 34px rgba(15, 23, 42, 0.10),
                inset 0 1px 0 rgba(255, 255, 255, 0.94);
        }

        .study-create-back-icon {
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

        .study-create-info-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 22px;
        }

        .study-create-info-card {
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

        .study-create-info-icon {
            width: 44px;
            height: 44px;
            flex: 0 0 44px;
            display: grid;
            place-items: center;
            border-radius: 17px;
        }

        .study-create-info-icon svg {
            width: 22px;
            height: 22px;
            fill: currentColor;
            display: block;
        }

        .study-create-info-blue {
            color: #1565C0;
            background: rgba(21, 101, 192, 0.10);
            border: 1px solid rgba(21, 101, 192, 0.12);
        }

        .study-create-info-yellow {
            color: #b77905;
            background: rgba(249, 168, 37, 0.14);
            border: 1px solid rgba(249, 168, 37, 0.18);
        }

        .study-create-info-green {
            color: #16a34a;
            background: rgba(22, 163, 74, 0.10);
            border: 1px solid rgba(22, 163, 74, 0.12);
        }

        .study-create-info-card p {
            margin: 0 0 4px;
            color: #64748b;
            font-size: 0.74rem;
            font-weight: 900;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .study-create-info-card strong {
            display: block;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 1.04rem;
            line-height: 1.2;
            font-weight: 950;
            letter-spacing: -0.04em;
        }

        .study-create-panel {
            overflow: hidden;
            padding: 22px;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(226, 232, 240, 0.95);
            box-shadow:
                0 18px 50px rgba(15, 23, 42, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        .study-create-panel-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            padding-bottom: 18px;
            border-bottom: 1px solid rgba(226, 232, 240, 0.85);
        }

        .study-create-panel-head h3 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 1.08rem;
            line-height: 1.2;
            font-weight: 950;
            letter-spacing: -0.04em;
        }

        .study-create-panel-head p {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 0.84rem;
            line-height: 1.55;
            font-weight: 650;
        }

        .study-create-panel-badge {
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

        .study-create-form {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            margin-top: 20px;
            padding: 0;
            background: transparent;
            border: 0;
        }

        .study-create-full {
            grid-column: 1 / -1;
        }

        .study-create-section-title {
            padding: 15px;
            border-radius: 20px;
            background:
                radial-gradient(circle at 100% 0%, rgba(249, 168, 37, 0.11), transparent 34%),
                linear-gradient(135deg, #f8fafc, #ffffff);
            border: 1px solid rgba(226, 232, 240, 0.92);
        }

        .study-create-section-title h4 {
            margin: 0;
            color: #0f172a;
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 0.98rem;
            font-weight: 950;
            letter-spacing: -0.035em;
        }

        .study-create-section-title p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 0.8rem;
            line-height: 1.5;
            font-weight: 650;
        }

        .study-create-field {
            display: grid;
            gap: 8px;
            min-width: 0;
            color: inherit;
            font-size: initial;
            font-weight: initial;
        }

        .study-create-field > span {
            color: #475569;
            font-size: 0.72rem;
            line-height: 1;
            font-weight: 950;
            letter-spacing: 0.07em;
            text-transform: uppercase;
        }

        .study-create-input-wrap,
        .study-create-select-wrap {
            position: relative;
            min-width: 0;
        }

        .study-create-input-wrap svg {
            position: absolute;
            top: 50%;
            left: 13px;
            width: 18px;
            height: 18px;
            fill: #94a3b8;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .study-create-input-wrap input {
            padding-left: 42px !important;
        }

        .study-create-field input,
        .study-create-field select {
            width: 100%;
            min-height: 48px;
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

        .study-create-field input::placeholder {
            color: #94a3b8;
            font-weight: 650;
        }

        .study-create-field input:focus,
        .study-create-field select:focus {
            border-color: rgba(21, 101, 192, 0.55);
            box-shadow:
                0 0 0 4px rgba(21, 101, 192, 0.10),
                0 12px 28px rgba(15, 23, 42, 0.05);
        }

        .study-create-message {
            margin: 0;
            font-weight: 850;
        }

        .study-create-submit-row {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            margin-top: 4px;
            padding-top: 16px;
            border-top: 1px solid rgba(226, 232, 240, 0.85);
        }

        .study-create-cancel-btn,
        .study-create-submit-btn {
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

        .study-create-cancel-btn {
            color: #475569;
            background: #ffffff;
            border: 1px solid #dbe3ee;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.035);
        }

        .study-create-cancel-btn:hover {
            color: #0f172a;
            border-color: #cbd5e1;
            transform: translateY(-1px);
        }

        .study-create-submit-btn {
            color: #ffffff;
            background: linear-gradient(135deg, #1565C0 0%, #0f4fa3 100%);
            border: 1px solid rgba(21, 101, 192, 0.22);
            box-shadow:
                0 16px 30px rgba(21, 101, 192, 0.22),
                inset 0 1px 0 rgba(255, 255, 255, 0.24);
        }

        .study-create-submit-btn:hover {
            transform: translateY(-1px);
            filter: brightness(1.03);
            box-shadow:
                0 20px 36px rgba(21, 101, 192, 0.28),
                inset 0 1px 0 rgba(255, 255, 255, 0.28);
        }

        .study-create-submit-btn:disabled {
            cursor: not-allowed;
            opacity: 0.65;
            transform: none;
            box-shadow: none;
        }

        @media (max-width: 1100px) {
            .study-create-hero,
            .study-create-panel {
                padding: 20px;
            }

            .study-create-hero-content {
                flex-direction: column;
            }

            .study-create-actions {
                width: 100%;
                justify-content: flex-start;
                flex-wrap: wrap;
            }
        }

        @media (max-width: 900px) {
            .study-create-info-grid {
                grid-template-columns: 1fr;
            }

            .study-create-info-card {
                padding: 14px;
            }

            .study-create-back-btn {
                flex: 1;
            }

            .study-create-status-pill {
                width: fit-content;
            }
        }

        @media (max-width: 640px) {
            .study-create-workspace {
                gap: 14px;
            }

            .study-create-hero,
            .study-create-panel {
                border-radius: 24px;
                padding: 16px;
            }

            .study-create-hero h2 {
                font-size: 1.55rem;
                letter-spacing: -0.055em;
            }

            .study-create-subtitle {
                font-size: 0.84rem;
                line-height: 1.62;
            }

            .study-create-actions {
                display: grid;
                grid-template-columns: 1fr;
            }

            .study-create-status-pill,
            .study-create-back-btn {
                width: 100%;
            }

            .study-create-info-grid {
                margin-top: 18px;
            }

            .study-create-panel-head {
                display: grid;
            }

            .study-create-panel-badge {
                width: fit-content;
            }

            .study-create-form {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .study-create-full {
                grid-column: auto;
            }

            .study-create-field > span {
                font-size: 0.68rem;
            }

            .study-create-field input,
            .study-create-field select,
            .study-create-cancel-btn,
            .study-create-submit-btn {
                min-height: 44px;
                border-radius: 15px;
            }

            .study-create-submit-row {
                display: grid;
                grid-template-columns: 1fr;
            }

            .study-create-cancel-btn,
            .study-create-submit-btn {
                width: 100%;
            }
        }

        @media (max-width: 420px) {
            .study-create-hero,
            .study-create-panel {
                padding: 14px;
            }

            .study-create-info-card {
                align-items: flex-start;
            }

            .study-create-info-icon {
                width: 40px;
                height: 40px;
                flex-basis: 40px;
                border-radius: 15px;
            }

            .study-create-info-card strong {
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