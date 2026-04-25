<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(Request $request): View
    {
        $booksQuery = Book::query();
        $search = trim((string) $request->string('search'));
        $category = trim((string) $request->string('category'));
        $stockStatus = trim((string) $request->string('stock_status'));
        $sort = $request->string('sort', 'latest')->toString();

        if ($search !== '') {
            $booksQuery->where(function ($query) use ($search): void {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%');
            });
        }

        if ($category !== '' && in_array($category, Book::categories(), true)) {
            $booksQuery->where('category', $category);
        }

        if ($stockStatus === 'in_stock') {
            $booksQuery->where('stock', '>', 0);
        }

        if ($stockStatus === 'low_stock') {
            $booksQuery->whereBetween('stock', [1, 5]);
        }

        match ($sort) {
            'oldest' => $booksQuery->oldest(),
            'title_asc' => $booksQuery->orderBy('title'),
            'title_desc' => $booksQuery->orderByDesc('title'),
            'year_asc' => $booksQuery->orderBy('published_year'),
            'year_desc' => $booksQuery->orderByDesc('published_year'),
            'stock_asc' => $booksQuery->orderBy('stock'),
            'stock_desc' => $booksQuery->orderByDesc('stock'),
            default => $booksQuery->latest(),
        };

        $books = $booksQuery
            ->paginate(8)
            ->withQueryString();

        return view('books.index', [
            'books' => $books,
            'search' => $search,
            'category' => $category,
            'stockStatus' => $stockStatus,
            'sort' => $sort,
            'totalBooks' => Book::count(),
            'availableBooks' => Book::where('stock', '>', 0)->count(),
            'lowStockBooks' => Book::whereBetween('stock', [1, 5])->count(),
            'categories' => Book::query()->distinct()->count('category'),
            'categoryOptions' => Book::categories(),
        ]);
    }

    public function create(): View
    {
        return view('books.create', [
            'book' => new Book(),
            'pageMode' => 'create',
            'pageTitle' => 'Tambah Buku',
        ]);
    }

    public function store(StoreBookRequest $request): RedirectResponse
    {
        $book = Book::create($request->validated());

        return redirect()
            ->route('books.show', $book)
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(Book $book): View
    {
        return view('books.show', [
            'book' => $book,
        ]);
    }

    public function edit(Book $book): View
    {
        return view('books.edit', [
            'book' => $book,
            'pageMode' => 'edit',
            'pageTitle' => 'Ubah Buku',
        ]);
    }

    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        $book->update($request->validated());

        return redirect()
            ->route('books.show', $book)
            ->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}