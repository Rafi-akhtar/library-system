<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\LaporanController;

Route::get('/', [BookController::class, 'index'])->name('home');
Route::get('/dashboard', [BookController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/books', [BookController::class, 'manage'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

    Route::get('/borrowings', [BorrowingController::class, 'index']);
    Route::get('/borrowings/create', [BorrowingController::class, 'create']);
    Route::post('/borrowings', [BorrowingController::class, 'store'])->name('borrowings.store');
    Route::put('/borrowings/{id}', [BorrowingController::class, 'update']);
    Route::get('/borrowings/{id}/return', [BorrowingController::class, 'update'])->name('borrowings.return');
    Route::get('/my-borrowings', [BorrowingController::class, 'myHistory'])->name('borrowings.history');
    Route::get('/sirkulasi', [App\Http\Controllers\BorrowingController::class, 'index'])->name('sirkulasi');

    Route::get('/wishlist', [WishlistController::class,'index'])->name('wishlist.index');
    Route::post('/wishlist/{book}', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::post('/wishlist/toggle/{book}', [WishlistController::class,'toggle'])->name('wishlist.toggle');
    Route::delete('/wishlist/{wishlist}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    Route::get('/members', [MemberController::class, 'index']);

    Route::get('/reports', [LaporanController::class, 'index']);
});
