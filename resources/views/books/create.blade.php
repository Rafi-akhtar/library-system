@extends('layouts.admin')

@section('title', 'Tambah Buku')
@section('header-title', 'Tambah Data Buku Baru')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 max-w-xl">
    <form action="/books" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori ID</label>
            <select name="category_id" style="color: #111827 !important; background-color: #ffffff !important;" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500 shadow-sm">
    <option value="" style="color: #6b7280 !important; background-color: #ffffff !important;">-- Pilih Kategori --</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}" style="color: #111827 !important; background-color: #ffffff !important;">{{ $category->Type }}</option>
    @endforeach
</select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Buku</label>
            <input type="text" name="judul" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Penulis</label>
            <input type="text" name="penulis" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Penerbit</label>
            <input type="text" name="penerbit" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Stok</label>
            <input type="number" name="stok" min="0" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Cover Buku</label>
            <input type="file" name="cover" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-xl font-medium shadow-lg shadow-emerald-600/20 transition">
                Simpan Buku
            </button>
            <a href="/books" class="text-gray-500 hover:text-gray-700 font-medium">Batal</a>
        </div>
    </form>
</div>
@endsection