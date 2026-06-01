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
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-heading { font-family: 'Sora', sans-serif; }
    </style>
</head>
@php($page = trim($__env->yieldContent('page', 'home')))
<body
    class="bg-[#F5F6FA] text-[#1A1A2E] antialiased"
    data-page="{{ $page }}"
    data-auth-required="@yield('authRequired', 'false')"
    data-role-required="@yield('roleRequired', '')"
>
    @unless(in_array($page, ['home', 'login', 'register', 'about', 'requirements', 'faq', 'announcements'], true))
    <header class="topbar">
        <a class="brand" href="/" aria-label="G-RPL2 home">
            <span class="brand-mark">GR</span>
            <span>
                <strong>G-RPL2</strong>
                <small>Recognition Platform</small>
            </span>
        </a>

        <nav class="nav-links nav-links-compact" aria-label="Primary navigation">
            <a href="/login" data-public-nav data-nav-link>Login</a>
            <a class="button button-small" href="/register" data-public-nav>Register</a>
        </nav>
    </header>
    @endunless

    <main>
        @isset($slot)
            {{ $slot }}
        @else
            @yield('content')
        @endisset
    </main>
</body>
</html>
