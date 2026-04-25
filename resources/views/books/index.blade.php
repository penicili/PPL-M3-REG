@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div class="stat-card">
            <p class="stat-label">Total Buku</p>
            <p class="stat-value">{{ $totalBooks }}</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">Buku Tersedia</p>
            <p class="stat-value">{{ $availableBooks }}</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">Stok Rendah</p>
            <p class="stat-value">{{ $lowStockBooks }}</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">Kategori</p>
            <p class="stat-value">{{ $categories }}</p>
        </div>
    </section>

    <section class="mt-6 rounded-3xl border border-white/10 bg-white/5 p-5 shadow-xl shadow-black/10 backdrop-blur-xl sm:p-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-white">Daftar Buku</h2>
                <p class="mt-1 text-sm text-slate-300">
                    Gunakan kolom pencarian untuk memfilter judul, penulis, atau kategori.
                </p>
            </div>

            <form method="GET" action="{{ route('books.index') }}" class="grid w-full gap-3 xl:max-w-4xl xl:grid-cols-[1.2fr_0.8fr_0.8fr_0.8fr_auto]" dusk="book-search-form">
                <input
                    type="search"
                    name="search"
                    value="{{ $search }}"
                    class="app-input"
                    placeholder="Cari judul, penulis, atau kategori"
                    dusk="book-search-input"
                >

                <select name="category" class="app-select" dusk="book-filter-category">
                    <option value="">Semua kategori</option>
                    @foreach ($categoryOptions as $option)
                        <option value="{{ $option }}" @selected($category === $option)>{{ $option }}</option>
                    @endforeach
                </select>

                <select name="stock_status" class="app-select" dusk="book-filter-stock">
                    <option value="" @selected($stockStatus === '')>Semua stok</option>
                    <option value="in_stock" @selected($stockStatus === 'in_stock')>Stok tersedia</option>
                    <option value="low_stock" @selected($stockStatus === 'low_stock')>Stok rendah</option>
                </select>

                <select name="sort" class="app-select" dusk="book-sort-select">
                    <option value="latest" @selected($sort === 'latest')>Terbaru</option>
                    <option value="oldest" @selected($sort === 'oldest')>Terlama</option>
                    <option value="title_asc" @selected($sort === 'title_asc')>Judul A-Z</option>
                    <option value="title_desc" @selected($sort === 'title_desc')>Judul Z-A</option>
                    <option value="year_desc" @selected($sort === 'year_desc')>Tahun terbaru</option>
                    <option value="year_asc" @selected($sort === 'year_asc')>Tahun terlama</option>
                    <option value="stock_desc" @selected($sort === 'stock_desc')>Stok terbanyak</option>
                    <option value="stock_asc" @selected($sort === 'stock_asc')>Stok tersedikit</option>
                </select>

                <button type="submit" class="btn-secondary whitespace-nowrap" dusk="book-search-button">Terapkan</button>
            </form>
        </div>

        <div class="mt-4 flex flex-wrap gap-2 text-xs text-slate-300" dusk="book-filter-summary">
            <span class="badge">Pencarian: {{ $search !== '' ? $search : 'Semua' }}</span>
            <span class="badge">Kategori: {{ $category !== '' ? $category : 'Semua' }}</span>
            <span class="badge">Stok: {{ $stockStatus === 'in_stock' ? 'Tersedia' : ($stockStatus === 'low_stock' ? 'Rendah' : 'Semua') }}</span>
            <span class="badge">Urut: {{ $sort }}</span>
        </div>

        <div class="mt-6 overflow-hidden rounded-2xl border border-white/10 bg-slate-950/60">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-white/10 text-left" dusk="book-table">
                    <thead class="bg-white/5 text-xs uppercase tracking-[0.24em] text-slate-300">
                        <tr>
                            <th class="px-5 py-4">Judul</th>
                            <th class="px-5 py-4">Penulis</th>
                            <th class="px-5 py-4">Kategori</th>
                            <th class="px-5 py-4">Tahun</th>
                            <th class="px-5 py-4">Stok</th>
                            <th class="px-5 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @forelse ($books as $book)
                            <tr class="hover:bg-white/5" dusk="book-row-{{ $book->id }}">
                                <td class="px-5 py-4">
                                    <div class="font-semibold text-white">{{ $book->title }}</div>
                                    <div class="mt-1 max-w-md text-sm text-slate-400">{{ \Illuminate\Support\Str::limit($book->summary ?? 'Tidak ada ringkasan.', 90) }}</div>
                                </td>
                                <td class="px-5 py-4 text-slate-200">{{ $book->author }}</td>
                                <td class="px-5 py-4"><span class="badge">{{ $book->category }}</span></td>
                                <td class="px-5 py-4 text-slate-200">{{ $book->published_year }}</td>
                                <td class="px-5 py-4">
                                    <span class="badge {{ $book->stock > 5 ? 'badge-success' : 'badge-warning' }}" dusk="book-stock-badge-{{ $book->id }}">{{ $book->stock }}</span>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('books.show', $book) }}" class="btn-mini" dusk="book-show-{{ $book->id }}">Detail</a>
                                        <a href="{{ route('books.edit', $book) }}" class="btn-mini" dusk="book-edit-{{ $book->id }}">Edit</a>
                                        <form method="POST" action="{{ route('books.destroy', $book) }}" onsubmit="return confirm('Hapus buku ini?')" class="inline" dusk="book-delete-form-{{ $book->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-mini btn-danger" dusk="book-delete-{{ $book->id }}">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-12 text-center text-slate-400" dusk="book-empty-state">
                                    Tidak ada data buku untuk ditampilkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <p class="text-sm text-slate-400">
                Menampilkan {{ $books->firstItem() ?? 0 }} - {{ $books->lastItem() ?? 0 }} dari {{ $books->total() }} data.
            </p>
            <div class="pagination-wrap">
                {{ $books->links() }}
            </div>
        </div>
    </section>
@endsection