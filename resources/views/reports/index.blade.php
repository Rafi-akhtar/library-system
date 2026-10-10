@extends('layouts.admin')

@section('title', 'Laporan Sirkulasi Peminjaman')
@section('header-title', 'Laporan Sirkulasi Peminjaman')

@section('content')
<div class="space-y-8 bg-[#FBF7F0] min-h-screen -m-8 p-8">

    <!-- Header Judul & Tombol Cetak -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h3 class="text-2xl font-extrabold text-[#2D3732] mb-1">Rekapitulasi Peminjaman Buku</h3>
            <p class="text-gray-500 text-sm">Daftar keseluruhan riwayat transaksi peminjaman dan pengembalian buku perpustakaan.</p>
        </div>
        <button onclick="window.print()" class="bg-[#2D3732] hover:bg-[#1a2320] text-white px-5 py-2.5 rounded-full text-sm font-semibold transition shadow-sm flex items-center gap-2">
            <i class="fa-solid fa-print"></i> Cetak Laporan
        </button>
    </div>

    <!-- 4 Kartu Statistik Atas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-[#EBE3D5] flex flex-col justify-between">
            <div class="bg-[#8FA89B]/20 w-12 h-12 rounded-2xl flex items-center justify-center text-[#8FA89B] mb-4">
                <i class="fa-solid fa-book-open text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium mb-1">Total Buku</p>
                <h3 class="text-3xl font-extrabold text-[#2D3732] mb-2">{{ $totalBuku }}</h3>
                <p class="text-xs text-emerald-600 font-semibold">Koleksi Tersedia</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-[#EBE3D5] flex flex-col justify-between">
            <div class="bg-[#8FA89B]/20 w-12 h-12 rounded-2xl flex items-center justify-center text-[#8FA89B] mb-4">
                <i class="fa-solid fa-users text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium mb-1">Total Anggota</p>
                <h3 class="text-3xl font-extrabold text-[#2D3732] mb-2">{{ $totalAnggota }}</h3>
                <p class="text-xs text-emerald-600 font-semibold">Terdaftar</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-[#EBE3D5] flex flex-col justify-between">
            <div class="bg-[#8FA89B]/20 w-12 h-12 rounded-2xl flex items-center justify-center text-[#8FA89B] mb-4">
                <i class="fa-solid fa-right-left text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium mb-1">Sedang Dipinjam</p>
                <h3 class="text-3xl font-extrabold text-[#2D3732] mb-2">{{ $sedangDipinjam }}</h3>
                <p class="text-xs text-amber-600 font-semibold">Transaksi Aktif</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-[#EBE3D5] flex flex-col justify-between">
            <div class="bg-rose-50 w-12 h-12 rounded-2xl flex items-center justify-center text-rose-500 mb-4">
                <i class="fa-solid fa-triangle-exclamation text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium mb-1">Buku Terlambat</p>
                <h3 class="text-3xl font-extrabold text-[#2D3732] mb-2">{{ $bukuTerlambat }}</h3>
                <p class="text-xs text-rose-500 font-semibold">Perlu Tindak Lanjut</p>
            </div>
        </div>
    </div>

    <!-- Bagian Tabel Rekapitulasi Riwayat Peminjaman -->
    <div class="bg-white rounded-3xl shadow-sm border border-[#EBE3D5] overflow-hidden p-6">
        <h4 class="text-lg font-bold text-[#2D3732] mb-4">Daftar Transaksi Peminjaman</h4>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-[11px] text-gray-400 uppercase tracking-wider">
                        <th class="py-3 px-4 font-bold">No</th>
                        <th class="py-3 px-4 font-bold">ID User</th>
                        <th class="py-3 px-4 font-bold">ID Buku</th>
                        <th class="py-3 px-4 font-bold">Tgl Pinjam</th>
                        <th class="py-3 px-4 font-bold">Tgl Harus Kembali</th>
                        <th class="py-3 px-4 font-bold">Status</th>
                        <th class="py-3 px-4 font-bold">Dikembalikan</th>
                        <th class="py-3 px-4 font-bold">Denda</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-xs text-gray-600">
                    @forelse($borrowings as $index => $item)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-4 px-4 font-medium text-gray-800">{{ $index + 1 }}</td>
                        <td class="py-4 px-4">{{ $item->user_id }}</td>
                        <td class="py-4 px-4">{{ $item->book_id }}</td>
                        <td class="py-4 px-4">{{ $item->borrow_date }}</td>
                        <td class="py-4 px-4">{{ $item->due_date }}</td>
                        <td class="py-4 px-4">
                            @if($item->status == 'dikembalikan')
                                <span class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full font-medium text-[11px]">Dikembalikan</span>
                            @else
                                <span class="bg-amber-50 text-amber-700 px-3 py-1 rounded-full font-medium text-[11px]">Dipinjam</span>
                            @endif
                        </td>
                        <td class="py-4 px-4">{{ $item->return_date ?? '-' }}</td>
                        <td class="py-4 px-4 font-medium text-gray-800">Rp {{ number_format($item->fine ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-8 text-gray-400">Belum ada data riwayat peminjaman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection