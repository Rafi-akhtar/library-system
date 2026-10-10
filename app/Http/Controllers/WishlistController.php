<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function index()
    {
        $wishlists = Auth::user()->wishlists()->with('book')->get();
        return view('wishlist.index', compact('wishlists'));
    }

    public function store(Request $request, Book $book)
    {
        $exists = Wishlist::where('user_id', Auth::id())
                          ->where('book_id', $book->id)
                          ->exists();

        if (!$exists) {
            Wishlist::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id
            ]);
            return back()->with('success', 'Buku berhasil ditambahkan ke wishlist!');
        }

        return back()->with('info', 'Buku sudah ada di dalam wishlist Anda.');
    }

    public function toggle(Book $book)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->where('book_id', $book->id)->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Wishlist::create([
                'user_id' => Auth::id(), 
                'book_id' => $book->id
            ]);
            return response()->json(['status' => 'added']);
        }
    }

    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();
        return back()->with('success', 'Buku dihapus dari wishlist.');
    }
}