@extends('layouts.admin')

@section('title', 'Riwayat Pinjam - E-Library')
@section('header-title', 'Riwayat & Status Peminjaman Saya')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-6">
    <div class="flex justify-between items-center border-b border-gray-100 pb-4">
        <div>
            <h4 class="font-bold text-gray-800 text-base flex items-center gap-2">
                <i class="fa-solid fa-clock-rotate-left text-emerald-600"></i> Daftar Peminjaman Buku Saya
            </h4>
            <span class="text-xs text-gray-500">Daftar buku yang sedang atau pernah Anda pinjam</span>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-emerald-600"></i> {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-xl border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider font-semibold border-b border-gray-100">
                    <th class="py-4 px-6">No</th>
                    <th class="py-4 px-6">Judul Buku</th>
                    <th class="py-4 px-6">Tgl Pinjam</th>
                    <th class="py-4 px-6">Tgl Harus Kembali</th>
                    <th class="py-4 px-6 text-center">Status</th>
                    <th class="py-4 px-6 text-center">Tgl Dikembalikan</th>
                    <th class="py-4 px-6 text-center">Denda</th>
                    <th class="py-4 px-6 text-center">Aksi</th>
                </tr>
            </thead>
<tbody class="divide-y divide-gray-100 text-sm text-gray-700">
    @forelse($borrowings as $index => $borrow)
    <tr class="hover:bg-gray-50/80 transition">
        <td class="py-4 px-6 font-medium text-gray-400">{{ $index + 1 }}</td>
        <td class="py-4 px-6 font-semibold text-gray-800">{{ $borrow->book->judul ?? 'Buku Dihapus' }}</td>
        <td class="py-4 px-6 text-gray-600">{{ $borrow->borrow_date }}</td>
        <td class="py-4 px-6 text-gray-600">{{ $borrow->due_date }}</td>
        <td class="py-4 px-6 text-center">
            <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ strtolower($borrow->status) == 'dipinjam' ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800' }}">
                {{ ucfirst($borrow->status) }}
            </span>
        </td>
        
        
            <td class="py-4 px-6 text-gray-600">
                {{ $borrow->return_date ?? '-' }}
            </td>

        
            <td class="py-4 px-6">
                @if($borrow->fine > 0)
                    <span class="text-red-600 font-bold">Rp {{ number_format($borrow->fine, 0, ',', '.') }}</span>
                @else
                    <span class="text-emerald-600 font-medium">Rp 0</span>
                @endif
            </td>

            <td class="py-4 px-6 text-center">
                @if(strtolower($borrow->status) == 'dipinjam')
                    <a href="{{ route('borrowings.return', $borrow->id) }}" 
                        onclick="return confirm('Yakin ingin mengembalikan buku ini?')"
                        class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1.5 rounded-lg text-xs font-semibold shadow-sm transition inline-flex items-center gap-1">
                            <i class="fa-solid fa-rotate-left"></i> Kembalikan
                    </a>
                @else
                    <span class="text-gray-400 text-xs italic">Selesai</span>
                @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-8 text-gray-400">
                        <i class="fa-solid fa-book-open text-3xl mb-2 text-gray-300 block"></i>
                        Anda belum memiliki riwayat peminjaman buku.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection