@extends('layouts.app')

@section('title', 'G-RPL2')
@section('page', 'home')

@section('content')
    <section class="hero">
        <div class="hero-copy">
            <p class="eyebrow">Rekognisi Pembelajaran Lampau</p>
            <h1>Kelola proses RPL dari pendaftaran sampai keputusan akhir.</h1>
            <p>
                Portal ini terhubung ke backend API untuk autentikasi, pemeriksaan sesi,
                dan navigasi berbasis role.
            </p>
            <div class="actions">
                <a class="button" href="/login">Masuk</a>
                <a class="button button-muted" href="/register">Daftar Applicant</a>
            </div>
        </div>
        <div class="status-panel" aria-label="System overview">
            <div>
                <span class="metric">5</span>
                <span>Role aktif</span>
            </div>
            <div>
                <span class="metric">Bearer</span>
                <span>Sanctum token</span>
            </div>
            <div>
                <span class="metric">API</span>
                <span>/api/auth</span>
            </div>
        </div>
    </section>
@endsection
