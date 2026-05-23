@extends('layouts.app')

@section('title', 'Edit Study Program - G-RPL2')
@section('page', 'study-programs-edit')
@section('authRequired', 'true')
@section('roleRequired', 'system_admin')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <aside class="sidebar">
            <p class="eyebrow">Admin</p>
            <h1>Edit Study Program</h1>
            <a class="button button-small button-muted" href="/admin/study-programs">Back</a>
        </aside>
        <div class="workspace">
            <div class="workspace-header">
                <div>
                    <p class="eyebrow">Master Data</p>
                    <h2>Ubah program studi</h2>
                </div>
                <span class="connection-pill" data-api-status>Connecting</span>
            </div>
            <div class="empty-state">
                <strong>Halaman edit program studi siap consume detail dan update API.</strong>
                <span>Route ini mengikuti dokumentasi frontend untuk edit study program.</span>
            </div>
        </div>
    </section>
@endsection
