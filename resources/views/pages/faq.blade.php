@extends('layouts.app')

@section('title', 'FAQ')
@section('page', 'faq')

@section('content')
    <x-navbar />

    <section class="min-h-screen bg-[#F5F6FA] px-6 py-32">
        <div class="mx-auto max-w-5xl">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#2F80ED]">FAQ</p>
            <h1 class="font-heading mt-4 text-4xl font-bold text-[#1A1A2E] md:text-5xl">
                Pertanyaan Umum
            </h1>
            <div class="mt-8 space-y-4">
                <div class="rounded-lg bg-white p-6 shadow-sm">
                    <h2 class="font-heading text-xl font-bold">Apakah applicant perlu verifikasi email?</h2>
                    <p class="mt-3 text-[#5F6472]">Ya. Setelah register, applicant harus verifikasi email sebelum login.</p>
                </div>
                <div class="rounded-lg bg-white p-6 shadow-sm">
                    <h2 class="font-heading text-xl font-bold">Siapa yang menentukan akses role?</h2>
                    <p class="mt-3 text-[#5F6472]">Backend tetap menjadi sumber otorisasi melalui API dan middleware role.</p>
                </div>
            </div>
        </div>
    </section>

    <x-footer />
@endsection
