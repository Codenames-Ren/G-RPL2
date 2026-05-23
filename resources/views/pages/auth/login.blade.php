{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')
@section('title', 'Masuk')
@section('page', 'login')
@section('content')

<x-navbar />

<div class="relative min-h-[calc(100vh-71px)] bg-[#F8FAFC] page-soft-grid flex items-center justify-center px-4 py-12 overflow-hidden">
    <div class="absolute -top-32 -right-28 w-[420px] h-[420px] bg-[#1565C0]/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-28 -left-24 w-[360px] h-[360px] bg-[#F9A825]/14 rounded-full blur-3xl"></div>

    <div class="relative bg-white/90 backdrop-blur-xl border border-[#1565C0]/10 rounded-[2rem] w-full max-w-md px-8 pt-8 pb-7 shadow-2xl shadow-blue-900/10 overflow-hidden">
        <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-[#1565C0] via-[#F9A825] to-[#E53935]"></div>

        {{-- Logo --}}
        <div class="flex items-center justify-center gap-2 mb-6">
            <div class="bg-white rounded-3xl shadow-lg border border-[#1565C0]/10 px-5 py-4">
                <img src="{{ asset('images/logo.png') }}" alt="G-RPL" class="h-12 w-auto">
            </div>
        </div>

        <h1 class="font-heading text-2xl font-extrabold text-center text-[#172033] mb-2">Selamat Datang</h1>
        <p class="text-sm text-[#5A6478] text-center mb-8">Silakan masuk menggunakan akun Anda</p>

        {{-- Form Universal --}}
        <form data-auth-form="login">
            {{-- Input Email --}}
            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5" for="email">
                Email
            </label>
            <input type="email" name="email" id="email" required autofocus
                   placeholder="Masukkan email"
                   class="w-full border border-[#1565C0]/15 rounded-2xl px-4 py-3 text-sm text-[#1A1A2E]
                          bg-white outline-none focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10 transition-all mb-4">

            {{-- Input Password --}}
            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5" for="password">
                Kata Sandi
            </label>
            <input type="password" name="password" id="password" required
                   placeholder="Masukkan Kata Sandi"
                   class="w-full border border-[#1565C0]/15 rounded-2xl px-4 py-3 text-sm text-[#1A1A2E]
                          bg-white outline-none focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10 transition-all mb-4">

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center gap-2 text-sm text-[#5A6478] cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded text-[#1565C0] border-gray-300 focus:ring-[#1565C0]">
                    Ingat Saya
                </label>
                <a href="#" class="text-sm font-bold text-[#1565C0] hover:underline">
                    Lupa Sandi?
                </a>
            </div>

            <div class="form-message min-h-5 text-xs text-[#D32F2F] mb-3" data-form-message aria-live="polite"></div>

            {{-- Flat Button (No shadow, 8px radius) --}}
            <button type="submit" data-submit-button
                    class="w-full bg-[#1565C0] hover:bg-[#0D47A1] text-white font-bold text-sm rounded-2xl py-3.5 mb-6 transition-all shadow-lg shadow-blue-500/20 hover:-translate-y-0.5">
                Masuk ke Sistem
            </button>
        </form>

        {{-- Footer Info --}}
        <div class="text-center text-sm text-[#5A6478] mb-4">
            Belum punya akun Calon Mahasiswa?
            <a href="/register" class="text-[#1565C0] font-bold hover:underline">Daftar di sini</a>
        </div>
        
        <div class="pt-4 border-t border-[#1565C0]/10 flex gap-3 mt-2">
            <svg class="w-5 h-5 text-[#1565C0] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-xs text-[#5A6478] leading-relaxed text-left">
                Bagi Asesor dan Pengelola, silakan masuk menggunakan kredensial (Email/Username) yang telah diberikan oleh Admin Sistem.
            </p>
        </div>
    </div>
</div>

@endsection
