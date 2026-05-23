@extends('layouts.app')

@section('title', 'Persyaratan RPL')
@section('page', 'requirements')

@section('content')
    <x-navbar />

    <section class="min-h-screen bg-[#F5F6FA] px-6 py-32">
        <div class="mx-auto max-w-5xl">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#2F80ED]">Persyaratan</p>
            <h1 class="font-heading mt-4 text-4xl font-bold text-[#1A1A2E] md:text-5xl">
                Dokumen Pendaftaran
            </h1>
            <div class="mt-8 grid gap-4 md:grid-cols-2">
                <div class="rounded-lg bg-white p-6 shadow-sm">
                    <h2 class="font-heading text-xl font-bold">Identitas</h2>
                    <p class="mt-3 text-[#5F6472]">KTP, ijazah terakhir, dan data kontak aktif.</p>
                </div>
                <div class="rounded-lg bg-white p-6 shadow-sm">
                    <h2 class="font-heading text-xl font-bold">Evidensi</h2>
                    <p class="mt-3 text-[#5F6472]">Portofolio, sertifikat, bukti kerja, atau dokumen pendukung lain.</p>
                </div>
            </div>
        </div>
    </section>

    <x-footer />
@endsection
