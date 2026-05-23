@extends('layouts.app')

@section('title', 'Users - G-RPL2')
@section('page', 'users')
@section('authRequired', 'true')

@section('content')
    <section class="app-shell" data-protected-shell>
        <aside class="sidebar">
            <p class="eyebrow">Admin</p>
            <h1>Users</h1>
        </aside>
        <div class="workspace">
            <div class="workspace-header">
                <div>
                    <p class="eyebrow">User Management</p>
                    <h2>Pengelolaan user</h2>
                </div>
                <span class="connection-pill" data-api-status>Connecting</span>
            </div>
            <div class="empty-state">
                <strong>Endpoint user management belum tersedia.</strong>
                <span>Halaman ini sudah diproteksi role admin melalui data user dari backend.</span>
            </div>
        </div>
    </section>
@endsection
