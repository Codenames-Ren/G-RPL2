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
            <div class="empty-state">
                <strong>Daftar approval belum tersedia.</strong>
                <span>Halaman ini sudah diproteksi role committee melalui data user dari backend.</span>
            </div>
        </div>
    </section>
@endsection
