@extends('layouts.app')

@section('title', 'Register - G-RPL2')
@section('page', 'register')

@section('content')
    <section class="auth-screen">
        <form class="auth-card" data-auth-form="register">
            <div>
                <p class="eyebrow">Applicant Registration</p>
                <h1>Buat akun applicant</h1>
            </div>

            <label>
                Nama
                <input name="name" type="text" autocomplete="name" required>
            </label>

            <label>
                Email
                <input name="email" type="email" autocomplete="email" required>
            </label>

            <label>
                Password
                <input name="password" type="password" autocomplete="new-password" minlength="8" required>
            </label>

            <label>
                Konfirmasi Password
                <input name="password_confirmation" type="password" autocomplete="new-password" minlength="8" required>
            </label>

            <div class="form-message" data-form-message aria-live="polite"></div>

            <button class="button" type="submit" data-submit-button>Register</button>

            <p class="auth-switch">
                Sudah punya akun?
                <a href="/login">Login</a>
            </p>
        </form>
    </section>
@endsection
