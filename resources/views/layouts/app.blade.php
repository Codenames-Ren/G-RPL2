<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sistem RPL') - G-RPL</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .font-heading {
            font-family: 'Sora', sans-serif;
        }
    </style>
</head>

@php
    $page = trim($__env->yieldContent('page', 'home'));
    $authRequired = trim($__env->yieldContent('authRequired', 'false'));

    /*
    |--------------------------------------------------------------------------
    | Halaman yang boleh menampilkan navbar publik
    |--------------------------------------------------------------------------
    | Dashboard/admin/user/master-data TIDAK masuk sini,
    | jadi navbar atas tidak akan muncul di halaman admin.
    */
    $showPublicNavbar = in_array($page, [
        'public-navbar',
    ], true);
@endphp

<body
    class="bg-[#F5F6FA] text-[#1A1A2E] antialiased"
    data-page="{{ $page }}"
    data-auth-required="{{ $authRequired }}"
    data-role-required="@yield('roleRequired', '')"
>
    @if($showPublicNavbar && $authRequired !== 'true')
        <header class="topbar">
            <a class="brand" href="/" aria-label="G-RPL home">
                <span class="brand-mark">
                    <img src="{{ asset('images/logo.png') }}" alt="G-RPL">
                </span>

                <span>
                    <strong>G-RPL</strong>
                    <small>Portal Resmi</small>
                </span>
            </a>

            <nav class="nav-links nav-links-compact" aria-label="Primary navigation">
                <a href="/login" data-public-nav data-nav-link>Login</a>
                <a class="button button-small" href="/register" data-public-nav>Register</a>
            </nav>
        </header>
    @endif

    <main>
        @isset($slot)
            {{ $slot }}
        @else
            @yield('content')
        @endisset
    </main>
</body>
</html>