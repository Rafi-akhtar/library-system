@extends('layouts.admin')

@section('title', 'Wishlist Saya')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Wishlist Saya</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($wishlists as $item)
        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col">

        <div class="h-64 w-full bg-slate-100 relative overflow-hidden flex items-center justify-center">
            @if(!empty($item->book->cover))
                <img src="{{ asset($item->book->cover) }}" alt="{{ $item->book->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            @else
            <div class="flex flex-col items-center justify-center text-[#8FA89B]">
                <i class="fa-solid fa-book-open text-4xl mb-2"></i>
                <span class="text-xs text-gray-400">Tidak ada cover</span>
            </div>
            @endif
        </div>

            <h4 class="font-bold text-gray-800 mb-1 truncate">{{ $item->book->judul }}</h4>
            <p class="text-xs text-gray-500 mb-4">Penulis: {{ $item->book->penulis }}</p>

            <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST" class="mt-auto">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-50 text-red-600 hover:bg-red-100 py-2 rounded-xl text-xs font-bold transition">
                    <i class="fa-solid fa-trash mr-1"></i> Hapus dari Wishlist
                </button>
            </form>
        </div>
        @empty
        <div class="col-span-full py-12 text-center text-gray-400">
            <i class="fa-solid fa-heart-broken text-4xl mb-3"></i>
            <p>Belum ada buku di wishlist Anda.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection