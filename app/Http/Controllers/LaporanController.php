<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Borrowing;

class LaporanController extends Controller
{
    public function index()
    {
        $totalBuku = Book::count();
        $totalAnggota = User::count();
        $sedangDipinjam = Borrowing::where('status', 'dipinjam')->count();
        
        $bukuTerlambat = Borrowing::where('status', 'dipinjam')
                                  ->where('due_date', '<', now())
                                  ->count();

        // Mengambil semua data riwayat peminjaman untuk tabel
        $borrowings = Borrowing::latest()->get();

        return view('reports.index', compact('totalBuku', 'totalAnggota', 'sedangDipinjam', 'bukuTerlambat', 'borrowings'));
    }
}