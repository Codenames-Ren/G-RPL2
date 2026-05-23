@extends('layouts.app')

@section('title', 'Create Study Program - G-RPL2')
@section('page', 'study-programs-create')
@section('authRequired', 'true')
@section('roleRequired', 'system_admin')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <aside class="sidebar">
            <p class="eyebrow">Admin</p>
            <h1>Create Study Program</h1>
            <a class="button button-small button-muted" href="/admin/study-programs">Back</a>
        </aside>
        <div class="workspace">
            <div class="workspace-header">
                <div>
                    <p class="eyebrow">Master Data</p>
                    <h2>Tambah program studi</h2>
                </div>
                <span class="connection-pill" data-api-status>Connecting</span>
            </div>
            <div class="empty-state">
                <strong>Form program studi siap consume endpoint create study program.</strong>
                <span>Route ini mengikuti dokumentasi frontend untuk create study program.</span>
            </div>
        </div>
    </section>
@endsection
