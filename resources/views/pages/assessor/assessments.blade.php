@extends('layouts.app')

@section('title', 'Assessments - G-RPL2')
@section('page', 'assessments')
@section('authRequired', 'true')
@section('roleRequired', 'assessor')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <aside class="sidebar">
            <p class="eyebrow">Assessor</p>
            <h1>Assessments</h1>
        </aside>
        <div class="workspace">
            <div class="workspace-header">
                <div>
                    <p class="eyebrow">Assessment Queue</p>
                    <h2>Penilaian applicant</h2>
                </div>
                <span class="connection-pill" data-api-status>Connecting</span>
            </div>
            <div class="dashboard-grid">
                <div class="module-card">
                    <strong>Assessment Queue</strong>
                    <span>Antrian assessment akan tampil di sini saat endpoint penilaian sudah tersedia.</span>
                </div>
                <div class="module-card">
                    <strong>Evidence Review</strong>
                    <span>Periksa course, learning experience, dan dokumen pendukung applicant.</span>
                </div>
                <div class="module-card">
                    <strong>Assessment Status</strong>
                    <span>Status penilaian akan mengikuti data resmi dari backend.</span>
                </div>
            </div>
        </div>
    </section>
@endsection
