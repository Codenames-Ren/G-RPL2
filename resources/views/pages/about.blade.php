@extends('layouts.app')

@section('title', 'Tentang RPL')
@section('page', 'about')

@section('content')
    <x-navbar />

    <section class="min-h-screen bg-[#F5F6FA] px-6 py-32">
        <div class="mx-auto max-w-5xl">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#2F80ED]">Tentang RPL</p>
            <h1 class="font-heading mt-4 text-4xl font-bold text-[#1A1A2E] md:text-5xl">
                Rekognisi Pembelajaran Lampau
            </h1>
            <p class="mt-6 max-w-3xl text-lg leading-8 text-[#5F6472]">
                Program RPL membantu calon mahasiswa mengonversi pengalaman kerja, pelatihan, dan capaian belajar
                sebelumnya menjadi pengakuan akademik sesuai ketentuan kampus.
            </p>
        </div>
    </section>

    <x-footer />
@endsection
