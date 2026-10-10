@extends('layouts.admin')

@section('title', 'Sirkulasi Pinjam')
@section('header-title', 'Sirkulasi Peminjaman Buku')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <div class="flex justify-between items-center mb-6">
        <a href="/borrowings/create" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl font-medium shadow-lg shadow-emerald-600/20 transition flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Catat Peminjaman
        </a>
    </div>

    <div class="overflow-x-auto rounded-xl border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider font-semibold border-b border-gray-100">
                    <th class="py-4 px-6">No</th>
                    <th class="py-4 px-6">ID User</th>
                    <th class="py-4 px-6">ID Buku</th>
                    <th class="py-4 px-6">Tgl Pinjam</th>
                    <th class="py-4 px-6">Tgl Harus Kembali</th>
                    <th class="py-4 px-6 text-center">Status</th>
                    <th class="py-4 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @forelse($borrowings as $index => $borrow)
                <tr class="hover:bg-gray-50/80 transition">
                    <td class="py-4 px-6 font-medium text-gray-400">{{ $index + 1 }}</td>
                    <td class="py-4 px-6 font-semibold text-gray-800">{{ $borrow->user_id }}</td>
                    <td class="py-4 px-6 text-gray-600">{{ $borrow->book_id }}</td>
                    <td class="py-4 px-6 text-gray-600">{{ $borrow->borrow_date }}</td>
                    <td class="py-4 px-6 text-gray-600">{{ $borrow->due_date }}</td>
                    <td class="py-4 px-6 text-center">
                        <span class="bg-amber-100 text-amber-800 px-2.5 py-1 rounded-full text-xs font-semibold">{{ $borrow->status }}</span>
                   <td class="py-4 px-6 text-center">
                        <div class="flex items-center justify-center gap-2">
                             @if(strtolower($borrow->status) == 'dipinjam')
                                <form action="/borrowings/{{ $borrow->id }}" method="POST" onsubmit="return confirm('Proses pengembalian buku ini?')">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-amber-100 text-amber-800 px-3 py-1 rounded-lg text-xs font-semibold hover:bg-amber-200 transition">
                                Kembalikan
                            </button>
                        </form>
                    @else
                        <span class="bg-emerald-100 text-emerald-800 px-2.5 py-1 rounded-full text-xs font-semibold">Selesai</span>
                     @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-6 text-gray-400">Belum ada data sirkulasi peminjaman di database.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection