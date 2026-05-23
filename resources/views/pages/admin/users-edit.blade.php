@extends('layouts.app')

@section('title', 'Edit User - G-RPL2')
@section('page', 'users-edit')
@section('authRequired', 'true')
@section('roleRequired', 'system_admin')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <aside class="sidebar">
            <p class="eyebrow">Admin</p>
            <h1>Edit User</h1>
            <a class="button button-small button-muted" href="/admin/users">Back</a>
        </aside>
        <div class="workspace">
            <div class="workspace-header">
                <div>
                    <p class="eyebrow">User Management</p>
                    <h2>Ubah data user</h2>
                </div>
                <span class="connection-pill" data-api-status>Connecting</span>
            </div>
            <div class="empty-state">
                <strong>Halaman edit user siap consume detail dan update user dari API.</strong>
                <span>Route ini mengikuti dokumentasi frontend untuk halaman edit user.</span>
            </div>
        </div>
    </section>
@endsection
