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
            <div data-page-message></div>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nomor Aplikasi</th>
                            <th>Pemohon</th>
                            <th>Program Studi</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th>Diajukan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody data-submissions-body>
                        <tr><td colspan="7">Memuat data...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
