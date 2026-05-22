@extends('layouts.app')

@section('title', 'Applications - G-RPL2')
@section('page', 'applications')
@section('authRequired', 'true')

@section('content')
    <section class="app-shell" data-protected-shell>
        <aside class="sidebar">
            <p class="eyebrow">Applicant</p>
            <h1>Applications</h1>
            <a class="button button-small" href="/applications/create">Create</a>
        </aside>
        <div class="workspace">
            <div class="workspace-header">
                <div>
                    <p class="eyebrow">Application List</p>
                    <h2>Pengajuan RPL</h2>
                </div>
                <span class="connection-pill" data-api-status>Connecting</span>
            </div>
            <div class="empty-state">
                <strong>Belum ada data aplikasi dari API modul applicant.</strong>
                <span>Autentikasi sudah memakai token backend dan siap untuk endpoint aplikasi berikutnya.</span>
            </div>
        </div>
    </section>
@endsection
