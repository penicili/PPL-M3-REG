@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <section class="mx-auto max-w-lg rounded-3xl border border-white/10 bg-white/5 p-6 shadow-xl shadow-black/10 backdrop-blur-xl sm:p-8">
        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-300">Autentikasi</p>
        <h2 class="mt-2 text-2xl font-bold text-white">Masuk ke Aplikasi</h2>
        <p class="mt-2 text-sm leading-6 text-slate-300">Gunakan akun terdaftar untuk mengakses modul buku.</p>

        @if ($errors->any())
            <div class="mt-6 rounded-2xl border border-rose-400/20 bg-rose-500/10 px-4 py-3 text-sm text-rose-100" dusk="auth-error-box">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.store') }}" method="POST" class="mt-6 space-y-5" dusk="login-form">
            @csrf
            <div>
                <label for="email" class="app-label">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" class="app-input" dusk="login-email-input">
                @error('email')<p class="app-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="password" class="app-label">Password</label>
                <input id="password" name="password" type="password" class="app-input" dusk="login-password-input">
                @error('password')<p class="app-error">{{ $message }}</p>@enderror
            </div>

            <label class="flex items-center gap-3 text-sm text-slate-300">
                <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-white/20 bg-slate-950/70 text-amber-400 focus:ring-amber-300" dusk="login-remember-input">
                Ingat saya
            </label>

            <button type="submit" class="btn-primary w-full" dusk="login-submit-button">Login</button>
        </form>

        <p class="mt-6 text-sm text-slate-300">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-semibold text-amber-300 hover:text-amber-200" dusk="login-register-link">Daftar di sini</a>
        </p>
    </section>
@endsection