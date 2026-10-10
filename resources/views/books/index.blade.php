@extends('layouts.admin')

@section('title', 'Manajemen Buku')
@section('header-title', 'Manajemen Buku')

@section('content')
<div class="space-y-6">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex justify-between items-center">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Daftar Koleksi Buku</h3>
            <p class="text-xs text-gray-500 mt-1">Kelola data buku, stok, dan informasi perpustakaan di sini.</p>
        </div>
        <a href="/books/create" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl font-medium shadow-sm transition flex items-center gap-2 text-sm">
            <i class="fa-solid fa-plus"></i> Tambah Buku
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="overflow-x-auto rounded-xl border border-gray-100">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider font-semibold border-b border-gray-100">
                        <th class="py-4 px-6">No</th>
                        <th class="py-4 px-6">Cover</th>
                        <th class="py-4 px-6">Judul Buku</th>
                        <th class="py-4 px-6">Penulis</th>
                        <th class="py-4 px-6">Penerbit</th>
                        <th class="py-4 px-6 text-center">Stok</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse($books as $index => $book)
                    <tr class="hover:bg-gray-50/80 transition">
                        <td class="py-4 px-6 font-medium text-gray-400">{{ $index + 1 }}</td>
                        <td class="py-4 px-6">
                            @if($book->cover)
                                <img src="{{ asset($book->cover) }}" alt="Cover" class="w-10 h-12 object-cover rounded-md shadow-sm">
                            @else
                                <div class="w-10 h-12 bg-emerald-100 rounded-md flex items-center justify-center text-emerald-600 font-bold text-xs">IMG</div>
                            @endif
                        </td>
                        <td class="py-4 px-6 font-semibold text-gray-800">{{ $book->judul }}</td>
                        <td class="py-4 px-6 text-gray-600">{{ $book->penulis }}</td>
                        <td class="py-4 px-6 text-gray-600">{{ $book->penerbit }}</td>
                        <td class="py-4 px-6 text-center">
                            <span class="bg-emerald-100 text-emerald-800 px-2.5 py-1 rounded-full text-xs font-semibold">{{ $book->stok }} Tersedia</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="/books/{{ $book->id }}/edit" class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                                <form action="/books/{{ $book->id }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition" title="Hapus">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-8 text-gray-400">Belum ada data buku di database.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection