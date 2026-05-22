@extends('layouts.app')

@section('title', 'Create Application - G-RPL2')
@section('page', 'applications-create')
@section('authRequired', 'true')

@section('content')
    <section class="app-shell" data-protected-shell>
        <aside class="sidebar">
            <p class="eyebrow">Applicant</p>
            <h1>Create Application</h1>
            <a class="button button-small button-muted" href="/applications">Back</a>
        </aside>
        <div class="workspace">
            <div class="workspace-header">
                <div>
                    <p class="eyebrow">Draft</p>
                    <h2>Form pengajuan</h2>
                </div>
                <span class="connection-pill" data-api-status>Connecting</span>
            </div>
            <form class="form-grid">
                <label>
                    Program Studi
                    <input type="text" placeholder="Pilih program studi" disabled>
                </label>
                <label>
                    Tipe Rekognisi
                    <input type="text" placeholder="Menunggu endpoint master data" disabled>
                </label>
                <button class="button" type="button" disabled>Submit</button>
            </form>
        </div>
    </section>
@endsection
