@extends('layouts.app')

@section('title', 'Approvals - G-RPL2')
@section('page', 'approvals')
@section('authRequired', 'true')
@section('roleRequired', 'committee')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <aside class="sidebar">
            <p class="eyebrow">Committee</p>
            <h1>Approvals</h1>
        </aside>
        <div class="workspace">
            <div class="workspace-header">
                <div>
                    <p class="eyebrow">Approval Board</p>
                    <h2>Persetujuan komite</h2>
                </div>
                <span class="connection-pill" data-api-status>Connecting</span>
            </div>
            <div class="dashboard-grid">
                <div class="module-card">
                    <strong>Approval Board</strong>
                    <span>Daftar pengajuan siap keputusan akan tampil di area ini.</span>
                </div>
                <div class="module-card">
                    <strong>Final Review</strong>
                    <span>Lihat hasil assessment dan catatan administrasi sebelum approval.</span>
                </div>
                <div class="module-card">
                    <strong>Decision Log</strong>
                    <span>Riwayat keputusan komite mengikuti data persetujuan dari backend.</span>
                </div>
            </div>
        </div>
    </section>
@endsection
