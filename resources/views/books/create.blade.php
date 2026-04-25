@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <section class="mx-auto max-w-5xl rounded-3xl border border-white/10 bg-white/5 p-6 shadow-xl shadow-black/10 backdrop-blur-xl sm:p-8">
        <div class="mb-6">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-300">Form Input</p>
            <h2 class="mt-2 text-2xl font-bold text-white">Tambah Buku Baru</h2>
            <p class="mt-2 text-sm leading-6 text-slate-300">Gunakan form ini untuk menambah data buku yang akan dipakai pada skenario pengujian.</p>
        </div>

        <form action="{{ route('books.store') }}" method="POST" class="space-y-6" dusk="book-form">
            @csrf
            @include('books._form', ['submitLabel' => 'Simpan Buku'])
        </form>
    </section>
@endsection