@extends('layouts.app')

@section('title', 'Submissions - G-RPL2')
@section('page', 'submissions')
@section('authRequired', 'true')
@section('roleRequired', 'staff_rpl')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <aside class="sidebar">
            <p class="eyebrow">Staff</p>
            <h1>Submissions</h1>
        </aside>
        <div class="workspace">
            <div class="workspace-header">
                <div>
                    <p class="eyebrow">Submission Review</p>
                    <h2>Review administrasi</h2>
                </div>
                <span class="connection-pill" data-api-status>Connecting</span>
            </div>
            <div class="dashboard-grid">
                <div class="module-card">
                    <strong>Submission Intake</strong>
                    <span>Pengajuan masuk akan tampil di sini untuk pemeriksaan administrasi.</span>
                </div>
                <div class="module-card">
                    <strong>Document Check</strong>
                    <span>Validasi kelengkapan dokumen sebelum diteruskan ke assessor.</span>
                </div>
                <div class="module-card">
                    <strong>Assessor Assignment</strong>
                    <span>Penugasan assessor mengikuti data submission yang sudah siap diproses.</span>
                </div>
            </div>
        </div>
    </section>
@endsection
