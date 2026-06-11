@extends('layouts.app')

@section('title', 'Assessment Detail - G-RPL2')
@section('page', 'assessment-detail')
@section('authRequired', 'true')
@section('roleRequired', 'assessor')

@section('content')
<style>
    :root {
        --assessor-dark: #0f172a;
        --assessor-dark-2: #111827;
        --assessor-blue: #2563eb;
        --assessor-blue-2: #1d4ed8;
        --assessor-blue-soft: #dbeafe;
        --assessor-gold: #f59e0b;
        --assessor-green: #10b981;
        --assessor-red: #ef4444;
        --assessor-slate: #64748b;
        --assessor-muted: #94a3b8;
        --assessor-border: rgba(148, 163, 184, .28);
        --assessor-card: rgba(255, 255, 255, .92);
        --assessor-shadow: 0 24px 70px rgba(15, 23, 42, .1);
    }

    * {
        box-sizing: border-box;
    }

    .assessor-shell {
        min-height: 100vh;
        padding: 40px 22px;
        background:
            radial-gradient(circle at top left, rgba(37, 99, 235, .12), transparent 34%),
            radial-gradient(circle at top right, rgba(245, 158, 11, .13), transparent 32%),
            linear-gradient(rgba(15, 23, 42, .035) 1px, transparent 1px),
            linear-gradient(90deg, rgba(15, 23, 42, .035) 1px, transparent 1px),
            #f6f8fc;
        background-size: auto, auto, 56px 56px, 56px 56px;
    }

    .assessor-container {
        width: min(1180px, 100%);
        margin: 0 auto;
    }

    .assessor-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 24px;
        padding: 18px;
        border: 1px solid var(--assessor-border);
        border-radius: 28px;
        background: rgba(255, 255, 255, .84);
        backdrop-filter: blur(18px);
        box-shadow: 0 18px 50px rgba(15, 23, 42, .075);
    }

    .assessor-brand {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
    }

    .assessor-logo {
        width: 52px;
        height: 52px;
        flex: 0 0 52px;
        border-radius: 18px;
        display: grid;
        place-items: center;
        color: #fff;
        font-size: 14px;
        font-weight: 950;
        letter-spacing: .04em;
        background:
            linear-gradient(135deg, rgba(255,255,255,.2), transparent),
            linear-gradient(135deg, var(--assessor-dark), var(--assessor-blue) 58%, var(--assessor-gold));
        box-shadow: 0 14px 32px rgba(37, 99, 235, .25);
    }

    .assessor-brand-text {
        min-width: 0;
    }

    .assessor-brand-text small {
        display: block;
        margin-bottom: 4px;
        color: var(--assessor-gold);
        font-size: 12px;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: .09em;
    }

    .assessor-brand-text h1 {
        margin: 0;
        color: var(--assessor-dark);
        font-size: 24px;
        line-height: 1.08;
        font-weight: 950;
        letter-spacing: -.045em;
        word-break: break-word;
    }

    .assessor-brand-text p {
        margin: 6px 0 0;
        color: var(--assessor-slate);
        font-size: 13px;
        line-height: 1.45;
    }

    .assessor-top-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: wrap;
        flex: 0 0 auto;
    }

    .connection-pill {
        min-height: 44px;
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
            0 12px 28px rgba(15, 23, 42, .08),
            inset 0 1px 0 rgba(255, 255, 255, .65);
        font-size: 13px;
        line-height: 1;
        font-weight: 950;
        white-space: nowrap;
    }

    .connection-pill::before {
        content: "";
        width: 9px;
        height: 9px;
        flex: 0 0 9px;
        border-radius: 999px;
        background: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, .15);
    }

    .connection-pill.is-connected {
        color: #14532d;
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        border-color: #4ade80;
        box-shadow:
            0 12px 28px rgba(34, 197, 94, .16),
            inset 0 1px 0 rgba(255, 255, 255, .72);
    }

    .connection-pill.is-connected::before {
        background: #16a34a;
        box-shadow: 0 0 0 4px rgba(34, 197, 94, .18);
    }

    .connection-pill.is-error,
    .connection-pill.is-disconnected {
        color: #991b1b;
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        border-color: #fca5a5;
        box-shadow:
            0 12px 28px rgba(239, 68, 68, .14),
            inset 0 1px 0 rgba(255, 255, 255, .65);
    }

    .connection-pill.is-error::before,
    .connection-pill.is-disconnected::before {
        background: #dc2626;
        box-shadow: 0 0 0 4px rgba(220, 38, 38, .16);
    }

    .assessor-back-btn,
    .assessor-logout-btn,
    .assessor-action-btn {
        min-height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0 16px;
        border-radius: 999px;
        text-decoration: none;
        cursor: pointer;
        border: 1px solid rgba(148, 163, 184, .28);
        background: #fff;
        font-size: 13px;
        font-weight: 950;
        transition:
            transform .2s ease,
            box-shadow .2s ease,
            background .2s ease,
            color .2s ease,
            border-color .2s ease;
        white-space: nowrap;
    }

    .assessor-back-btn {
        color: var(--assessor-dark);
        background: #fff7ed;
        border-color: rgba(245, 158, 11, .42);
        box-shadow: 0 10px 24px rgba(245, 158, 11, .13);
    }

    .assessor-back-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 30px rgba(245, 158, 11, .18);
    }

    .assessor-logout-btn {
        color: #b91c1c;
        background: #fff;
        border-color: rgba(239, 68, 68, .25);
        box-shadow: 0 12px 26px rgba(15, 23, 42, .055);
    }

    .assessor-logout-btn:hover {
        color: #fff;
        background: linear-gradient(135deg, #ef4444, #b91c1c);
        border-color: transparent;
        box-shadow: 0 14px 30px rgba(239, 68, 68, .22);
        transform: translateY(-1px);
    }

    .assessor-page-card {
        border: 1px solid var(--assessor-border);
        border-radius: 32px;
        background: var(--assessor-card);
        box-shadow: var(--assessor-shadow);
        overflow: hidden;
    }

    .assessor-card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 22px;
        padding: 28px;
        border-bottom: 1px solid rgba(148, 163, 184, .22);
        background:
            linear-gradient(135deg, rgba(255, 255, 255, .94), rgba(248, 250, 252, .76)),
            radial-gradient(circle at top right, rgba(37, 99, 235, .11), transparent 36%);
    }

    .assessor-title-group {
        display: flex;
        gap: 15px;
        align-items: flex-start;
        min-width: 0;
    }

    .assessor-title-line {
        width: 10px;
        height: 72px;
        flex: 0 0 10px;
        border-radius: 999px;
        background: linear-gradient(180deg, var(--assessor-blue), var(--assessor-gold));
        box-shadow: 0 10px 22px rgba(37, 99, 235, .18);
    }

    .eyebrow {
        margin: 0 0 7px;
        color: var(--assessor-gold);
        font-size: 12px;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: .09em;
    }

    .assessor-card-header h2 {
        margin: 0;
        color: var(--assessor-dark);
        font-size: 32px;
        line-height: 1.12;
        font-weight: 950;
        letter-spacing: -.05em;
        word-break: break-word;
    }

    .assessor-subtitle {
        max-width: 680px;
        margin: 9px 0 0;
        color: var(--assessor-slate);
        font-size: 14px;
        line-height: 1.65;
    }

    .assessor-header-actions {
        display: flex;
        align-items: flex-start;
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: wrap;
        flex: 0 0 auto;
    }

    .assessor-action-btn {
        color: #1d4ed8;
        background: #dbeafe;
        border-color: rgba(37, 99, 235, .20);
        box-shadow: 0 12px 24px rgba(37, 99, 235, .12);
    }

    .assessor-action-btn:hover {
        color: #fff;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        border-color: transparent;
        box-shadow: 0 14px 28px rgba(37, 99, 235, .22);
        transform: translateY(-1px);
    }

    .assessor-submit-btn {
        color: #047857;
        background: #d1fae5;
        border-color: rgba(16, 185, 129, .24);
        box-shadow: 0 12px 24px rgba(16, 185, 129, .11);
    }

    .assessor-submit-btn:hover {
        color: #fff;
        background: linear-gradient(135deg, #10b981, #047857);
        border-color: transparent;
        box-shadow: 0 14px 28px rgba(16, 185, 129, .23);
    }

    .assessor-content {
        padding: 26px 28px 30px;
    }

    [data-page-message] {
        margin-bottom: 16px;
    }

    .assessor-info-panel {
        margin-bottom: 22px;
        padding: 18px;
        border: 1px solid rgba(148, 163, 184, .32);
        border-radius: 24px;
        background:
            linear-gradient(135deg, rgba(248, 250, 252, .98), rgba(255, 255, 255, .98));
        box-shadow:
            0 16px 38px rgba(15, 23, 42, .075),
            inset 0 1px 0 rgba(255, 255, 255, .9);
    }

    .assessor-info-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 16px;
    }

    .assessor-info-header h3 {
        margin: 0;
        color: var(--assessor-dark);
        font-size: 18px;
        font-weight: 950;
        letter-spacing: -.03em;
    }

    .assessor-info-header p {
        margin: 5px 0 0;
        color: var(--assessor-slate);
        font-size: 13px;
        line-height: 1.55;
    }

    .assessor-mini-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 34px;
        padding: 7px 12px;
        border-radius: 999px;
        color: #92400e;
        background: #fef3c7;
        border: 1px solid rgba(245, 158, 11, .24);
        font-size: 12px;
        font-weight: 950;
        white-space: nowrap;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
    }

    .detail-item {
        position: relative;
        min-height: 96px;
        padding: 16px;
        border-radius: 20px;
        border: 1px solid rgba(148, 163, 184, .42);
        background: #fff;
        box-shadow:
            0 18px 36px rgba(15, 23, 42, .085),
            0 3px 8px rgba(15, 23, 42, .035),
            inset 0 1px 0 rgba(255, 255, 255, .95);
        overflow: hidden;
        transition:
            transform .2s ease,
            box-shadow .2s ease,
            border-color .2s ease;
    }

    .detail-item::after {
        content: "";
        position: absolute;
        right: -18px;
        top: -18px;
        width: 58px;
        height: 58px;
        border-radius: 999px;
        background: rgba(37, 99, 235, .07);
    }

    .detail-item:hover {
        transform: translateY(-2px);
        border-color: rgba(148, 163, 184, .55);
        box-shadow:
            0 22px 42px rgba(15, 23, 42, .11),
            0 5px 12px rgba(15, 23, 42, .045),
            inset 0 1px 0 rgba(255, 255, 255, .96);
    }

    .detail-label {
        display: block;
        position: relative;
        z-index: 1;
        color: #64748b;
        font-size: 11px;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: .06em;
        margin-bottom: 8px;
    }

    .detail-value {
        display: block;
        position: relative;
        z-index: 1;
        color: #0f172a;
        font-size: 14px;
        font-weight: 850;
        line-height: 1.5;
        word-break: break-word;
    }

    .assessor-tabs-panel {
        border: 1px solid rgba(148, 163, 184, .30);
        border-radius: 24px;
        background: #fff;
        box-shadow:
            0 18px 44px rgba(15, 23, 42, .075),
            inset 0 1px 0 rgba(255, 255, 255, .92);
        overflow: hidden;
    }

    .tabs {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        padding: 12px;
        border-bottom: 1px solid rgba(148, 163, 184, .18);
        background: linear-gradient(180deg, #f8fafc, #f1f5f9);
    }

    .tab-button {
        border: 0;
        cursor: pointer;
        min-height: 42px;
        padding: 10px 14px;
        border-radius: 14px;
        background: transparent;
        color: #64748b;
        font-size: 13px;
        font-weight: 950;
        transition: .2s ease;
    }

    .tab-button:hover {
        color: #0f172a;
        background: rgba(255, 255, 255, .7);
    }

    .tab-button.active {
        color: #0f172a;
        background: #fff;
        box-shadow: 0 10px 22px rgba(15, 23, 42, .08);
    }

    .assessor-tab-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 16px 18px;
        border-bottom: 1px solid rgba(148, 163, 184, .16);
        background: linear-gradient(135deg, rgba(248, 250, 252, .94), rgba(255, 255, 255, .96));
    }

    .assessor-tab-toolbar h3 {
        margin: 0;
        color: var(--assessor-dark);
        font-size: 17px;
        font-weight: 950;
        letter-spacing: -.03em;
    }

    .assessor-tab-toolbar p {
        margin: 5px 0 0;
        color: var(--assessor-slate);
        font-size: 13px;
        line-height: 1.55;
    }

    .assessor-search-wrap {
        position: relative;
        width: min(330px, 100%);
        flex: 0 0 auto;
    }

    .assessor-search-wrap::before {
        content: "";
        position: absolute;
        left: 14px;
        top: 50%;
        width: 14px;
        height: 14px;
        transform: translateY(-50%);
        border: 2px solid #64748b;
        border-radius: 999px;
        opacity: .72;
        pointer-events: none;
    }

    .assessor-search-wrap::after {
        content: "";
        position: absolute;
        left: 27px;
        top: 57%;
        width: 7px;
        height: 2px;
        transform: rotate(45deg);
        border-radius: 999px;
        background: #64748b;
        opacity: .72;
        pointer-events: none;
    }

    .assessor-search-input {
        width: 100%;
        min-height: 42px;
        padding: 0 14px 0 40px;
        border-radius: 999px;
        border: 1px solid rgba(148, 163, 184, .34);
        background: #fff;
        color: #0f172a;
        box-shadow:
            0 12px 26px rgba(15, 23, 42, .055),
            inset 0 1px 0 rgba(255, 255, 255, .95);
        font-size: 13px;
        font-weight: 800;
        outline: none;
        transition:
            border-color .2s ease,
            box-shadow .2s ease;
    }

    .assessor-search-input::placeholder {
        color: #94a3b8;
        font-weight: 750;
    }

    .assessor-search-input:focus {
        border-color: rgba(37, 99, 235, .45);
        box-shadow:
            0 0 0 5px rgba(37, 99, 235, .10),
            0 12px 26px rgba(15, 23, 42, .06),
            inset 0 1px 0 rgba(255, 255, 255, .95);
    }

    .tab-content {
        display: none;
        padding: 18px;
    }

    .tab-content.active {
        display: block;
    }

    .table-container {
        overflow: hidden;
        border-radius: 20px;
        border: 1px solid rgba(148, 163, 184, .28);
        background: #fff;
        box-shadow: 0 14px 34px rgba(15, 23, 42, .045);
    }

    .table-scroll {
        width: 100%;
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        min-width: 820px;
        border-collapse: collapse;
    }

    .data-table thead {
        background: linear-gradient(180deg, #f8fafc, #f1f5f9);
    }

    .data-table th {
        padding: 16px;
        color: #64748b;
        font-size: 12px;
        font-weight: 950;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: .045em;
        border-bottom: 1px solid rgba(148, 163, 184, .24);
        white-space: nowrap;
    }

    .data-table td {
        padding: 16px;
        color: #1e293b;
        font-size: 14px;
        line-height: 1.5;
        border-bottom: 1px solid rgba(148, 163, 184, .15);
        vertical-align: middle;
        font-weight: 700;
        background: #fff;
    }

    .data-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .data-table tbody tr {
        transition: .18s ease;
    }

    .data-table tbody tr:hover td {
        background: #f8fafc;
    }

    .data-table td[colspan] {
        padding: 34px 18px;
        color: var(--assessor-slate);
        text-align: center;
        font-weight: 850;
    }

    .mapping-actions {
        margin-top: 0;
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .status-badge {
        min-height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 10px;
        border-radius: 999px;
        color: #1d4ed8;
        background: #dbeafe;
        border: 1px solid rgba(37, 99, 235, .18);
        font-size: 12px;
        font-weight: 950;
        white-space: nowrap;
    }

    .status-badge[data-status="draft"] {
        color: #92400e;
        background: #fef3c7;
        border-color: rgba(245, 158, 11, .24);
    }

    .status-badge[data-status="active"],
    .status-badge[data-status="approved"],
    .status-badge[data-status="assessed"] {
        color: #047857;
        background: #d1fae5;
        border-color: rgba(16, 185, 129, .24);
    }

    .status-badge[data-status="rejected"] {
        color: #b91c1c;
        background: #fee2e2;
        border-color: rgba(239, 68, 68, .25);
    }

    .table-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .button,
    .button-small,
    .button-muted {
        text-decoration: none;
        border: 0;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        font-weight: 900;
        transition: .2s ease;
    }

    .button {
        min-height: 42px;
        padding: 10px 15px;
        color: #fff;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        font-size: 14px;
        font-weight: 950;
        box-shadow: 0 12px 24px rgba(37, 99, 235, .18);
    }

    .button:hover {
        transform: translateY(-1px);
        box-shadow: 0 16px 32px rgba(37, 99, 235, .22);
    }

    .button-small {
        min-height: 34px;
        padding: 8px 12px;
        font-size: 12px;
        white-space: nowrap;
    }

    .button-muted {
        color: #1d4ed8;
        background: #dbeafe;
        border: 1px solid rgba(37, 99, 235, .18);
        box-shadow: none;
    }

    .button-muted:hover {
        color: #fff;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        border-color: transparent;
        box-shadow: 0 12px 24px rgba(37, 99, 235, .2);
        transform: translateY(-1px);
    }

    .modal {
        position: fixed;
        inset: 0;
        z-index: 999;
        display: grid;
        place-items: center;
        padding: 18px;
        background: rgba(15, 23, 42, .58);
        backdrop-filter: blur(10px);
    }

    .modal[hidden] {
        display: none;
    }

    .modal-content {
        width: min(620px, 100%);
        max-height: calc(100vh - 36px);
        overflow: hidden;
        border-radius: 28px;
        background: #fff;
        box-shadow: 0 30px 90px rgba(15, 23, 42, .32);
        border: 1px solid rgba(255,255,255,.5);
    }

    .modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 20px 24px;
        border-bottom: 1px solid rgba(148, 163, 184, .22);
        background:
            linear-gradient(135deg, rgba(255, 255, 255, .96), rgba(248, 250, 252, .86));
    }

    .modal-header h3 {
        margin: 0;
        color: #0f172a;
        font-size: 20px;
        font-weight: 950;
        letter-spacing: -.03em;
    }

    .modal-close {
        width: 38px;
        height: 38px;
        border: 0;
        border-radius: 14px;
        background: #f1f5f9;
        color: #0f172a;
        font-size: 24px;
        line-height: 1;
        cursor: pointer;
        transition: .2s ease;
    }

    .modal-close:hover {
        color: #fff;
        background: #ef4444;
    }

    .modal-body {
        padding: 24px;
        max-height: calc(100vh - 128px);
        overflow-y: auto;
    }

    .form-grid {
        display: grid;
        gap: 14px;
    }

    .form-grid-full {
        min-width: 0;
    }

    .form-grid label {
        display: grid;
        gap: 8px;
        color: #334155;
        font-size: 14px;
        font-weight: 900;
    }

    .form-grid input[type="checkbox"] {
        width: 17px;
        height: 17px;
        accent-color: #2563eb;
    }

    .modal-body {
        min-height: 340px;
    }

    .form-grid textarea,
    .form-grid select {
        width: 100%;
        border: 1px solid rgba(148, 163, 184, .35);
        border-radius: 16px;
        padding: 12px 14px;
        color: #0f172a;
        background: #fff;
        outline: none;
        font-size: 14px;
        transition: .2s ease;
    }

    .form-grid textarea:focus,
    .form-grid select:focus {
        border-color: rgba(37, 99, 235, .45);
        box-shadow: 0 0 0 5px rgba(37, 99, 235, .1);
    }

    .checkbox-label {
        display: flex !important;
        align-items: center;
        gap: 10px !important;
        min-height: 42px;
        padding: 12px 14px;
        border-radius: 16px;
        background: #f8fafc;
        border: 1px solid rgba(148, 163, 184, .24);
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 16px;
    }

    @media (max-width: 1050px) {
        .detail-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 900px) {
        .assessor-topbar,
        .assessor-card-header,
        .assessor-tab-toolbar {
            align-items: stretch;
            flex-direction: column;
        }

        .assessor-top-actions,
        .assessor-header-actions {
            justify-content: flex-start;
        }

        .connection-pill {
            width: fit-content;
        }

        .assessor-info-header {
            flex-direction: column;
        }

        .assessor-search-wrap {
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        .assessor-shell {
            padding: 18px 14px;
        }

        .assessor-topbar {
            border-radius: 22px;
            padding: 16px;
        }

        .assessor-brand {
            align-items: flex-start;
        }

        .assessor-logo {
            width: 46px;
            height: 46px;
            flex-basis: 46px;
            border-radius: 16px;
        }

        .assessor-brand-text h1 {
            font-size: 21px;
        }

        .assessor-brand-text p {
            font-size: 12px;
        }

        .assessor-top-actions {
            display: grid;
            grid-template-columns: 1fr;
            width: 100%;
        }

        .connection-pill,
        .assessor-logout-btn,
        .assessor-back-btn,
        .assessor-action-btn {
            width: 100%;
        }

        .assessor-page-card {
            border-radius: 24px;
        }

        .assessor-card-header {
            padding: 22px 18px;
        }

        .assessor-title-line {
            height: 66px;
        }

        .assessor-card-header h2 {
            font-size: 25px;
        }

        .assessor-subtitle {
            font-size: 13px;
        }

        .assessor-header-actions {
            display: grid;
            grid-template-columns: 1fr;
            width: 100%;
        }

        .assessor-content {
            padding: 18px;
        }

        .assessor-info-panel {
            padding: 14px;
            border-radius: 20px;
        }

        .detail-grid {
            grid-template-columns: 1fr;
        }

        .assessor-tabs-panel {
            border-radius: 20px;
        }

        .tabs {
            display: grid;
            grid-template-columns: 1fr;
        }

        .tab-button {
            width: 100%;
        }

        .tab-content {
            padding: 14px;
        }

        .assessor-tab-toolbar {
            padding: 14px;
        }

        .data-table {
            min-width: 760px;
        }

        .modal-actions {
            flex-direction: column-reverse;
        }

        .modal-actions .button,
        .modal-actions .button-muted {
            width: 100%;
        }
    }
</style>

<section class="assessor-shell" data-protected-shell hidden data-assessment-id="">
    <div class="assessor-container">

        <header class="assessor-topbar">
            <div class="assessor-brand">
                <div class="assessor-logo">RPL</div>

                <div class="assessor-brand-text">
                    <small>Assessor Panel</small>
                    <h1 data-assessment-title>Assessment Detail</h1>
                    <p>Detail pemeriksaan dan penilaian pengajuan calon mahasiswa.</p>
                </div>
            </div>

            <div class="assessor-top-actions">
                <span class="connection-pill" data-api-status>Connecting</span>

                <a class="assessor-back-btn" href="/assessments">
                    Back
                </a>

                <button type="button" class="assessor-logout-btn" data-logout>
                    Logout
                </button>
            </div>
        </header>

        <main class="assessor-page-card">
            <div class="assessor-card-header">
                <div class="assessor-title-group">
                    <span class="assessor-title-line"></span>

                    <div>
                        <p class="eyebrow" data-assessment-status-badge>Status</p>
                        <h2 data-assessment-number>Application Number</h2>
                        <p class="assessor-subtitle">
                            Periksa data calon mahasiswa, matakuliah sebelumnya, pengalaman belajar, dokumen pendukung,
                            dan mapping ke mata kuliah tujuan untuk proses konversi SKS.
                        </p>
                    </div>
                </div>

                <div class="assessor-header-actions">
                    <button class="assessor-action-btn" type="button" data-create-assessment hidden>
                        Mulai Penilaian
                    </button>

                    <button class="assessor-action-btn assessor-submit-btn" type="button" data-submit-assessment hidden>
                        Submit Penilaian
                    </button>
                </div>
            </div>

            <div class="assessor-content">
                <div data-page-message></div>

                <section class="assessor-info-panel">
                    <div class="assessor-info-header">
                        <div>
                            <h3>Informasi Assessment</h3>
                            <p>
                                Ringkasan data calon mahasiswa dan hasil assessment.
                            </p>
                        </div>

                        <span class="assessor-mini-badge">
                            Assessment Review
                        </span>
                    </div>

                    <div class="detail-grid" data-assessment-info>
                        <div class="detail-item">
                            <span class="detail-label">Pemohon</span>
                            <span class="detail-value" data-detail-applicant-name>-</span>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Email</span>
                            <span class="detail-value" data-detail-applicant-email>-</span>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Program Studi</span>
                            <span class="detail-value" data-detail-study-program>-</span>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Tipe RPL</span>
                            <span class="detail-value" data-detail-rpl-type>-</span>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Total SKS Dikonversi</span>
                            <span class="detail-value" data-detail-total-sks>-</span>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Rekomendasi</span>
                            <span class="detail-value" data-detail-recommendation>-</span>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Catatan</span>
                            <span class="detail-value" data-detail-notes>-</span>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Diajukan</span>
                            <span class="detail-value" data-detail-submitted-at>-</span>
                        </div>
                    </div>
                </section>

                <section class="assessor-tabs-panel">
                    <div class="tabs" data-tabs>
                        <button class="tab-button active" data-tab-button="a1-courses" data-rpl-section="a1">
                            Matakuliah Sumber
                        </button>

                        <button class="tab-button" data-tab-button="a2-experiences" data-rpl-section="a2">
                            Pengalaman Belajar
                        </button>

                        <button class="tab-button" data-tab-button="course-mappings">
                            Mapping Matakuliah
                        </button>

                        <button class="tab-button" data-tab-button="documents">
                            Documents
                        </button>
                    </div>

                    <div class="assessor-tab-toolbar">
                        <div>
                            <h3>Data Assessment</h3>
                            <p>Gunakan search bar untuk mencari data pada tabel aktif.</p>
                        </div>

                        <div style="display:flex; align-items:center; gap:8px;">
                            <div class="mapping-actions" data-mapping-actions style="margin-top:0;">
                                <button class="button button-small button-muted" type="button" data-add-a1-mapping hidden>
                                    Mapping Matakuliah
                                </button>
                                <button class="button button-small button-muted" type="button" data-add-a2-mapping hidden>
                                    Mapping Matakuliah
                                </button>
                            </div>

                            <label class="assessor-search-wrap" for="assessmentDetailSearch">
                                <input
                                    type="search"
                                    id="assessmentDetailSearch"
                                    class="assessor-search-input"
                                    data-assessment-detail-search
                                    placeholder="Cari data tabel aktif..."
                                    autocomplete="off"
                                >
                            </label>
                        </div>
                    </div>

                    <div class="tab-content active" data-tab-content="a1-courses" data-rpl-section="a1">
                        <div class="table-container">
                            <div class="table-scroll">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama Mata Kuliah</th>
                                            <th>SKS</th>
                                            <th>Nilai</th>
                                            <th>Institusi</th>
                                        </tr>
                                    </thead>

                                    <tbody data-a1-courses-body>
                                        <tr>
                                            <td colspan="5">Memuat data...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" data-tab-content="a2-experiences" data-rpl-section="a2">
                        <div class="table-container">
                            <div class="table-scroll">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Judul</th>
                                            <th>Tipe</th>
                                            <th>Organisasi</th>
                                            <th>Periode</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>

                                    <tbody data-a2-experiences-body>
                                        <tr>
                                            <td colspan="5">Memuat data...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" data-tab-content="course-mappings">
                        <div class="table-container">
                            <div class="table-scroll">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Sumber</th>
                                            <th>Tipe Pengajuan</th>
                                            <th>Mata Kuliah Tujuan</th>
                                            <th>SKS</th>
                                            <th>Diakui</th>
                                            <th>Catatan</th>
                                        </tr>
                                    </thead>

                                    <tbody data-assessment-mappings-body>
                                        <tr>
                                            <td colspan="6">Memuat data...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" data-tab-content="documents">
                        <div class="table-container">
                            <div class="table-scroll">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Nama Dokumen</th>
                                            <th>Jenis</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody data-documents-body>
                                        <tr>
                                            <td colspan="3">Memuat data...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </main>
    </div>
</section>

<div class="modal" data-modal="create-mapping" hidden>
    <div class="modal-content">
        <div class="modal-header">
            <h3 data-mapping-modal-title>Mapping Matakuliah</h3>
            <button class="modal-close" type="button" data-close-modal="create-mapping">&times;</button>
        </div>

        <div class="modal-body">
            <form data-mapping-form class="form-grid" style="border:0;background:transparent;box-shadow:none;padding:0;">
                <input type="hidden" name="source_type" data-source-type>

                <div class="form-grid-full">
                    <label>
                        Sumber
                        <select name="source_id" required>
                            <option value="">Memuat...</option>
                        </select>
                    </label>
                </div>

                <div class="form-grid-full">
                    <label>
                        Status Pengakuan
                        <select name="is_recognized" data-recognized-select>
                            <option value="1">Diakui</option>
                            <option value="0">Tidak Diakui</option>
                        </select>
                    </label>
                </div>

                <div class="form-grid-full" data-study-program-wrapper>
                    <label>
                        Filter Prodi
                        <select data-study-program-select>
                            <option value="">Memuat prodi...</option>
                        </select>
                    </label>
                </div>

                <div class="form-grid-full" data-semester-wrapper>
                    <label>
                        Filter Semester
                        <select data-semester-select>
                            <option value="">-- Semua Semester --</option>
                            <option value="1">Semester 1</option>
                            <option value="2">Semester 2</option>
                            <option value="3">Semester 3</option>
                            <option value="4">Semester 4</option>
                            <option value="5">Semester 5</option>
                            <option value="6">Semester 6</option>
                            <option value="7">Semester 7</option>
                            <option value="8">Semester 8</option>
                        </select>
                    </label>
                </div>

                <div class="form-grid-full" data-course-select-wrapper>
                    <label>
                        Mata Kuliah Tujuan
                        <select name="course_id" data-course-select>
                            <option value="">Memuat course...</option>
                        </select>
                    </label>
                </div>

                <div class="form-grid-full">
                    <label>
                        Catatan
                        <textarea name="notes" rows="3" placeholder="Catatan mapping..."></textarea>
                    </label>
                </div>

                <div data-form-message></div>

                <div class="modal-actions">
                    <button class="button button-muted" type="button" data-close-modal="create-mapping">
                        Batal
                    </button>

                    <button class="button" type="button" data-submit-mapping>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const apiStatus = document.querySelector('[data-api-status]');
        const searchInput = document.querySelector('[data-assessment-detail-search]');
        const tabs = document.querySelector('[data-tabs]');

        function normalizeText(value) {
            return String(value || '').trim().toLowerCase();
        }

        function refreshApiStatusClass() {
            if (!apiStatus) return;

            const text = normalizeText(apiStatus.textContent);

            apiStatus.classList.remove('is-connected', 'is-connecting', 'is-error', 'is-disconnected');

            if (text.includes('connected') && !text.includes('disconnect')) {
                apiStatus.classList.add('is-connected');
                return;
            }

            if (text.includes('connecting') || text.includes('loading') || text.includes('memuat')) {
                apiStatus.classList.add('is-connecting');
                return;
            }

            if (text.includes('error') || text.includes('failed') || text.includes('offline') || text.includes('disconnected') || text.includes('gagal')) {
                apiStatus.classList.add('is-error');
                return;
            }

            apiStatus.classList.add('is-connecting');
        }

        function getActiveTabContent() {
            return document.querySelector('.tab-content.active');
        }

        function isUtilityRow(row) {
            if (!row) return true;
            const colspanCell = row.querySelector('td[colspan]');
            if (!colspanCell) return false;
            const text = normalizeText(row.textContent);
            return (
                text.includes('memuat') ||
                text.includes('gagal') ||
                text.includes('tidak ada') ||
                text.includes('belum ada')
            );
        }

        function removeSearchEmptyRow(tbody) {
            if (!tbody) return;
            const emptyRow = tbody.querySelector('[data-search-empty-row]');
            if (emptyRow) emptyRow.remove();
        }

        function ensureSearchEmptyRow(tbody, colspan) {
            if (!tbody) return;
            let emptyRow = tbody.querySelector('[data-search-empty-row]');
            if (!emptyRow) {
                emptyRow = document.createElement('tr');
                emptyRow.setAttribute('data-search-empty-row', 'true');
                emptyRow.innerHTML = '<td colspan="' + colspan + '">Data tidak ditemukan sesuai pencarian.</td>';
                tbody.appendChild(emptyRow);
            }
        }

        function resetHiddenRowsOutsideActive() {
            document.querySelectorAll('.tab-content:not(.active) tbody tr').forEach(function (row) {
                row.hidden = false;
            });
        }

        function syncMappingActionsVisibility() {
            const mappingActions = document.querySelector('[data-mapping-actions]');
            if (!mappingActions) return;

            const activeTab = document.querySelector('.tab-button.active');
            const isMappingTab = activeTab?.dataset.tabButton === 'course-mappings';
            const isAllowed = mappingActions.dataset.allowMapping === 'true';

            mappingActions.hidden = !(isMappingTab && isAllowed);
        }

        window.syncMappingActionsVisibility = syncMappingActionsVisibility;

        function filterActiveTable() {
            if (!searchInput) return;
            const activeContent = getActiveTabContent();
            if (!activeContent) return;
            const tbody = activeContent.querySelector('tbody');
            if (!tbody) return;
            const query = normalizeText(searchInput.value);
            const rows = Array.from(tbody.querySelectorAll('tr')).filter(function (row) {
                return !row.hasAttribute('data-search-empty-row');
            });
            const dataRows = rows.filter(function (row) {
                return !isUtilityRow(row);
            });
            const firstRow = rows[0];
            const colspan = firstRow?.querySelector('td[colspan]')?.getAttribute('colspan')
                || activeContent.querySelectorAll('thead th').length
                || 1;
            removeSearchEmptyRow(tbody);
            if (!dataRows.length) return;
            let visibleCount = 0;
            dataRows.forEach(function (row) {
                const text = normalizeText(row.textContent);
                const match = !query || text.includes(query);
                row.hidden = !match;
                if (match) visibleCount++;
            });
            if (query && visibleCount === 0) {
                ensureSearchEmptyRow(tbody, colspan);
            }
        }

        if (apiStatus) {
            const statusObserver = new MutationObserver(refreshApiStatusClass);
            statusObserver.observe(apiStatus, { childList: true, subtree: true, characterData: true });
            refreshApiStatusClass();
        }

        if (searchInput) {
            searchInput.addEventListener('input', filterActiveTable);
        }

        if (tabs) {
            tabs.addEventListener('click', function () {
                setTimeout(function () {
                    resetHiddenRowsOutsideActive();
                    filterActiveTable();
                    syncMappingActionsVisibility();
                }, 0);
            });
        }

        document.querySelectorAll('.tab-content tbody').forEach(function (tbody) {
            const observer = new MutationObserver(filterActiveTable);
            observer.observe(tbody, { childList: true, subtree: true, characterData: true });
        });
    });
</script>
@endsection