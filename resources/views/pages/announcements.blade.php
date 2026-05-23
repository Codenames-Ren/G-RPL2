@extends('layouts.app')

@section('title', 'Pengumuman')
@section('page', 'announcements')

@section('content')
    <x-navbar />

    <section class="min-h-screen bg-[#F5F6FA] px-6 py-32">
        <div class="mx-auto max-w-5xl">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#2F80ED]">Pengumuman</p>
            <h1 class="font-heading mt-4 text-4xl font-bold text-[#1A1A2E] md:text-5xl">
                Informasi RPL
            </h1>
            <div class="mt-8 rounded-lg bg-white p-6 shadow-sm">
                <h2 class="font-heading text-xl font-bold">Belum ada pengumuman baru.</h2>
                <p class="mt-3 text-[#5F6472]">Halaman ini siap dihubungkan dengan endpoint pengumuman jika backend sudah tersedia.</p>
            </div>
        </div>
    </section>

    <x-footer />
@endsection
