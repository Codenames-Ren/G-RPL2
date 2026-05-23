{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')
@section('title', 'Daftar Akun')
@section('page', 'register')
@section('content')

<x-navbar />

<div class="relative min-h-[calc(100vh-71px)] bg-[#F8FAFC] page-soft-grid flex items-center justify-center px-4 py-12 overflow-hidden">
    <div class="absolute -top-32 -right-28 w-[420px] h-[420px] bg-[#1565C0]/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-28 -left-24 w-[360px] h-[360px] bg-[#F9A825]/14 rounded-full blur-3xl"></div>

    <div class="relative bg-white/90 backdrop-blur-xl border border-[#1565C0]/10 rounded-[2rem] w-full max-w-md px-8 pt-8 pb-7 shadow-2xl shadow-blue-900/10 overflow-hidden">
        <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-[#1565C0] via-[#F9A825] to-[#E53935]"></div>
        
        <div class="flex items-center justify-center gap-2 mb-6">
            <div class="bg-white rounded-3xl shadow-lg border border-[#1565C0]/10 px-5 py-4">
                <img src="{{ asset('images/logo.png') }}" alt="G-RPL" class="h-12 w-auto">
            </div>
        </div>

        <h1 class="font-heading text-2xl font-extrabold text-center text-[#172033] mb-2">Pendaftaran Mahasiswa</h1>
        <p class="text-sm text-[#5A6478] text-center mb-8">Buat akun untuk memulai proses pengajuan RPL</p>

        <form data-auth-form="register">

            {{-- NIK --}}
            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">
                Nomor Induk Kependudukan (NIK)
            </label>
            <input type="text" name="nik" placeholder="Contoh: 3171234567890001" maxlength="16"
                   class="w-full border border-[#1565C0]/15 rounded-2xl px-4 py-3 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10 outline-none transition-all mb-1">
            <div class="mb-3"></div>

            {{-- Nama Lengkap --}}
            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">
                Nama Lengkap (Sesuai KTP/Ijazah)
            </label>
            <input type="text" name="name" placeholder="Contoh: Budi Santoso" required
                   class="w-full border border-[#1565C0]/15 rounded-2xl px-4 py-3 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10 outline-none transition-all mb-1">
            <div class="mb-3"></div>

            {{-- Email --}}
            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">
                Alamat Email Aktif
            </label>
            <input type="email" name="email" placeholder="nama@institusi.com" required
                   class="w-full border border-[#1565C0]/15 rounded-2xl px-4 py-3 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10 outline-none transition-all mb-1">
            <div class="mb-3"></div>

            {{-- No HP --}}
            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">
                Nomor HP Aktif
            </label>
            <input type="text" name="no_hp" placeholder="Contoh: 08123456789"
                   class="w-full border border-[#1565C0]/15 rounded-2xl px-4 py-3 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10 outline-none transition-all mb-1">
            <div class="mb-3"></div>

            {{-- Alamat --}}
            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">
                Alamat Lengkap
            </label>
            <textarea name="alamat" rows="2" placeholder="Masukkan alamat lengkap Anda"
                      class="w-full border border-[#1565C0]/15 rounded-2xl px-4 py-3 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10 outline-none transition-all mb-1 resize-none"></textarea>
            <div class="mb-3"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Password --}}
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">Kata Sandi</label>
                    <input type="password" name="password" placeholder="Minimal 8 karakter" minlength="8" required
                           class="w-full border border-[#1565C0]/15 rounded-2xl px-4 py-3 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10 outline-none transition-all">
                </div>
                {{-- Confirm Password --}}
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">Konfirmasi Sandi</label>
                    <input type="password" name="password_confirmation" placeholder="Ketik ulang sandi" minlength="8" required
                           class="w-full border border-[#1565C0]/15 rounded-2xl px-4 py-3 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10 outline-none transition-all">
                </div>
            </div>
            <div class="form-message min-h-5 text-xs text-[#D32F2F] mt-3 mb-2" data-form-message aria-live="polite"></div>

            <button type="submit" data-submit-button
                    class="w-full bg-[#1565C0] hover:bg-[#0D47A1] text-white font-bold text-sm rounded-2xl py-3.5 mt-4 mb-6 transition-all shadow-lg shadow-blue-500/20 hover:-translate-y-0.5">
                Daftar Sekarang
            </button>
        </form>

        <div class="text-center text-sm text-[#5A6478]">
            Sudah memiliki akun? 
            <a href="/login" class="text-[#1565C0] font-bold hover:underline">Masuk di sini</a>
        </div>
    </div>
</div>
@endsection
