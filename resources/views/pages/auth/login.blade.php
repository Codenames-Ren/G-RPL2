@extends('layouts.app')

@section('title', 'Login - G-RPL2')
@section('page', 'login')

@section('content')
    <section class="auth-screen">
        <form class="auth-card" data-auth-form="login">
            <div>
                <p class="eyebrow">Secure Access</p>
                <h1>Masuk ke G-RPL2</h1>
            </div>

            <label>
                Email
                <input name="email" type="email" autocomplete="email" required>
            </label>

            <label>
                Password
                <input name="password" type="password" autocomplete="current-password" required>
            </label>

            <div class="form-message" data-form-message aria-live="polite"></div>

            <button class="button" type="submit" data-submit-button>Login</button>

            <p class="auth-switch">
                Belum punya akun?
                <a href="/register">Daftar sebagai applicant</a>
            </p>
        </form>
    </section>
@endsection
