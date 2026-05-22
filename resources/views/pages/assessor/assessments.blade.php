@extends('layouts.app')

@section('title', 'Assessments - G-RPL2')
@section('page', 'assessments')
@section('authRequired', 'true')

@section('content')
    <section class="app-shell" data-protected-shell>
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
            <div class="empty-state">
                <strong>Antrian assessment belum tersedia.</strong>
                <span>Halaman ini sudah diproteksi role assessor melalui data user dari backend.</span>
            </div>
        </div>
    </section>
@endsection
