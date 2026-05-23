@extends('layouts.app')

@section('title', 'Study Programs - G-RPL2')
@section('page', 'study-programs')
@section('authRequired', 'true')
@section('roleRequired', 'system_admin')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <aside class="sidebar">
            <p class="eyebrow">Admin</p>
            <h1>Study Programs</h1>
            <a class="button button-small" href="/admin/study-programs/create">Create</a>
        </aside>
        <div class="workspace">
            <div class="workspace-header">
                <div>
                    <p class="eyebrow">Master Data</p>
                    <h2>Daftar program studi</h2>
                </div>
                <span class="connection-pill" data-api-status>Connecting</span>
            </div>
            <div class="empty-state">
                <strong>Data program studi siap dihubungkan ke API admin.</strong>
                <span>Route ini mengikuti dokumentasi frontend untuk study program list.</span>
            </div>
        </div>
    </section>
@endsection
