@extends('layouts.admin')

@section('title', 'Catat Peminjaman')
@section('header-title', 'Form Peminjaman Buku')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 max-w-xl">

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/borrowings') }}" method="POST">

        @csrf

        <div class="mb-4">

            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Pilih Buku
            </label>

            <select
                name="book_id"
                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                required
            >

                <option value="">
                </option>

                @foreach($books as $book)

                    <option
                        value="{{ $book->id }}"
                        {{ old('book_id') == $book->id ? 'selected' : '' }}
                        @if($book->stok <= 0)
                            disabled
                        @endif
                    >

                        {{ $book->judul }}

                        (Stok: {{ $book->stok }})

                        @if($book->stok <= 0)
                            - HABIS
                        @endif

                    </option>

                @endforeach

            </select>

            <p class="text-xs text-gray-500 mt-1">
                Buku dengan stok 0 tetap ditampilkan, tetapi tidak dapat dipinjam.
            </p>

        </div>


        <div class="mb-4">

            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Jumlah Pinjam
            </label>

            <input
                type="number"
                name="jumlah_pinjam"
                value="{{ old('jumlah_pinjam', 1) }}"
                min="1"
                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                required
            >

        </div>


        <div class="mb-4">

            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Tanggal Pinjam
            </label>

            <input
                type="date"
                name="borrow_date"
                value="{{ old('borrow_date', date('Y-m-d')) }}"
                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                required
            >

        </div>


        <div class="mb-6">

            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Tanggal Jatuh Tempo
            </label>

            <input
                type="date"
                name="due_date"
                value="{{ old('due_date') }}"
                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                required
            >

        </div>

        <div class="flex items-center gap-4">
            <button
                type="submit"
                class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-xl font-medium shadow-lg shadow-emerald-600/20 transition"
            >
                <i class="fa-solid fa-book"></i>
                Simpan & Kurangi Stok

            </button>
            <a
                href="{{ url('/borrowings') }}"
                class="text-gray-500 hover:text-gray-700 font-medium"
            >
                Batal
            </a>
        </div>
    </form>
</div>
@endsection