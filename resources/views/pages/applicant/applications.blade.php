@extends('layouts.app')

@section('title', 'Applications - G-RPL2')
@section('page', 'applications')
@section('authRequired', 'true')
@section('roleRequired', 'applicant')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
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
            <div data-page-message></div>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nomor Aplikasi</th>
                            <th>Program Studi</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody data-applications-body>
                        <tr><td colspan="6">Memuat data...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
