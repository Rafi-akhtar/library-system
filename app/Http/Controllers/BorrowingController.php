<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::all();
        return view('borrowings.index', compact('borrowings'));
    }

    public function myHistory()
    {
        $borrowings = Borrowing::where('user_id', auth()->id())->with('book')->latest()->get();
        return view('borrowings.my-history', compact('borrowings'));
    }

    public function create()
    {
        $books = Book::where('stok', '>', 0)->get();
        return view('borrowings.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'jumlah_pinjam' => 'required|integer|min:1',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:borrow_date',
        ]);

        DB::transaction(function () use ($request) 
        {
            $book = Book::findOrFail($request->book_id);
            if ($book->stok < $request->jumlah_pinjam) {
                throw new \Exception('Stok buku tidak mencukupi!');
            }

            $book->stok -= $request->jumlah_pinjam;
            $book->save();

            Borrowing::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'jumlah_pinjam' => $request->jumlah_pinjam,
            'borrow_date' => $request->borrow_date,
            'due_date' => $request->due_date,
            'status' => 'Dipinjam',
            ]);
        });

        return Redirect('/my-borrowings')
            ->with('success', 'Peminjaman berhasil dicatat!');
    }
    public function update($id)
    {
        DB::transaction(function () use ($id) {
            $borrowing = Borrowing::findOrFail($id);
            
            if (strtolower($borrowing->status) == 'dipinjam') {
                $book = Book::findOrFail($borrowing->book_id);

                // Kembalikan stok buku
                $book->stok += $borrowing->jumlah_pinjam;
                $book->save();

                // Hitung denda otomatis
                $returnDate = Carbon::now()->startOfDay(); 
                $dueDate = Carbon::parse($borrowing->due_date)->startOfDay(); 
                $fine = 0;

                if ($returnDate->greaterThan($dueDate)) {
                    $daysLate = $dueDate->diffInDays($returnDate); // Hitung selisih hari
                    $tariffPerDay = 5000; // Tarif denda per hari
                    $fine = $daysLate * $tariffPerDay;
                }

                // Update data peminjaman pakai cara save() biasa (aman dan tidak error)
                $borrowing->return_date = $returnDate->toDateString();
                $borrowing->fine = $fine;
                $borrowing->status = 'dikembalikan';
                $borrowing->save();
            }
        });

        return back()
        ->with('success', 'Buku Berhasil dikembalikan!');
    }
}