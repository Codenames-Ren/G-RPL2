@extends('layouts.app')

@section('title', 'Master Data - G-RPL2')
@section('page', 'master-data')
@section('authRequired', 'true')

@section('content')
    <section class="app-shell" data-protected-shell>
        <aside class="sidebar">
            <p class="eyebrow">Admin</p>
            <h1>Master Data</h1>
        </aside>
        <div class="workspace">
            <div class="workspace-header">
                <div>
                    <p class="eyebrow">Reference Data</p>
                    <h2>Program dan mata kuliah</h2>
                </div>
                <span class="connection-pill" data-api-status>Connecting</span>
            </div>
            <div class="empty-state">
                <strong>Endpoint master data belum tersedia.</strong>
                <span>Halaman ini sudah diproteksi role admin melalui data user dari backend.</span>
            </div>
        </div>
    </section>
@endsection
