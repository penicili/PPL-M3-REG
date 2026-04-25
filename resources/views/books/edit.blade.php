@extends('layouts.app')

@section('title', 'Ubah Buku')

@section('content')
    <section class="mx-auto max-w-5xl rounded-3xl border border-white/10 bg-white/5 p-6 shadow-xl shadow-black/10 backdrop-blur-xl sm:p-8">
        <div class="mb-6">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-300">Form Ubah</p>
            <h2 class="mt-2 text-2xl font-bold text-white">Ubah Data Buku</h2>
            <p class="mt-2 text-sm leading-6 text-slate-300">Perbarui data buku ini untuk menguji alur update pada aplikasi CRUD.</p>
        </div>

        <form action="{{ route('books.update', $book) }}" method="POST" class="space-y-6" dusk="book-form">
            @csrf
            @method('PUT')
            @include('books._form', ['submitLabel' => 'Perbarui Buku'])
        </form>
    </section>
@endsection