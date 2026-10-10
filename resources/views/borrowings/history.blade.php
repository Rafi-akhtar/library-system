@extends('layouts.admin')

@section('title', 'Riwayat Pinjaman')
@section('header-title', 'Riwayat Peminjaman Buku Saya')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    @if(session('success'))
        <div class="mb-4 bg-emerald-50 text-emerald-800 p-3 rounded-lg text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="text-xs uppercase text-gray-400 border-b">
                <tr>
                    <th class="py-3 px-4">Judul Buku</th>
                    <th class="py-3 px-4">Tgl Pinjam</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y">
                @forelse($borrowings as $borrow)
                <tr>
                    <td class="py-4 px-4 font-bold">{{ $borrow->book->judul ?? 'N/A' }}</td>
                    <td class="py-4 px-4">{{ $borrow->borrow_date }}</td>
                    <td class="py-4 px-4">
                        <span class="px-2 py-1 rounded-full text-[10px] font-bold {{ $borrow->status == 'Dipinjam' ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800' }}">
                            {{ $borrow->status }}
                        </span>
                    </td>
                    <td class="py-4 px-4">
                        @if($borrow->status == 'Dipinjam')
                            <form action="{{ route('borrowings.return', $borrow->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-amber-500 text-white px-3 py-1 rounded-lg text-xs hover:bg-amber-600">
                                    Kembalikan
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400 text-xs italic">Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-6 text-gray-400">Belum ada riwayat.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection