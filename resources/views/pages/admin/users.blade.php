@extends('layouts.app')

@section('title', 'Users - G-RPL2')
@section('page', 'users')
@section('authRequired', 'true')
@section('roleRequired', 'system_admin')

@section('content')
    <section class="app-shell" data-protected-shell hidden>
        <aside class="sidebar">
            <p class="eyebrow">Admin</p>
            <h1>Users</h1>
            <a class="button button-small" href="/admin/users/create">Create</a>
        </aside>
        <div class="workspace">
            <div class="workspace-header">
                <div>
                    <p class="eyebrow">User Management</p>
                    <h2>Manajemen Data Pengguna Internal</h2>
                </div>
                <span class="connection-pill" data-api-status>Connecting</span>
            </div>
            <form class="toolbar" data-admin-filter="users">
                <input type="search" name="search" placeholder="Cari nama atau email">
                <select name="role">
                    <option value="">Semua role</option>
                    <option value="assessor">Assessor</option>
                    <option value="staff_rpl">Staff RPL</option>
                    <option value="committee">Committee</option>
                </select>
                <select name="is_active">
                    <option value="">Semua status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                <button class="button button-small" type="submit">Filter</button>
            </form>

            <p class="form-message" data-page-message aria-live="polite"></p>

            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>NIP</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody data-users-body>
                        <tr>
                            <td colspan="6">Memuat user...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
