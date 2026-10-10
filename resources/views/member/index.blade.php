@extends('layouts.admin')

@section('title', 'Daftar Anggota')
@section('header-title', 'Manajemen Anggota Perpustakaan')

@section('content')
<!-- CSS Khusus Print / Download Kartu -->
<!-- CSS Print yang Diperbaiki -->
<style>
    @media print {
        /* Sembunyikan elemen navigasi dan tombol */
        aside, nav, header, footer, button, .no-print {
            display: none !important;
        }
        body {
            background-color: white !important;
            -webkit-print-color-adjust: exact;
        }
        
        /* Jika mode cetak satuan (single), sembunyikan kartu yang lain */
        body.is-single-print .card-item {
            display: none !important;
        }
        body.is-single-print .card-item.printing {
            display: flex !important;
            width: 100% !important;
            max-width: 450px !important;
            margin: 50px auto !important;
            box-shadow: none !important;
            border: 1px solid #ccc !important;
        }
    }
</style>

<div class="space-y-6">
    <!-- Header Tombol Cetak Semua -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 no-print">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Kartu Tanda Anggota (KTA)</h3>
            <p class="text-xs text-gray-500 mt-1">Daftar kartu identitas digital anggota perpustakaan yang terdaftar.</p>
        </div>
        <button onclick="window.print()" class="bg-slate-900 hover:bg-slate-800 text-white px-4 py-2.5 rounded-xl font-medium shadow-sm transition flex items-center gap-2 text-sm cursor-pointer">
            <i class="fa-solid fa-print"></i> Cetak Semua Kartu
        </button>
    </div>

    <!-- Grid Kartu -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($members as $member)
        <div id="card-{{ $member->id }}" class="card-item bg-gradient-to-br from-slate-900 to-slate-800 text-white rounded-2xl shadow-xl p-6 border border-slate-700 relative overflow-hidden flex flex-col justify-between">
            <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-emerald-500/20 rounded-full blur-2xl pointer-events-none"></div>

            <div>
                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center gap-2">
                        <div class="bg-emerald-500 p-1.5 rounded-lg text-white text-xs">
                            <i class="fa-solid fa-book-open"></i>
                        </div>
                        <span class="text-xs font-bold tracking-wider uppercase text-emerald-400">E-Library Card</span>
                    </div>
                    <span class="text-[10px] bg-slate-800 text-slate-300 px-2.5 py-1 rounded-full border border-slate-700">ID: #00{{ $member->id }}</span>
                </div>

                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-bold text-xl shadow-md">
                        {{ strtoupper(substr($member->name, 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-lg text-white leading-tight">{{ $member->name }}</h4>
                        <p class="text-xs text-slate-400 mt-0.5">{{ $member->email }}</p>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-700/60 flex justify-between items-center text-xs text-slate-400">
                <span>Member sejak: {{ $member->created_at->format('M Y') }}</span>
                
                <!-- Tombol Download Spesifik Per Kartu -->
                <button onclick="printSingleCard('card-{{ $member->id }}')" class="no-print bg-emerald-600 hover:bg-emerald-500 text-white px-3 py-1.5 rounded-lg font-medium transition flex items-center gap-1.5 text-xs shadow-sm cursor-pointer">
                    <i class="fa-solid fa-download"></i> Download
                </button>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12 text-gray-400 bg-white rounded-2xl border border-gray-100">
            Belum ada data anggota di database.
        </div>
        @endforelse
    </div>
</div>

<!-- Script JavaScript untuk Print Kartu Satuan -->
<script>
    // Fungsi untuk mencetak satu kartu spesifik
    function printSingleCard(cardId) {
        document.body.classList.add('is-single-print'); // Aktifkan mode satuan
        document.querySelectorAll('.card-item').forEach(el => el.classList.remove('printing'));
        const selectedCard = document.getElementById(cardId);
        selectedCard.classList.add('printing');
        window.print();
    }

    // Fungsi untuk mencetak semua kartu
    function printAllCards() {
        document.body.classList.remove('is-single-print'); // Matikan mode satuan (tampilkan semua)
        document.querySelectorAll('.card-item').forEach(el => el.classList.remove('printing'));
        window.print();
    }
</script>
@endsection