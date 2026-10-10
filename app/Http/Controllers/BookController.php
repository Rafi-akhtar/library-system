<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input ('search');
        $books = Book::when($search, function ($query, $search) {
            return $query->where('judul', 'like', "%{$search}%")
                         ->orWhere('penulis', 'like', "%{$search}%");
    })->get();
    return view('dashboard', compact('books'));
    }

    public function manage(Request $request)
    {
        $search = $request->input('search');
        $books = Book::when($search, function ($query, $search) {
            return $query->where('judul', 'like', "%{$search}%")
                         ->orWhere('penulis', 'like', "%{$search}%");
        })->get();
        return view('books.index', compact('books', 'search'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'judul'    => 'required|string|max:255',
            'penulis'  => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'stok'     => 'required|integer|min:0',
            'cover'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pathCover = null;

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('covers'), $filename);
            $pathCover = 'covers/' . $filename;
        }

        Book::create([
            'category_id'=> $request->category_id,
            'judul'    => $request->judul,
            'penulis'  => $request->penulis,
            'penerbit' => $request->penerbit,
            'stok'     => $request->stok,
            'cover'    => $pathCover,
        ]);

        return redirect('/books')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('books.edit', compact('book','categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'judul'    => 'required|string|max:255',
            'penulis'  => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'stok'     => 'required|integer|min:0',
            'cover'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $book = Book::findOrFail($id);
        $pathCover = $book->cover;

        if ($request->hasFile('cover')) {
            if ($book->cover && file_exists(public_path($book->cover))) {
                unlink(public_path($book->cover));
            }
            $file = $request->file('cover');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('covers'), $filename);
            $pathCover = 'covers/' . $filename;
        }

        $book->update([
            'category_id' => $request->category_id,
            'judul'       => $request->judul,
            'penulis'     => $request->penulis,
            'penerbit'    => $request->penerbit,
            'stok'        => $request->stok,
            'cover'       => $pathCover,
        ]);
        return redirect('/books')->with('success', 'Buku berhasil diupdate!');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        if ($book->cover && file_exists(public_path($book->cover))) {
            unlink(public_path($book->cover));
        }
        $book->delete();
        return redirect('/books')->with('success', 'Buku berhasil dihapus!');
    }
}