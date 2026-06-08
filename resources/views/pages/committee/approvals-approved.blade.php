@extends('layouts.app')

@section('title', 'Approved Applications - G-RPL2')
@section('page', 'approvals-approved')
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
                    <h2>Pengajuan sudah disetujui</h2>
                </div>
                <span class="connection-pill" data-api-status>Connecting</span>
            </div>
            <div data-page-message></div>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nomor Aplikasi</th>
                            <th>Pemohon</th>
                            <th>Program Studi</th>
                            <th>Total SKS</th>
                            <th>Catatan</th>
                            <th>Disetujui</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody data-approved-body>
                        <tr><td colspan="7">Memuat data...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
