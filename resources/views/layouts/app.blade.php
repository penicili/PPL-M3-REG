<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Manajemen Buku')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
    <div class="pointer-events-none fixed inset-0 overflow-hidden">
        <div class="absolute -top-24 left-1/2 h-80 w-80 -translate-x-1/2 rounded-full bg-amber-500/20 blur-3xl"></div>
        <div class="absolute right-0 top-32 h-72 w-72 rounded-full bg-cyan-400/10 blur-3xl"></div>
        <div class="absolute left-0 bottom-0 h-72 w-72 rounded-full bg-emerald-400/10 blur-3xl"></div>
    </div>

    <div class="relative mx-auto flex min-h-screen w-full max-w-7xl flex-col px-4 py-6 sm:px-6 lg:px-8">
        <header class="mb-8 rounded-3xl border border-white/10 bg-white/5 p-5 shadow-2xl shadow-black/20 backdrop-blur-xl sm:p-6">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-300">Laravel 12 Dusk Target</p>
                    <h1 class="mt-2 text-2xl font-bold tracking-tight text-white sm:text-3xl">Manajemen Buku Praktikum</h1>
                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-300">
                        Aplikasi CRUD sederhana dengan pencarian, validasi, halaman detail, dan selector yang stabil untuk skenario automated testing.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('books.index') }}" class="btn-secondary" dusk="nav-books-index">Daftar Buku</a>
                    <a href="{{ route('books.create') }}" class="btn-primary" dusk="nav-books-create">Tambah Buku</a>
                </div>
            </div>
        </header>

        <main class="flex-1">
            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-emerald-400/20 bg-emerald-400/10 px-4 py-3 text-sm text-emerald-100" dusk="flash-success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>