@extends('layouts.app')

@section('title', $book->title)

@section('content')
    <section class="grid gap-6 xl:grid-cols-[1.2fr_0.8fr]">
        <div class="rounded-3xl border border-white/10 bg-white/5 p-6 shadow-xl shadow-black/10 backdrop-blur-xl sm:p-8">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-300">Detail Buku</p>
            <h2 class="mt-2 text-3xl font-bold text-white">{{ $book->title }}</h2>
            <p class="mt-3 text-sm text-slate-300">{{ $book->summary ?: 'Tidak ada ringkasan untuk buku ini.' }}</p>

            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <div class="info-card">
                    <p class="info-label">Penulis</p>
                    <p class="info-value">{{ $book->author }}</p>
                </div>
                <div class="info-card">
                    <p class="info-label">Kategori</p>
                    <p class="info-value">{{ $book->category }}</p>
                </div>
                <div class="info-card">
                    <p class="info-label">Tahun Terbit</p>
                    <p class="info-value">{{ $book->published_year }}</p>
                </div>
                <div class="info-card">
                    <p class="info-label">Stok</p>
                    <p class="info-value">{{ $book->stock }}</p>
                </div>
            </div>

            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('books.edit', $book) }}" class="btn-primary" dusk="detail-edit-button">Edit Buku</a>
                <a href="{{ route('books.index') }}" class="btn-secondary" dusk="detail-back-button">Kembali</a>
            </div>
        </div>

        <aside class="rounded-3xl border border-white/10 bg-slate-950/60 p-6 shadow-xl shadow-black/10 backdrop-blur-xl sm:p-8">
            <h3 class="text-lg font-semibold text-white">Informasi Cepat</h3>
            <dl class="mt-5 space-y-4 text-sm text-slate-300">
                <div class="flex items-center justify-between gap-4 border-b border-white/10 pb-3">
                    <dt>ID Data</dt>
                    <dd class="font-semibold text-white">{{ $book->id }}</dd>
                </div>
                <div class="flex items-center justify-between gap-4 border-b border-white/10 pb-3">
                    <dt>Dibuat</dt>
                    <dd class="font-semibold text-white">{{ $book->created_at?->format('d M Y H:i') }}</dd>
                </div>
                <div class="flex items-center justify-between gap-4 border-b border-white/10 pb-3">
                    <dt>Diubah</dt>
                    <dd class="font-semibold text-white">{{ $book->updated_at?->format('d M Y H:i') }}</dd>
                </div>
            </dl>

            <form action="{{ route('books.destroy', $book) }}" method="POST" class="mt-6" onsubmit="return confirm('Hapus buku ini?')" dusk="detail-delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger w-full justify-center" dusk="detail-delete-button">Hapus Buku</button>
            </form>
        </aside>
    </section>
@endsection