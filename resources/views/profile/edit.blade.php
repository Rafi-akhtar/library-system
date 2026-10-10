@extends('layouts.admin')

@section('title', 'Profil Anggota')
@section('header-title', 'Profil & Kartu Tanda Anggota')

@section('content')
<div class="max-w-4xl space-y-8">

    <!-- FITUR CETAK KTA (KARTU TANDA ANGGOTA) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-6">
        <div class="flex justify-between items-center border-b border-gray-100 pb-4">
            <h4 class="font-bold text-gray-800 text-base flex items-center gap-2">
                <i class="fa-solid fa-id-card text-emerald-600"></i> Kartu Tanda Anggota (KTA) Digital
            </h4>
            <button onclick="window.print()" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-xs font-semibold shadow-sm transition flex items-center gap-2">
                <i class="fa-solid fa-print"></i> Cetak Kartu KTA
            </button>
        </div>

        <!-- TAMPILAN KARTU KTA -->
        <div class="flex justify-center py-4">
            <div id="printable-card" class="w-full max-w-md bg-gradient-to-br from-slate-900 via-slate-800 to-emerald-950 text-white rounded-3xl p-6 shadow-xl border border-slate-700 relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-emerald-500/20 rounded-full blur-2xl"></div>
                
                <!-- Header Kartu -->
                <div class="flex justify-between items-start border-b border-slate-700/80 pb-4 relative z-10">
                    <div class="flex items-center gap-2.5">
                        <div class="bg-emerald-500 p-2 rounded-xl text-white shadow">
                            <i class="fa-solid fa-book-open text-lg"></i>
                        </div>
                        <div>
                            <h5 class="font-extrabold text-sm tracking-wider uppercase">E-Library</h5>
                            <p class="text-[10px] text-emerald-400 font-medium">Perpustakaan Digital Modern</p>
                        </div>
                    </div>
                    <span class="bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">
                        Member Aktif
                    </span>
                </div>

                <div class="flex items-center gap-5 py-6 relative z-10">
                    <div class="h-20 w-20 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center font-black text-white text-3xl shadow-lg border-2 border-white/20 shrink-0">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    
                    <div class="space-y-1.5 overflow-hidden">
                        <div>
                            <span class="text-[10px] text-slate-400 uppercase tracking-wider block font-semibold">Nama Lengkap</span>
                            <h4 class="font-bold text-base text-white truncate">{{ Auth::user()->name }}</h4>
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-400 uppercase tracking-wider block font-semibold">Email Terdaftar</span>
                            <p class="text-xs text-slate-300 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-400 uppercase tracking-wider block font-semibold">ID Anggota</span>
                            <p class="text-xs font-mono text-emerald-400 font-bold">LIB-2026-{{ str_pad(Auth::user()->id, 4, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-700/80 flex justify-between items-center text-[10px] text-slate-400 relative z-10">
                    <span>Berlaku Selama Menjadi Anggota</span>
                    <span class="font-bold text-emerald-400">Official Member</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-6">
        <h4 class="font-bold text-gray-800 text-base border-b border-gray-100 pb-4">
            <i class="fa-solid fa-user-pen text-emerald-600 mr-2"></i> Perbarui Informasi Profil
        </h4>
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-6">
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    #printable-card, #printable-card * {
        visibility: visible;
    }
    #printable-card {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        max-width: 400px;
        box-shadow: none !important;
        border: 1px solid #cbd5e1 !important;
    }
}
</style>
@endsection